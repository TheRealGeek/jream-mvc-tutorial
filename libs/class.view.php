<?
class View
{
    function __construct()
    {
        // echo 'This is the view.';
    }
    public function render($name, $noHeaderFooter = false, $noHeader = false, $noFooter = false)//options aren't working atm 05/23 @1204 MVC pt2 
    {//usage should be "render('URL', 0/1 DEFAULT:0, 0/1 DEFAULT:0, 0/1 DEFAULT:0); " in the 

        if ($noHeaderFooter === true) {//.........stops loading of both
            require 'views/' . $name . '.php';
        } elseif ($noHeader === true) {//.........stops loading of footer
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        } elseif ($noFooter === true) {//.........stops loading of header
            require 'views/header.php';
            require 'views/' . $name . '.php';
        } else { //............................includes both by default
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }
}
