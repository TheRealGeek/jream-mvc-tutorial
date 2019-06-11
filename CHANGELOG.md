CHANGELOG
This is the changelog, starting from part 5 of the MVC.
This documents changes that were not done in the code, or provide more description for the ones that 
were.

03.06.2019 @1314 
    Part 5: Roles, User Management and Error Logging
    https://www.youtube.com/watch?v=JmPgJXS7uxA&list=PL7A20112CF84B2229&index=5

            
                - VSC - added .changelog

                - DB - Added 'role' field the users table in the db
                    datatype: ENUM ('default', 'admin', 'owner') and set the default value to 'default')

                - DB - modified user 'Michael' and changed his role value to 'owner'

                - DB - added user 'Mike' and changed his role value to 'owner'. Password is the same as 
                        the 'Michael' user

                - VSC - imported JREAM's css code to public/css/default.css to incorporate his style 
                        changes. 

                    changed the default text color back to the default of black
                -VSC- added the following to models/login_model.php
                ```
                        25         Session::set('role',$data['role']);
                ```
                -VSC- changed the contents of the header div in header.php to the following:
                    ```
                        23    <div id="header"> <!-- Header -->
                        24            <br>
                        25            <?php if (Session::get('loggedIn') == false) : ?>
                        26                <a href="<?php echo URL; ?>index"> Index </a>
                        27                <a href="<?php echo URL; ?>help"> Help </a>
                        28            <?php endif; ?>
                        29            
                        30            <?php if (Session::get('loggedIn') == true) : ?>
                        31                <a href="<?php echo URL; ?>dashboard"> Dashboard </a>
                        32
                        33                <?php if (Session::get('role') == 'owner') : ?>
                        34                    <a href="<?php echo URL; ?>user"> Users </a>
                        35                <?php endif; ?>
                        36
                        37                <a href="<?php echo URL; ?>dashboard/logout"> Logout</a>
                        38            <?php else : ?>
                        39                <a href="<?php echo URL; ?>login"> Login</a>
                        40            <?php endif; ?>
                        41        </div>
                            ```
                    This adds a 'user' page if the user 'role' is 'owner'. Otherwise, it hides it.
                - GIT - Committed. @1314

03.06.2019
            @1005 
                Summary: 
                    VSC: Added a user controller, model, views, an edit view that is based in 
                        the user model and controller and is only accessible by a user defined 
                        as an "owner".  
                    DB: Added a new enumerated row in the users table called 'role' with three      
                        options: (default, admin, owner), and a default value of "default".
                    Notes: Only the owner can access the User page, (it logs anyone else out 
                        for attempting) as it provides a list of all users in the database, 
                        their roles, logins and passwords, and allows for CRUD operations for 
                        new and existing users. Passwords created for new users are hashed 
                        passwords edited for existing users are not. I didn't want to take
                         the time to get around that, so for now, the passwords are unhashed
                          for the edit.
                       
                        I did my best in documenting all of the major changes, for more 
                        details, look through the commit manually.

                            
                -VSC-   controllers/user.php - New file
                            -> New user controller
                            -> Populated it based on the login controller
                            ->Final code reads:
                                ```
                                    <?php
                                        class User extends Controller{
                                            public function __construct(){ //adding public does 
                                            nothing in php 5.6
                                                parent::__construct();
                                                Session::init();
                                                $logged = Session::get('loggedIn');
                                                $role =  Session::get('role');

                                                if ($logged == false || $role != 'owner') { //this 
                                                logs out the user if they try to access an 
                                                unauthorized page. I don't like this
                                                    Session::destroy();
                                                    header('location: login');
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
                                                $data['password'] = md5($_POST['password']);
                                                $data['role'] = $_POST['role'];

                                                // @TODO do your error checking

                                                $this->model->create($data);
                                                header('location: ' . URL . 'user'); //this 
                                                'refreshes' the page. It actually sets the header 
                                                back to http://localhost/mvc/user
                                            }
                                        public function edit($id)  
                                            {
                                                //fetch ind. user
                                                $this->view->user = $this->model->userSingleList
                                                ($id);
                                                $this->view->render('user/edit');
                                            }
                                        public function editSave($id)  
                                            {
                                                $data = array();
                                                $data['id'] = $id;
                                                $data['login'] = $_POST['login'];
                                                $data['password'] = md5($_POST['password']);
                                                // $data['password'] = $_POST['password'];
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
                                ```
                    +    views/user/index.php - New file
                            ->User page view

                    +    views/user/js - New Directory
                            ->Created to hold javascript specific to only this file
                            ->Unused as of part 5 of the tutorial

                    m    controllers/dashboard.php - Modified
                            ->Added code to destroy the session on unauthorized page access and 
                            redirect to the login page.
                                //I don't like this, but it's how he wrote the code in the tutorial 
                                and I'm following along.
                    +    models/user_model.php - New File
                            ->Created the user model anf filled it in

                    m    controllers/user.php - Modified
                            ->Added code to the index() function

                    m   views/user/index.php - Modified
                            -> Added code to query the database and list all of the users in an 
                            html table, as well as giving the option edit and delete individual 
                            users directly. In addition, there is the possibility of writing new 
                            users to the database directly from the website via the users page. 
                            only users defined as owners can access this page, and must be
                            logged in.

                    m    controllers/user.php - Modified
                            ->added code to the create() function to allow post actions

                    m    models/user_model.php - Modified 
                            -> Added a create() function to reflect the create() function in 
                            controllers/user.php

                    m   index.php - Modified
                            ->Removed the code to flag errors from here, placed it at the bottom of 
                            the same file and commented it out

                   m r  .changelog-->CHANGELOG.md - Modified and Renamed
                            ->cleaned up the log and renamed it to the correct file extension and 
                            name

                - GIT - Committed @1005
