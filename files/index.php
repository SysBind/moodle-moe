<?php // $Id$

//  Manage all uploaded files in a course file area

//  All the Moodle-specific stuff is in this top section
//  Configuration and access control occurs here.
//  Must define:  USER, basedir, baseweb, html_header and html_footer
//  USER is a persistent variable using sessions

    require("../config.php");

    $id     = required_param('id', PARAM_INT);
    $file   = optional_param('file', '');
    $wdir   = optional_param('wdir', '');
    $action = optional_param('action', '');

    if (! $course = get_record("course", "id", $id) ) {
        error("That's an invalid course id");
    }

    require_login($course->id);

    if (! isteacheredit($course->id) ) {
        error("You need to be a teacher with editing privileges");
    }

    function html_footer() {
        global $course;
        echo "</td></tr></table></body></html>";
        print_footer($course);
    }
    
    function html_header($course, $wdir, $formfield=""){

        global $CFG;

        if ($course->id == SITEID) {
            $strfiles = get_string("sitefiles");
        } else {
            $strfiles = get_string("files");
        }
    
        if ($wdir == "/") {
            $fullnav = "$strfiles";
        } else {
            $dirs = explode("/", $wdir);
            $numdirs = count($dirs);
            $link = "";
            $navigation = "";
            for ($i=1; $i<$numdirs-1; $i++) {
               $navigation .= " -> ";
               $link .= "/".urlencode($dirs[$i]);
               $navigation .= "<a href=\"index.php?id=$course->id&amp;wdir=$link\">".$dirs[$i]."</a>";
            }
            $fullnav = "<a href=\"index.php?id=$course->id&amp;wdir=/\">$strfiles</a> $navigation -> ".$dirs[$numdirs-1];
        }

        if ($course->id == SITEID) {
            print_header("$course->shortname: $strfiles", "$course->fullname", 
                         "<a href=\"../$CFG->admin/index.php\">".get_string("administration").
                         "</a> -> $fullnav", $formfield);

            print_heading(get_string("publicsitefileswarning"), "center", 2);

        } else {
            print_header("$course->shortname: $strfiles", "$course->fullname", 
                         "<a href=\"../course/view.php?id=$course->id\">$course->shortname".
                         "</a> -> $fullnav", $formfield);
        }

        echo "<table border=\"0\" align=\"center\" cellspacing=\"3\" cellpadding=\"3\" width=\"640\">";
        echo "<tr>";
        echo "<td colspan=\"2\">";
    }

    if (! $basedir = make_upload_directory("$course->id")) {
        error("The site administrator needs to fix the file permissions");
    }

    $baseweb = $CFG->wwwroot;

