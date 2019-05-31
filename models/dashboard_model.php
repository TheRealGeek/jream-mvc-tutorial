<?php
class Dashboard_Model extends Model
{
    function __construct(){
        parent::__construct(); //without this, it would just load the things inside model. We want access to the actual model class, that's what parent::__construct(); does

    }

    function xhrInsert()
    {  
       $text = $_POST['text'];

       $sth = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
       $sth->execute(array(':text' => $text));
    }
}