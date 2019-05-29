<?php

class Database extends PDO
{
    
    public function __construct()
    {
         parent::__construct('mysql:localhost;dbname=mvc', 'rootTest', '12345'); //syntax ('DATABASETYPE:DBLOCATION;dbname=DATABASENAME', 'USERNAME', 'PASSWORD (leave blank if no password exists)')
    }
}