//  End of configuration and access control

    require("mimetypes.php");

    if (!$wdir) {
        $wdir="/";
    }

    if (($wdir != '/' and detect_munged_arguments($wdir, 0))
      or ($file != '' and detect_munged_arguments($file, 0))) {
        $message = "Error: Directories can not contain \"..\"";
        $wdir = "/";
        $action = "";
    }

    if ($wdir == "/backupdata") {
        if (! make_upload_directory("$course->id/backupdata")) {   // Backup folder
            error("Could not create backupdata folder.  The site administrator needs to fix the file permissions");
        }
    }


    switch ($action) {

        case "upload":
            html_header($course, $wdir);
            require_once($CFG->dirroot.'/lib/uploadlib.php');
                
            if (!empty($save)) {
                $um = new upload_manager('userfile',false,false,$course,false,0);
                $dir = "$basedir$wdir";
                if ($um->process_file_uploads($dir)) {
                    notify(get_string('uploadedfile'));
                }
                // um will take care of error reporting.
                displaydir($wdir);
            } else {
                $upload_max_filesize = get_max_upload_file_size($CFG->maxbytes);  // Restricted by site setting
                $filesize = display_size($upload_max_filesize);

                $struploadafile = get_string("uploadafile");
                $struploadthisfile = get_string("uploadthisfile");
                $strmaxsize = get_string("maxsize", "", $filesize);
                $strcancel = get_string("cancel");

                echo "<p>$struploadafile ($strmaxsize) --> <b>$wdir</b>";
                echo "<table><tr><td colspan=\"2\">";
                echo "<form enctype=\"multipart/form-data\" method=\"post\" action=\"index.php\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"upload\" />";
                upload_print_form_fragment(1,array('userfile'),null,false,null,$course->maxbytes,0,false);
                echo " </td><tr><td width=\"10\">";
                echo " <input type=\"submit\" name=\"save\" value=\"$struploadthisfile\" />";
                echo "</form>";
                echo "</td><td width=\"100%\">";
                echo "<form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"$strcancel\" />";
                echo "</form>";
                echo "</td></tr></table>";
            }
            html_footer();
            break;

        case "delete":
            if (!empty($confirm)) {
                html_header($course, $wdir);
                foreach ($USER->filelist as $file) {
                    $fullfile = $basedir.$file;
                    if (! fulldelete($fullfile)) {
                        echo "<br />Error: Could not delete: $fullfile";
                    }
                }
                clearfilelist();
                displaydir($wdir);
                html_footer();

            } else {
                html_header($course, $wdir);
                if (setfilelist($_POST)) {
                    echo "<p align=\"center\">".get_string("deletecheckwarning").":</p>";
                    print_simple_box_start("center");
                    printfilelist($USER->filelist);
                    print_simple_box_end();
                    echo "<br />";
                    notice_yesno (get_string("deletecheckfiles"), 
                                "index.php?id=$id&amp;wdir=$wdir&amp;action=delete&amp;confirm=1",
                                "index.php?id=$id&amp;wdir=$wdir&amp;action=cancel");
                } else {
                    displaydir($wdir);
                }
                html_footer();
            }
            break;

        case "move":
            html_header($course, $wdir);
            if ($count = setfilelist($_POST)) {
                $USER->fileop     = $action;
                $USER->filesource = $wdir;
                echo "<p align=\"center\">";
                print_string("selectednowmove", "moodle", $count);
                echo "</p>";
            }
            displaydir($wdir);
            html_footer();
            break;

        case "paste":
            html_header($course, $wdir);
            if (isset($USER->fileop) and $USER->fileop == "move") {
                foreach ($USER->filelist as $file) {
                    $shortfile = basename($file);
                    $oldfile = $basedir.$file;
                    $newfile = $basedir.$wdir."/".$shortfile;
                    if (!rename($oldfile, $newfile)) {
                        echo "<p>Error: $shortfile not moved";
                    }
                }
            }
            clearfilelist();
            displaydir($wdir);
            html_footer();
            break;

        case "rename":
            if (!empty($name)) {
                html_header($course, $wdir);
                $name    = clean_filename($name);
                $oldname = clean_filename($oldname);
                if (file_exists($basedir.$wdir."/".$name)) {
                    echo "Error: $name already exists!";
                } else if (!rename($basedir.$wdir."/".$oldname, $basedir.$wdir."/".$name)) {
                    echo "Error: could not rename $oldname to $name";
                }
                displaydir($wdir);
                    
            } else {
                $strrename = get_string("rename");
                $strcancel = get_string("cancel");
                $strrenamefileto = get_string("renamefileto", "moodle", $file);
                html_header($course, $wdir, "form.name");
                echo "<p>$strrenamefileto:";
                echo "<table><tr><td>";
                echo "<form action=\"index.php\" method=\"post\" name=\"form\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"rename\" />";
                echo " <input type=\"hidden\" name=\"oldname\" value=\"$file\" />";
                echo " <input type=\"text\" name=\"name\" size=\"35\" value=\"$file\" />";
                echo " <input type=\"submit\" value=\"$strrename\" />";
                echo "</form>";
                echo "</td><td>";
                echo "<form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"$strcancel\" />";
                echo "</form>";
                echo "</td></tr></table>";
            }
            html_footer();
            break;

        case "mkdir":
            if (!empty($name)) {
                html_header($course, $wdir);
                $name = clean_filename($name);
                if (file_exists("$basedir$wdir/$name")) {
                    echo "Error: $name already exists!";
                } else if (! make_upload_directory("$course->id/$wdir/$name")) {
                    echo "Error: could not create $name";
                }
                displaydir($wdir);
                    
            } else {
                $strcreate = get_string("create");
                $strcancel = get_string("cancel");
                $strcreatefolder = get_string("createfolder", "moodle", $wdir);
                html_header($course, $wdir, "form.name");
                echo "<p>$strcreatefolder:";
                echo "<table><tr><td>";
                echo "<form action=\"index.php\" method=\"post\" name=\"form\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"mkdir\" />";
                echo " <input type=\"text\" name=\"name\" size=\"35\" />";
                echo " <input type=\"submit\" value=\"$strcreate\" />";
                echo "</form>";
                echo "</td><td>";
                echo "<form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"$strcancel\" />";
                echo "</form>";
                echo "</td></tr></table>";
            }
            html_footer();
            break;

        case "edit":
            html_header($course, $wdir);
            if (isset($text)) {
                $fileptr = fopen($basedir.$file,"w");
                fputs($fileptr, stripslashes($text));
                fclose($fileptr);
                displaydir($wdir);
                    
            } else {
                $streditfile = get_string("edit", "", "<b>$file</b>");
                $fileptr  = fopen($basedir.$file, "r");
                $contents = fread($fileptr, filesize($basedir.$file));
                fclose($fileptr);

                if (mimeinfo("type", $file) == "text/html") {
                    $usehtmleditor = can_use_html_editor();
                } else {
                    $usehtmleditor = false;
                }
                $usehtmleditor = false;    // Always keep it off for now

                print_heading("$streditfile");

                echo "<table><tr><td colspan=\"2\">";
                echo "<form action=\"index.php\" method=\"post\" name=\"form\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"file\" value=\"$file\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"edit\" />";
                print_textarea($usehtmleditor, 25, 80, 680, 400, "text", $contents);
                echo "</td></tr><tr><td>";
                echo " <input type=\"submit\" value=\"".get_string("savechanges")."\" />";
                echo "</form>";
                echo "</td><td>";
                echo "<form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"".get_string("cancel")."\" />";
                echo "</form>";
                echo "</td></tr></table>";

                if ($usehtmleditor) { 
                    use_html_editor();
                }


            }
            html_footer();
            break;

        case "zip":
            if (!empty($name)) {
                html_header($course, $wdir);
                $name = clean_filename($name);

                $files = array();
                foreach ($USER->filelist as $file) {
                   $files[] = "$basedir/$file";
                }

                if (!zip_files($files,"$basedir/$wdir/$name")) {
                    error(get_string("zipfileserror","error"));
                }

                clearfilelist();
                displaydir($wdir);
                    
            } else {
                html_header($course, $wdir, "form.name");

                if (setfilelist($_POST)) {
                    echo "<p align=\"center\">".get_string("youareabouttocreatezip").":</p>";
                    print_simple_box_start("center");
                    printfilelist($USER->filelist);
                    print_simple_box_end();
                    echo "<br />";
                    echo "<p align=\"center\">".get_string("whattocallzip");
                    echo "<table><tr><td>";
                    echo "<form action=\"index.php\" method=\"post\" name=\"form\">";
                    echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                    echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                    echo " <input type=\"hidden\" name=\"action\" value=\"zip\" />";
                    echo " <input type=\"text\" name=\"name\" size=\"35\" value=\"new.zip\" />";
                    echo " <input type=\"submit\" value=\"".get_string("createziparchive")."\" />";
                    echo "</form>";
                    echo "</td><td>";
                    echo "<form action=\"index.php\" method=\"get\">";
                    echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                    echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                    echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                    echo " <input type=\"submit\" value=\"".get_string("cancel")."\" />";
                    echo "</form>";
                    echo "</td></tr></table>";
                } else {
                    displaydir($wdir);
                    clearfilelist();
                }
            }
            html_footer();
            break;

        case "unzip":
            html_header($course, $wdir);
            if (!empty($file)) {
                $strok = get_string("ok");
                $strunpacking = get_string("unpacking", "", $file);

                echo "<p align=\"center\">$strunpacking:</p>";

                $file = basename($file);

                if (!unzip_file("$basedir/$wdir/$file")) {
                    error(get_string("unzipfileserror","error"));
                }

                echo "<center><form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"$strok\" />";
                echo "</form>";
                echo "</center>";
            } else {
                displaydir($wdir);
            }
            html_footer();
            break;

        case "listzip":
            html_header($course, $wdir);
            if (!empty($file)) {
                $strname = get_string("name");
                $strsize = get_string("size");
                $strmodified = get_string("modified");
                $strok = get_string("ok");
                $strlistfiles = get_string("listfiles", "", $file);

                echo "<p align=\"center\">$strlistfiles:</p>";
                $file = basename($file);

                include_once("$CFG->libdir/pclzip/pclzip.lib.php");
                $archive = new PclZip(cleardoubleslashes("$basedir/$wdir/$file"));
                if (!$list = $archive->listContent(cleardoubleslashes("$basedir/$wdir"))) {
                    notify($archive->errorInfo(true));

                } else {
                    echo "<table cellpadding=\"4\" cellspacing=\"2\" border=\"0\" width=\"640\">";
                    echo "<tr><th align=\"left\">$strname</th><th align=\"right\">$strsize</th><th align=\"right\">$strmodified</th></tr>";
                    foreach ($list as $item) {
                        echo "<tr>";
                        print_cell("left", $item['filename']);
                        if (! $item['folder']) {
                            print_cell("right", display_size($item['size']));
                        } else {
                            echo "<td>&nbsp;</td>";
                        }
                        $filedate  = userdate($item['mtime'], get_string("strftimedatetime"));
                        print_cell("right", $filedate);
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                echo "<br /><center><form action=\"index.php\" method=\"get\">";
                echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
                echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
                echo " <input type=\"hidden\" name=\"action\" value=\"cancel\" />";
                echo " <input type=\"submit\" value=\"$strok\" />";
                echo "</form>";
                echo "</center>";
            } else {
                displaydir($wdir);
            }
            html_footer();
            break;

        case "restore":
            html_header($course, $wdir);
            if (!empty($file)) {
                echo "<p align=\"center\">".get_string("youaregoingtorestorefrom").":</p>";
                print_simple_box_start("center");
                echo $file;
                print_simple_box_end();
                echo "<br />";
                echo "<p align=center>".get_string("areyousuretorestorethisinfo")."</p>";
                $restore_path = "$CFG->wwwroot/backup/restore.php";
                notice_yesno (get_string("areyousuretorestorethis"),
                                $restore_path."?id=".$id."&file=".cleardoubleslashes($id.$wdir."/".$file),
                                "index.php?id=$id&wdir=$wdir&action=cancel");
            } else {
                displaydir($wdir);
            }
            html_footer();
            break;
          
        case "cancel";
            clearfilelist();

        default:
            html_header($course, $wdir);
            displaydir($wdir);
            html_footer();
            break;
}


/// FILE FUNCTIONS ///////////////////////////////////////////////////////////

function approvefile($p_event, &$p_header){
    if (detect_munged_arguments($p_header['filename'], 0)) {
        return 0; // do not extract file!!
    } else {
        return 1;
    }
}

function fulldelete($location) { 
    if (is_dir($location)) {
        $currdir = opendir($location);
        while ($file = readdir($currdir)) { 
            if ($file <> ".." && $file <> ".") {
                $fullfile = $location."/".$file;
                if (is_dir($fullfile)) { 
                    if (!fulldelete($fullfile)) {
                        return false;
                    }
                } else {
                    if (!unlink($fullfile)) {
                        return false;
                    }
                } 
            }
        } 
        closedir($currdir);
        if (! rmdir($location)) {
            return false;
        }

    } else {
        if (!unlink($location)) {
            return false;
        }
    }
    return true;
}



function setfilelist($VARS) {
    global $USER;

    $USER->filelist = array ();
    $USER->fileop = "";

    $count = 0;
    foreach ($VARS as $key => $val) {
        if (substr($key,0,4) == "file") {
            $count++;
            $val = rawurldecode($val);
            if (!detect_munged_arguments($val, 0)) {
                $USER->filelist[] = rawurldecode($val);
            }
        }
    }
    return $count;
}

function clearfilelist() {
    global $USER;

    $USER->filelist = array ();
    $USER->fileop = "";
}


function printfilelist($filelist) {
    global $CFG, $basedir;

    foreach ($filelist as $file) {
        if (is_dir($basedir.$file)) {
            echo "<img src=\"$CFG->pixpath/f/folder.gif\" height=\"16\" width=\"16\" alt=\"\" /> $file<br />";
            $subfilelist = array();
            $currdir = opendir($basedir.$file);
            while ($subfile = readdir($currdir)) { 
                if ($subfile <> ".." && $subfile <> ".") {
                    $subfilelist[] = $file."/".$subfile;
                }
            }
            printfilelist($subfilelist);

        } else { 
            $icon = mimeinfo("icon", $file);
            echo "<img src=\"$CFG->pixpath/f/$icon\"  height=\"16\" width=\"16\" alt=\"\" /> $file<br />";
        }
    }
}


function print_cell($alignment="center", $text="&nbsp;") {
    echo "<td align=\"$alignment\" nowrap=\"nowrap\">";
    echo "<font size=\"-1\" face=\"Arial, Helvetica\">";
    echo "$text";
    echo "</font>";
    echo "</td>\n";
}

function displaydir ($wdir) {
//  $wdir == / or /a or /a/b/c/d  etc

    global $basedir;
    global $id;
    global $USER, $CFG;

    $fullpath = $basedir.$wdir;

    $directory = opendir($fullpath);             // Find all files
    while ($file = readdir($directory)) {
        if ($file == "." || $file == "..") {
            continue;
        }
        
        if (is_dir($fullpath."/".$file)) {
            $dirlist[] = $file;
        } else {
            $filelist[] = $file;
        }
    }
    closedir($directory);

    $strname = get_string("name");
    $strsize = get_string("size");
    $strmodified = get_string("modified");
    $straction = get_string("action");
    $strmakeafolder = get_string("makeafolder");
    $struploadafile = get_string("uploadafile");
    $strwithchosenfiles = get_string("withchosenfiles");
    $strmovetoanotherfolder = get_string("movetoanotherfolder");
    $strmovefilestohere = get_string("movefilestohere");
    $strdeletecompletely = get_string("deletecompletely");
    $strcreateziparchive = get_string("createziparchive");
    $strrename = get_string("rename");
    $stredit   = get_string("edit");
    $strunzip  = get_string("unzip");
    $strlist   = get_string("list");
    $strrestore= get_string("restore");


    echo "<form action=\"index.php\" method=\"post\" name=\"dirform\">";
    echo "<hr width=\"640\" align=\"center\" noshade=\"noshade\" size=\"1\" />";
    echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"640\">";    
    echo "<tr>";
    echo "<th width=\"5\"></th>";
    echo "<th align=\"left\">$strname</th>";
    echo "<th align=\"right\">$strsize</th>";
    echo "<th align=\"right\">$strmodified</th>";
    echo "<th align=\"right\">$straction</th>";
    echo "</tr>\n";

    if ($wdir == "/") {
        $wdir = "";
    }

    $count = 0;

    if (!empty($dirlist)) {
        asort($dirlist);
        foreach ($dirlist as $dir) {

            $count++;

            $filename = $fullpath."/".$dir;
            $fileurl  = rawurlencode($wdir."/".$dir);
            $filesafe = rawurlencode($dir);
            $filesize = display_size(get_directory_size("$fullpath/$dir"));
            $filedate = userdate(filemtime($filename), "%d %b %Y, %I:%M %p");
    
            echo "<tr>";

            print_cell("center", "<input type=\"checkbox\" name=\"file$count\" value=\"$fileurl\" />");
            print_cell("left", "<a href=\"index.php?id=$id&amp;wdir=$fileurl\"><img src=\"$CFG->pixpath/f/folder.gif\" height=\"16\" width=\"16\" border=\"0\" alt=\"Folder\" /></a> <a href=\"index.php?id=$id&amp;wdir=$fileurl\">".htmlspecialchars($dir)."</a>");
            print_cell("right", "<b>$filesize</b>");
            print_cell("right", $filedate);
            print_cell("right", "<a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$filesafe&amp;action=rename\">$strrename</a>");
    
            echo "</tr>";
        }
    }


    if (!empty($filelist)) {
        asort($filelist);
        foreach ($filelist as $file) {

            $icon = mimeinfo("icon", $file);

            $count++;
            $filename    = $fullpath."/".$file;
            $fileurl     = "$wdir/$file";
            $filesafe    = rawurlencode($file);
            $fileurlsafe = rawurlencode($fileurl);
            $filedate    = userdate(filemtime($filename), "%d %b %Y, %I:%M %p");

            echo "<tr>";

            print_cell("center", "<input type=\"checkbox\" name=\"file$count\" value=\"$fileurl\" />");
            echo "<td align=\"left\" nowrap=\"nowrap\">";
            if ($CFG->slasharguments) {
                $ffurl = "/file.php/$id$fileurl";
            } else {
                $ffurl = "/file.php?file=/$id$fileurl";
            }
            link_to_popup_window ($ffurl, "display", 
                                  "<img src=\"$CFG->pixpath/f/$icon\" height=\"16\" width=\"16\" border=\"0\" alt=\"File\" />", 
                                  480, 640);
            echo "<font size=\"-1\" face=\"Arial, Helvetica\">";
            link_to_popup_window ($ffurl, "display", 
                                  htmlspecialchars($file),
                                  480, 640);
            echo "</font></td>";

            $file_size = filesize($filename);
            print_cell("right", display_size($file_size));
            print_cell("right", $filedate);
            if ($icon == "text.gif" || $icon == "html.gif") {
                $edittext = "<a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$fileurl&amp;action=edit\">$stredit</a>";
            } else if ($icon == "zip.gif") {
                $edittext = "<a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$fileurl&amp;action=unzip\">$strunzip</a>&nbsp;";
                $edittext .= "<a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$fileurl&amp;action=listzip\">$strlist</a> ";
                if (!empty($CFG->backup_version) and isteacheredit($id)) {
                    $edittext .= "<a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$filesafe&amp;action=restore\">$strrestore</a> ";
                }
            } else {
                $edittext = "";
            }
            print_cell("right", "$edittext <a href=\"index.php?id=$id&amp;wdir=$wdir&amp;file=$filesafe&amp;action=rename\">$strrename</a>");
    
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "<hr width=\"640\" align=\"center\" noshade=\"noshade\" size=\"1\" />";

    if (empty($wdir)) {
        $wdir = "/";
    }

    echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"640\">";    
    echo "<tr><td>";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";
    echo "<input type=\"hidden\" name=\"wdir\" value=\"$wdir\" /> ";
    $options = array (
                   "move" => "$strmovetoanotherfolder",
                   "delete" => "$strdeletecompletely",
                   "zip" => "$strcreateziparchive"
               );
    if (!empty($count)) {
        choose_from_menu ($options, "action", "", "$strwithchosenfiles...", "javascript:document.dirform.submit()");
    }

    echo "</form>";
    echo "<td align=\"center\">";
    if (!empty($USER->fileop) and ($USER->fileop == "move") and ($USER->filesource <> $wdir)) {
        echo "<form action=\"index.php\" method=\"get\">";
        echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
        echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
        echo " <input type=\"hidden\" name=\"action\" value=\"paste\" />";
        echo " <input type=\"submit\" value=\"$strmovefilestohere\" />";
        echo "</form>";
    }
    echo "<td align=\"right\">";
        echo "<form action=\"index.php\" method=\"get\">";
        echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
        echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
        echo " <input type=\"hidden\" name=\"action\" value=\"mkdir\" />";
        echo " <input type=\"submit\" value=\"$strmakeafolder\" />";
        echo "</form>";
    echo "</td>";
    echo "<td align=\"right\">";
        echo "<form action=\"index.php\" method=\"get\">";
        echo " <input type=\"hidden\" name=\"id\" value=\"$id\" />";
        echo " <input type=\"hidden\" name=\"wdir\" value=\"$wdir\" />";
        echo " <input type=\"hidden\" name=\"action\" value=\"upload\" />";
        echo " <input type=\"submit\" value=\"$struploadafile\" />";
        echo "</form>";
    echo "</td></tr>";
    echo "</table>";
    echo "<hr width=\"640\" align=\"center\" noshade=\"noshade\" size=\"1\" />";

}

?>
