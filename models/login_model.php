<?php //business logic only, no routing

class Login_Model extends Model
{
    public function __construct() //make sure the __construct() is called on every new model
    {
        parent::__construct();
    }
    public function run()
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE login = :login AND password = MD5(:password)");
        $sth->execute(array(
            ':login'=> $_POST['login'],
            ':password'=> $_POST['password']
        ));
        
        $data = $sth->fetchAll();
        print_r($data);
        var_dump($data);
        
        
    //     $loginArray = array(':login' => $_POST['login'],':password' => MD5($_POST['password']));
    //     $sth = $this->db->prepare("SELECT id FROM users WHERE login = :login AND password = :password");
    //     $sth->execute($loginArray
    //         // array(
    //         // ':login' => $_POST['login'],
    //         // ':password' => $_POST['password']
    //     // )
    // ); //runs the query
    //     print_r($loginArray);
    //     // $data = $sth->fetchAll();
    //     $data = $loginArray->fetchAll();
    //     print_r($data);
    //     echo "Successful run of the login_model<br/>";
    }
}
