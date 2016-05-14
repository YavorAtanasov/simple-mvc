<?php

/*
 *      MVC framework
 * 	Written for ITG
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class picturesModel extends BaseModel {
    
    // Define model's table
    protected $table = 'pictures';

    // Get last five newly created pictures with users who uploaded them
    public function getLastFivePicturesWithUsers() {
        
        // Return the result
        return $this->runQuery(
            "select * from pictures
            left join users on pictures.owner_id=users.id
            where pictures.deleted=0 
            order by pictures.date_created desc
            limit 5"
        );
        
    }

}
