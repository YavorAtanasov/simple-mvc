<?php

/*
 *      MVC framework
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class home extends BaseController {

    // Index page
    public function index($params = '') {

        //Load pictures model
        $pic = $this->model('pictures');

        //If user is admin
        if (isset($_SESSION['user']['is_admin']) and $_SESSION['user']['is_admin'] == 1) {

            //Load users model
            $users = $this->model('users');

            //Get last five newly registered users
            $data['users'] = $users->selectAll('*', array( 'deleted=0' ), array( 'date_created desc' ), 5);

            //Get last five newly created pictures with users who uploaded them
            $data['pics'] = $pic->getLastFivePicturesWithUsers();

            //Else regular user
        } else {

            //Load newest 10 pictures
            $data = $pic->selectAll('*', array( 'deleted=0' ), array( 'date_created desc' ), 10);
        }

        //Load view
        $this->view('index', $data);
    }

    //Page with form for uploading pictures
    public function picForm($params = '') {
        
        //Load View
        $this->view('pictures/picturesForm');
        
    }

}
