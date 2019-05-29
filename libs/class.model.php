<?php
 class Model {
     function __construct()
     {
         $this->db = new Database(); //models often use databases. Created one during MVC Tut. p3
     }
 }

