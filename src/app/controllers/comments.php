<?php

/*
 *      MVC framework
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class comments extends BaseController {

    // Class constructor
    public function __contruct() {

        // Allow only admins
        if (!isset($_SESSION['user']['is_admin']) || $_SESSION['user']['is_admin'] != 1)
            header('Location:' . BASEURL);
    }

    // Index page
    public function index($params = '') {
        
    }

    // List comments page
    public function listC($params = '') {

        // Load comments model
        $comments = $this->model('comments');

        // Conveet param to int value
        $params = intval($params);

        // Load view if there is param passed
        if (!empty($params)) {

            // Select all comments for picture ID
            $data['res'] = $comments->selectAll('*', array( 'deleted=0', 'picture_id=' . $params ), array( 'date_created desc' ));

            // Load view
            $this->view('comments/list', $data);
        }
    }

    // Delete picture
    public function delete($params = '') {

        // Conveet param to int value
        $params = intval($params);

        // Check param
        if (!empty($params)) {

            // Load comments model
            $comment = $this->model('comments');

            // Check if logged user is Admin
            if (!empty($params) && isset($_SESSION['user']['id']) && $_SESSION['user']['is_admin'] == 1) {

                // Delete picture
                $result = $comment->update(
                    array(
                        'deleted' => 1
                    ), 
                    array(
                        "id=" . $params
                    )
                );

                // If succefuly deleted
                if ($result)
                    $data['success'] = 'Comment deleted!';

                // If there was an error
                else
                    $data['errMSG'] = 'Unable to deleted!';

                // Else User does not have permissions
            } else {

                // Define error message
                $data['errMSG'] = 'You do not have permissions to delete!';
            }

            // Load view
            $this->view('delete', $data);
        }
    }

}
