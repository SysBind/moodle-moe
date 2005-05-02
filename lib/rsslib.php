<?php  // $Id$
       // This file contains all the common stuff to be used in RSS System

//This function returns the icon (from theme) with the link to rss/file.php
function rss_get_link($courseid, $userid, $modulename, $id, $tooltiptext='') {

    global $CFG, $USER;

    static $pixpath = '';
    static $rsspath = '';

    //In site course, if no logged (userid), use admin->id. Bug 2048.
    if ($courseid == SITEID and empty($userid)) {
        $admin = get_admin();
        $userid = $admin->id;
    }

    if ($CFG->slasharguments) {
        $rsspath = "$CFG->wwwroot/rss/file.php/$courseid/$userid/$modulename/$id/rss.xml";
    } else {
        $rsspath = "$CFG->wwwroot/rss/file.php?file=/$courseid/$userid/$modulename/$id/rss.xml";
    }

    $rsspix = $CFG->pixpath .'/i/rss.gif';

    return '<a href="'. $rsspath .'"><img src="'. $rsspix .'" title="'. strip_tags($tooltiptext) .'" alt="" /></a>';

}

//This function prints the icon (from theme) with the link to rss/file.php
function rss_print_link($courseid, $userid, $modulename, $id, $tooltiptext='') {

    print rss_get_link($courseid, $userid, $modulename, $id, $tooltiptext);

}
//This function iterates over each module in the server to see if
//it supports generating rss feeds, searching for a MODULENAME_rss_feeds()
//function and invoking it foreach activity as necessary
function cron_rss_feeds () {

    global $CFG;

    $status = true;
   
    mtrace('    Generating rssfeeds...');

    //Check for required functions...
    if(!function_exists('utf8_encode')) {
        mtrace('        ERROR: You need to add XML support to your PHP installation!');
        return true;
    }

    if ($allmods = get_records('modules') ) {
        foreach ($allmods as $mod) {
            mtrace('        '.$mod->name.': ', '');
            $modname = $mod->name;
            $modfile = "$CFG->dirroot/mod/$modname/rsslib.php";
            //If file exists and we have selected to restore that type of module
            if (file_exists($modfile)) {
                include_once($modfile);
                $generaterssfeeds = $modname.'_rss_feeds';
                if (function_exists($generaterssfeeds)) {
                    if ($status) {
                        mtrace('generating ', '');;
                        $status = $generaterssfeeds();
                        if (!empty($status)) {
                            mtrace('...OK');
                        } else {
                            mtrace('...FAILED');
                        }
                    } else {
                        mtrace('...SKIPPED (failed above)');
                    }
                } else {
                    mtrace('...NOT SUPPORTED (function)');
                }
            } else {
                mtrace('...NOT SUPPORTED (file)');
            }
        }
    }
    mtrace('    Ending  rssfeeds...', '');
    if (!empty($status)) {
        mtrace('...OK');
    } else {
        mtrace('...FAILED');
    }

    return $status;
}

//This function saves to file the rss feed specified in the parameters
function rss_save_file ($modname, $mod, $result) {
 
    global $CFG;
    
    $status = true;

    if (! $basedir = make_upload_directory ('rss/'. $modname)) {
        //Cannot be created, so error
        $status = false;
    }

    if ($status) {
        $file = rss_file_name($modname, $mod);
        $rss_file = fopen($file, "w");
        if ($rss_file) {
            $status = fwrite ($rss_file, $result);
            fclose($rss_file);
        } else {
            $status = false;
        }
    }
    return $status;
}


function rss_file_name($modname, $mod) {
    global $CFG;

    return "$CFG->dataroot/rss/$modname/$mod->id.xml";
}

