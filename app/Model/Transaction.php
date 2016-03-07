<?php

class Transaction extends AppModel {

    var $name = 'Transaction';
    var $displayField = 'transaction_id';
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Booking' => array(
            'className' => 'Booking',
            'foreignKey' => 'booking_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}

?>