<?PHP //$Id$
    //This php script contains all the stuff to backup/restore
    //choice mods

    //This is the "graphical" structure of the choice mod:
    //
    //                      choice                                      
    //                    (CL,pk->id)
    //                        |
    //                        |
    //                        |
    //                   choice_answers 
    //               (UL,pk->id, fk->choice)     
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
    function choice_restore_mods($mod,$restore) {

        global $CFG;

        $status = true;

        //Get record from backup_ids
        $data = backup_getid($restore->backup_unique_code,$mod->modtype,$mod->id);

        if ($data) {
            //We have info, get and unserialize info
            //First strip slashes
            $temp = stripslashes($data->info);
            //Now get completed xmlized object
            $info = unserialize($temp);
            //traverse_xmlize($info);                                                                     //Debug
            //print_object ($GLOBALS['traverse_array']);                                                  //Debug
            //$GLOBALS['traverse_array']="";                                                              //Debug

            //Now, build the CHOICE record structure
            $choice->course = $restore->course_id;
            $choice->name = backup_todb($info['MOD']['#']['NAME']['0']['#']);
            $choice->text = backup_todb($info['MOD']['#']['TEXT']['0']['#']);
            $choice->format = backup_todb($info['MOD']['#']['FORMAT']['0']['#']);
            $choice->answer1 = backup_todb($info['MOD']['#']['ANSWER1']['0']['#']);
            $choice->answer2 = backup_todb($info['MOD']['#']['ANSWER2']['0']['#']);
            $choice->answer3 = backup_todb($info['MOD']['#']['ANSWER3']['0']['#']);
            $choice->answer4 = backup_todb($info['MOD']['#']['ANSWER4']['0']['#']);
            $choice->answer5 = backup_todb($info['MOD']['#']['ANSWER5']['0']['#']);
            $choice->answer6 = backup_todb($info['MOD']['#']['ANSWER6']['0']['#']);
            $choice->publish = backup_todb($info['MOD']['#']['PUBLISH']['0']['#']);
            $choice->timemodified = backup_todb($info['MOD']['#']['TIMEMODIFIED']['0']['#']);

            //The structure is equal to the db, so insert the choice
            $newid = insert_record ("choice",$choice);
            if ($newid) {
                //We have the newid, update backup_ids
                backup_putid($restore->backup_unique_code,$mod->modtype,$mod->id,
                             $newid,$data->info);
                //Now check if want to restore user data and do it.
                if ($restore->mods[choice]->userinfo) {
                    //Restore choice_answers
                    $status = choice_answers_restore_mods ($newid,$info,$restore);
                }
            } else {
                $status = false;
            }

        } else {
            $status = false;
        }

        return $status;
    }

    //This function restores the choice_answers
    function choice_answers_restore_mods($choice_id,$info,$restore) {

        global $CFG;

        $status = true;

        //Get the submissions array
        $answers = $info['MOD']['#']['ANSWERS']['0']['#']['ANSWER'];

        //Iterate over submissions
        for($i = 0; $i < sizeof($answers); $i++) {
            $sub_info = $answers[$i];
            traverse_xmlize($sub_info);                                                                 //Debug
            print_object ($GLOBALS['traverse_array']);                                                  //Debug
            $GLOBALS['traverse_array']="";                                                              //Debug

            //We'll need this later!!
            $oldid = backup_todb($sub_info['#']['ID']['0']['#']);
            $olduserid = backup_todb($sub_info['#']['USERID']['0']['#']);

            //Now, build the CHOICE_ANSWERS record structure
            $answer->choice = $choice_id;
            $answer->userid = backup_todb($sub_info['#']['USERID']['0']['#']);
            $answer->answer = backup_todb($sub_info['#']['CHOICE_ANSWER']['0']['#']);
            $answer->timemodified = backup_todb($sub_info['#']['TIMEMODIFIED']['0']['#']);

            //We have to recode the userid field
            $user = backup_getid($restore->backup_unique_code,"user",$answer->userid);
            if ($user) {
                $answer->userid = $user->new_id;
            }

            //The structure is equal to the db, so insert the choice_answers
            $newid = insert_record ("choice_answers",$answer);
            if ($newid) {
                //We have the newid, update backup_ids
                backup_putid($restore->backup_unique_code,"choice_answers",$oldid,
                             $newid);
            } else {
                $status = false;
            }
        }

        return $status;
    }

?>
