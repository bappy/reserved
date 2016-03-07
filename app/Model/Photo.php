<?php

class Photo extends AppModel {

    var $name = 'Photo';
    var $displayField = 'user_id';
//    public $actsAs = array(
//        'Upload.Upload' => array(
//            'path' => '{ROOT}webroot{DS}img{DS}{model}{DS}{field}{DS}',
//            'fields' => array(
//                'dir' => 'picture_dir'
//            ),
//            'thumbnailSizes' => array(
//                'thumb' => '100x100'
//            ),
//            'thumbnailMethod' => 'php',
//            'deleteOnUpdate'  => true
//        )
//    );
    var $validate = array(
        'photos' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'photo_type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'profile_picture' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Club' => array(
            'className' => 'Club',
            'foreignKey' => 'club_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    function make_thumb($src, $dest, $desired_width,$ext) 
    {
        /* read the source image */
        if($ext =="image/jpeg")
        {
            $source_image = imagecreatefromjpeg($src);
        }
        if($ext =="image/png")
        {
            $source_image = imagecreatefrompng($src);
        }
        $width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
        if($ext =="image/jpeg")
        {
            imagejpeg($virtual_image, $dest);
        }
        if($ext =="image/png")
        {
            imagepng($virtual_image, $dest);
        }
    }

}

?>