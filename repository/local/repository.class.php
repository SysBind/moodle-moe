<?php
/**
 * repository_local class
 * This is a subclass of repository class
 *
 * @version $Id$
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

/**
 *
 */
class repository_local extends repository {

    /**
     *
     * @global <type> $SESSION
     * @global <type> $action
     * @global <type> $CFG
     * @param <type> $repositoryid
     * @param <type> $context
     * @param <type> $options
     */
    public function __construct($repositoryid, $context = SITEID, $options = array()) {
        global $SESSION, $action, $CFG;
        parent::__construct($repositoryid, $context, $options);
        // TODO:
        // get the parameter from client side
        // $this->context can be used here.
        // When user upload a file, $action == 'upload'
        // You can use $_FILES to find that file
    }

    /**
     *
     * @global <type> $SESSION
     * @param <type> $ajax
     * @return <type>
     */
    public function print_login($ajax = true) {
        global $SESSION;
        // TODO
        // Return file list in moodle
        return $this->get_listing();
    }

    /**
     *
     * @param <type> $filearea
     * @param <type> $path
     * @param <type> $visiblename
     * @return <type>
     */
    private function _encode_path($filearea, $path, $visiblename) {
        return array('path'=>serialize(array($filearea, $path)), 'name'=>$visiblename);
    }

    /**
     *
     * @param <type> $path
     * @return <type>
     */
    private function _decode_path($path) {
        $filearea = '';
        $path = '';
        if (($file = unserialize($path)) !== false) {
            $filearea = $file[0];
            $path = $file[1];
        }
        return array('filearea' => $filearea, 'path' => $path);
    }

    /**
     *
     * @param <type> $search_text
     * @return <type>
     */
    public function search($search_text) {
        return $this->get_listing('', $search_text);
    }

    /**
     *
     * @global <type> $CFG
     * @param <type> $encodedpath
     * @param <type> $search
     * @return <type>
     */
    public function get_listing($encodedpath = '', $search = '') {
        global $CFG;
        $ret = array();

        // no login required
        $ret['nologin'] = true;
        // todo: link to file manager
        $ret['manage'] = $CFG->wwwroot .'/files/index.php'; // temporary
       
        $browser = get_file_browser();
        $itemid = null;
        $filename = null;
        $filearea = null;
        $path = '/';
        $ret['dynload'] = false;

        /// useful only if dynamic mode can be worked out.
        //if ($encodedpath != '') {
        //    list($filearea, $path) = $this->_decode_path($encodedpath);
        //}

        if ($fileinfo = $browser->get_file_info(get_system_context(), $filearea, $itemid, $path, $filename)) {
            $ret['path'] = array();
            $params = $fileinfo->get_params();
            $filearea = $params['filearea'];
            //todo: fix this call, and similar ones here and in build_tree - encoding path works only for real folders
            $ret['path'][] = $this->_encode_path($filearea, $path, $fileinfo->get_visible_name());
            if ($fileinfo->is_directory()) {
                $level = $fileinfo->get_parent();
                while ($level) {
                    $params = $level->get_params();
                    $ret['path'][] = $this->_encode_path($params['filearea'], $params['filepath'], $level->get_visible_name());
                    $level = $level->get_parent();
                }
            }
            $filecount = $this->build_tree($fileinfo, $search, $ret['dynload'], $ret['list']);
            $ret['path'] = array_reverse($ret['path']);
        } else {
            // throw some "context/filearea/item/path/file not found" exception?
        }

        if (empty($ret['list'])) {
            throw new repository_exception('emptyfilelist', 'repository_local');
        } else {
            // if using dynamic mode, only the subfolder needs be returned.
            //if ($loadroot) {
                return $ret;
            //} else {
            //    return $ret['list'];
            //}
        }
    }

