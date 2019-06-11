<?php

require '../config.php';
require '../libs/Form.php';
require '../libs/Database.php';

// var_dump($_POST);
if (isset($_REQUEST['run'])) {
    try {
        $form = new Form();
        $form->post('name');
        $form->val('minlength', 2); //written a different way, this would be $_val->minlength('name');

        $form->post('age'); //it never reaches 'age', the array shows as a string
        $form->val('digit');

        $form->post('gender');
        // echo '<pre> The print_r of $form: ';
        // print_r($form);
        // echo '<br> end of the print_r <br></pre>';
        $form->submit();

        echo 'The form passed!';
        $data = $form->fetch();

        echo '<pre>The data in form.php <br>';
        print_r($data);
        echo '</pre>';

        $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); //models often use databases. Created one during MVC Tut. p3
        $db->insert('person', $data);

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<form method="post" action="?run">
    Name <input type="text" name="name" /><br>
    Age <input type="text" name="age" /><br>
    Gender <select name="gender">
        <option value="m">Male</option>
        <option value="f">Female</option>
    </select><br>
    <input type="submit" />
    <br><a href="./form.php">back</a>
</form>