<?php

/*
 *      MVC framework
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class pictures extends BaseController {

    // Index page
    public function index($params = '') {

        // Load model
        $pic = $this->model('pictures');

        // Get count of all not deleted picutres
        $data['vars']['count'] = $pic->count('*', array( 'deleted=0' ));

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

        // Get all not deleted pictures order by date created desc
        $data['res'] = $pic->selectAll('*', array( 'deleted=0' ), array( 'date_created desc' ), 10, $start);
        
        // Pass current page to the view
        $data['vars']['page'] = $params;
        
        // Pass limit of pages to the view
        $data['vars']['limit'] = $limit;
        
        // Load view
        $this->view('pictures/index', $data);
        
    }

    // Upload picture
    public function upload($params = '') {

        // If form is submitted
        if (isset($_POST['submit'])) {
            
            // Define empty element of the array. Need to be able to add all errors.
            $data['errMSG'] = '';
            
            // Load model
            $pic = $this->model('pictures');
            
            // Define path where and name of the picture
            $file = 'uploads/' . basename($_FILES["file"]["name"]);
            
            // Get size of an image file
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            
            // If file is not image add error message.
            if ($check == false) $data['errMSG'] .= "File is not an image.<br/>";
            
            // Get count of the same names as the file in the database
            $count = $pic->count('*', array( "file_name='" . basename($_FILES["file"]["name"]) . "'" ));

            // If file exists or the file name is already in the database add error message.
            if (file_exists($file) or $count > 10) $data['errMSG'] .= "Sorry, file already exists.<br/>";
 
            // If file is bigger than 1.5MB add error message.
            if ($_FILES["file"]["size"] > 1610612736) $data['errMSG'] .= "Sorry, your file is too large.<br/>";

            //  Get extension of the file.
            $imageFileType = pathinfo($file, PATHINFO_EXTENSION);
            
            // If extension of the file is different from JPG, JPEG, PNG & GIF add error message
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
               
                $data['errMSG'] .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
            
            }

            // Get count of the images uploaded by user
            $countU = $pic->count('*', array( "owner_id = " . $_SESSION['user']['id'] ));
            
            // If user uploaded more than 10 pictures add error.
            if ($countU || $countU > 10) $data['errMSG'] .= "Limit of 10 pictures per users is reached.<br/>";

            // If there are no errors save file and create record in the database
            if (strlen($data['errMSG'])==0) {
                
                // If file is moved succefully
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $file)) {
                    
                    // Add success message
                    $data['success'] = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                    
                    // Load model
                    $pic = $this->model('pictures');
                    
                    // Insert picture information in the database.
                    $pic->insert(
                        array(
                            'file_name' => basename($_FILES["file"]["name"]),
                            'date_created' => date('Y-m-d H:i:s'),
                            'date_updated' => date('Y-m-d H:i:s'),
                            'deleted' => 0,
                            'owner_id' => $_SESSION['user']['id'],
                        )
                    );
                } 
                
                // Else add error message
                else $data['errMSG'] .= "Sorry, there was an error uploading your file.";
                       
            }

            // Remove last new line
            $data['errMSG'] = rtrim($data['errMSG'], "<br/>");
        }
        
        // Load view and pass data.
        $this->view('pictures/picturesForm', $data);
    }

    // Page for viewing a picture
    public function thumbview($params = '') {
        
        // Load model
        $pic = $this->model('pictures');
        
        // Load model
        $comment = $this->model('comments');
        
        // If there is picture id passed prepare view
        if (!empty($params)) {
            
            // If logged user is admin get all comments for visualization
            if (isset($_SESSION['user']['id']) && $_SESSION['user']['is_admin'] == 1) {
               
                // Get comments from DB
                $data['comments'] = $comment->selectAll('*', array( 'picture_id=' . $params, 'deleted=0' ));
            
            // If comment is submited store it in DB    
            } else if (isset($_POST['submit']) && isset($_SESSION['user']['id'])) {

                // Load model
                $users = $this->model('users');
                
                // Get count of comments submited for this picture
                $count = $comment->count('*', array( 'picture_id=' . $params, 'deleted=0' ));
                
                // If there are no comments or less than 10 store the comment
                if (!$count or $count < 10) {
                    
                    // Insert comment in the DB
                    $res = $comment->insert(
                        array(
                            'comment' => $_POST['comment'],
                            'picture_id' => $params,
                            'user_id' => $_SESSION['user']['id'],
                            'date_created' => date('Y-m-d H:i:s'),
                            'date_updated' => date('Y-m-d H:i:s'),
                        )
                    );
                    
                    // If succefully stored add success message
                    $data['success'] = $res ? 'Commenet saved. Thank you!' : null;
                    
                } 
                
                // Else limit of 10 reached add error message
                else $data['errMSG'] = 'Limit of 10 comments per image is reached!';

                // Get number of posts for user 
                $res = $users->selectOne('number_of_posts', array( 'id=' . $_SESSION['user']['id'] ));
                
                // Increase the number of posts with one.
                $res = $users->update(array( 'number_of_posts' => $res['number_of_posts'] + 1 ), array( 'id=' . $_SESSION['user']['id'] ));
            }
            
            // Get picture by id
            $data['pic'] = $pic->selectOne('*', array( 'id=' . $params ));
            
            // Load View with data
            $this->view('pictures/thumbview', $data);
        }
    }

    
    // Delete picture drom DB
    public function delete($params = '') {
        
        // Convert params to int value
        $params = intval($params);
        
        // If there is param passed
        if (!empty($params)) {
            
            //Load model
            $pic = $this->model('pictures');
            
            // Get picture info by id
            $res = $pic->selectOne('*', array( 'id=' . $params ));
            
            // If user is logged and is owner or admin then start delete process
            if (isset($_SESSION['user'])) {
                
                // If logged user is owner
                if ($res["owner_id"] == $_SESSION['user']['id'] or $_SESSION['user']['is_admin'] == 1) {
                    
                    // Delete picture in DB
                    $result = $pic->update(
                        array(
                            'deleted' => 1
                        ), 
                        array( 
                            "id=" . $params 
                        )
                    );
                    
                    // If success add succes message
                    if ($result) $data['success'] = 'Picture deleted!';
                      
                    // Else add error message
                    else $data['errMSG'] = 'Unable to deleted!';
                        

                } 
                
                // Else user is not owner or admin and add error message - No permissions 
                else $data['errMSG'] = 'You do not have permissions to delete!';
                        
            }
            
            // Else user is not logged in add error message no permission to delete/
            else $data['errMSG'] = 'You do not have permissions to delete!';
                
            //Load view with data
            $this->view('delete', $data);
        }
    }

    public function listU($params = '') {
        
        // Convert params to int value
        $params = intval($params);
        
        // If param is passed
        if (!empty($params)) {
            
            // Load Model
            $pic = $this->model('pictures');

           // Get all picture by user id
            $data['res'] = $pic->selectAll('*', array( 'deleted=0', 'owner_id=' . $params ));
            
        }
        
        // Load view with data
        $this->view('pictures/index', $data);
   
    }

}