04.06.2019  @1016
    Part 6: Password Security
    https://www.youtube.com/watch?v=JmPgJXS7uxA&list=PL7A20112CF84B2229&index=6
            Summary: BLANKFORNOW


                    +   libs/class.hash.php - New File
                            ->Created a hash class that takes in an algorithm variable, the data, and a 
                                salt key and returns the salted and hashed data 
                
                - GIT - Committed @1016

                    
            @1220
                    m   index.php - Modified
                            ->Included the hash class file and the new constants.php file

                    +   /config/constants.php - New File
                            -> Created a site-wide constant file
                                -> Added constant HASH_KEY with the value of 'catsFLYhigh2000miles' to 
                                    be used as the salt key. Now, all we have to do is use the HASH_KEY 
                                    constant, and it will load correctly on its own. Still using md5 as 
                                    the encryption algorithm.

                    m   index.php - Modified
                            ->Required the hash class file and the new constants.php file

                 - GIT - Committed. @1220
            @1350                  

                    m   model/login_model.php - Modified
                            ->Changed the run() password to use the new hash class for new user creation

                    m   /config/constants.php - Modified
                        -> Created a general hash constant and a password hash constant

                    m   models/user_model.php - Modified
                            -> updated the hash class salt key call to the new HASH_PASSWORD_KEY                                    
                    m   models/login_model.php - Modified
                            -> updated the hash class salt key call to the new HASH_PASSWORD_KEY

                    m   controllers/user.php - Modified
                            -> updated the password fields of create() and editSave() to not encrypt 
                                before sending the information to the user model.

                 - GIT - Committed.  @1350                 


            @1220
    Part 6: Autoloaders
    https://youtu.be/JmPgJXS7uxA?list=PL7A20112CF84B2229&t=1002

                    m   index.php - Modified
                            ->Added an autoloader using the default __autoload() function
                                NOTE: The class names need to be the same as the file name. Pay attention to the case as well, because in linux and some versions of the macOS, dir names are case sensitive.
                                
                                    Because my class names in my /lib/ dir are different than his, I had to put 
                                    ```
                                        function __autoload($class){
                                            require "libs/class.$class.php";
                                        }
                                    ```
                                    instead of 
                                    ```
                                        function __autoload($class){
                                            require "libs/$class.php";
                                        }
                                    ```
                                    in order for the loader to work correctly.
                                        my class names:
                                            class.[classname].php
                                        JREAM class names:
                                            [Classname].php

                    m   config/paths.php - Modified
                            ->defined constant LIBS for the 'libs/' pathname
                  
                    m   index.php - Modified
                            ->changed the code to use the LIBS constant in the require 
                  
                    m   libs/class.database.php - Modified
                            ->changed the constants to variables so that we can reuse the same code in other apps.
  
                    m   libs/class.models.php - Modified
                            ->changed the Database class creation to pass the db constants from config/database.php to the construct of Database at /libs/class.database.php as variables of the same name
                 - GIT - Committed.  @1220  
            @1624
        Part 6: New insert and update methods 
            (to make them more universal and useful)
        https://youtu.be/JmPgJXS7uxA?list=PL7A20112CF84B2229&t=1421

                    m   /libs/class.database.php
                            ->Added two new public functions: 
                            insert($table,$data) 
                                        & 
                             update($table, $data, $where)      
                             ->WHAT DO THEY DO

                     m   /libs/class.database.php

                     Finished the setup for the insert and update fields
                - GIT - Committed.  @1624 
