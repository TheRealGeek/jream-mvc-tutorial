<?php 

class User_Model extends Model
{
    public function __construct() //make sure the __construct() is called on every new model
    {
        parent::__construct();
    }

    public function userList()//READ
    {
        return $this->db->select('SELECT id, login, role FROM user'); 
    }
    public function userSingleList($id)//READ
    {
        // $sth = $this->db->prepare('SELECT id, login, password, role FROM user WHERE id = :id');
        // $sth->execute(array(':id' => $id));
        // return $sth->fetch();

        return $this->db->select( 'SELECT id, login, password, role FROM user WHERE id = :$id', array(':id'=> $id)); //not working https://youtu.be/Pz3Oj_fYMn8?list=PL7A20112CF84B2229&t=1003
    }
    public function create($data)//CREATE 
    {
        $this->db->insert('user', array(
            'login' => $data['login'],
            'password' => Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']
        ));
    }

    public function editSave($data) //UPDATE
    {
        $postData = array(
                'login'=>$data['login'],
                'password'=>Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
                'role' => $data['role']
            );

       $this->db->update('user', $postData, "`id` = {$data['id']}");
        }
    
    public function delete($id) //DELETE
    {
        $sth = $this->db->prepare('SELECT role FROM user WHERE id = :id');
        $sth->execute(array(':id' => $id));
        $data = $sth->fetch();
        if ($data['role'] == 'owner'){
            return false;
        } 
        $sth = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $sth->execute(array(':id' => $id));
    
    }
}