//This function return all the common headers for every rss feed in the site
function rss_standard_header($title = NULL, $link = NULL, $description = NULL) {

    global $CFG, $USER;

    static $pixpath = '';

    $status = true;
    $result = "";

    if (!$site = get_site()) {
        $status = false;
    }

    if ($status) {

        //Calculate title, link and description
        if (empty($title)) {
            $title = $site->fullname;
        }
        if (empty($link)) {
            $link = $CFG->wwwroot;
        }
        if (empty($description)) {
            $description = $site->summary;
        }

        //xml headers
        $result .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $result .= "<rss version=\"2.0\">\n";

        //open the channel
        $result .= rss_start_tag('channel', 1, true);

        //write channel info
        $result .= rss_full_tag('title', 2, false, $title);
        $result .= rss_full_tag('link', 2, false, $link);
        $result .= rss_full_tag('description', 2, false, $description);
        if (!empty($USER->lang)) {
            $result .= rss_full_tag('language', 2, false, substr($USER->lang,0,2));
        }
        $today = getdate();
        $result .= rss_full_tag('copyright', 2, false, '&copy; '. $today['year'] .' '. $site->fullname);
        if (!empty($USER->email)) {
            $result .= rss_full_tag('managingEditor', 2, false, $USER->email);
            $result .= rss_full_tag('webMaster', 2, false, $USER->email);
        }

        //write image info
        $rsspix = $CFG->pixpath."/i/rsssitelogo.gif";

        //write the info 
        $result .= rss_start_tag('image', 2, true);
        $result .= rss_full_tag('url', 3, false, $rsspix);
        $result .= rss_full_tag('title', 3, false, 'moodle');
        $result .= rss_full_tag('link', 3, false, $CFG->wwwroot);
        $result .= rss_full_tag('width', 3, false, '140');
        $result .= rss_full_tag('height', 3, false, '35');
        $result .= rss_end_tag('image', 2, true);
    }

    if (!$status) {
        return false;
    } else {
        return $result;
    }
}

//This function returns the rss XML code for every item passed in the array
//item->title: The title of the item
//item->author: The author of the item. Optional !!
//item->pubdate: The pubdate of the item
//item->link: The link url of the item
//item->description: The content of the item
function rss_add_items($items) {

    global $CFG;
        
    $result = '';

    if (!empty($items)) {
        foreach ($items as $item) {
            $result .= rss_start_tag('item',2,true);
            $result .= rss_full_tag('title',3,false,$item->title);
            $result .= rss_full_tag('link',3,false,$item->link);
            $result .= rss_full_tag('pubDate',3,false,date('r',$item->pubdate));
            //Include the author if exists 
            if (isset($item->author)) {
                //$result .= rss_full_tag('author',3,false,$item->author);
                //We put it in the description instead because it's more important 
                //for moodle than most other feeds, and most rss software seems to ignore
                //the author field ...
                $item->description = get_string('byname','',$item->author).'. &nbsp;<p>'.$item->description.'</p>';
            }
            $result .= rss_full_tag('description',3,false,$item->description);
            $result .= rss_end_tag('item',2,true);

        }
    } else {
        $result = false;
    }
    return $result;
}

//This function return all the common footers for every rss feed in the site
function rss_standard_footer($title = NULL, $link = NULL, $description = NULL) {

    global $CFG, $USER;

    $status = true;
    $result = '';

    //Close the chanel
    $result .= rss_end_tag('channel', 1, true);
    ////Close the rss tag
    $result .= '</rss>';

    return $result;
}

//This function return an error xml file (string)
//to be sent when a rss is required (file.php)
//and something goes wrong
function rss_geterrorxmlfile() {

    global $CFG;

    $return = '';

    //XML Header
    $return = rss_standard_header();

    //XML item 
    if ($return) {
        $item->title = "RSS Error";
        $item->link = $CFG->wwwroot;
        $item->pubdate = time();
        $item->description = get_string("rsserror");
        $return .= rss_add_items(array($item));
    }

    //XML Footer
    if ($return) {
        $return .= rss_standard_footer();
    }
    
    return $return;
}

// ===== This function are used to write XML tags =========
// [stronk7]: They are similar to the glossary export and backup generation
// but I've replicated them here because they have some minor
// diferences. Someday all they should go to a common place.

//Return the xml start tag
function rss_start_tag($tag,$level=0,$endline=false) {
    if ($endline) {
       $endchar = "\n";
    } else {
       $endchar = "";
    }
    return str_repeat(" ",$level*2)."<".$tag.">".$endchar;
}

//Return the xml end tag
function rss_end_tag($tag,$level=0,$endline=true) {
    if ($endline) {
       $endchar = "\n";
    } else {
       $endchar = "";
    }
    return str_repeat(" ",$level*2)."</".$tag.">".$endchar;
}

//Return the start tag, the contents and the end tag
function rss_full_tag($tag,$level=0,$endline=true,$content,$to_utf=true) {
    //Here we encode absolute links
    $st = rss_start_tag($tag,$level,$endline);
    $co="";
    if ($to_utf) {
        $co = preg_replace("/\r\n|\r/", "\n", utf8_encode(htmlspecialchars($content)));
    } else {
        $co = preg_replace("/\r\n|\r/", "\n", htmlspecialchars($content));
    }
    $et = rss_end_tag($tag,0,true);
    return $st.$co.$et;
}

//////////////////// LIBRARY FUNCTIONS FOR RSS_CLIENT BLOCK ////////////////

