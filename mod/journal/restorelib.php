<?PHP //$Id$
    //This php script contains all the stuff to backup/restore
    //journal mods

    //This is the "graphical" structure of the journal mod:
    //
    //                      journal                                      
    //                    (CL,pk->id)
    //                        |
    //                        |
    //                        |
    //                   journal_entries 
    //               (UL,pk->id, fk->journal)     
    //
    // Meaning: pk->primary key field of the table
    //          fk->foreign key to link with parent
    //          nt->nested field (recursive data)
    //          CL->course level info
    //          UL->user level info
    //          files->table may have files)
    //
    //-----------------------------------------------------------

    //This function executes all the restore procedure about this mod
    function journal_restore_mods($mod,$restore) {

        global $CFG;

        $status = true;

        //Get record from backup_ids
        $data = backup_getid($restore->backup_unique_code,$mod->modtype,$mod->id);

        if ($data) {
            //Now get completed xmlized object
            $info = $data->info;
            //traverse_xmlize($info);                                                                     //Debug
            //print_object ($GLOBALS['traverse_array']);                                                  //Debug
            //$GLOBALS['traverse_array']="";                                                              //Debug

            //Now, build the JOURNAL record structure
            $journal->course = $restore->course_id;
            $journal->name = backup_todb($info['MOD']['#']['NAME']['0']['#']);
            $journal->intro = backup_todb($info['MOD']['#']['INTRO']['0']['#']);
            $journal->days = backup_todb($info['MOD']['#']['DAYS']['0']['#']);
            $journal->assessed = backup_todb($info['MOD']['#']['ASSESSED']['0']['#']);
            $journal->timemodified = backup_todb($info['MOD']['#']['TIMEMODIFIED']['0']['#']);

            //The structure is equal to the db, so insert the journal
            $newid = insert_record ("journal",$journal);

            //Do some output
            echo "<ul><li>Journal \"".$journal->name."\"<br>";
            backup_flush(300);

            if ($newid) {
                //We have the newid, update backup_ids
                backup_putid($restore->backup_unique_code,$mod->modtype,
                             $mod->id, $newid);
                //Now check if want to restore user data and do it.
                if ($restore->mods[journal]->userinfo) {
                    //Restore journal_entries
                    $status = journal_entries_restore_mods ($mod->id, $newid,$info,$restore);
                }
            } else {
                $status = false;
            }

            //Finalize ul
            echo "</ul>";

        } else {
            $status = false;
        }

        return $status;
    }


    //This function restores the journal_entries
    function journal_entries_restore_mods($old_journal_id, $new_journal_id,$info,$restore) {

        global $CFG;

        $status = true;

        //Get the entries array
        $entries = $info['MOD']['#']['ENTRIES']['0']['#']['ENTRY'];

        //Iterate over entries
        for($i = 0; $i < sizeof($entries); $i++) {
            $entry_info = $entries[$i];
            //traverse_xmlize($entry_info);                                                               //Debug
            //print_object ($GLOBALS['traverse_array']);                                                  //Debug
            //$GLOBALS['traverse_array']="";                                                              //Debug

            //We'll need this later!!
            $oldid = backup_todb($sub_info['#']['ID']['0']['#']);
            $olduserid = backup_todb($sub_info['#']['USERID']['0']['#']);

            //Now, build the JOURNAL_ENTRIES record structure
            $entry->journal = $new_journal_id;
            $entry->userid = backup_todb($entry_info['#']['USERID']['0']['#']);
            $entry->modified = backup_todb($entry_info['#']['MODIFIED']['0']['#']);
            $entry->text = backup_todb($entry_info['#']['TEXT']['0']['#']);
            $entry->format = backup_todb($entry_info['#']['FORMAT']['0']['#']);
            $entry->rating = backup_todb($entry_info['#']['RATING']['0']['#']);
            $entry->comment = backup_todb($entry_info['#']['COMMENT']['0']['#']);
            $entry->teacher = backup_todb($entry_info['#']['TEACHER']['0']['#']);
            $entry->timemarked = backup_todb($entry_info['#']['TIMEMARKED']['0']['#']);
            $entry->mailed = backup_todb($entry_info['#']['MAILED']['0']['#']);

            //We have to recode the userid field
            $user = backup_getid($restore->backup_unique_code,"user",$entry->userid);
            if ($user) {
                $entry->userid = $user->new_id;
            }

            //We have to recode the teacher field
            $user = backup_getid($restore->backup_unique_code,"user",$entry->teacher);
            if ($user) {
                $entry->teacher = $user->new_id;
            }

            //The structure is equal to the db, so insert the journal_entry
            $newid = insert_record ("journal_entries",$entry);

            //Do some output
            if (($i+1) % 50 == 0) {
                echo ".";
                if (($i+1) % 1000 == 0) {
                    echo "<br>";
                }
                backup_flush(300);
            }

            if ($newid) {
                //We have the newid, update backup_ids
                backup_putid($restore->backup_unique_code,"journal_entry",$oldid,
                             $newid);
            } else {
                $status = false;
            }
        }

        return $status;
    }

?>
