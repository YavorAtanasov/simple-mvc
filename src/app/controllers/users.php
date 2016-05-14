<?php

/*
 *      MVC framework
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class users extends BaseController {

    // Index page
    public function index($params = '') {

        // Load model
        $user = $this->model('users');

        // Get count of all not deleted users
        $data['vars']['count'] = $user->count('*', array( 'deleted=0' ));
        
        
        // If there is param create offset for the query
        if (!empty($params) and $params > 0)  $start = $params * 10 - 10;
           
        // Else laod first page
        else $start = 0;
            
        // If count devided by 10 is not whole number then we need one page more
        if ($data['vars']['count'] % 10 > 0) $limit = intval($data['vars']['count'] / 10) + 1;
            
        // Else number of pages is count devided by 10            
        else $limit = $data['vars']['count'] % 10;
            
        // If some passes variable in the url bigger than the limit, load last page instead of empty page.
        if ($start > $limit) $params = $limit;
        
        // Get all not deleted users order by number of posts desc
        $data['res'] = $user->selectAll('*', array( 'deleted=0' ), array( 'number_of_posts desc' ), 10, $start);

        // Pass the current page to view
        $data['vars']['page'] = $params;
        
        // Pass limit of pages to the view
        $data['vars']['limit'] = $limit;
        
        // Load view with data
        $this->view('users/index', $data);
    }

    // Check username and password
    public function entrance() {
        
        // If userneme is posted sanitize it
        if (isset($_POST['username'])) $login = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        
        // Else login empty login
        else $login = null;
       
        // If password is posted sanitize it
        if (isset($_POST['password'])) $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
        
        // Else login empty login
        else $password = null;
        
        //Load model
        $user = $this->model('users');

        // Get user from DB where login and password matche
        $records = $user->selectOne('*', array( "username ='" . $login . "'", "password='" . $password . "'" ));

        // If there is matching record succesful login and set SESSION
        if (count($records) > 0) {
            
            // Set session for logged in user
            $_SESSION['user'] = array(
                'id' => $records['id'],
                'first_name' => $records['first_name'],
                'is_admin' => $records['admin'],
            );
        }
        
        // If login succeful redirect to index page
        if (isset($_SESSION['user']['id'])) header('Location:' . BASEURL);
            
        // Else load wrong password view
        else {
            
            // Create Error message
            $data['errMSG'] = 'Wrong Username or Password';
            
            //Load view
            $this->view('wrongPassword', $data);
            
        }
    }

    // Logout 
    public function logout() {
        
        // Unset SESSION
        unset($_SESSION['user']);
        
        // Redirect to index page
        header('Location:' . BASEURL);
    }

    // Register page
    public function register() {
        
        // If form is submited
        if (isset($_POST['submit'])) {
            
            //Load model
            $user = $this->model('users');
            
            // Get one user from DB as posted username
            $chk = $user->selectOne('*', array( "username='" . $_POST['username'] . "'" ));

            // If there is no duplicate username save the record
            if (!$chk) {
                $rec = $user->insert(
                        array(
                            'username' => $_POST['username'],
                            'password' => md5($_POST['password']),
                            'deleted' => 0,
                            'first_name' => $_POST['first_name'],
                            'last_name' => $_POST['last_name'],
                            'phone' => $_POST['phone'],
                            'email' => $_POST['email'],
                            'address' => $_POST['address'],
                            'city' => $_POST['city'],
                            'state' => $_POST['state'],
                            'date_created' => date('Y-m-d H:i:s'),
                            'date_updated' => date('Y-m-d H:i:s'),
                        )
                );
                
                // If saving successful create success message and do not display the form
                if ($rec) {
                    
                    // Create success mesage
                    $data['success'] = 'Succefuly register!';
                    
                    // Hide form
                    $data['doNotShowForm'] = true;
                    
                } 
                
                // Create error message
                else  $data['errMSG'] = 'Something went wrong';

            } 
            
            // Else create message user already exists
            else $data['errMSG'] = 'Username already exists!';

        }
        
        // Load view with data
        $this->view('register', $data);
    }

    // Profile page
    public function profile() {
        
        // If user is logged in
        if (isset($_SESSION['user'])) {

            // Load model
            $user = $this->model('users');
           
            // Get user info by id
            $data = $user->selectOne('*', array( 'id=' . $_SESSION['user']['id'] ));
            
            // If form is submited save changes in profile
            if (isset($_POST['submit'])) {
                
                // If new password is passed change it
                if (isset($_POST['password']) and !empty($_POST['password'])) $pass = md5($_POST['password']);
                
                // Else do not change password
                else  $pass = null;
                
                // Set update array
                $updateArray = array(
                    'password' => $pass,
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'address' => $_POST['address'],
                    'city' => $_POST['city'],
                    'state' => $_POST['state'],
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_updated' => date('Y-m-d H:i:s'),
                );   
               
                // If password was not passed do not change it
                if (!$pass) unset($updateArray['password']);
                 
              
                // Update the record in DB
                $res = $user->update(
                        $updateArray, 
                        array(
                            'id=' . $_SESSION['user']['id']
                        )
                );
                
                // If was not succefully updated create error message
                if (!$res)  $data['errMSG'] = 'Unable to update!';
                   
                // Ger new data from DB and load it for view
                else $data = $user->selectOne('*', array( 'id=' . $_SESSION['user']['id'] ));
                
            }
            
            // Load view
            $this->view('profile', $data);
        } 
        
        // Else not login user trying ot access redirect to index page
        else header('Location:' . BASEURL);

    }

    //Delete user
    public function delete($params = '') {
        
        // Convert params to int value
        $params = intval($params);
        
        // If there is param passed
        if (!empty($params)) {
            
            // Load model
            $user = $this->model('users');

            //If user is logged in and is admin
            if (isset($_SESSION['user']['id']) and $_SESSION['user']['is_admin'] == 1) {
                
                // Update the db 
                $result = $user->update(
                    array(
                        'deleted' => 1
                    ), 
                    array(
                        "id=" . $params 
                    )
                );

                // If succefully deleted create success message
                if ($result) $data['success'] = 'Comment deleted!';
                  
                //Else create Error message
                else $data['errMSG'] = 'Unable to deleted!';
                    
            } 
            
            //Else user does not have permission create error message
            else $data['errMSG'] = 'You do not have permissions to delete!';
                
            // Laod view
            $this->view('delete', $data);
        }
    }

}