05.06.2019  @1611
        Part 7: Improving the layout, code cleanup, minor security improvements, and database wrapper improvements.
        https://www.youtube.com/watch?v=Pz3Oj_fYMn8&list=PL7A20112CF84B2229&index=7

                    m   /libs/class.bootstrap.php
                            ->added code to sanitize the $url variable to prevent xss attacks and unauthorized navigation                    

                    m   /models/login_model, /models/login_model 
                            ->changed the encryption from md5 to sha256 in these files
                            ->update the users/password row in the database to have a 64 character limit and updated the individual passwords themselves.
                    ±   config.php, /config/*
                            ->Created a config.php and combined the contents of the config dir into it
                            ->deleted the config/ dir and all of its contents
                    - GIT - Committed @1611
06.06.2019  @946
              -DB-  m   users->user MVC table - Modified
                            changed the 'users' table to 'user' in 
              -VSC-    m   views/user/index.php - Modified
                            ->added an if statement to the foreach loop to not display the delete link for owners.
                                ->NOTE: this is something I decided to do on my own. His code does not include this function.
                    m   models/login_model - Modified
                            -> Added code that protects user entries with the role of owner from being deleted from the data page.
                - GIT - Committed @946    
            @1222
                    m   libs/class.database.php    
                            ->Added a select method in the database class
                    m   models/userModel.php    
                            ->Modified the userList query to use the new select() function
                    m   views/user/index.php
                            ->added a second if statement on top of the other in the views/user/index.php 
                            to catch errors if the query fails to return anything from the database.

                - GIT - Committed @1212 
                
            @1422
                    m  libs/user_model.php - Modified
                            ->changed the content of userSinglelist() to the following:
                                ```
                                            return $this->db->select( 'SELECT id, login, password, role FROM user WHERE id = :$id', array(':id'=> $id)); //not working https://youtu.be/Pz3Oj_fYMn8?list=PL7A20112CF84B2229&t=1003
                                ```
                                NOTE: this does NOT work as of right now, so I left the code commented and added a comment with the link to that spot in the video

                 - GIT - Committed @1412 
07.06.2019  @940
                    m   libs/class.database.php
                            ->added a parameter to the select function to allow for fetch and fetchAll differentiation. The variable is an integer, and it lies between the $sql and the array. 2 is default and creates a fetchAll response. The userSingleList function needs a fetch(), so that one needs a 1 to be passed. 
                            -> added an integer value of 2 on the delete function 
                            ->new select function works
                -GIT- Reintegrated branches and commit and pushed the fix to the origin @940
            @@1114
                    +   libs/class.form.php File added
                                    ->added a file to handle form sanitization.
                                        ->Incomplete as of yet, we'll complete it likely in the next part of the tutorial
                - GIT - Committed @1114


             @1611
        Part 8: Form Posting
        https://www.youtube.com/watch?v=Pz3Oj_fYMn8&list=PL7A20112CF84B2229&index=8

                    This was a booger. Follow the tutorial, but don't try to fix why it isn't working. In the form, when you are pulling data from the form in the form.php file, don't do it like he did it

                             $form  ->post('name');
                                    ->val('minlength', 2);

                    The above did not work for me. Instead, I had to do this:

                            $form->post('name');
                            $form->val('minlength', 2);

                    For each item. 

                I also changed the names of the contents of the entire libs directory, to make it match with what he has. This ended up being unnecessary to fix an error I was having, but I'm not going to take the time to change it back. 

                - DB - Added a new table called person with columns called personid, name, age, and gender, all of which accept data from the form in test/form.php
                - GIT - Committed @1611                