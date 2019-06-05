<?php
class User extends Controller{
    public function __construct(){ //adding public does nothing in php 5.6
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        $role =  Session::get('role');

        if ($logged == false || $role != 'owner') { //this logs out the user if they try to access an unauthorized page. I don't like this
            Session::destroy();
            header('location: ../login');
            exit;
        }
    }
    public function index()  
     {
        $this->view->userList = $this->model->userList();
         $this->view->render('user/index');

     }
    public function create()  
     {
        $data = array();
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role']; 

        // @TODO do your error checking

        $this->model->create($data);
        header('location: ' . URL . 'user'); //this 'refreshes' the page. It actually sets the header back to http://localhost/mvc/user
     }
   public function edit($id)  
    {
        //fetch ind. user
        $this->view->user = $this->model->userSingleList($id);
        $this->view->render('user/edit');
    }
   public function editSave($id)  
    {
        $data = array();
        $data['id'] = $id;
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        // @TODO do your error checking
        $this->model->editSave($data,$id);
        header('location: ' . URL . 'user');
        }
   public function delete($id)  
    {
        $this->model->delete($id);
        header('location: ' . URL . 'user');  

    }


}
?>