//initialize default config vars for rss_client block if needed
if (!isset($CFG->block_rss_client_submitters) ) {
    $CFG->block_rss_client_submitters = 1; //default to admin only
}
if (empty($CFG->block_rss_client_num_entries) ) {
    $CFG->block_rss_client_num_entries = 5; //default to 5 entries per block
}
if (!isset($CFG->block_rss_timeout) ) {
    $CFG->block_rss_timeout = 30;
}

// Defines for moodle's use of magpierss classes
define('MAGPIE_DIR', $CFG->dirroot.'/lib/magpie/');
define('MAGPIE_CACHE_DIR', $CFG->dataroot .'/cache/rsscache');
define('MAGPIE_CACHE_ON', true); //might want to expose as an admin config option, but perhaps this is something that should truly just be on unless the code is tweaked
define('MAGPIE_CACHE_FRESH_ONLY', false); //should be exposed as an admin config option
define('MAGPIE_CACHE_AGE', $CFG->block_rss_timeout);
if ($CFG->debug) {
    define('MAGPIE_DEBUG', true);
} else {
    define('MAGPIE_DEBUG', false);
}

// defines for config var block_rss_client_submitters
define('SUBMITTERS_ALL_ACCOUNT_HOLDERS', 0);
define('SUBMITTERS_ADMIN_ONLY', 1);
define('SUBMITTERS_ADMIN_AND_TEACHER', 2);

/**
 * @param int $rssid .
 */
function rss_display_feeds($rssid='none') {
    global $db, $USER, $CFG;
    global $blogid; //hackish, but if there is a blogid it would be good to preserve it

    $rsspix = $CFG->pixpath .'/i/rss.gif';

    $closeTable = false;
    if ($rssid != 'none'){
        $feeds = get_records('block_rss_client', 'id', $rssid);
    } else {
        $feeds = get_records('block_rss_client');
    }
    
    if ($feeds){
        $closeTable = true;
        ?>
            <table width="100%" cellpadding="8">
            <tr class="forumpostheadertopic">
                <td><?php print_string('block_rss_feed', 'block_rss_client'); ?></td>
                <td><?php print_string('edit'); ?></td>
                <td><?php print_string('delete'); ?></td>
            </tr>
        <?php
        foreach ($feeds as $feed) {
            $editString = '&nbsp;';
            $deleteString = '&nbsp;';
            if ($feed->userid == $USER->id || isadmin()) {
                $editString = '<a href="'. $CFG->wwwroot .'/blocks/rss_client/block_rss_client_action.php?act=rss_edit&rssid='. $feed->id .'&blogid='. $blogid .'">';
                $editString .= '<img src="'. $CFG->pixpath .'/t/edit.gif" alt="'. get_string('edit');
                $editString .= '" title="'. get_string('edit') .'" align="absmiddle" height="16" width="16" border="0" /></a>';

                $deleteString = '<a href="'. $CFG->wwwroot .'/blocks/rss_client/block_rss_client_action.php?act=delfeed&rssid='. $feed->id;
                $deleteString .= '&blogid='. $blogid .'" onClick="return confirm(\''. get_string('block_rss_delete_feed_confirm', 'block_rss_client') .'\');">';
                $deleteString .= '<img src="'. $CFG->pixpath .'/t/delete.gif" alt="'. get_string('delete');
                $deleteString .= '" title="'. get_string('delete') .'" align="absmiddle" border="0" /></a>';
            }
            if (!empty($feed->preferredtitle)) {
                $feedtitle = stripslashes_safe($feed->preferredtitle);
            } else {
                $feedtitle =  stripslashes_safe($feed->title);
            }            
            print '<tr class="forumpostmessage"><td><strong><a href="'. $CFG->wwwroot .'/blocks/rss_client/block_rss_client_action.php?act=view&rssid=';
            print $feed->id .'&blogid='. $blogid .'">'. $feedtitle .'</a></strong><br />' ."\n";
            print '<a href="'. $feed->url .'">'. $feed->url .'</a><br />'."\n";
            print $feed->description .'<br />' ."\n";
            print '</td>';
            print '<td align="center">'. $editString .'</td>' ."\n";
            print '<td align="center">'. $deleteString .'</td>' ."\n";
            print '</tr>'."\n";
        }
    }
    if ($closeTable){
        print '</table>'."\n";
    }
}

/**
 *   translates HTML special characters back to ASCII
 * RSS feeds may have encoded html commands which we want to translate properly
 * to display as intended rather than as source (html script visible in feed)
 * This function taken from Simplog - www.simplog.net
 */
function rss_unhtmlentities($string) {
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return strtr ($string, $trans_tbl);
}
?>
