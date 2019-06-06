<?php
/**
 *located in the model class
 * @param Database Calls and constructs the database class
 * @return CLASS Returns a new instance of the Database class with constant parameters that are defined in the config.php file
 *
 */
 class Model {

     function __construct()
     {
         $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); //models often use databases. Created one during MVC Tut. p3
     }
 }

