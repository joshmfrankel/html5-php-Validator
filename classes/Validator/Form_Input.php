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
    
    /**
     * Constructor
     */
    public function __construct() {
        require_once('plugins/phpSimpleDom/simple_html_dom.php');
        
        $this->_referer = $_SERVER['HTTP_REFERER'];
        $this->_html    = new simple_html_dom();
        $this->_html->load_file($this->_referer);
        
        $this->buildInput();
        //$this->start();
    }
    
    /**
     * buildInputArray method
     * 
     * Builds an array of data from the previously submitted form
     * @return void
     * 
     * @todo add image support
     */
    private function buildInput(){
        
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
                if(isset($element->attr['data-validate'])) 
                    $this->_inputArray[$x]['special']    = $element->attr['data-validate'];

                /**
                 * Other Attributes
                 */
                $this->_inputArray[$x]['value']      = $_POST[$element->name];
                $this->_inputArray[$x]['required']   = $element->required;

                /**
                 * @todo Perform validation
                 *       should save an entire step and speed up
                 */

                $x++;
            }
        }
        
        //set the index based off the number of iterations
        $this->setIndex();
        
    }
    
    private function setIndex() {
        $this->_index = count($this->_inputArray);
    }
    
    public function getRawResults() {
        return $this->_inputArray;
    }

    public function getErrors() {
        
    }


    
    public function start() {

        for($i = 0; $i < $this->_index; $i++) {

            $Validator = AbstractValidator::factory($this->_inputArray[$i]['type']);

            /**
             * COMMON VALIDATION LOGIC
             */
            
            $this->_inputArray[$i]['isValid'] = $Validator->validate($this->_inputArray[$i]['value']);

            /**
             * @todo  check for class type if string validator then do not create a new object
             */

            /**
             * @todo  Fix the following logic for numbers or ranges with minimum and maximums
             */
            // if(isset($this->_inputArray[$i]['min'])){
            //     $this->_inputArray[$i]['min'] = FALSE;
            // }

            // if(isset($this->_inputArray[$i]['max'])){
            //     $this->_inputArray[$i]['max'] = FALSE;
            // }

            // if($this->_inputArray[$i]['min'] && $this->_inputArray[$i]['isValid']) {
            //      $this->_inputArray[$i]['isValid'] = $Validator->isGreaterThan($this->_inputArray[$i]['value'], $this->_inputArray[$i]['min']);
            //  }

            // //if there is a max attribute and the isValid flag is not FALSE
            // if($this->_inputArray[$i]['max'] && $this->_inputArray[$i]['isValid']) {
            //     $this->_inputArray[$i]['isValid'] = $Validator->isLessThan($this->_inputArray[$i]['value'], $this->_inputArray[$i]['max']);
            // }
            

            if($this->_inputArray[$i]['isValid']) {
                $this->_inputArray[$i]['sanitizedValue'] = $Validator->sanitize($this->_inputArray[$i]['value']);
            }

            $Validator = NULL;
            
        }
    }
    
}

?>
