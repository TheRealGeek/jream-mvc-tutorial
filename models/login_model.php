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
            Session::init();
            Session::set('loggedIn',true);
            $url = URL;
            $route = 'dashboard';
            $h = "location:$url$route";
            header("$h"); //should be http://localhost/mvc/dashboard
         }else{
             $url = URL;
             $route= 'login';
             $h="location:$url$route";
             header("$h"); //should be http://localhost/mvc/dashboard
             //show an error 
         }
    }
}
