<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UserInfo extends AppModel {

    var $name = 'UserInfo';
    var $validate = array(
        'website' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Wesite address can not be blank.'
            ), 
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
		'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
        )
    );
}

?>