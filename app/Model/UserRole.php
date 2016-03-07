<?php

App::uses('AppModel', 'Model');

/**
 * UserRole Model
 *
 * @property Role $Role
 * @property User $User
 */
class UserRole extends AppModel {
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    function check_user_role($user_id, $user_type){        
        $conditions = array(
            'UserRole.user_id' => $user_id,
            'UserRole.name' => $user_type
            );
        $this->recursive = -1;
        return $user_types = $this->find("count",array(
                "conditions" => $conditions
                )
                );
    }
    
}
