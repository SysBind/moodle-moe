<?PHP  // $Id$
/// Extended by Michael Schneider
/// This page prints a particular instance of wiki

    require_once("../../config.php");
    require_once("lib.php");
#    require_once("$CFG->dirroot/course/lib.php"); // For side-blocks

    optional_variable($ewiki_action,"");     // Action on Wiki-Page
    optional_variable($id);     // Course Module ID, or
    optional_variable($wid);    // Wiki ID
    optional_variable($wikipage, false);     // Wiki Page Name
    optional_variable($q,"");    // Search Context
    optional_variable($userid);     // User wiki.
    optional_variable($groupid);    // Group wiki.
    optional_variable($canceledit,"");    // Editing has been cancelled
    if($canceledit) {
      $wikipage=$ewiki_id;
    }

    if ($id) {
        if (! $cm = get_record("course_modules", "id", $id)) {
            error("Course Module ID was incorrect");
        }

        if (! $course = get_record("course", "id", $cm->course)) {
            error("Course is misconfigured");
        }

        if (! $wiki = get_record("wiki", "id", $cm->instance)) {
            error("Course module is incorrect");
        }

    } else {
        if (! $wiki = get_record("wiki", "id", $wid)) {
            error("Course module is incorrect");
        }
        if (! $course = get_record("course", "id", $wiki->course)) {
            error("Course is misconfigured");
        }
        if (! $cm = get_coursemodule_from_instance("wiki", $wiki->id, $course->id)) {
            error("Course Module ID was incorrect");
        }
        $id = $cm->id;
        $_REQUEST["id"] = $id;
    }

    if ($course->category or !empty($CFG->forcelogin)) {
        require_login($course->id);
    }

    /// Add the course module 'groupmode' to the wiki object, for easy access.
    $wiki->groupmode = $cm->groupmode;

    /// If the wiki entry doesn't exist, can this user create it?

    if (($wiki_entry = wiki_get_entry($wiki, $course, $userid, $groupid)) === false) {

        if (wiki_can_add_entry($wiki, $USER, $course, $userid, $groupid)) {
            wiki_add_entry($wiki, $course, $userid, $groupid);
            if (($wiki_entry = wiki_get_entry($wiki, $course, $userid, $groupid)) === false) {
                error("Could not add wiki entry.");
            }
        }
        else {
            $wiki_entry_text = '<div align="center">'.get_string('nowikicreated', 'wiki').'</div>';
        }
    }

    /// How shall we display the wiki-page ?
    $moodle_format=FORMAT_MOODLE;

    ### SAVE ID from Moodle
    $moodleID=@$_REQUEST["id"];
    if ($wiki_entry) {
        
///     The wiki_entry->pagename is set to the specified value of the wiki,
///     or the default value in the 'lang' file if the specified value was empty.
        define("EWIKI_PAGE_INDEX",$wiki_entry->pagename);

        $wikipage = ($wikipage === false) ?  EWIKI_PAGE_INDEX: $wikipage;
//////


///     ################# EWIKI Part ###########################

///     ### Prevent ewiki getting id as PageID...
        unset($_REQUEST["id"]);
        unset($_GET["id"]);
        unset($_POST["id"]);
        unset($_POST["id"]);
        unset($_SERVER["QUERY_STRING"]);
        unset($HTTP_GET_VARS["id"]);
        unset($HTTP_POST_VARS["id"]);
        global $ewiki_title;

///     #-- predefine some of the configuration constants
        define("EWIKI_NAME", $wiki_entry->pagename);

        /// Search Hilighting
        if($ewiki_title=="SearchPages") {
            $qArgument="&q=".urlencode($q);
        }
 
        /// Build the ewsiki script constant
        /// ewbase will also be needed by EWIKI_SCRIPT_BINARY
        $ewbase = $ME.'?id='.$moodleID;
        if (isset($userid)) $ewbase .= '&userid='.$userid;
        if (isset($groupid)) $ewbase .= '&groupid='.$groupid;
        $ewscript = $ewbase.'&wikipage=';
        define("EWIKI_SCRIPT", $ewscript);

        /// # Settings for this specific Wiki
        define("EWIKI_PRINT_TITLE", $wiki->ewikiprinttitle);

        define("EWIKI_INIT_PAGES", wiki_content_dir($wiki));

///     # fix broken PHP setup
        if (!function_exists("get_magic_quotes_gpc") || get_magic_quotes_gpc()) {
            include($CFG->dirroot."/mod/wiki/ewiki/fragments/strip_wonderful_slashes.php");
        }
        if (ini_get("register_globals")) {
            #    include($CFG->dirroot."/mod/wiki/ewiki/fragments/strike_register_globals.php");
        }

        # Database Handler
        include_once($CFG->dirroot."/mod/wiki/ewikimoodlelib.php");
        # Plugins
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/email_protect.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/patchsaving.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/notify.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/feature/imgresize_gd.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/moodle_highlight.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/f_fixhtml.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/aview/backlinks.php");
        #include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/markup/css.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/markup/footnotes.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/action/diff.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/page/pageindex.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/page/orphanedpages.php");
        include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/wantedpages.php");

        # Binary Handling
        if($wiki->ewikiacceptbinary) {
            define("EWIKI_UPLOAD_MAXSIZE", get_max_upload_file_size());
            define("EWIKI_SCRIPT_BINARY", $ewbase."&binary=");
            define("EWIKI_ALLOW_BINARY",1);
            define("EWIKI_IMAGE_CACHING",1);
            #define("EWIKI_AUTOVIEW",1);
            include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/lib/mime_magic.php");
            include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/aview/downloads.php");
            include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/downloads.php");
            #include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/db/binary_store.php");
            include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/moodle_binary_store.php");
        } else {
            define("EWIKI_SCRIPT_BINARY", 0);
            define("EWIKI_ALLOW_BINARY",0);
        }

        # The mighty Wiki itself
        include_once($CFG->dirroot."/mod/wiki/ewiki/ewiki.php");

        # Language-stuff: eWiki gets language from Browser. Lets correct it. Empty arrayelements do no harm
        $ewiki_t["languages"]=array(current_language(), $course->lang, $CFG->lang,"en","c");

        # Check Access Rights
        $canedit = wiki_can_edit_entry($wiki_entry, $wiki, $USER, $course);
        if (!$canedit) {
            # Protected Mode
            unset($ewiki_plugins["action"]["edit"]);
            unset($ewiki_plugins["action"]["info"]);
        }

        # HTML Handling
        $ewiki_use_editor=0;
        if($wiki->htmlmode == 0) {
            # No HTML
            $ewiki_config["htmlentities"]=array(); // HTML is managed by moodle
            $moodle_format=FORMAT_TEXT;
        }
        if($wiki->htmlmode == 1) {
            # Safe HTML
            include_once($CFG->dirroot."/mod/wiki/ewiki/plugins/moodle/moodle_rescue_html.php");
            $moodle_format=FORMAT_HTML;
        }
        if($wiki->htmlmode == 2) {
            # HTML Only 
            $moodle_format=FORMAT_HTML;
            $ewiki_use_editor=1;
            $ewiki_config["htmlentities"]=array(); // HTML is allowed
            $ewiki_config["wiki_link_regex"] = "\007 [!~]?(
            			\#?\[[^<>\[\]\n]+\] |
            			\^[-".EWIKI_CHARS_U.EWIKI_CHARS_L."]{3,} |
            			\b([\w]{3,}:)*([".EWIKI_CHARS_U."]+[".EWIKI_CHARS_L."]+){2,}\#?[\w\d]* |
            			\w[-_.+\w]+@(\w[-_\w]+[.])+\w{2,}	) \007x";
        }

        global $ewiki_author, $USER;
        $ewiki_author=fullname($USER);
        $content=ewiki_page($wikipage);

        ### RESTORE ID from Moodle
        $_REQUEST["id"]=$moodleID;
        $id=$moodleID;
