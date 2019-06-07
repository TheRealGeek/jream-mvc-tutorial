<?php
class Dashboard_Model extends Model
{
    public function __construct(){
        parent::__construct(); //without this, it would just load the things inside model. We want access to the actual model class, that's what parent::__construct(); does

    }

    public function xhrInsert()
    {  
       $text = $_POST['text'];//this will need to be sanitized
        $this->db->insert('data', array('text'=>$text));
        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
       echo json_encode($data);
       $text =''; 
    }
    public function xhrGetListings(){
        $result = $this->db->select( "SELECT * FROM data");
        echo json_encode($result);
    }
    public function xhrDeleteListing(){
        $id = (int) $_POST['id']; 
        $this->db->delete('data', "id = '$id'");
    }
}
