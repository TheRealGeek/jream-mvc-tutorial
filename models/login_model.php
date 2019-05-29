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
        // var_dump($sth);
        $credentials = array(
            ':login' => $_POST['login'],
            ':password' => $_POST['password']
        );
        $sth->execute($credentials);//I modified this. before, the value of $credentials was place in the parenthesis raw. 05-29-2019@13:12

        $data = $sth->fetchAll();
        print_r($data); //all this prints is Array()
        // var_dump($data);
        
    // // Attempt number one: Not sure if this actually works or if it is just returning the input
    //     $loginArray = array(':login' => $_POST['login'],':password' => MD5($_POST['password']));
    //     $sth = $this->db->prepare("SELECT id FROM users WHERE login = :login AND password = :password");
    //      $sth->execute(); //runs the query
    //     print_r($sth); //prints "PDOStatement Object ( [queryString] => SELECT id FROM users WHERE login = :login AND password = :password )"
    //     // $data = $sth->fetchAll();
    //     $data = $sth->fetchAll();
    //     print_r($data);
    //     var_dump($data);
    //     echo "Successful run of the login_model<br/>";
    }
}
