<?PHP // $Id$
      // Display the whole course as "topics" made of of modules
      // In fact, this is very similar to the "weeks" format, in that
      // each "topic" is actually a week.  The main difference is that
      // the dates aren't printed - it's just an aesthetic thing for 
      // courses that aren't so rigidly defined by time.
      // Included from "view.php"

    require_once("$CFG->dirroot/mod/forum/lib.php");

    if (isset($topic)) {
        $displaysection = course_set_display($course->id, $topic);
    } else {
        if (isset($USER->display[$course->id])) {       // for admins, mostly
            $displaysection = $USER->display[$course->id];
        } else {
            $displaysection = course_set_display($course->id, 0);
        }
    }

    if (isteacher($course->id) and isset($marker)) {
        $course->marker = $marker;
        if (! set_field("course", "marker", $marker, "id", $course->id)) {
            error("Could not mark that topic for this course");
        }
    }

    if ($course->newsitems) {
        $news = forum_get_course_forum($course->id, "news");
    }

    $streditsummary = get_string("editsummary");
    $stradd         = get_string("add");
    $stractivities  = get_string("activities");
    $strshowalltopics = get_string("showalltopics");
    $strcoursedisplay = get_string("coursedisplay");
    if (isediting($course->id)) { 
        $strmarkthistopic = get_string("markthistopic");
        $strtopichide = get_string("topichide", "", moodle_strtolower($course->students));
        $strtopicshow = get_string("topicshow", "", moodle_strtolower($course->students));
    }


/// Layout the whole page as three big columns.
    echo "<table border=0 cellpadding=3 cellspacing=0 width=100%>";

/// The left column ...

    echo "<tr valign=top><td valign=top width=180>";
    
/// Links to people
    $moddata[]="<a title=\"".get_string("listofallpeople")."\" href=\"../user/index.php?id=$course->id\">".get_string("participants")."</a>";
    $modicon[]="<img src=\"$pixpath/i/users.gif\" height=16 width=16 alt=\"\">";
    $editmyprofile = "<a title=\"$USER->firstname $USER->lastname\" href=\"../user/edit.php?id=$USER->id&course=$course->id\">".get_string("editmyprofile")."</a>";
    if ($USER->description) {
        $moddata[]= $editmyprofile;
    } else {
        $moddata[]= $editmyprofile." <blink>*</blink>";
    }
    $modicon[]="<img src=\"$pixpath/i/user.gif\" height=16 width=16 alt=\"\">";
    print_side_block(get_string("people"), "", $moddata, $modicon);


/// Links to all activity modules by type
    $moddata = array();
    $modicon = array();
    if ($modnamesused) {
        foreach ($modnamesused as $modname => $modfullname) {
            $moddata[] = "<a href=\"../mod/$modname/index.php?id=$course->id\">".$modnamesplural[$modname]."</a>";
            $modicon[] = "<img src=\"$modpixpath/$modname/icon.gif\" height=16 width=16 alt=\"\">";
        }
    }
    print_side_block($stractivities, "", $moddata, $modicon);

/// Print a form to search forums
    $searchform = forum_print_search_form($course, "", true);
    $searchform = "<div align=\"center\">$searchform</div>";
    print_side_block(get_string("search","forum"), $searchform);

/// Admin links and controls
    print_course_admin_links($course);

/// Start main column
    echo "</td><td width=\"*\">";

    print_heading_block(get_string("topicoutline"), "100%", "outlineheadingblock");
    print_spacer(8, 1, true);

    echo "<table class=\"topicsoutline\" border=\"0\" cellpadding=\"8\" cellspacing=\"0\" width=\"100%\">";

/// Print Section 0 

    $topic = 0;
    $thistopic = $sections[$topic];

    if ($thistopic->summary or $thistopic->sequence or isediting($course->id)) {
        echo "<tr>";
        echo "<td nowrap bgcolor=\"$THEME->cellheading\" class=\"topicsoutlineside\" valign=top width=20>&nbsp;</td>";
        echo "<td valign=top bgcolor=\"$THEME->cellcontent\" class=\"topicsoutlinecontent\" width=\"100%\">";
    
        if (isediting($course->id)) {
            $thistopic->summary .= "&nbsp;<a title=\"$streditsummary\" ".
                                     "href=\"editsection.php?id=$thistopic->id\"><img src=\"$pixpath/t/edit.gif\" ".
                                     "height=11 width=11 border=0 alt=\"$streditsummary\"></a></p>";
        }
    
        echo text_to_html($thistopic->summary);
    
        print_section($course, $thistopic, $mods, $modnamesused);
    
        if (isediting($course->id)) {
            echo "<div align=right>";
            popup_form("$CFG->wwwroot/course/mod.php?id=$course->id&amp;section=$topic&add=", 
                        $modnames, "section$topic", "", "$stradd...", "mods", $stractivities);
            echo "</div>";
        }
    
        echo "</td>";
        echo "<td nowrap bgcolor=\"$THEME->cellheading\" class=\"topicsoutlineside\" valign=top align=center width=10>&nbsp;";
        echo "<a href=\"view.php?id=$course->id&topic=all\" title=\"$strshowalltopics\"><img src=\"$pixpath/i/all.gif\" height=25 width=16 border=0></a><br><br>";
        echo "</td>";
        echo "</tr>";
        echo "<tr><td colspan=3><img src=\"../pix/spacer.gif\" width=1 height=1></td></tr>";
    }


