<?php

/**
 * Form Input class
 * 
 * A validator class for html5 forms
 * This will be used for back-end validation when
 * javascript is disabled
 *
 * @author Joshua Frankel <joshmfrankel@gmail.com>
 * @see http://www.joshmfrankel.com
 * @copyright 2012
 * @version 0.1a
 * 
 */

class Form_Input{
    
    /**
     * Private Variables 
     */
    private $_referer;
    private $_inputArray = array();
    private $_html;
    private $_index;
    private $_x;
    
    /**
     * Constructor
     */
    public function __construct() {
        require_once('plugins/phpSimpleDom/simple_html_dom.php');
        
        $this->_referer = $_SERVER['HTTP_REFERER'];
        $this->_html    = new simple_html_dom();
        $this->_html->load_file($this->_referer);
        
        $this->buildOutput();
        //$this->start();
    }
    
    /**
     * buildOutput method
     * 
     * Builds an array of data from the previously submitted form
     * @return void
     * 
     * @todo add image support
     */
    private function buildOutput(){
        
        $x = 0;
        
        foreach($this->_html->find('input[type!=submit]') as $element) {
            
            /**
             * @todo find better way of filtering both submit and hidden fields 
             */
            if($element->type != 'hidden') {
                
                //Force the required attribute to contain a value
                if(!$element->required) {
                    $element->required = FALSE;
                }

                //Build the array with proper attributes
                $this->_inputArray[$x]['name']       = $element->name;
                $this->_inputArray[$x]['type']       = $element->type;

                /**
                * Special cases for the number and range types
                */
                if($element->type == 'number' || $element->type == 'range'){
                    if($element->min){
                        $this->_inputArray[$x]['min'] = $element->min;
                    }

                    if($element->max){
                        $this->_inputArray[$x]['max'] = $element->max;
                    }
                }
                
                /**
                 * Regex pattern attribute
                 */
                if($element->pattern) {
                    $this->_inputArray[$x]['pattern']    = $element->pattern;
                }

                /**
                 * HTML5 data attribute
                 * data-validate contains a special validator parameter
                 */
                if(isset($element->attr['data-validate'])) {
                    $this->_inputArray[$x]['special']    = $element->attr['data-validate'];
                }
                    

                /**
                 * Other Attributes
                 */
                $this->_inputArray[$x]['value']      = $_POST[$element->name];
                $this->_inputArray[$x]['required']   = $element->required;

                /**
                 * @todo Perform validation
                 *       should save an entire step and speed up
                 */
                
                //Start the factory method
                $Validator = ValidatorAbstract::factory($this->_inputArray[$x]['type']);

                //Check for basic validation passing
                $this->_inputArray[$x]['isValid'] = $Validator->validate($this->_inputArray[$x]['value']);

                //if the type is a number or range and has a min or max then validate against
                if($this->_inputArray[$x]['type'] == 'number' || $this->_inputArray[$x]['type'] == 'range') {

                    if(isset($this->_inputArray[$x]['min']) && $this->_inputArray[$x]['isValid']){
                        $this->_inputArray[$x]['isValid'] = $Validator->isGreaterThan($this->_inputArray[$x]['min'], $this->_inputArray[$x]['value']);
                    }

                    if(isset($this->_inputArray[$x]['max']) && $this->_inputArray[$x]['isValid']){
                        $this->_inputArray[$x]['isValid'] = $Validator->isLessThan($this->_inputArray[$x]['max'], $this->_inputArray[$x]['value']);
                    }    

                }
                
                //Sanitize the value if it passes validation
                if($this->_inputArray[$x]['isValid']) {
                    $this->_inputArray[$x]['sanitizedValue'] = $Validator->sanitize($this->_inputArray[$x]['value']);
                }

                //Reset the validator object
                $Validator = NULL;

                //increment index
                $x++;
            }
            /* END FOREACH */
        }
        
    }
   
    
    public function getRawResults() {
        return $this->_inputArray;
    }

    public function getErrorResults() {
        
    }

    
}

?>
