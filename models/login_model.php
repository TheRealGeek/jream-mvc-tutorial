<?php //business logic only, no routing

class Login_Model extends Model
{
    public function __construct() //make sure the __construct() is called on every new model
    {
        parent::__construct();
    }
    public function run()
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE 
        login = :login AND password = MD5(:password)");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => $_POST['password']
        ));

        // $data = $sth->fetchAll();
         $count = $sth->rowCount();
         if ($count >0){
             //login
         }else{
             //show an error
         }
    }
}
