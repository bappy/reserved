<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    var $name = 'User';
    var $displayField = 'email_address';
    public $virtualFields = array(
        'name' => "CONCAT(User.first_name, ' ', User.last_name)"
    );
    var $validate = array(
        'email_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email of Administrator cannot be left empty.'
            ), 'required' => array(
                'rule' => array('email'),
                'message' => 'Invalid email address.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Email address already used.',
            ),
        ),
        'confirm_email_address' => array(
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'email_address'),
                'message' => 'Both Email and cofirm Email must be same.'
            )
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Password cannot be left empty.'
            ),
        ),
        'confirm_password' => array(
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'password'),
                'message' => 'Both password and cofirm password must be same.'
            )
        ),
        'promoter_code' => array(
            'notempty' => array(
                'on' => 'create',
                'rule' => array('notempty'),
                'message' => 'Promotion code cannot be left empty.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Promoter Code already used.',
            ),
        ),
        'con_promoter_code' => array(
            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'promoter_code'),
                'message' => 'Both Promotion code and cofirm Promotion code password must be same.'
            )
        ),
        'phone_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Phone number cannot be left empty.',
            //'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

//The Associations below have been created with all possible keys, those that are not needed can be removed
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    var $belongsTo = array(
        'JobTitle' => array(
            'className' => 'JobTitle',
            'foreignKey' => 'job_title_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    var $hasOne = array('UserInfo' => array('className' => 'UserInfo', 'foreignKey' => 'user_id'));
    var $hasMany = array(
        
        'Reference' => array(
            'className' => 'Reference',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Booking' => array(
            'className' => 'Booking',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Card' => array(
            'className' => 'Card',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ClubBottle' => array(
            'className' => 'ClubBottle',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ClubTable' => array(
            'className' => 'ClubTable',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Club' => array(
            'className' => 'Club',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'QuestionAnswer' => array(
            'className' => 'QuestionAnswer',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Split' => array(
            'className' => 'Split',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    function identicalFieldValues($field = array(), $compare_field = null) {
        foreach ($field as $key => $value) {
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if ($v1 !== $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }

    function generatePassword($length = 8) {
// inicializa variables 
        $password = "";
        $i = 0;
        $possible = "123456789bcdfghjkmnpqrstvwxyz";
        $pincode = "123456789";

        if ($length > 4) {
            while ($i < $length) {
                $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

                if (!strstr($password, $char)) {
                    $password .= $char;
                    $i++;
                }
            }
        } else {
            while ($i < $length) {
                $char = substr($pincode, mt_rand(0, strlen($pincode) - 1), 1);

                if (!strstr($password, $char)) {
                    $password .= $char;
                    $i++;
                }
            }
        }
        return $password;
    }

    public function send_user_access($to_email, $pass, $pincode = null) {
//        $Email = new CakeEmail();
//        $Email->from(array('me@example.com' => 'My Site'))
//                ->to($to_email)
//                ->subject('Youe reserved app administrator login access')
//                ->send('My message'.$pass);
        $options = array();
        $defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => __d('users', 'Club Information'),
            'template' => 'club_password',
            'emailFormat' => CakeEmail::MESSAGE_TEXT,
            'layout' => 'default'
        );


        $options = array_merge($defaults, $options);
        $Email = $this->_getMailInstance();
        $Email->to($to_email)
                ->from($options['from']);
        $Email->emailFormat($options['emailFormat'])
                ->subject($options['subject'])
                ->template($options['template'], $options['layout'])
                ->viewVars(array(
                    'email' => $to_email,
                    'password' => $pass,
                    'pincode' => $pincode
                ))
                ->send();
    }

    /**
     * Checks the token for a password change
     * 
     * @param string $token Token
     * @return mixed False or user data as array
     */
    public function checkPasswordToken($token = null) {
        $user = $this->find('first', array(
            'contain' => array(),
            'conditions' => array(
                $this->alias . '.password_token' => $token,
                $this->alias . '.email_token_expires >=' => date('Y-m-d H:i:s'))));
        if (empty($user)) {
            return false;
        }
        return $user;
    }

    /**
     * Checks if an email is in the system, validated and if the user is active so that the user is allowed to reste his password
     *
     * @param array $postData post data from controller
     * @return mixed False or user data as array on success
     */
    public function passwordReset($postData = array()) {
        $user = $this->find('first', array(
            'contain' => array(),
            'conditions' => array(
                $this->alias . '.email_address' => $postData[$this->alias]['email_address'])
        ));

        if (!empty($user)) {
            $sixtyMins = time() + 43000;
            $token = $this->generateToken();
            $user[$this->alias]['password_token'] = $token;
            $user[$this->alias]['email_token_expires'] = date('Y-m-d H:i:s', $sixtyMins);
            $user = $this->save($user, false);
            $this->data = $user;
            return $user;
        } elseif (!empty($user) && $user[$this->alias]['email_verified'] == 0) {
            $this->invalidate('email', __d('users', 'This Email Address exists but was never validated.'));
        } else {
            $this->invalidate('email', __d('users', 'This Email Address does not exist in the system.'));
        }

        return false;
    }

    /**
     * Generate token used by the user registration system
     *
     * @param int $length Token Length
     * @return string
     */
    public function generateToken($length = 10) {
        $possible = '0123456789abcdefghijklmnopqrstuvwxyz';
        $token = "";
        $i = 0;

        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!stristr($token, $char)) {
                $token .= $char;
                $i++;
            }
        }
        return $token;
    }

    /**
     * Resets the password
     * 
     * @param array $postData Post data from controller
     * @return boolean True on success
     */
    public function resetPassword($postData = array()) {
        $result = false;
        $this->set($postData);

        if ($this->data[$this->alias]['password'] == $this->data[$this->alias]['confirm_password']) {
            $passwordHasher = new SimplePasswordHasher();
            $password = $passwordHasher->hash($this->data[$this->alias]['password']);
            $this->data[$this->alias]['password'] = $password;

            $this->data[$this->alias]['password_token'] = null;
            $result = $this->save($this->data, array('validate' => false));
        } else {
            $this->validates();
        }
        return $result;
    }

    protected function _getMailInstance() {
        $emailConfig = Configure::read('Users.emailConfig');
        if ($emailConfig) {
            return new CakeEmail($emailConfig);
        } else {
            return new CakeEmail('default');
        }
    }

    public function fetch_user_id($info) {        
        if ($info['created_by'] > 0) {
            $user_id = $info["created_by"];
        } else {
            $user_id = $info["id"];
        }
        return $user_id;
    }

}

?>