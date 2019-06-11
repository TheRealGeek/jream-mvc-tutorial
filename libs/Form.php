<?php
/**
 * 
 * - Fill out a form
 *      -POST to PHP
 *      -Sanitize input data
 *      -Validate input data
 *      -Return input data 
 *      -Send input data to Database
 */

require 'Form/Val.php';
 class Form{

    /** @var array $_currentItem The immediately posted item */
    private $_currentItem = null;

    /** @var array $_postData Stores the posted data */
    private $_postData = array();

    /** @var object $_val The Val object */
    private $_val = array();

    /** @var array $_error Holds the forms current errors */
    private $_error = array();

    /** __construct - Instantiates the Validator class */
    public function __construct() {
        $this->_val = new Val();
    }
    
    /**
     * post This is to run $_POST
     * @param string $field This is the data coming from the input.
     */
    public function post($field){
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;
        // $field = null;
        // echo '<pre>The data in Form.php: <br>';
        // var_dump($this->_currentItem); //this should be an array, not a string
        // echo '</pre>';

        return $this;//returns the Form object
    }
    /**
     * fetch - Return the posted data
     * 
     * @param mixed $fieldName
     * 
     * @return mixed String or array
     */
    public function fetch($fieldName = false)
    {
        if($fieldName){
            if(isset($this->_postData[$fieldName])) {
                return $this->_postData[$fieldName];
            }else{
                return false;
            }   
        }
        else{
            return $this->_postData;
        }
    }


    /**
     * val - This is to validate
     * @param (mixed) $vType Type of Val we want
     * @param (mixed) $arg This is the argument
     * 
     * 
     */ 
    public function val($vType,$arg=null){
        if($arg==null){
            $error = $this->_val->{$vType}($this->_postData[$this->_currentItem]); // this passes in the value of the field we are posting
        }else{
            $error = $this->_val->{$vType}($this->_postData[$this->_currentItem],$arg); // this passes in the value of the field we are posting
        }if($error){
            $this->_error[$this->_currentItem] = $error;
            return $this;
        }
       
    }
    public function submit()
    {   
        if(empty($this->_error)){
            return true;
        } else{
            $str = '';
            foreach ($this->_error as $key => $value) {
                $str .= $key . ' => ' . $value . "\n";
            }
        }
        throw new Exception($str);
    } 
    
}
