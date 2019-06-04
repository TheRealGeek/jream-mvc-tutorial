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
        $sth = $this->db->prepare( 'INSERT INTO users 
        (`login`,`password`,`role`)
        VALUES(:login,:password,:role) ');
        $sth->execute(array(
            ':login' => $data['login'],
            ':password' => Hash::create('md5', $data['password'], HASH_PASSWORD_KEY),
            ':role' => $data[ 'role']
        ));
    }



    public function editSave($data,$id) //UPDATE
    {
        $sth = $this->db->prepare( 'UPDATE users 
        SET
         `login` = :login,
         `password` = :password,
         `role` = :role
         WHERE id = :id');
         $array=array(':id'=>$id,
                      ':login'=>$data['login'],
                       ':password'=>Hash::create('md5', $data['password'], HASH_PASSWORD_KEY),
                      ':role' => $data['role']);
        $sth->execute($array);

        // $sth->execute(array(
        //     ':id' => ['id'],
        //     ':login' => $data['login'],
        //     ':password' => md5($data['password']),
        //     ':role' => $data['role']
        // ));



    }




    // public function editSave($data) //UPDATE
    // {
    //     $sth = $this->db->prepare('INSERT INTO users 
    //     `login` => :login, `password` => :password,`role` => :role
    //     WHERE id = :id
    //     ');
    //     $sth->execute(array(
    //         ':id' => $data['data'],
    //         ':login' => $data['login'],
    //         ':password' => $data['password'],
    //         ':role' => $data['role']
    //     ));
    // }
    public function delete($id) //DELETE
    {
        $sth = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $sth->execute(array(':id' => $id));
        //you would want to make sure that you couldn't delete the owner
    }
}