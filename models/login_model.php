<?php //business logic only, no routing

class Login_Model extends Model
{
    public function __construct() //make sure the __construct() is called on every new model
    {
        parent::__construct();
    }
    
    public function run()
    {
        
        $sth = $this->db->prepare("SELECT id, role FROM users WHERE 
        login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => Hash::create('sha256', $_POST['password'] , HASH_PASSWORD_KEY)
        ));

        $data = $sth->fetch();
    
        $count = $sth->rowCount();
         if ($count >0){
            //login
            Session::init();
            Session::set('role',$data['role']);
            Session::set('loggedIn',true);
            // $url = URL;
            // $route = 'dashboard';
            // $h = "location:$url$route";
            // header("$h"); //should be http://localhost/mvc/dashboard
            header('location: ../dashboard');

         }else{
             $url = URL;
             $route= 'login';
             $h="location:$url$route";
             header("$h"); //should be http://localhost/mvc/dashboard
             //show an error 
         }
    }
}
