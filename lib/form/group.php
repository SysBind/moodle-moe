<?php
require_once("HTML/QuickForm/group.php");

/**
 * HTML class for a form element group
 * 
 * @author       Adam Daniel <adaniel1@eesus.jnj.com>
 * @author       Bertrand Mansion <bmansion@mamasam.com>
 * @version      1.0
 * @since        PHP4.04pl1
 * @access       public
 */
class MoodleQuickForm_group extends HTML_QuickForm_group{
    /**
     * html for help button, if empty then no help
     *
     * @var string
     */
    var $_helpbutton='';
    var $_elementTemplateType='fieldset';
    //would cause problems with client side validation so will leave for now
    //var $_elementTemplateType='fieldset';
    /**
     * set html for help button
     *
     * @access   public
     * @param array $help array of arguments to make a help button
     */
    function setHelpButton($helpbuttonargs){
        if (!is_array($helpbuttonargs)){
            $helpbuttonargs=array($helpbuttonargs);
        }else{
            $helpbuttonargs=$helpbuttonargs;
        }
        //we do this to to return html instead of printing it 
        //without having to specify it in every call to make a button.
        $defaultargs=array('', '', 'moodle', true, false, '', true);
        $helpbuttonargs=$helpbuttonargs + $defaultargs ;
        $this->_helpbutton=call_user_func_array('helpbutton', $helpbuttonargs);
    }
    /**
     * get html for help button
     *
     * @access   public
     * @return  string html for help button
     */
    function getHelpButton(){
        return $this->_helpbutton;
    }
    function getElementTemplateType(){
        return $this->_elementTemplateType;
    }
}