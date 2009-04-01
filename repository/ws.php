<?php  // $Id$

/// The Web service script that is called from the filepicker front end

    require_once('../config.php');
    require_once('../lib/filelib.php');
    require_once('lib.php');

/// Parameters
    $page  = optional_param('page', '', PARAM_RAW);           // page
    $env   = optional_param('env', 'filepicker', PARAM_ALPHA);// opened in editor or moodleform
    $file  = optional_param('file', '', PARAM_RAW);           // file to download
    $title = optional_param('title', '', PARAM_FILE);         // new file name
    $itemid = optional_param('itemid', '', PARAM_INT);
    $action = optional_param('action', '', PARAM_ALPHA);
    $ctx_id = optional_param('ctx_id', SITEID, PARAM_INT);    // context ID
    $repo_id   = optional_param('repo_id', 1, PARAM_INT);     // repository ID
    $req_path  = optional_param('p', '', PARAM_RAW);          // path
    $callback  = optional_param('callback', '', PARAM_CLEANHTML);
    $search_text = optional_param('s', '', PARAM_CLEANHTML);

/// Headers to make it not cacheable
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

/// Check permissions
    if (! (isloggedin() && repository::check_context($ctx_id)) ) {
        $err = new stdclass;
        $err->e = get_string('nopermissiontoaccess', 'repository');
        die(json_encode($err));
    }

/// Wait as long as it takes for this script to finish
    set_time_limit(0);

/// Check for actions that do not need repository ID
    switch ($action) {
        // delete a file from filemanger
        case 'delete':
            try {
                if (!$context = get_context_instance(CONTEXT_USER, $USER->id)) {
                }
                $contextid = $context->id;
                $fs = get_file_storage();
                if ($file = $fs->get_file($contextid, 'user_draft', $itemid, '/', $title)) {
                    $file->delete();
                    echo 200;
                } else {
                    echo '';
                }
                exit;
            } catch (repository_exception $e) {
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            }
            break;
        case 'gsearch':     //  Global Search
            $repos = repository::get_instances(array(get_context_instance_by_id($ctx_id), get_system_context()));
            $list = array();
            foreach($repos as $repo){
                if ($repo->global_search()) {
                    try {
                        $ret = $repo->search($search_text);
                        array_walk($ret['list'], 'repository_attach_id', $repo->id);  // See function below
                        $tmp = array_merge($list, $ret['list']);
                        $list = $tmp;
                    } catch (repository_exception $e) {
                        $err = new stdclass;
                        $err->e = $e->getMessage();
                        die(json_encode($err));
                    }
                }
            }
            die(json_encode(array('list'=>$list)));
            break;

        case 'ccache':      // Clean cache
            $cache = new curl_cache;
            $cache->refresh();
            $action = 'list';
            break;
    }

/// Get repository instance information
    $sql = 'SELECT i.name, i.typeid, r.type FROM {repository} r, {repository_instances} i '.
           'WHERE i.id=? AND i.typeid=r.id';
    if (!$repository = $DB->get_record_sql($sql, array($repo_id))) {
        $err = new stdclass;
        $err->e = get_string('invalidrepositoryid', 'repository');
        die(json_encode($err));
    } else {
        $type = $repository->type;
    }

    if (file_exists($CFG->dirroot.'/repository/'.$type.'/repository.class.php')) {
        require_once($CFG->dirroot.'/repository/'.$type.'/repository.class.php');
        $classname = 'repository_' . $type;
        try {
            $repo = new $classname($repo_id, $ctx_id, array('ajax'=>true, 'name'=>$repository->name));
        } catch (repository_exception $e){
            $err = new stdclass;
            $err->e = $e->getMessage();
            die(json_encode($err));
        }
    } else {
        $err = new stdclass;
        $err->e = get_string('invalidplugin', 'repository', $type);
        die(json_encode($err));
    }

    if (!empty($callback)) {
        // call opener window to refresh repository
        // the callback url should be something like this:
        // http://xx.moodle.com/repository/ws.php?callback=yes&repo_id=1&sid=xxx
        // sid is the attached auth token from external source
        $js  =<<<EOD
<html><head><script type="text/javascript">
    window.opener.repository_callback($repo_id);
    window.close();
</script><body></body></html>
EOD;
        echo $js;
        die;
    }


/// These actions all occur on the currently active repository instance
    switch ($action) {
        case 'sign':
        case 'list':
            if ($repo->check_login()) {
                try {
                    echo json_encode($repo->get_listing($req_path, $page));
                } catch (repository_exception $e) {
                    $err = new stdclass;
                    $err->e = $e->getMessage();
                    die(json_encode($err));
                }
                break;
            } else {
                $action = 'login';
            }
        case 'login':
            try {
                echo json_encode($repo->print_login());
            } catch (repository_exception $e){
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            }
            break;
        case 'logout':
            echo json_encode($repo->logout());
            break;
        case 'searchform':
            $repo->print_search();
            break;
        case 'search':
            try {
                $search_result = $repo->search($search_text);
                $search_result['search_result'] = true;
                echo json_encode($search_result);
            } catch (repository_exception $e) {
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            }
            break;
        case 'download':
            $path = $repo->get_file($file, $title);
            if (empty($itemid)) {
                $itemid = (int)substr(hexdec(uniqid()), 0, 9)+rand(1,100);
            }
            try {
                if (preg_match('#(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)#', $path)) {
                    echo json_encode(array('url'=>$path, 'id'=>$path, 'file'=>$path));
                } else {
                    $info = repository::move_to_filepool($path, $title, $itemid);
                    if ($env == 'filepicker' || $env == 'filemanager'){
                        echo json_encode($info);
                    } else if ($env == 'editor') {
                        echo json_encode($info);
                    }
                }
            } catch (repository_exception $e){
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            } catch (Exception $e) {
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            }
            break;
        case 'upload':
            try {
                echo json_encode($repo->get_listing());
            } catch (repository_exception $e){
                $err = new stdclass;
                $err->e = $e->getMessage();
                die(json_encode($err));
            }
            break;
    }

/**
 * Small function to walk an array to attach repository ID
 */
function repository_attach_id(&$value, $key, $id){
    $value['repo_id'] = $id;
}
