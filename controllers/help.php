<?
class Help extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        $this->view->render('help/index');
    }
    public function other($arg = false){
        // echo 'We are inside other<br/>';
        // echo 'optional: ' . $arg . '<br/>';

        require 'models/help_model.php';
        $model = new Help_Model();
        $this->view->blah = $model->blah();
    }
}
?>