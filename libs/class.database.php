<?php

class Database extends PDO
{
    
    public function __construct()
    {
        // parent::__construct('mysql:host=localhost;dbname=mvc', 'rootTest', '12345'); //syntax ('DATABASETYPE:DBLOCATION;dbname=DATABASENAME', 'USERNAME', 'PASSWORD (leave blank if no password exists)')
         parent::__construct(DB_TYPE.':host=' .DB_HOST. ';dbname=' .DB_NAME, DB_USER, DB_PASS); //This replaces the above. The constants used are stored in config/database.php
    }
}
