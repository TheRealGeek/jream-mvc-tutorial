<?php
class Dashboard extends Controller
{
    function __construct(){
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) { 
            Session::destroy();
            header('location: login');
            exit;
        }
        $this->view->js = array('dashboard/js/default.js'); //setting a js variable to the view //Moved to line 7
    }
    function index()
    {
        $this->view->render('dashboard/index');
    }
    function logout(){
        Session::destroy();
        header('location: ../login');
        exit; 
    }
    function xhrInsert(){ //xml http request vs ajax
        $this->model->xhrInsert(); 
    }
    function xhrGetListings(){ //xml http request vs ajax
        $this->model-> xhrGetListings(); 
    }
}
