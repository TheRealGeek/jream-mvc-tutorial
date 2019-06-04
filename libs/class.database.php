<?php

class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
         parent::__construct($DB_TYPE.':host=' .$DB_HOST. ';dbname=' .$DB_NAME, $DB_USER, $DB_PASS); 
    }
}
