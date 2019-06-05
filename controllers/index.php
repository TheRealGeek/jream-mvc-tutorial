<?
class Index extends Controller{
    function __construct() {
        parent::__construct();
    }
    function index()
    {
        // echo Hash::create('sha256', 'Michael', HASH_PASSWORD_KEY) . ' Michael </br>';
        // echo Hash::create('sha256', 'Test', HASH_PASSWORD_KEY) . ' Test';
        $this->view->render('index/index');
    }
}
