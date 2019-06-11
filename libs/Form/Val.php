<?php

class Val
{
    public function __construct()
    {

    }
    public function minlength($data, $arg)
    {
        if (strlen($data) < $arg) {
            return "Validation Error: String length is smaller than the minimum of $arg";
        }
    }
 
     public function maxlength($data,$arg){
         if(strlen($data)> $arg){
             return "Validation Error: String length is greater than the maximum of $arg";
         }
     }

    public function digit($data){
        if (ctype_digit($data) == false) {
            return "Validation Error: Item cannot be Must be a digit, cannot contain any special characters.";
        }
    }
    public function __call($name, $arguments){
        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }

}
