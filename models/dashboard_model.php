<?php
class Dashboard_Model extends Model
{
    public function __construct(){
        parent::__construct(); //without this, it would just load the things inside model. We want access to the actual model class, that's what parent::__construct(); does

    }

    public function xhrInsert()
    {  
       $text = $_POST['text'];//this will need to be sanitized

       $sth = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
       $sth->execute(array(':text' => $text));

        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
       echo json_encode($data); 
    }
    public function xhrGetListings(){
        $sth = $this->db->prepare('SELECT * FROM data');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        echo json_encode($data);
    }
    public function xhrDeleteListing(){
        $id = $_POST['id'];
        $sth = $this->db->prepare('DELETE FROM data WHERE id = "'.$id.'"  ');
        $sth->execute();

    
    }
}