    /**
     * Builds a tree of files, to be used by get_listing(). This function is 
     * then called recursively.
     *
     * @param $fileinfo an object returned by file_browser::get_file_info()
     * @param $search searched string
     * @param $dynamicmode bool no recursive call is done when in dynamic mode
     * @param $list - the array containing the files under the passed $fileinfo
     * @returns int the number of files found
     *
     * todo: take $search into account, and respect a threshold for dynamic loading
     */
    private function build_tree($fileinfo, $search, $dynamicmode, &$list) {
        global $CFG;

        $filecount = 0;
        $children = $fileinfo->get_children();

        foreach ($children as $child) {
            $filename = $child->get_visible_name();
            $filesize = $child->get_filesize();
            $filesize = $filesize ? display_size($filesize) : '';
            $filedate = $child->get_timemodified();
            $filedate = $filedate ? userdate($filedate) : '';
            $filetype = $child->get_mimetype();

            if ($child->is_directory()) {
                $path = array();
                $level = $child->get_parent();
                while ($level) {
                    $params = $level->get_params();
                    $path[] = $this->_encode_path($params['filearea'], $params['filepath'], $level->get_visible_name());
                    $level = $level->get_parent();
                }
                
                $tmp = array(
                    'title' => $child->get_visible_name(),
                    'size' => 0,
                    'date' => $filedate,
                    'path' => array_reverse($path),
                    'thumbnail' => $CFG->pixpath .'/f/folder.gif'
                );

                //if ($dynamicmode && $child->is_writable()) {
                //    $tmp['children'] = array();
                //} else {
                    // if folder name matches search, we send back all files contained.
                    $_search = $search;
                    if ($search && stristr($tmp['title'], $search) !== false) {
                        $_search = false;
                    }
                    $tmp['children'] = array();
                    $_filecount = $this->build_tree($child, $_search, $dynamicmode, $tmp['children']);
                    if ($search && $_filecount) {
                        $tmp['expanded'] = 1;
                    }

                //}
                
                if (!$search || $_filecount || (stristr($tmp['title'], $search) !== false)) {
                    $list[] = $tmp;
                    $filecount += $_filecount;
                }

            } else { // not a directory
                // skip the file, if we're in search mode and it's not a match
                if ($search && (stristr($filename, $search) === false)) {
                    continue;
                }
                $params = $child->get_params();
                $source = serialize(array($params['contextid'], $params['filearea'], $params['itemid'], $params['filepath'], $params['filename']));
                $list[] = array(
                    'title' => $filename,
                    'size' => $filesize,
                    'date' => $filedate,
                    //'source' => $child->get_url(),
                    'source' => base64_encode($source),
                    'thumbnail' => $CFG->pixpath .'/f/'. mimeinfo_from_type("icon", $filetype)
                );
                $filecount++;
            }
        }

        return $filecount;
    }

     /**
     * Download a file, this function can be overridden by
     * subclass.
     *
     * @global object $CFG
     * @param string $url the url of file
     * @param string $file save location
     * @return string the location of the file
     * @see curl package
     */
    public function get_file($url, $file = '') {
        global $CFG;
        if (!file_exists($CFG->dataroot.'/temp/download')) {
            mkdir($CFG->dataroot.'/temp/download/', 0777, true);
        }
        if (is_dir($CFG->dataroot.'/temp/download')) {
            $dir = $CFG->dataroot.'/temp/download/';
        }
        if (empty($file)) {
            $file = uniqid('repo').'_'.time().'.tmp';
        }
        if (file_exists($dir.$file)) {
            $file = uniqid('m').$file;
        }

        ///retrieve the file
        $fileparams = unserialize(base64_decode($url));
        $contextid = $fileparams[0];
        $filearea = $fileparams[1];
        $itemid = $fileparams[2];
        $filepath = $fileparams[3];
        $filename = $fileparams[4];
        $fs = get_file_storage();
        $sf = $fs->get_file($contextid, $filearea, $itemid, $filepath, $filename);
        $contents = $sf->get_content();
        $fp = fopen($dir.$file, 'w');      
        fwrite($fp,$contents);
        fclose($fp);
       
        return $dir.$file;
    }

    /**
     *
     */
    public function print_listing() {
        // will be used in non-javascript file picker
    }

    /**
     *
     * @return <type>
     */
    public function get_name(){
        return get_string('repositoryname', 'repository_local');;
    }
}
?>