/// Now all the normal modules by topic
/// Everything below uses "section" terminology - each "section" is a topic.

    $timenow = time();
    $section = 1;

    while ($section <= $course->numsections) {

        if (!empty($displaysection) and $displaysection != $section) {
            $section++;
            continue;
        }

        if (!empty($sections[$section])) {
            $thissection = $sections[$section];

        } else {
            unset($thissection);
            $thissection->course = $course->id;   // Create a new section structure
            $thissection->section = $section;
            $thissection->summary = "";
            $thissection->visible = 1;
            if (!$thissection->id = insert_record("course_sections", $thissection)) {
                notify("Error inserting new topic!");
            }
        }

        $currenttopic = ($course->marker == $section);

        if (!$thissection->visible) {
            $colorsides = "bgcolor=\"$THEME->hidden\" class=\"topicsoutlinesidehidden\"";
            $colormain  = "bgcolor=\"$THEME->cellcontent\" class=\"topicsoutlinecontenthidden\"";
        } else if ($currenttopic) {
            $colorsides = "bgcolor=\"$THEME->cellheading2\" class=\"topicsoutlinesidehighlight\"";
            $colormain  = "bgcolor=\"$THEME->cellcontent\" class=\"topicsoutlinecontenthighlight\"";
        } else {
            $colorsides = "bgcolor=\"$THEME->cellheading\" class=\"topicsoutlineside\"";
            $colormain  = "bgcolor=\"$THEME->cellcontent\" class=\"topicsoutlinecontent\"";
        }

        echo "<tr>";
        echo "<td nowrap $colorsides valign=top width=20>";
        echo "<p align=center><font size=3><b>$section</b></font></p>";
        echo "</td>";
    
        if (!isteacher($course->id) and !$thissection->visible) {   // Hidden for students
            echo "<td valign=top align=center $colormain width=\"100%\">";
            echo get_string("notavailable");
            echo "</td><td $colorsides width=20>";
            echo "&nbsp;";
            echo "</td></tr>";

        } else {
            echo "<td valign=top $colormain width=\"100%\">";

            if (isediting($course->id)) {
                $thissection->summary .= "&nbsp;<a href=editsection.php?id=$thissection->id><img src=\"$pixpath/t/edit.gif\" border=0 height=11 width=11 alt=\"$streditsummary\"></a>";
            }
    
            echo text_to_html($thissection->summary);
    
            print_section($course, $thissection, $mods, $modnamesused);
    
            if (isediting($course->id)) {
                echo "<div align=right>";
                popup_form("$CFG->wwwroot/course/mod.php?id=$course->id&amp;section=$section&add=", 
                            $modnames, "section$section", "", "$stradd...");
                echo "</div>";
            }
    
            echo "</td>";
            echo "<td nowrap $colorsides valign=top align=center width=10>";
            echo "<font size=1>";

            if ($displaysection == $section) {      // Show the zoom box
                echo "<a href=\"view.php?id=$course->id&topic=all\" title=\"$strshowalltopics\">".
                     "<img src=\"$pixpath/i/all.gif\" height=25 width=16 border=0></a><br />";
            } else {
                $strshowonlytopic = get_string("showonlytopic", "", $section);
                echo "<a href=\"view.php?id=$course->id&topic=$section\" title=\"$strshowonlytopic\">".
                     "<img src=\"$pixpath/i/one.gif\" height=16 width=16 border=0></a><br />";
            }

            if (isediting($course->id)) {      // Show the hide/show eye
                    $strmarkthistopic = get_string("markthistopic");
                if ($thissection->visible) {
                    echo "<a href=\"view.php?id=$course->id&hide=$section\" title=\"$strtopichide\">".
                         "<img src=\"$pixpath/i/hide.gif\" height=16 width=16 border=0></a><br />";
                } else {
                    echo "<a href=\"view.php?id=$course->id&show=$section\" title=\"$strtopicshow\">".
                         "<img src=\"$pixpath/i/show.gif\" height=16 width=16 border=0></a><br />";
                }

                if ($course->marker != $section) {  // Show the "tick"
                    echo "<a href=\"view.php?id=$course->id&marker=$section\" title=\"$strmarkthistopic\">".
                         "<img src=\"$pixpath/i/marker.gif\" height=16 width=16 border=0></a><br />";
                }
            }

            echo "</td>";
            echo "</tr>";
        }
        echo "<tr><td colspan=3><img src=\"../pix/spacer.gif\" width=1 height=1></td></tr>";

        $section++;
    }
    echo "</table>";
    

    if ($news or $course->showrecent) {
        echo "</td><td width=210>";

        /// Print all the news items.

        if ($news) {
            print_side_block_start(get_string("latestnews"), 210, "sideblocklatestnews");
            echo "<font size=\"-2\">";
            forum_print_latest_discussions($news->id, $course->newsitems, "minimal", "", false);
            echo "</font>";
            print_side_block_end();
        }
        
        // Print all the recent activity
        if ($course->showrecent) {
            print_side_block_start(get_string("recentactivity"), 210, "sideblockrecentactivity");
            print_recent_activity($course);
            print_side_block_end();
        }
    
        print_spacer(1, 120, true);
    }

    echo "</td></tr></table>\n";

?>
