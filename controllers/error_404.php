<?
class Error_404 extends Controller{
    function __construct() {
        parent::__construct();

    }
    function index()
    {
        // echo 'Error 404, file could not be found';

        $this->view->msg = "Page could not be found! Maybe it moved, maybe you typed it wrong.¯\_o_o_/¯";
        $this->view->render('error/index');
    }
}
?>