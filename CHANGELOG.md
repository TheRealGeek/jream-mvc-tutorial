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
                - GIT - Committed.

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

                - GIT - Committed.
04.06.2019  @1016
    Part 6: Password Security
    https://www.youtube.com/watch?v=JmPgJXS7uxA&list=PL7A20112CF84B2229&index=6
            Summary: BLANKFORNOW


                    +   libs/class.hash.php - New File
                            ->Created a hash class that takes in an algorithm variable, the data, and a 
                                salt key and returns the salted and hashed data 
                
                - GIT - Committed @1219
                        Pushed  @1219
                    
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

                 - GIT - Committed. @1350                  

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

                 - GIT - Committed.  @1458                 
                 - GIT - Pushed.  @1458                 



        
                            

