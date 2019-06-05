<?php 

class User_Model extends Model
{
    public function __construct() //make sure the __construct() is called on every new model
    {
        parent::__construct();
    }

    public function userList()//READ
    {
        $sth = $this->db->prepare('SELECT id, login, role FROM users');
        $sth->execute();
        return $sth->fetchAll();
    }
    public function userSingleList($id)//READ
    {
        $sth = $this->db->prepare('SELECT id, login, password, role FROM users WHERE id = :id'); 
        $sth->execute(array(':id' => $id));
        return $sth->fetch();
    }
    public function create($data)//CREATE
    {
        $this->db->insert('users', array(
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

       $this->db->update('users', $postData, "`id` = {$data['id']}");
        }
    
    public function delete($id) //DELETE
    {
        $sth = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $sth->execute(array(':id' => $id));
        //you would want to make sure that you couldn't delete the owner
    }
}