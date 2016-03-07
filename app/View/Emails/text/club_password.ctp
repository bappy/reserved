<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$url = "http://54.193.48.215";
echo __d('users', 'Thank you for the registration!');
echo "\n";
echo "Your user id is ".$email." And your password : ".$password;
echo "\n";
if($pincode > 0){
echo "\n";
echo "Your waitress account access details are as follows";
echo "Email address : ".$email;
echo "\n";
echo "Pin code : ".$pincode;
}
echo "\n";
echo "You can login using the link below :";
echo "\n";

echo $this->Html->url(array('admin' => false,'controller' => 'Users', 'action' => 'login'));