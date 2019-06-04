<?php
 class Model {
     function __construct()
     {
         $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); //models often use databases. Created one during MVC Tut. p3
     }
 }