///     ################# EWIKI Part ###########################
    }
    else {
        $content = $wiki_entry_text;
    }


/// Moodle Log
    add_to_log($course->id, "wiki", $ewiki_action, "view.php?id=$cm->id&groupid=$groupid&userid=$userid&wikipage=$wikipage", $wiki->name." ".$ewiki_title);


/// Print the page header
    if ($course->category) {
        $navigation = "<A HREF=\"../../course/view.php?id=$course->id\">$course->shortname</A> ->";
    }

    $strwikis = get_string("modulenameplural", "wiki");
    $strwiki  = get_string("modulename", "wiki");

    print_header("$course->shortname: $wiki_entry->pagename", "$course->fullname",
                "$navigation <A HREF=\"index.php?id=$course->id\">$strwikis</A> -> <A HREF=\"view.php?id=$moodleID\">$wiki->name</a> -> $ewiki_title",
                "", "", true, update_module_button($cm->id, $course->id, $strwiki),
                navmenu($course, $cm));


    /// Print Page

    /// The top row contains links to other wikis, if applicable.
    if ($wiki_list = wiki_get_other_wikis($wiki, $USER, $course, $wiki_entry->id)) {
        $selected="";
        if (isset($wiki_list['selected'])) {
            $selected = $wiki_list['selected'];
            unset($wiki_list['selected']);
        }
        echo '<tr><td colspan="2">';

        echo '<form name="otherwikis" action="'.$CFG->wwwroot.'/mod/wiki/view.php">';
        echo '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>';
        echo '<td class="sideblockheading" bgcolor="'.$THEME->cellheading.'">&nbsp;'
            .$WIKI_TYPES[$wiki->wtype].' '
            .get_string('modulename', 'wiki')." ".get_string('for',"wiki")." "
            .wiki_get_owner($wiki_entry).':</td>';

        echo '<td class="sideblockheading" bgcolor="'.$THEME->cellheading.'" align="right">'
            .get_string('otherwikis', 'wiki').':&nbsp;&nbsp;';
        $script = 'self.location=document.otherwikis.wikiselect.options[document.otherwikis.wikiselect.selectedIndex].value';
        choose_from_menu($wiki_list, "wikiselect", $selected, "choose", $script);
        echo '</td>';        
        echo '</tr></table>';
        echo '</form>';

        echo '</td>';
        echo '</tr>';
    }

    if ($wiki_entry) {
        $specialpages=array("SearchPages", "PageIndex","NewestPages","MostVisitedPages","MostOftenChangedPages","UpdatedPages","FileDownload","FileUpload","OrphanedPages","WantedPages");
    /// Page Actions
        echo '<table border="0" width="100%">';
        echo '<tr>';
        
        if ($canedit) {
          $iconstr="";
          $editicon= '<img hspace=1 alt="'.get_string("editthispage","wiki").'" height=16 width=16 border=0 src="'.$CFG->pixpath.'/t/edit.gif">';
          $infoicon= '<img hspace=1 alt="'.get_string("pageinfo","wiki").'" height=16 width=16 border=0 src="'.$CFG->pixpath.'/i/info.gif">';
          if($ewiki_action!="edit" && !in_array($wikipage, $specialpages)) {          
            $iconstr='<a title="'.get_string("editthispage","wiki").'" href="'.EWIKI_SCRIPT.'&wikipage=edit/'.$ewiki_id.'">'.$editicon."</a>";
          } else {
            $iconstr=$editicon;
          }
          if($ewiki_action!="info" && !in_array($wikipage, $specialpages)) {                      
            $iconstr.='<a title="'.get_string("pageinfo","wiki").'" href="'.EWIKI_SCRIPT.'&wikipage=info/'.$ewiki_id.'">'.$infoicon."</a>";
          } else {
            $iconstr.=$infoicon;
          }
          echo "<td>$iconstr</td>";
        }

        echo '<td>';
        wiki_print_page_actions($cm->id, $specialpages, $ewiki_id, $ewiki_action, $wiki->ewikiacceptbinary, $canedit);
        echo '</td>';    

        /// Searchform
        echo '<td align="center">';    
        wiki_print_search_form($cm->id, $q, $userid, $groupid, false);
        echo '</td>';
    
        /// Internal Wikilinks
        echo '<td align="center">';
        wiki_print_wikilinks_block($cm->id,  $wiki->ewikiacceptbinary);
        echo '</td>';
    
        /// Administrative Links
        if($canedit) {
          echo '<td align="center">';          
          wiki_print_administration_actions($cm->id, $userid, $groupid, $ewiki_title, $wiki->htmlmode!=2);
          echo '</td>';
        }
        
        /// Formatting Rules
        if($wiki->htmlmode!=2) {
          echo '<td align="center">';          
          helpbutton('wikiusage', get_string('wikiusage', 'wiki'), 'wiki');
          echo get_string("wikiusage","wiki");
          echo '</td>';
        }
        
        echo '</tr></table>';
    }

    // The wiki Summary (Closes Bug #1496)
    if($ewiki_title==$wiki_entry->pagename && !empty($wiki->summary)) {
      print "<br>";
      print_simple_box(format_text($wiki->summary, FORMAT_HTML), "center", "100%");
      print "<br>";
    }
    
    
    // The wiki Contents
    print_simple_box_start( "center", "100%", "$THEME->cellcontent", "20");
    if($ewiki_action=="edit") {
      # When editing, the filters shall not interfere the wiki-source
      print $content;
    } else {
      print(format_text($content, $moodle_format));
    }
    print_simple_box_end();

/// Finish the page
    print_footer($course);
?>