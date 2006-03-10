<?php

$string['enrolname'] = 'IMS Enterprise file';

// Subheadings which divide up the config page
$string['basicsettings'] = 'Basic settings';
$string['usersettings'] = 'User data options';
$string['coursesettings'] = 'Course data options';
$string['miscsettings'] = 'Miscellaneous';

// Labels in the config page
$string['description'] = 'This method will repeatedly check for and process a specially-formatted text file in the location that you specify.  The file must follow the <a href=\'../help.php?module=enrol/imsenterprise&file=formatoverview.html\' target=\'blank\'>IMS Enterprise specifications</a> containing person, group, and membership XML elements.';
$string['createnewusers'] = 'Create user accounts for users not yet registered in Moodle';
$string['deleteusers'] = 'Delete user accounts when specified in IMS data';
$string['fixcaseusernames'] = 'Change usernames to lower case';
$string['fixcasepersonalnames'] = 'Change personal names to Title Case';
$string['truncatecoursecodes'] = 'Truncate course codes to this length';
$string['createnewcourses'] = 'Create new (hidden) courses if not found in Moodle';
$string['createnewcategories'] = 'Create new (hidden) course categories if not found in Moodle';
$string['zeroisnotruncation'] = '0 indicates no truncation';
$string['cronfrequency'] = 'Frequency of processing';
$string['allowunenrol'] = 'Allow the IMS data to <strong>unenrol</strong> students/teachers';
$string['sourcedidfallback'] = 'Use the &quot;sourcedid&quot; for a person\'s userid if the &quot;userid&quot; field is not found';
$string['usecapitafix']= 'Tick this box if using &quot;Capita&quot; (their XML format is slightly wrong)';
$string['location'] = 'File location';
$string['mailusers'] = 'Notify users by email';
$string['mailadmins'] = 'Notify admin by email';
$string['processphoto'] = 'Add user photo data to profile';
$string['processphotowarning'] = 'Warning: Image processing is likely to add a significant burden to the server. You are recommended not to activate this option if large numbers of students are expected to be processed.';
$string['logtolocation'] = 'Log file output location (blank for no logging)';
$string['restricttarget'] = 'Only process data if the following target is specified';

$string['aftersaving...']= 'Once you have saved your settings, you may wish to';
$string['doitnow']= 'perform an IMS Enterprise import right now';

$string['filelockedmailsubject'] = 'Important error: Enrolment file';
$string['filelockedmail'] = 'The text file you are using for IMS-file-based enrolments ($a) can not be deleted by the cron process.  This usually means the permissions are wrong on it.  Please fix the permissions so that Moodle can delete the file, otherwise it might be processed repeatedly.';

?>
