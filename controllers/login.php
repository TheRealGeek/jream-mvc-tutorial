<?
    class Login extends Controller{
        function __construct(){
            parent::__construct();
        }
        function index(){       
            $this->view->render('login/index');  
            return;      }
        function run(){
            $this->model->run();
        }
    }
