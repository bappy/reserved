<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'braintree/Braintree');

//final Update 5th november
//bookinginfo good time calculation
class MobilesController extends AppController {

    var $name = 'Mobiles';
    public $components = array('RequestHandler');
   // var $default_time_zone = 'Asia/Dhaka';
    var $default_time_zone = "America/Los_Angeles";
    var $environmemt = 'sandbox';
    var $marchentid = 'dqyqf5vh3vypthtm';
    var $publickey = 'xbrywsqf5cym7d7t';
    var $privatekey = 'f3a438fbff478efa42fe1c6fdeb7d514';
    var $marchentAccountId = '3dz9799qsjtgkr8h';
    var $uses = array("User", "Question", "QuestionAnswer", "UserRole", "Club", "ClubException", 'Photo', "Booking", "ClubTable", "Split", "Event", "Category", "Deal", "ClubBottle", "Reference", "Card");

    function gtd($t1, $t2) {


        if (($t1 = strtotime($t1)) === false)
            die("Input string 1 unrecognized");
        if (($t2 = strtotime($t2)) === false)
            die("Input string 2 unrecognized");

        if ($t1 < $t2) {
            $d1 = getdate($t2);
            $d2 = getdate($t1);
        } else {
            $d1 = getdate($t1);
            $d2 = getdate($t2);
        }

        foreach ($d1 as $k => $v) {
            $d1[$k]-= $d2[$k];
        }


        if ($d1['seconds'] < 0) {
            $d1['seconds'] +=60;
            $d1['minutes'] -=1;
        }

        if ($d1['minutes'] < 0) {
            $d1['minutes'] +=60;
            $d1['hours'] -=1;
        }

        if ($d1['hours'] < 0) {
            $d1['hours'] +=24;
            $d1['yday'] -=1;
        }

        if ($d1['yday'] < 0) {
            $d1['yday'] +=365;
            $d1['year'] -=1;
        }



        return ($d1);
    }

    function index() {
        $this->Tip->recursive = 0;
        $this->set('tips', $this->paginate());
    }

    public function beforeFilter() {
        $this->Auth->allow();
        $this->set('_jsonp', true);
    }

    function bookingprice($booking_id) {
        $this->loadModel('Booking');
        $booking_price = $this->Booking->findById($booking_id, array('fields' => 'Booking.booking_price'));
        return($booking_price['Booking']['booking_price']);
    }

    function braintreeprocesstansaction($booking_id, $function_name, $user_id) {
        $this->autoRender = false;
        $this->debug = false;
        //$booking_id=388;
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $this->loadModel('Split');
        $this->loadModel('User');
        $this->Split->Behaviors->load('Containable');
        $this->Split->contain('User');
        //$this->Split->recursive=-1;//, 'fields' => array("Split.splited_amount","Split.id","User.token","Booking.booking_price")
        $conditions = array('conditions' => array('Split.booking_id' => $booking_id, 'Split.status' => 'braintreehold'), 'fields' => array('Split.booking_id', "Split.splited_amount", "Split.id", "User.token", "Split.id"));
        // $this->User->recursive = ;
        $data = $this->Split->find("all", $conditions);

        foreach ($data as $d) {
            $pre_amount = ($this->bookingprice($d['Split']['booking_id'])) * ($d['Split']['splited_amount'] / 100);
            //echo '"'.$pre_amount.'"';
            //echo $d['User']['token']; 
            $pre_amount = number_format((float) $pre_amount, 2, '.', '');


            $result = Braintree_Transaction::sale(
                            array(
                                'paymentMethodToken' => $d['User']['token'],
                                'amount' => $pre_amount
                            )
            );
            if (!$result->success) {
                $club['Success'] = 'Yes'; //for login 
                $club['user_id'] = $user_id;
                $club['acceptence_split_bill_request']['message'] = $result->message;
                $club['acceptence_split_bill_request']['Success'] = 'no';
                echo "$function_name (\n";
                echo json_encode($club);
                echo ");\n";
                exit();
            } else {
                $transaction[] = $result->transaction->id;
                $this->Split->id = $d['Split']['id'];
                $this->Split->set('transaction_id', $result->transaction->id);
                $this->Split->save();
            }
        }

        return $transaction;
    }

    function spliterinfo($booking_id) {

        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Booking');

        return($this->Booking->findById($booking_id, array('field' => 'Booking.booking_price')));
    }

    function resetpin() {
        $this->autoRender = false;
        $this->debug = false;
        $function_name = $this->params->query['callback'];
        $old_pincode = $this->params->query['old_pincode'];
        $new_pincode = $this->params->query['new_pincode'];
        $email = $this->params->query['email'];
        $conditions = array("User.email_address" => $email, "User.pincode" => $old_pincode);
        $this->User->recursive = -1;
        $users = $this->User->find("first", array("conditions" => $conditions));
        if (!isset($users['User']['id'])) {
            $club['Success'] = 'No';
            $club['reason'] = 'User name and pin code did not match';
        } else {
            $id = $users['User']['id'];
            $this->User->id = $id;
            $data = array('id' => $id, 'pincode' => $new_pincode);
            if ($this->User->save($data)) {
                $club['Success'] = 'Yes';
                $club['reason'] = 'Reseted pin code successfully';
            }
        }

        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function forgot_pin_code() {

        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];

        $this->User->recursive = -1;
        $options = array("fields" => array("User.email_address", 'User.id'),
            "conditions" => array("User.id" => $user_id));
        $info = $this->User->find("first", $options);

        if (isset($info['User']['email_address'])) {


            $information['Success'] = 'Yes';
            $information['pincode'] = substr(strrev(time()), 0, 4);
            $this->User->id = $user_id;
            $this->User->set('pincode', $information['pincode']);
            $this->User->save();
            $this->sendpassword($information['pincode'], $info['User']['email_address']);
            $information['reason'] = 'Successfully generated pincode and emailed to ' . $info['User']['email_address'] . ' email address';
            echo "$function_name (\n";
            echo json_encode($information);
            echo ");\n";
            exit();
        } else {
            $information['Success'] = 'No';
            $information['reason'] = 'Failed to genenrate pin code';
            echo "$function_name (\n";
            echo json_encode($information);
            echo ");\n";
            exit();
        }
    }

    function login() {
        $this->autoRender = false;
        $this->debug = false;

        $function_name = $this->params->query['callback'];
        $pincode = $this->params->query['pincode'];
        $email = $this->params->query['email'];

        $hour = $this->params->query['hour'];
        $min = $this->params->query['min'];
        $app_current_date = $this->params->query['app_arrival_date'];
        $this->layout = 'ajax';

        $this->User->recursive = -1;
        $information = $this->User->find('first', array(
            'fields' => array('first_name', 'id', 'club_id', 'promoter_code', 'referral_code'), 'conditions' => array('User.email_address' => $email, 'User.pincode' => $pincode)
        ));

        if ($information) {
            $info['User']['Username'] = $email;
            $info['User']['pincode'] = $pincode;


            $club['Success'] = 'Yes';
            $club['user_id'] = $information['User']['id'];
            $club['club_id'] = $information['User']['club_id'];
            $club['user_first_name'] = $information['User']['first_name'];

            if (isset($information['User']['promoter_code']) && (strlen($information['User']['promoter_code']) > 0))
                $club['my_promo_code'] = $information['User']['promoter_code'];
            else
                $club['my_promo_code'] = ' You have no promoter code';



            if (isset($information['User']['referral_code']) && (strlen($information['User']['referral_code']) > 0))
                $club['my_referal_code'] = $information['User']['referral_code'];
            else
                $club['my_referal_code'] = '';



            $club['acceptence_split_bill_request']['Success'] = 'no';
            $user_id = $club['user_id'];
            $this->loadModel('Reference');
            $ref_promo_id = $this->Reference->find('first', array('fields' => array('Reference.promoter_id', 'Reference.user_id'),
                'conditions' => array('Reference.user_id' => $user_id, 'Reference.status' => 'on'))); ////whether somebody used my promo code.
            //whether I HAVE  used OTHER'S referal code.
            $ref_code_used_by_others = $this->Reference->find('first', array('fields' => array('Reference.promoter_id', 'Reference.user_id'),
                'conditions' => array('Reference.user_id' => $user_id, 'Reference.status' => 'on', 'Reference.type' => 'referal')));

            //whether I HAVE  refereed others.
            $my_ref_code = $this->Reference->find('first', array('fields' => array('Reference.promoter_id', 'Reference.user_id'),
                'conditions' => array('Reference.promoter_id' => $user_id, 'Reference.status' => 'on', 'Reference.type' => 'referal')));


            if (((isset($my_ref_code)) && (!empty($my_ref_code['Reference']['promoter_id'])))) {
                $club['ten_percent_comission_booking'] = 'Yes';
                $club['reference_id'] = $my_ref_code['Reference']['user_id'];
            } else {
                $club['ten_percent_comission_booking'] = 'No';
                $club['reference_id'] = '';
            }




            if (((isset($ref_code_used_by_others)) && (!empty($ref_code_used_by_others['Reference']['promoter_id'])))) {
                $club['ten_percent_comission_first_bottle'] = 'Yes';
                $club['reference_id'] = $ref_code_used_by_others['Reference']['promoter_id'];
            } else {
                $club['ten_percent_comission_first_bottle'] = 'No';
                $club['reference_id'] = '';
            }



            if (isset($ref_promo_id['Reference']['promoter_id'])) {
                $club['promoter_id'] = $ref_promo_id['Reference']['promoter_id'];
            } else {
                $club['promoter_id'] = 'No';
            }
            /*
             *  Fetch user roles for waitres APP   
             * param1 user id
             * param2 user type 
             */
            $this->loadModel('UserRole');
            if ($this->UserRole->check_user_role($user_id, "Waitress") > 0) {
                $club['waitress'] = 'Yes';
            } else {
                $club['waitress'] = 'No';
            }

            $this->Split->unbindSplitAll();
            $this->Split->recursive = -1;

            $split_counter = $this->Split->find('first', array(
                'order' => array('Split.id DESC'),
                'conditions' => array('Split.splited_user_id!=Split.user_id', 'Split.splited_user_id' => $information['User']['id'], 'Split.status' => 'pending'),
            ));


            if (!empty($split_counter['Split']['id'])) {
                $club['Split'] = 'yes';
                $club['spliter_booking_id'] = $split_counter['Split']['booking_id'];
                $s = $this->spliterinfo($club['spliter_booking_id']);
                $club['booking_price'] = $s['Booking']['booking_price'];
            } else {
                //$club['club']=$this->Clubparams($club['user_id'],$club['club_id'],$app_current_date);//window.localStorage.setItem('club', JSON.stringify(data));
                $club['Split'] = 'no';
                $club['acceptence_split_bill_request'] = $this->checkpaymentstatusofsplitter($user_id, $hour, $min, $app_current_date, $function_name);
                $booking_id = $this->Split->find('first', array(
                    'order' => array('Split.id DESC'),
                    'conditions' => array('Split.splited_user_id' => $user_id, 'Split.status' => 'braintreehold'),
                ));
                if (isset($booking_id['Split']['booking_id'])) {

                    $s = $this->spliterinfo($booking_id['Split']['booking_id']);

                    $club['booking_price'] = $s['Booking']['booking_price'];
                }
            }
        } else {
            $club['Success'] = 'No';
        }
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    ////////////////////////////////registration////////////////////////////
    function add() {
        $this->autoRender = false;
        // if ($this->request->is('ajax')) {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->debug = false;
        $function_name = $this->params->query['callback'];
        $email = $this->params->query['email'];
        $first_name = $this->params->query['fname'];
        $my_first_name = $first_name;
        $last_name = $this->params->query['lname'];
        $pin = $this->params->query['pin'];
        $fbid = $this->params->query['fbid'];
        $profilePicture = $this->params->query['profilePicture'];
        $phone = $this->params->query['phone'];


        $has_promoter = false;
        if ((isset($this->params->query['promoter_id']) && (!empty($this->params->query['promoter_id'])))) {
            $promoter_id = $this->params->query['promoter_id'];
            $has_promoter = true;
        }
        $passwordHasher = new SimplePasswordHasher();
        $info['User']['last_name'] = $last_name;
        $info['User']['first_name'] = $first_name;

        $pass = $this->User->generatePassword();
        $info['User']['email_address'] = $email;
        $info['User']['password'] = $pass;
        $info['User']['Userpass'] = $pass;
        $info['User']['pincode'] = $pin;
        $info['User']['fbid'] = $fbid;
        $info['User']['phone_number'] = $phone;
        $info['User']['referral_code'] = 'R-' . uniqid();
        $my_ref_code = $info['User']['referral_code'];
        if (isset($this->params->query['user_id']))
            $id = $this->params->query['user_id'];
        else
            $id = 0;

        if ((isset($id) && ($id) > 0)) {


            $this->User->id = $id;
            if ($this->User->save($info)) {
                $info['Success'] = 'Yes';
                $info['user_id'] = $id;

                //
                // $info['my_referal_code']=$info['User']['referral_code'];
                //$info['user_first_name']=$info['User']['first_name'];
                //
                echo "$function_name (\n";
                echo json_encode($info);
                echo ");\n";
                exit();
            }
        } else {
            $this->User->recursive = -1;
            $counter = $this->User->find('count', array(
                'conditions' => array('OR' => array('User.email_address' => trim($email), 'User.phone_number' => $phone))));
            if ($counter > 0) {
                $info['Success'] = 'No';
                $info['reason'] = 'User Exists By this email or Phone number number';
                echo "$function_name (\n";
                echo json_encode($info);
                echo ");\n";
                return false;
            } else {
                if ($this->User->save($info)) {
                    $lastId = $this->User->getLastInsertID();
                    $this->sendpassword($info['User']['Userpass'], $email);


                    if ($profilePicture != "") {
                        $this->loadModel('Photo');
                        $array['Photo']['user_id'] = $lastId;
                        $array['Photo']['photos'] = $profilePicture;
                        $array['Photo']['photo_type'] = 'user';
                        $array['Photo']['profile_picture'] = 'yes';
                        $this->Photo->save($array);
                    }
                }
                if ($has_promoter) {


                    $info['Reference']['user_id'] = $lastId;
                    $info['Reference']['promoter_id'] = $promoter_id; //Newly Added
                    $this->Reference->save($info);
                }
                $info['User']['lid'] = $lastId;
                $info['User']['user_id'] = $lastId;
                $info['my_referal_code'] = $my_ref_code;
                $info['user_first_name'] = $my_first_name;
                $info['Success'] = 'Yes';
                $info['reason'] = 'Successfully registered';
                echo "$function_name (\n";
                echo json_encode($info);
                echo ");\n";


                return true;
            }
        }
    }

    function forgot_pin() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $email = $this->params->query['email'];
        $this->User->recursive = -1;
        $options = array("fields" => array("User.id", "User.email_address", "User.pincode"),
            "conditions" => array("User.email_address" => trim($email)));
        $info = $this->User->find("first", $options);

        if (isset($info['User']['id'])) {
            if ($info['User']['id'] > 0) {

                $information['Success'] = 'yes';
                $information['pincode'] = $info['User']['pincode'];
                echo "$function_name (\n";
                echo json_encode($information);
                echo ");\n";
                $this->sendpassword($information['pincode'], $email);
                exit();
            }
        } else {
            $information['Success'] = 'no';
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
            exit();
        }
    }

    function credituserinfo() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $creditCard['credit_card'] = $this->params->query['credit_card'];
        $creditCard['cciv'] = $this->params->query['cciv'];
        $creditCard['expire_date'] = date('Y-m-d', strtotime($this->params->query['expire_date']));
         $creditCard['card_type'] = "VISA";   
        $this->loadModel('UserInfo');
        $user_id = $this->params->query['user_id'];
        $flag = $this->creditcardtoken($user_id, $creditCard, '');
        //$sub_marchent_id = $this->submarchentaccountid($user_id);
        ///$this->User->set('marchentid', $sub_marchent_id['subMerchantAccount']);

        if ($flag) {
            $output['Success'] = 'yes';
            echo "$function_name (\n";
            echo json_encode($output);
            echo ");\n";
        } else {
            $output['Success'] = 'no';
            echo "$function_name (\n";
            echo json_encode($output);
            echo ");\n";
        }
    }

    function adduserinfo() {
        $this->autoRender = false;
        $this->layout = 'ajax';

        $function_name = $this->params->query['callback'];
        $info['UserInfo']['add_address'] = $this->params->query['address'];
        $info['UserInfo']['street_address'] = $this->params->query['st_address'];
        $info['UserInfo']['city'] = $this->params->query['locality'];
        $info['UserInfo']['region'] = $this->params->query['region'];
        $info['UserInfo']['postal_code'] = $this->params->query['zipcode'];
        $info['UserInfo']['user_id'] = $this->params->query['user_id'];
        $this->loadModel('UserInfo');
        $this->UserInfo->recursive = -1;
        $user_info = $this->UserInfo->find('first', array("fields" => "UserInfo.id", "conditions" => array("UserInfo.user_id" => $info['UserInfo']['user_id'])));
        if (isset($user_info['UserInfo']['id']) && ($user_info['UserInfo']['id'] > 0)) {
            $id = $user_info['UserInfo']['id'];
            $this->UserInfo->id = $id;
            if ($this->UserInfo->save($info)) {


                $output = $info;
                $output['Success'] = 'Yes';
                $output['user_id'] = $info['UserInfo']['user_id'];
                $output['UserInfo']['lid'] = $this->UserInfo->getLastInsertID();
            } else {
                $output['Success'] = 'No';
            }

            echo "$function_name (\n";
            echo json_encode($output);
            echo ");\n";
            exit();
        }


        if ($this->UserInfo->save($info)) {


            $output = $info;
            $output['Success'] = 'Yes';
            $output['user_id'] = $info['UserInfo']['user_id'];
            $output['UserInfo']['lid'] = $this->UserInfo->getLastInsertID();
        } else {
            $output['Success'] = 'No';
        }


        echo "$function_name (\n";
        echo json_encode($output);
        echo ");\n";
    }

    function creditcardtoken($user_id, $creditCard, $website) {
        $this->layout = 'ajax';
        $this->autoRender = false;
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $this->User->recuƒrsive = 1;
        $info = $this->User->findById($user_id);

        $exp = explode('-', $creditCard['expire_date']);
        $exp = $exp[1] . '/' . $exp[0];

        $result = Braintree_Customer::create(array(
                    'firstName' => $info['User']['first_name'],
                    'id' => 'reserved_' . $user_id
        ));

        //         $res = Braintree_CreditCard::create(array(
        //        'customerId' => 'reserved_'.$user_id,
        //        'number' =>$creditCard['credit_card'],
        //         'expirationDate' => $exp,
        //         'cvv' =>$creditCard['cciv'] 
        //        ));
        //$credit = $creditCard['credit_card'];
        $res = Braintree_CreditCard::create(array(
                    'customerId' => 'reserved_' . $user_id,
                    'number' => $creditCard['credit_card'],
                    'expirationDate' => $exp, //'expirationDate' => '05/2011',
        ));

        if ($res->success) {
            $token = $res->creditCard->token;
            //$this->UserInfo->Upda($info);

            $this->User->id = $user_id;
            $this->User->set('token', $token);
            $this->loadModel('Card');
            $this->Card->token = $token;
            $this->Card->user_id = $user_id;
            //$this->Card->card=  strtr($creditCard['credit_card'], strlen($creditCard['credit_card'])-4, strlen($creditCard['credit_card']));
            $sql = 'INSERT INTO cards(id,user_id,card,token,date,type,status)' .
                    'VALUES(NULL,'
                    . '"' . $user_id . '",'
                    . '"' . substr($creditCard['credit_card'], strlen($creditCard['credit_card']) - 4) . '",'
                    . '"' . $token . '",'
                    . '"' . date('Y-m-d H:m:s') . '",'
                    . '"' . $creditCard['card_type'] . '",'
                    . "'on'" . ')';

            $this->Card->query($sql);
            if ($this->User->save())
                return true;
            else
                return false;
        } else
            return false;
    }

    //////////////////////////////////registration///////////////
    protected function _getMailInstance() {

        $emailConfig = Configure::read('Users.emailConfig');
        if ($emailConfig) {
            return new CakeEmail($emailConfig);
        } else {
            return new CakeEmail('default');
        }
    }

    public function sendpassword($password, $mail_to) {
        $defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => 'Reserved Password',
            'template' => 'invitation_by_email',
            'emailFormat' => CakeEmail::MESSAGE_TEXT,
            'layout' => 'default'
        );


        App::uses('CakeEmail', 'Network/Email');

        $Email = $this->_getMailInstance();
        $Email->to($mail_to);
        $Email->from($defaults['from']);
        $Email->emailFormat($defaults['emailFormat'])
                ->subject($defaults['subject'])
                ->template($defaults['template'], $defaults['layout'])
                ->viewVars(array(
                    'password' => $password))
                ->send();
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid tip'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Tip->save($this->request->data)) {
                $this->Session->setFlash(__('The tip has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Tip->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for tip'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Tip->delete($id)) {
            $this->Session->setFlash(__('Tip deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Tip was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->Tip->recursive = 0;
        $this->set('tips', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid tip'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('tip', $this->Tip->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Tip->create();
            if ($this->Tip->save($this->request->data)) {
                $this->Session->setFlash(__('The tip has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid tip'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Tip->save($this->request->data)) {
                $this->Session->setFlash(__('The tip has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Tip->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for tip'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Tip->delete($id)) {
            $this->Session->setFlash(__('Tip deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Tip was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function Test() {
        $this->autoRender = false;
        $Email = new CakeEmail();
        $Email->from(array('noreply@bglobal.com' => 'Reserved'));
        $Email->to('bappyiub@gmail.com');
        $Email->subject('Password');

        if ($Email->send("123"))
            echo "sennd";
    }

    function status() {
        //$this->params->query['callback'];
        $this->layout = 'ajax';
        $this->autoRender = false;
        $date = $this->params->query['date'];
        $month = $this->params->query['month'];
        $year = $this->params->query['year'];
        $date = $this->process($date);
        $month = $this->Month($month);
        $time = $year . '-' . $month . '-' . $date;

        $count = $this->ClubException->find("count", array("conditions" => array("ClubException.exception_date" => $time, "ClubException.status" => "Closed")));


        $function_name = $this->params->query['callback'];
        if ($count > 0) {
            //echo 1;
            echo "$function_name (\n";
            echo 1;
            echo ");\n";
        } else {
            echo "$function_name (\n";
            echo 0;
            echo ");\n";
        }
    }

    function process($date) {
        $info = str_split($date);
        $str = '';
        for ($i = 0; $i < strlen($date); $i++)
            if (!ctype_alpha($info[$i]))
                $str.=$info[$i];
            else
                return $str;
    }

    function Month($Month) {
        $array = array("1" => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return array_search($Month, $array);
    }

    function Club() {
        date_default_timezone_set($this->default_time_zone);
        $this->layout = 'ajax';
        $this->autoRender = false;
        if (isset($this->params->query['callback'])) {
            $function_name = $this->params->query['callback'];
        }

        $user_id = $this->params->query['user_id'];
        $id = $this->params->query['id'];

        if (isset($this->params->query['date'])) {

            $strtime = strtotime($this->params->query['date']);
            $day = date("l", $strtime);
            $date = date("Y-m-d", $strtime);
        } else {
            $day_param = $this->params->query['day'];
            $month = $this->params->query['month'];
            $year = $this->params->query['year'];
            //$day = $this->process($day_param);
            $day = $day_param;
            $month = $this->Month($month);
            $time = $year . '-' . $month . '-' . $day;
            $strtime = strtotime($time);
            $day = date("l", $strtime);

            $date = date("Y-m-d", $strtime);
        }

        $conditions = array('Booking.status' => 'reserved', 'Booking.user_id' => $user_id, 'Booking.club_id' => $id, 'Booking.arrival_date' => $date);
        $fields = array('Booking.id');
        $this->Booking->recursive = -1;
        $bookings = $this->Booking->find('first', array('conditions' => $conditions, 'fields' => $fields));

        if (count($bookings) > 0) {
            $club['hasBooking'] = "Yes";
            $club['hasBooking_id'] = $bookings['Booking']['id'];
        } else {
            $this->Club->unbindModel(
                    array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking'))
            );
            $this->Event->bindModel(array('belongsTo' => array('Category')));

            $conditions = array('Club.id' => $id, 'Club.status' => 'approved');
            $contain = array(
                'ClubOpenDay' => array(
                    'fields' => array('ClubOpenDay.open_time', 'ClubOpenDay.close_time', 'ClubOpenDay.days', 'ClubOpenDay.status'),
                    'conditions' => array('ClubOpenDay.days' => $day),
                    'order' => array('ClubOpenDay.id desc'),
                    'limit' => array('1'),
                ),
                'Photo' => array(
                    'conditions' => array('Photo.club_id' => 'Club.id', 'Photo.photo_type' => 'club', 'Photo.profile_picture' => 'no')
                ),
                'ClubException' => array(
                    'fields' => array('ClubException.status'),
                    'conditions' => array('ClubException.club_id' => 'Club.id', 'ClubException.exception_date' => $date)
                ),
                'Event' => array(
                    'conditions' => array('Event.club_id' => 'Club.id', 'Event.event_date' => $date)
                ),
                'Deal' => array(
                    'conditions' => array('Deal.club_id' => 'Club.id', 'Deal.status' => '1', 'Deal.deal_date <= ' => $date, 'OR' => array('Deal.recur' => 'yes', 'Deal.deal_date' => $date))
                )
            );

            $this->Club->Behaviors->load('Containable', array('recursive' => true));

            $club = $this->Club->find('first', array('conditions' => $conditions, 'contain' => $contain));
            $club['ClubOpenDay'][0]['days'] = date("M d", $strtime);
            $club['Deals']['show_deal'] = "no";
            $club['Deals']['deal_price'] = 0;
            $club['arraival_date'] = date("Y-m-d", $strtime);

            if (isset($club['Deal'])) {
                foreach ($club['Deal'] as $deal) {
                    if ($deal['recur'] == "no" && ( $deal['deal_date'] == $date )) {
                        $club['Deal']['show_deal'] = "yes";
                        $club['Deal']['deal_price'] = $deal['deal_price'];
                    }
                    if ($deal['recur'] == "yes" && ( date("D", strtotime($deal['deal_date'])) == date("D", $strtime) )) {
                        $club['Deals']['show_deal'] = "yes";
                        $club['Deals']['deal_price'] = $deal['deal_price'];
                    }
                }
            }

            if (isset($club['Event'][0]['category_id'])) {
                $fields = array('Category.category_name');
                $conditions = array('Category.id' => $club['Event'][0]['category_id']);
                $this->Category->recursive = -1;
                $cat = $this->Category->find('first', array('fields' => $fields, 'conditions' => $conditions));
                $club['Event'][0]['category_name'] = $cat['Category']['category_name'];
            }
            unset($club['Deal']);

            $club['hasBooking'] = "No";
        }
        if (isset($function_name)) {
            $club['Success'] = 'Yes';
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        } else {
            $club['Success'] = 'Yes';
            echo json_encode($club);
        }
        //pr($club);
    }

    function Clubparams($user_id, $id, $date) { //id=>$club_id
        $this->layout = 'ajax';
        $this->autoRender = false;
        if (isset($date)) {
            $strtime = strtotime($date);
            $day = date("l", $strtime);
            $date = date("Y-m-d", $strtime);
        }
        $conditions = array('Booking.status' => 'reserved', 'Booking.user_id' => $user_id, 'Booking.club_id' => $id, 'Booking.arrival_date' => $date);
        $fields = array('Booking.id');
        $this->Booking->recursive = -1;
        $bookings = $this->Booking->find('first', array('conditions' => $conditions, 'fields' => $fields));

        if (count($bookings) > 0) {
            $club['hasBooking'] = "Yes";
            $club['hasBooking_id'] = $bookings['Booking']['id'];
        } else {
            $this->Club->unbindModel(
                    array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking'))
            );
            $this->Event->bindModel(array('belongsTo' => array('Category')));

            $conditions = array('Club.id' => $id, 'Club.status' => 'approved');
            $contain = array(
                'ClubOpenDay' => array(
                    'fields' => array('ClubOpenDay.open_time', 'ClubOpenDay.close_time', 'ClubOpenDay.days', 'ClubOpenDay.status'),
                    'conditions' => array('ClubOpenDay.days' => $day),
                    'order' => array('ClubOpenDay.id desc'),
                    'limit' => array('1'),
                ),
                'Photo' => array(
                    'conditions' => array('Photo.club_id' => 'Club.id')
                ),
                'ClubException' => array(
                    'fields' => array('ClubException.status'),
                    'conditions' => array('ClubException.club_id' => 'Club.id', 'ClubException.exception_date' => $date)
                ),
                'Event' => array(
                    'conditions' => array('Event.club_id' => 'Club.id', 'Event.event_date' => $date)
                ),
                'Deal' => array(
                    'conditions' => array('Deal.club_id' => 'Club.id', 'Deal.status' => '1', 'Deal.deal_date <= ' => $date, 'OR' => array('Deal.recur' => 'yes', 'Deal.deal_date' => $date))
                )
            );

            $this->Club->Behaviors->load('Containable', array('recursive' => true));

            $club = $this->Club->find('first', array('conditions' => $conditions, 'contain' => $contain));
            $club['ClubOpenDay'][0]['days'] = date("M d", $strtime);
            $club['Deals']['show_deal'] = "no";
            $club['Deals']['deal_price'] = 0;
            $club['arraival_date'] = date("Y-m-d", $strtime);

            if (isset($club['Deal'])) {
                foreach ($club['Deal'] as $deal) {
                    if ($deal['recur'] == "no" && ( $deal['deal_date'] == $date )) {
                        $club['Deal']['show_deal'] = "yes";
                        $club['Deal']['deal_price'] = $deal['deal_price'];
                    }
                    if ($deal['recur'] == "yes" && ( date("D", strtotime($deal['deal_date'])) == date("D", $strtime) )) {
                        $club['Deals']['show_deal'] = "yes";
                        $club['Deals']['deal_price'] = $deal['deal_price'];
                    }
                }
            }

            if (isset($club['Event'][0]['category_id'])) {
                $fields = array('Category.category_name');
                $conditions = array('Category.id' => $club['Event'][0]['category_id']);
                $this->Category->recursive = -1;
                $cat = $this->Category->find('first', array('fields' => $fields, 'conditions' => $conditions));
                $club['Event'][0]['category_name'] = $cat['Category']['category_name'];
            }
            unset($club['Deal']);

            $club['hasBooking'] = "No";
        }

        return $club;
    }

    public function booking() { //addressbook.html
        $function_name = $this->params->query['callback'];
        $this->layout = 'ajax';
        $this->autoRender = false;
        date_default_timezone_set($this->default_time_zone);
        $club_id = $this->params->query['club_id'];
        $user_id = $this->params->query['user_id'];
        $guys = $this->params->query['guys'];
        $ladies = $this->params->query['ladies'];
        //$book_time = $this->params->query['booking_time'];
        $book_time = date('Y-m-d H:i:s');
        $table_id = $this->params->query['table_id'];
        $table_price = $this->params->query['table_price'];
        $arrival_time = $this->params->query['arrival_time'];
        $arrival_date = $this->params->query['arrival_date'];
        $splited_amount = $this->params->query['splited_amount'];
        $status = $this->params->query['status'];



        $info['user_id'] = $user_id;
        $info['club_id'] = $club_id;
        $info['guys'] = $guys;
        $info['girls'] = $ladies;
        $info['arrival_time'] = $arrival_time;
        $info['arrival_date'] = $arrival_date;
        $info['booking_price'] = ($table_price) / 10; //is booking parice and table price same
        $info['club_table_id'] = $table_id;
        $info['booking_time'] = $book_time;
        $info['status'] = $status;
        $info['client_name'] = '';
        $info['client_phone'] = '';


        //


        if ($this->Booking->save($info)) {

            $club['booking_id'] = $this->Booking->getLastInsertId();

            if ($splited_amount != 'f') { //true ->split bills
                $club['Success'] = 'Yes';
                $this->splitbill($splited_amount, $club['booking_id'], $info['user_id'], $status, $book_time);
                $flag = $this->params->query['flag'];
                $comments = $this->params->query['comments'];
                $club['transaction_id'] = $this->paymentspliter($function_name, $user_id, $flag, $club['booking_id'], $comments, $club_id);
                echo "$function_name (\n";
                echo json_encode($club);
                echo ");\n";
                exit();
            } else {
                $club['Success'] = 'Yes';
                $club['transaction_id'] = $this->payment('booking', $user_id, ($table_price / 10), $club_id, $club['booking_id']);
            }
        } else
        {
         $club['Success'] = 'No';
         
         
        }
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    public function table_listing() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $listing = $this->ClubTable->find("all");
        if ($listing) {
            $function_name = $this->params->query['callback'];
            $club['Success'] = 'Yes';
            $club["listing"] = $listing;
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        }
    }

    public function table_price() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $numberof_guy_booked_table = $this->params->query['guys'];
        $numberof_girls_booked_table = $this->params->query['girls'];
        $arraival_date = $this->params->query['arraival_date'];
        $club_id = $this->params->query['club_id'];
        $cat_id = $this->params->query['cat_id'];


        $table_id = $this->ClubTable->select_table_for_booking($cat_id, $club_id, $arraival_date);

        $this->ClubTable->recursive = -1;
        $listing = true;
        if ($table_id)
            $listing = $this->ClubTable->findById($table_id);
        else
            $listing = false;
        $function_name = $this->params->query['callback'];
        if ($listing) {



            $tbl_min_guy = $listing ['ClubTable'] ['table_min_guy'];
            $tbl_min_girls = $listing ['ClubTable'] ['table_min_girls'];
            $max_guys1 = $listing ['ClubTable'] ['max_guys1'];
            $max_guys2 = $listing ['ClubTable'] ['max_guys2'];

            //            if ($numberof_guy_booked_table > $max_guys2) {
            //                $info['Success'] = 'No';
            //                $info['error'] = 'You cannot select this table.The number of guys must be  less than or equal ' . $max_guys2;
            //                echo "$function_name (\n";
            //                echo json_encode($info);
            //                echo ");\n";
            //                exit();
            //            }


            if ((($numberof_guy_booked_table + $numberof_girls_booked_table) > ($tbl_min_guy + $tbl_min_girls))) {
                $info['Success'] = 'No';
                $info['error'] = 'You cannot select this table.The number of guys and girls must   sum of ' . $tbl_min_guy . ' and ' . $tbl_min_girls;
                echo "$function_name (\n";
                echo json_encode($info);
                echo ");\n";
                exit();
            }

            setlocale(LC_MONETARY, "en_US");
            $club ['amount'] = $listing ['ClubTable'] ['minimum_price'];
            $club ['reservation'] = 'ok';

            if (!empty($max_guys1) || !empty($max_guys2)) {
                if ($numberof_guy_booked_table == $max_guys1) {
                    $club ['amount'] = $listing['ClubTable']['max_guys1_price'];
                } else if ($numberof_guy_booked_table == $max_guys2) {
                    $club ['amount'] = $listing['ClubTable']['max_guys2_price'];
                } else if (($numberof_guy_booked_table > $max_guys1) && ($numberof_guy_booked_table < $max_guys2)) {
                    $club ['amount'] = $listing['ClubTable']['max_guys2_price'];
                } else if ($numberof_guy_booked_table < $max_guys1) {
                    $club ['amount'] = $listing['ClubTable']['minimum_price'];
                } else if ($numberof_guy_booked_table > $max_guys2) {
                    $club ['amount'] = $listing['ClubTable']['max_guys2_price'];
                }
            }
            //$club ['amount'] = $club ['amount'] + ($club ['amount'] / 2);
            $club ['table_id'] = $table_id;
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        } else {
            $info['Success'] = 'No';
            $info['error'] = 'You have already Booked in this date';
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
        }
    }

    public function table_type() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        $arraival_date = $this->params->query['arraival_date'];
        $club_id = $this->params->query['club_id'];
        //$this->Category->recursive = 2;
        $this->Category->unbindModel(
                array('hasMany' => array('Event', 'ClubBottle'))
        );
        $conditions = array(
            'Category.status' => 'active',
            'Category.category_type' => 'table'
        );
        $listing = $this->Category->find("all", array(
            'conditions' => $conditions,
            'order' => array('Category.id' => 'DESC')
        ));

        $this->ClubTable->find("all", array(
            'conditions' => $conditions,
            'order' => array('Category.id' => 'DESC')
        ));

        $listings = $this->ClubTable->tabletype($club_id); // all table listing.


        foreach ($listings as $key => $row) {
            $total_bookings = $this->ClubTable->tablebookings($row['c']['id'], $club_id, $arraival_date);

            if (($total_bookings >= $row['X']['totalT']))
                $listings[$key]['c']['booked'] = 1;
            else
                $listings[$key]['c']['booked'] = 0;
        }
        $this->Booking->recursive = -1;
        $booking = $this->Booking->find("all", array(
            'conditions' => array(
                'Booking.status' => array('check_in', 'reserved', 'taken'),
                'Booking.club_id' => $club_id,
                'Booking.arrival_date' => $arraival_date
            )
        ));

        if ($listing) {
            $function_name = $this->params->query['callback'];
            $club['Success'] = 'Yes';
            $club['table_type'] = $listings;

            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        }
    }

    public function fetch_table_type() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        $arraival_date = $this->params->query['arraival_date'];
        $club_id = $this->params->query['club_id'];
        $numberof_guy_booked_table = $this->params->query['guys'];
        $numberof_girls_booked_table = $this->params->query['girls'];

        $listings = $this->ClubTable->tabletype();

        foreach ($listings as $key => $row) {
            $total_bookings = $this->ClubTable->tablebookings($row['c']['id'], $club_id, $arraival_date);

            if ($total_bookings <= $row['x']['totalT']) {
                $cat_id = $row['c']['id'];
                break;
            }
        }


        $table_id = $this->ClubTable->select_table_for_booking($cat_id, $club_id, $arraival_date);

        $this->ClubTable->recursive = -1;
        $listing = $this->ClubTable->findById($table_id);

        if ($listing) {
            $function_name = $this->params->query['callback'];
            $club['Success'] = 'Yes';
            $club['table_id'] = $table_id;

            $tbl_min_guy = $listing ['ClubTable'] ['table_min_guy'];
            $tbl_min_girls = $listing ['ClubTable'] ['table_min_girls'];
            $max_guys1 = $listing ['ClubTable'] ['max_guys1'];
            $max_guys2 = $listing ['ClubTable'] ['max_guys2'];

            setlocale(LC_MONETARY, "en_US");
            $club ['amount'] = $listing ['ClubTable'] ['minimum_price'];
            $club ['reservation'] = 'ok';

            if (!empty($max_guys1) || !empty($max_guys2)) {
                if (($numberof_guy_booked_table >= $max_guys1) && ($numberof_guy_booked_table <= $max_guys2)) {
                    $club ['amount'] = $listing['ClubTable']['max_guys2_price'];
                }

                if ($numberof_guy_booked_table <= $max_guys1) {
                    $club ['amount'] = $listing['ClubTable']['max_guys1_price'];
                }
            }
            $club ['table_id'] = $table_id;
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        }
        /////////////////////////////
    }

    public function splitbill($splited_amount, $booking_id, $user_id, $status = 'pending', $book_time = '') {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $splited_amount = $splited_amount;
        $i = 0;
        date_default_timezone_set($this->default_time_zone);
        $time = date('Y-m-d H:i:s A');
        foreach ($splited_amount as $key => $obj) {


            $save [$i] ['booking_id'] = $booking_id; //$this->params->query ['booking_id'];
            $save [$i] ['name'] = $obj['name'];
            $save [$i] ['splited_amount'] = rtrim($obj['qty'], '%');
            $save[$i]['splited_user_id'] = $obj['splited_user_id'];
            $save [$i] ['status'] = $status;
            $save [$i] ['user_id'] = $user_id;
            $save[$i]['splited_date'] = $book_time;
            $save[$i]['server_time'] = $time;
            $i++;
        }

        $this->loadModel('Split');

        if ($this->Split->saveAll($save))
            return true;
        return false;
    }

    public function clublist() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        $strtime = strtotime($this->params->query['date']);
        $day = date("l", $strtime);
        $date = date("Y-m-d", $strtime);

        $this->Club->recursive = -1;

        $conditions = array('Club.status' => 'approved');
        $orders = array('Club.club_name' => 'asc');

        $contain = array(
            'Deal' => array(
                'conditions' => array('Deal.club_id' => 'Club.id', 'Deal.status' => '1', 'Deal.deal_date <= ' => $date, 'OR' => array('Deal.recur' => 'yes', 'Deal.deal_date' => $date))
            )
        );

        $this->Club->Behaviors->load('Containable');

        $club = $this->Club->find('all', array('conditions' => $conditions, 'order' => $orders, 'contain' => $contain));

        foreach ($club as $key => $data) {
            if (is_array($data['Deal']) && isset($data['Deal'])) {
                $club[$key]['Club']['show_deal'] = "no";
                $club[$key]['Club']['deal_price'] = "0";
                foreach ($data['Deal'] as $deal) {
                    if ($deal['recur'] == "no" && ( $deal['deal_date'] == $date )) {
                        $club[$key]['Club']['show_deal'] = "yes";
                        $club[$key]['Club']['deal_price'] = $deal['deal_price'];
                    }
                    if ($deal['recur'] == "yes" && ( date("D", strtotime($deal['deal_date'])) == date("D", $strtime) )) {
                        $club[$key]['Club']['show_deal'] = "yes";
                        $club[$key]['Club']['deal_price'] = $deal['deal_price'];
                    }
                }
                unset($club[$key]['Club']['Deal']);
            }
        }
        $data['Club'] = $club;
        if ($data['Club'])
            $data['Success'] = 'Yes';
        else
            $data['Success'] = 'No';
        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    function getreferalcode() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $promoter_code = $this->params->query['promoter_code'];
        $user_id = $this->params->query['user_id'];
        $this->User->recursive = -1;
        $info = $this->User->find('first', array('conditions' => array('User.referral_code' => $promoter_code)));

        if (!empty($info['User']['id'])) {
            $refaree_user_id = $info['User']['id'];
            $this->loadModel('Reference');
            $array = array();
            $array['Reference']['user_id'] = $user_id;
            $array['Reference']['promoter_id'] = $refaree_user_id;
            $array['Reference']['status'] = 'on';
            $array['Reference']['type'] = 'referal';
            if ($this->Reference->save($array)) {
                $array['Success'] = 'Yes';
            } else {
                $array['Success'] = 'No';
            }
        } else {
            $array['Success'] = 'No';
        }

        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($array);
        echo ");\n";
    }

    public function getpromoter() {

        $this->layout = 'ajax';
        $this->autoRender = false;
        $promoter_code = $this->params->query['promoter_code'];
        $user_id = $this->params->query['user_id'];
        $condition = array('User.user_type' => 'promoter', 'User.promoter_code' => $promoter_code);
        // $data['User'] = $this->User->find("first", array("conditions" => $condition));
        $promoterId = $this->User->find('first', array(
            'fields' => array('User.id'),
            'conditions' => $condition));
        if (isset($promoterId['User']) && count($promoterId['User'] > 0)) {
            $data['promoterId'] = $promoterId['User']['id'];
            $this->loadModel('Reference');
            $count = $this->Reference->find('count', array('user_id' => $user_id));
            if ($count <= 0) {
                $this->Reference->create();
                $info = array('user_id' => $user_id, 'promoter_id' => $data['promoterId'], 'status' => 'on');
                $this->Reference->save($info);
            }
            $data['Success'] = 'Yes';
        } else
            $data['Success'] = 'No';
        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    function hasdeal($club_id, $table_id) {
        $deal_priece = $this->Deal->find(
                "all", array(
            "conditions" => array("Deal.club_id" => $club_id, "Deal.club_table_id" => $table_id),
            "fields" => array("Deal.deal_price")));
        if ($deal_priece)
            return $deal_priece;
        return false;
    }

    public function splitbilldetails() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        $booking_id = $this->params->query['booking_id'];
        $club_id = $this->params->query['club_id'];
        $user_id = $this->params->query['user_id'];
        $table_id = $this->params->query['table_id'];
        $numberof_guy_booked_table = $this->params->query['guys'];
        $numberof_girls_booked_table = $this->params->query['girls'];
        $show_deal = $this->params->query['show_deal']; //yes or no
        $deal_price = $this->params->query['deal_price']; //Deal price

        $splited_amount = sizeof(json_decode($this->params->query['splited_amount'], true));

        //        $condition = array(
        //            "Splits.status" => 'pending',
        //            'Splits.booking_id' => $booking_id
        //        );
        //
    //        $data ['Split'] = $this->Splits->find("all", array(
        //            "conditions" => $condition
        //        ));
        //
    //
    //        if ($show_deal == "yes") {
        //            $data ['amount'] = $deal_price;
        //        } else {
        //            $this->ClubTable->id = $table_id;
        //            $this->ClubTable->recursive = - 1;
        //            $information = $this->ClubTable->read(null);
        //            $tbl_min_guy = $information ['ClubTable'] ['table_min_guy'];
        //            $tbl_min_girls = $information ['ClubTable'] ['table_min_girls'];
        //            $max_guys1 = $information ['ClubTable'] ['max_guys1'];
        //            $max_guys2 = $information ['ClubTable'] ['max_guys2'];

        $this->Club->recursive = -1;
        $club_name = $this->Club->findById($club_id);
        $club_name = $club_name['Club']['club_name'];

        $this->splitbillcalculation($booking_id, $deal_price, $show_deal, $numberof_guy_booked_table, $numberof_girls_booked_table, $club_name, $table_id, $splited_amount);


        $this->Club->recursive = -1;
        $club_name = $this->Club->findById($club_id);
        $club_name = $club_name['Club']['club_name'];

        $this->splitbillcalculation($booking_id, $deal_price, $show_deal, $numberof_guy_booked_table, $numberof_girls_booked_table, $club_name, $table_id);

        //            if (($information ['ClubTable'] ['table_min_guy'] <= $numberof_guy_booked_table) || ($information ['ClubTable'] ['table_min_girls'] <= $numberof_girls_booked_table)) {
        //                $data ['amount'] = $information ['ClubTable'] ['minimum_price']; // first condition
        //                $data ['reservation'] = 'ok';
        //            } else { // else1
        //                if (($numberof_guy_booked_table >= $max_guys1) && ($numberof_guy_booked_table <= $max_guys2)) {
        //                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
        //                }     // else1
        //                else if ($numberof_guy_booked_table <= $max_guys1) {
        //                    $data ['amount'] = $information['ClubTable']['max_guys1_price'];
        //                } // else1
        //            }
        //            if (($information ['ClubTable'] ['table_min_guy'] <= $numberof_guy_booked_table) || ($information ['ClubTable'] ['table_min_girls'] <= $numberof_girls_booked_table)) {
        //                // else1
        //                if (($numberof_guy_booked_table >= $max_guys1) && ($numberof_guy_booked_table <= $max_guys2)) {
        //                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
        //                }     // else1
        //                else if ($numberof_guy_booked_table <= $max_guys1) {
        //                    $data ['amount'] = $information['ClubTable']['max_guys1_price'];
        //                    
        //                } // else1
        //                else $data ['amount'] = $information ['ClubTable'] ['minimum_price'];
        //            }
        //            $function_name = $this->params->query ['callback'];
        //            echo "$function_name (\n";
        //            echo json_encode($data);
        //            echo ");\n";
    }

    public function clubbottlesorder() {

        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->ClubBottle->unbindModel(array('belongsTo' => array('User', 'Club')));
        $this->ClubBottle->unbindModel(array('hasMany' => array('Order')));
        if (isset($this->params->query ['club_id']))
            $club_id = $this->params->query ['club_id'];

        if (isset($this->params->query ['booking_id'])) {
            $booking_id = $this->params->query ['booking_id'];
            $this->Booking->recursive = -1;
            $club = $this->Booking->findById($booking_id, array("Booking.club_id"));
            $club_id = $club['Booking']['club_id'];
        }


        $contain = array(
            'ClubBottle' => array(
                'fields' => array('ClubBottle.id', 'ClubBottle.club_id', 'ClubBottle.bottle_name', 'ClubBottle.bottle_price'),
                'conditions' => array('ClubBottle.club_id' => $club_id),
                'order' => array('ClubBottle.bottle_name asc'),
        ));
        $conditions = array("Category.category_type" => "bottle");
        $fields = array("Category.category_name", "Category.id");

        $this->Category->Behaviors->load('Containable');

        $item['info'] = $this->Category->find("all", array(
            "conditions" => $conditions,
            "fields" => $fields,
            "contain" => $contain
        ));


        $function_name = $this->params->query ['callback'];
        echo "$function_name (\n";
        echo json_encode($item);
        echo ");\n";
    }

    function addorder() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $user_id = $this->params->query['user_id'];
        $booking_id = $this->params->query['booking_id'];
        $this->loadModel('Booking');

        $all = $this->Booking->findById($booking_id);

        $club_id = $all['Booking']['club_id']; //club_id
        $club_table_id = $all['Booking']['club_table_id'];
        ; //club_table_id
        if (!isset($user_id)) { //waitress
            $user_id = $all['Booking']['user_id'];
        }


        $pro_id_qty_price = json_decode($this->params->query['pro_id_qty_price'], true);
        $i = 0;

        $this->Reference->recursive = -1;
        $promoter = $this->Reference->find('first', array('conditions' => array('Reference.user_id' => $user_id, 'Reference.status' => 'on')));
        if (isset($promoter['Reference']['promoter_id'])) {
            $info['promoter_id'] = $promoter['Reference']['promoter_id'];
        } else
            $info['promoter_id'] = 0;

        $this->loadModel('Order');
        $order['booking_id'] = $booking_id;
        $order['user_id'] = $user_id; //new
        $order['club_id'] = $club_id;
        $order['booking_id'] = $booking_id;
        $order['club_table_id'] = $club_table_id; ////club_table_id
        $order['status'] = 'pending';
        $order['order_time'] = $this->params->query['order_time'];
        $order['order_date'] = $this->params->query['order_date'];
        $order['promoter_id'] = $info['promoter_id'];
        //$this->Order->save($order);
        $this->Order->create();
        $this->Order->save($order);

        $last_id = $this->Order->getLastInsertId();

        $this->loadModel('Reference');

        $info = array();
        $output = array();
        foreach ($pro_id_qty_price as $pro) {
            $info[$i]['club_bottle_id'] = $pro["id"];
            $info[$i]['quantity'] = $pro["qty"];
            $info[$i]['price'] = $pro["price"];
            $info[$i]['order_id'] = $last_id;
            $info[$i]['first_bottle'] = $this->params->query['first_bottle'];
            $this->loadModel('ClubBottle');
            $product_name = $this->ClubBottle->read('bottle_name', $pro["id"]);
            $output["order_item"][$i]["prod_name"] = $product_name["ClubBottle"]["bottle_name"];
            $output["order_item"][$i]["prod_qty"] = $pro["qty"];
            $output["order_item"][$i]["prod_price"] = $pro["price"];
            $output['Order_id'] = $last_id;

            $i++;
        }
        $this->loadModel('OrderItem');
        $output["Success"] = "Yes";

        if ($this->OrderItem->saveAll($info)) {
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($output);
            echo ");\n";
        }
    }

    function checkpincode() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $password = $this->params->query['password'];
        $user_id = $this->params->query['user_id'];
        $passwordHasher = new SimplePasswordHasher();
        $password = $passwordHasher->hash($password);
        $this->User->recursive = -1;
        $information = $this->User->find('first', array(
            'fields' => array('User.id', 'User.password', 'User.email_address'), 'conditions' => array('User.id' => $user_id, 'User.password' => $password)
        ));

        if ($information) {
            $club['Success'] = 'Yes';
        } else {
            $club['Success'] = 'No';
        }
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function points_calucator() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $email = $this->params->query['email'];
        if (isset($this->params->query['booking_id']) && (!empty($this->params->query['booking_id']))) {
            $this->Booking->recursive = -1;
            $booking = $this->Booking->findById($this->params->query['booking_id'], array('fields' => 'booking_price'));
            $booking_pice = $booking['Booking']['booking_price'];
            $club["booking_price"] = $booking_pice;
        } else
            $club["booking_price"] = '';
        $this->loadModel('OrderItem');
        //        $this->OrderItem->Behaviors->load('Containable');
        //
    //
    //        $contain = array(
        //            'Order' => array(
        //                'fields' => array('User.email_address'),
        //                'conditions' => array("User.email_address" => $email),
        //                'limit' => 1,
        //        ));

        $email = '"' . $email . '"';
        $sql = "SELECT SUM(order_items.`price`)total_points,order_items.`order_id`,orders.`id` FROM order_items,orders,users WHERE order_items.`order_id`=orders.id 
            AND orders.user_id=users.id AND users.`email_address`=$email";

        $club["total_earnings"] = $this->OrderItem->query($sql);
        if ($club["total_earnings"])
            $club["Success"] = "Yes";
        else
            $club["Success"] = "No";
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    //////Account Settings///////////////////
    function receiptclublisting() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $user_id = $this->params->query['user_id'];
        $this->loadModel('Order');
        //$query = "select booking_price from bookings where  ";
        $sql = 'SELECT id,order_time,(SELECT club_name FROM `clubs` WHERE clubs.`id`=orders.`club_id`)club_name FROM `orders`  WHERE orders.user_id=' . $user_id . ' AND orders.`status`="completed"';
        $club['info'] = $this->Order->query($sql);


        if ($club['info'])
            $club['info']["Success"] = "Yes";
        else
            $club['info']["Success"] = "No";

        $function_name = $this->params->query ['callback'];
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function individaulreceipt() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Order');
        $order_id = $this->params->query['order_id'];
        // $club_id=$this->params->query['club_id'];
        //$this->loadModel('OrderItem');
        //       $club['Order']=
        //               $this->OrderItem->query('Select * from price bottle_price,quantity,club_bottle_id, (Select bottle_name from club_bottles where club_bottles.id=order_items.club_bottle_id)bottle_name'
        //              . ' from order_items where order_id='.$order_id.'');
        //  $this->loadModel('Split');
        //$club['Order']=$this->Order->query('select * from  order_items,orders where order_items.order_id='.$order_id.' and orders.id=order_items.order_id');
        $club['booking_price'] = $this->Booking->query('select booking_price price ,booking_time  from bookings,orders where bookings.`id`=orders.`booking_id` and orders.id=' . $order_id . ' LIMIT 1');

        $club['Order'] = $this->Order->query('select * from  club_bottles,order_items,orders,(select bottle_name from club_bottles,'
                . 'order_items where  club_bottles.`id`=order_items.`club_bottle_id` and order_items.`order_id`=' . $order_id . ') bottle_name  where order_items.order_id=orders.id and order_items.order_id=' . $order_id . ' and  club_bottles.`id`=order_items.`club_bottle_id` GROUP BY order_items.club_bottle_id Order by order_items.id');

        $club_name = $this->Club->query('Select club_name from clubs,orders where orders.`club_id`=clubs.id and orders.id=' . $order_id . '');
        $club['club_name'] = $club_name;
        $function_name = $this->params->query['callback'];
        $club['Success'] = 'Yes';
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function checkpromotercode() {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->autoRender = false;
        $this->layout = 'ajax';
        $promo_code = $this->params->query['promo_code'];
        $options = array(
            "conditions" => array("User.promoter_code" => trim($promo_code)),
            "fields" => array("User.promoter_code", "User.first_name", "User.last_name"),
            "limit" => 1,
        );
        $this->recursive = -1;
        $club["information"] = $this->User->find("first", $options);

        if ($club["information"]) {
            $club["Success"] = "Yes";
        } else
            $club["Success"] = "No";



        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function insertrefferalcode() {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->autoRender = false;
        $this->layout = 'ajax';
        $promo_code = $this->params->query['promo_code'];
        ; //my user id
        $options = array(
            "conditions" => array("User.promoter_code" => trim($promo_code)),
            "fields" => array("User.promoter_code", "User.first_name", "User.last_name", "User.id"),
            "limit" => 1,
        );
        $this->recursive = -1;
        $inf = $this->User->find("first", $options);

        if (!$inf) {//valid promotor code
            $club["Success"] = "No";
            $club["Reason"] = "Invalid Code";

            $function_name = $this->params->query['callback'];
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        } else {
            $info['promoter_id'] = $inf['User']['id'];
            $info['status'] = 'off';
            $this->loadModel('Reference');

            $info['user_id'] = $this->params->query['user_id'];

            if ($this->checkifalreadyexists($info['user_id'], $info['promoter_id'])) {
                if ($this->Reference->save($info)) {

                    $club['promoter_name'] = $inf['User']['first_name'];

                    //                    $reference = array(
                    //            "fields" => array("Reference.user_id", "User.first_name", "User.id", "Reference.status"),
                    //            "joins" => array(
                    //                array('table' => 'users',
                    //                    'alias' => 'User',
                    //                    'type' => 'INNER',
                    //                    'conditions' => array(
                    //                        'Reference.promoter_id=User.id', 'Reference.user_id' => $user_id
                    //                    )
                    //                )
                    //        ));

                    $user_id = $this->params->query['user_id'];
                    $reference = array(
                        "fields" => array("Reference.user_id", "User.first_name", "User.id", "Reference.status"),
                        "joins" => array(
                            array('table' => 'users',
                                'alias' => 'User',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'Reference.promoter_id=User.id', 'Reference.user_id' => $user_id
                                )
                            )
                    ));



                    $club['ref'] = $this->Reference->find("all", $reference); //all the person who refered me.

                    $club["Success"] = "Yes";
                }
            } else {
                $club["Success"] = "No";
                $club['Reason'] = 'Taken';
                $user_id = $this->params->query['user_id'];
                $reference = array(
                    "fields" => array("Reference.user_id", "User.first_name", "User.id", "Reference.status"),
                    "joins" => array(
                        array('table' => 'users',
                            'alias' => 'User',
                            'type' => 'INNER',
                            'conditions' => array(
                                'Reference.promoter_id=User.id', 'Reference.user_id' => $user_id
                            )
                        )
                ));
                $club['ref'] = $this->Reference->find("all", $reference);
            }
            $function_name = $this->params->query['callback'];
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
        }//
    }

    function showallpromoter() {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->autoRender = false;
        $this->layout = 'ajax';


        $this->loadModel('Reference');
        $user_id = $this->params->query['user_id'];
        $reference = array(
            "fields" => array("Reference.user_id", "User.first_name", "User.id", "Reference.status"),
            "joins" => array(
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Reference.promoter_id=User.id', 'Reference.user_id' => $user_id
                    )
                )
        ));

        $club['ref'] = $this->Reference->find("all", $reference); //all the person who refered me.
        if ($club['ref'])
            $club["Success"] = "Yes";
        else
            $club["Success"] = "No";

        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function checkifalreadyexists($user_id, $promoter_id) {
        $options = array(
            "conditions" => array("Reference.promoter_id" => trim($promoter_id), "Reference.user_id" => trim($user_id)),
            "limit" => 1,
        );
        $this->loadModel("Reference");

        if ($this->Reference->find("count", $options))
            return false;
        return true;
    }

    function prodmoterupdatestatus() {

        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel("Reference");
        $info['promoter_id'] = $this->params->query['promoter_id'];
        $info['user_id'] = $this->params->query['user_id'];
        if ($info['promoter_id'] == 'all') {
            if ($this->Reference->updateAll(array('Reference.status' => '"off"'), array('Reference.user_id' => $info['user_id'])))
                $club['Success'] = 'Yes';
        }

        else {
            if ($this->Reference->updateAll(array('Reference.status' => '"on"'), array('Reference.promoter_id' => $info['promoter_id'], 'Reference.user_id' => $info['user_id']))) {
                $club['Success'] = 'Yes';
                $this->Reference->updateAll(array('Reference.status' => '"off"'), array('Reference.promoter_id !=' => $info['promoter_id'], 'Reference.user_id' => $info['user_id']));
            } else
                $club['Success'] = 'No';
        }
        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    //    function splitthebconformation() {
    //        $this->autoRender = false;
    //        $this->layout = 'ajax';
    //        $this->loadModel("Split");
    //$this->Split->contain(array('User'));
    //"fields"=>array("User.first_name","User.id","Booking.id","Booking.order_id","Booking.guys","Booking.girls",
    //        $conditions=array(
    //            "conditions"=>array("Split.user_id"=>8),
    //            "fields"=>array("User.first_name","User.id","Split.booking_id","Split.user_id")
    //            
    //            );
    //        $contain = array(
    //            'Booking' => array(
    //                'conditions' => array('Booking.id' => 'Split.booking_id'),                
    //            ),
    //            'order' => array(
    //                'conditions' => array('Booking.id' => 'Order.booking_id'),                
    //            )
    //            
    //            );
    //        $this->Split->Booking->unbindModel(
    //                array('belongsTo'=> array('ClubTable','User','Club'))
    //        );
    //        
    //       $this->Split->Behaviors->load('Containable');
    //        //$this->Split->recursive=2;
    //$information=$this->Split->find("all",$conditions,'contain' => $contain);
    // $information = $this->Split->find('all', array('limit' =>1,'conditions' => array("Split.user_id"=>8), 'contain' => $contain));
    //       $information= $this->Split->find('all', array(
    //  'limit' => 1,
    //  'contain' => array(
    //    'Booking.Order'
    //  )
    //));
    //$this->Split->recursive=2;
    //        $conditions = array("conditions" => array("Split.id" => 38),
    //            "fields" => array("User.id", "User.first_name", "Split.splited_user_id", "Split.id", "Booking.id")
    //        );
    //        //"fields"=>array("User.id","User.first_name","Split.splited_user_id","Split.id","Booking.id","Booking.club_table_id","ClubTable.table_name","ClubTable.id"),      
    //
    //        $this->Split->Behaviors->load('Containable');
    //        
    //        
    //        $this->Split->belongsTo = array(
    //		'User' => array(
    //			'className' => 'User',
    //			'foreignKey' => 'user_id',
    //			'conditions' => '',
    //			'fields' => 'id,first_name',
    //			'order' => ''
    //		),
    //		'Booking' => array(
    //			'className' => 'Booking',
    //			'foreignKey' => 'booking_id',
    //			'conditions' => '',
    //			'fields' => '',
    //			'order' => '',
    //                        
    //		)
    //	);
    //        
    //        $information = $this->Split->find('all', array("conditions" => array("Split.id" => 38),
    //            'limit' => 1,
    //            'contain' => array(
    //            'User.Booking.ClubTable',
    //            ),
    //            "fields" => array("User.id", "User.first_name", "Split.booking_id", "Split.splited_user_id", "Split.id"),
    //        ));
    //       $this->Split->recursive=2;
    //        $information= $this->Split->find("all");
    //
    //        pr($information);
    //    }


    function splitthebconformation() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->Booking->hasMany = array(
            'Split' => array(
                'className' => 'Split',
                'foreignKey' => 'booking_id',
                'dependent' => false,
                'conditions' => 'Split.status="pending"',
                'fields' => 'splited_user_id,name,splited_amount',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''),
        );
        $this->Booking->belongsTo = array(
            'ClubTable' => array(
                'className' => 'ClubTable',
                'foreignKey' => 'club_table_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => 'minimum_price,table_min_guy,table_min_girls,max_guys1,id',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''),
            'Club' => array(
                'className' => 'Club',
                'foreignKey' => 'club_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => 'club_name',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => '')
        );
        $this->loadModel("Split");
        $this->Booking->unbindModel(array('hasMany' => array('Order')));
        $this->Split->unbindModel(array('belongsTo' => array('Booking')));
        $this->ClubTable->unbindModel(array('hasMany' => array('Booking')));
        //$this->ClubTable->unbindModel(array('hasMany' => array('Deal')));
        $this->ClubTable->unbindModel(array('belongsTo' => array('Club')));
        $this->ClubTable->unbindModel(array('belongsTo' => array('Category')));
        //$this->ClubTable->unbindModel(array('belongsTo' => array('User')));
        //$this->Club->unbindModel(array('belongsTo' => array('User')));
        $this->Club->unbindModel(array('belongsTo' => array('ClubType')));
        //$this->Booking->recursive = 1;
        $user_id = $this->params->query['user_id'];
        $splited_user_id = $this->Split->find("all", array("conditions" =>
            array('Split.splited_user_id' => $user_id, 'Split.status' => 'pending'),
            "fields" => array("","Split.booking_id,Split.id", "Split.splited_amount"),
            'order' => array('Split.splited_date DESC')
            
        ));
        
        if (isset($splited_user_id['Split']['booking_id']) && ($splited_user_id['Split']['booking_id'])) {
            $booking_id = $splited_user_id['Split']['booking_id'];
            $splited_amount = $splited_user_id['Split']['splited_amount'];
        } else {
            $data["Success"] = 'No';
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
            return false;
        }

        //        $booking_id=$this->Split->read('booking_id');
        //        $booking_id=$booking_id["Split"]["booking_id"];
        //        
        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubException', 'ClubOpenDay', 'Deal', 'Booking', 'Event', 'Photo')));
        $information = $this->Booking->findById($booking_id, array("fields" => "Booking.user_id,Booking.guys,Booking.girls,Booking.club_id", "Booking.club_table_id"));


        $info['club_name'] = $information['Club']['club_name'];
        $info['Club_table'] = $information['ClubTable'];
        ///////////////////calculation////////////////////////////////////////////////
        $club_id = $information['Booking']['club_id'];
        $user_id = $information['Booking']['user_id'];
        $table_id = $information['Booking']['club_table_id'];
        $numberof_guy_booked_table = $information['Booking']['guys'];
        $numberof_girls_booked_table = $information['Booking']['girls'];

        if (isset($information['ClubTable']['Deal'][0]['deal_now'])) {
            $show_deal = $information['ClubTable']['Deal'][0]['deal_now']; //yes or no
            if ($show_deal == 'on') {
                $show_deal = 'yes';
            } else
                $show_deal = 'no';
            //Deal price
        } else
            $show_deal = 'no';
        if (isset($information['ClubTable']['Deal'][0]['deal_price']))
            $deal_price = $information['ClubTable']['Deal'][0]['deal_price'];
        else
            $deal_price = '';
        $this->splitbillcalculation($booking_id, $deal_price, $show_deal, $numberof_guy_booked_table, $numberof_girls_booked_table, $info['club_name'], $table_id, $splited_amount);
    }

    function splitbillcalculation($booking_id, $deal_price, $show_deal, $numberof_guy_booked_table, $numberof_girls_booked_table, $club_name, $table_id, $splited_amount) {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $condition = array(
            "Splits.status" => 'pending',
            'Splits.booking_id' => $booking_id
        );
        //        $data ['Split'] = $this->Splits->find("all", array(
        //            "conditions" => $condition
        //        ));
        $data['group_size'] = $numberof_guy_booked_table + $numberof_girls_booked_table;
        if ($show_deal == "yes") {
            $data ['amount'] = $deal_price;
        } else {
            // No deal table price            
            //$amount = $data ['group'];
            $this->ClubTable->id = $table_id;
            $this->ClubTable->recursive = - 1;
            $information = $this->ClubTable->read(null);
            $tbl_min_guy = $information ['ClubTable'] ['table_min_guy'];
            $tbl_min_girls = $information ['ClubTable'] ['table_min_girls'];
            $max_guys1 = $information ['ClubTable'] ['max_guys1'];
            $max_guys2 = $information ['ClubTable'] ['max_guys2'];

            //            if (($information ['ClubTable'] ['table_min_guy'] <= $numberof_guy_booked_table) || ($information ['ClubTable'] ['table_min_girls'] <= $numberof_girls_booked_table)) {
            //                $data ['amount'] = $information ['ClubTable'] ['minimum_price']; // first condition
            //                $data ['reservation'] = 'ok';
            //            } else { // else1
            //                if (($numberof_guy_booked_table >= $max_guys1) && ($numberof_guy_booked_table <= $max_guys2)) { //$max_guys1<=$numberof_guy_booked_table<=$max_guys2
            //                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
            //                    $data ['reservation'] = 'ok';
            //                }     // else1
            //                else if ($numberof_guy_booked_table <= $max_guys1) {
            //                    $data ['amount'] = $information['ClubTable']['max_guys1_price'];
            //                    $data ['reservation'] = 'ok';
            //                } // else1
            //            }


            if (!empty($max_guys1) || !empty($max_guys2)) {
                if ($numberof_guy_booked_table == $max_guys1) {
                    $data ['amount'] = $information['ClubTable']['max_guys1_price'];
                    $data ['reservation'] = 'ok';
                } else if ($numberof_guy_booked_table == $max_guys2) {
                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
                    $data ['reservation'] = 'ok';
                } else if (($numberof_guy_booked_table > $max_guys1) && ($numberof_guy_booked_table < $max_guys2)) {
                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
                    $data ['reservation'] = 'ok';
                } else if ($numberof_guy_booked_table > $max_guys2) {
                    $data ['amount'] = $information['ClubTable']['max_guys2_price'];
                    $data ['reservation'] = 'ok';
                } else if ($numberof_guy_booked_table < $max_guys1) {
                    $data ['amount'] = $information['ClubTable']['minimum_price'];
                    $data ['reservation'] = 'ok';
                }
            }
        }

        ;
        $data['booking_id'] = $booking_id;
        $data['amount'] = $data['amount'] + $data['amount'] * .5;
        $data ['final_amount'] = $data ['amount'] * ($splited_amount / 100);
        $data ['total_amount'] = $data ['amount'];
        $data['club_name'] = $club_name;
        $data['Success'] = 'yes';
        $function_name = $this->params->query ['callback'];
        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    public function bookingchangestatus() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $booking_id = $this->params->query ['booking_id'];
        $status_booking = $this->params->query ['status_booking'];
        $status_splitbill = $this->params->query ['status_splitbill'];
        $splited_user_id = $this->params->query ['user_id'];

        if (($status_splitbill == 'completed') || ( $status_splitbill == 'braintreehold')) {
            $this->Booking->id = $booking_id;
            $this->loadModel("Split");
            //$this->Split->primaryKey = $booking_id;
            $this->Split->id = $booking_id;
            if ($this->Booking->saveField('status', $status_booking) && ($this->Split->saveField('status', $status_splitbill))) {

                $data['Success'] = 'yes';
                // $this->release_cancel_fund_braintree($booking_id, 'release');
            } else
                $data['Success'] = 'no';
        }
        else if ($status_splitbill == 'cancelled') {


            $this->loadModel("Split");
            $this->Booking->id = $booking_id;
            //if ($this->Booking->saveField('status', $status_booking) && ($this->Split->saveField('status', $status_splitbill))) {
            if ($this->Booking->saveField('status', $status_booking) && ($this->Split->updateAll(
                            array('Split.status' => '"' . $status_splitbill . '"'), array('Split.booking_id' => $booking_id)
                    ))) {

                $data['Success'] = 'yes';
                //  $this->release_cancel_fund_braintree($booking_id, 'cancel');
            } else
                $data['Success'] = 'no';
        }

        $function_name = $this->params->query ['callback'];
        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    public function bookinginfo() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $id = $this->params->query['booking_id'];
        date_default_timezone_set($this->default_time_zone);
        //echo $this->params->query['current_time'];
        //  echo"-----------";
        //$current_time = strtotime($this->params->query['current_time']);
        $current_time = strtotime(date('Y-m-d H:i:s'));


        $conditions = array("AND" => array('Booking.id' => $id, array('OR' => array(array('Booking.status' => 'pending'), array('Booking.status' => 'braintreehold'), array('Booking.status' => 'reserved'), array('Booking.status' => 'taken'))))); //edited by Manzoor 'Booking.status'=>'pending'
        $bookings = $this->Booking->find('first', array('conditions' => $conditions));

        if (isset($bookings['Booking']['club_id'])) {
            $this->Club->recursive = -1;
            $data['Club'] = $this->Club->find('first', array('Club.id' => $bookings['Booking']['club_id']));
        }


        if (isset($bookings['Booking']['booking_time'])) {
            $booking_time = strtotime($bookings['Booking']['booking_time']);
            $diff = round(abs($current_time - $booking_time) / 60);
            //  echo 'c'.$current_time.'-b-'.$booking_time.'<br>';    
            // echo $diff;
            $data = $bookings;
            $data['MintLeft'] = $diff;
            $data['Success'] = 'Yes';


            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
        } else {
            $data['Success'] = 'No';
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
        }
    }

    function splited_user_bookinginfo() {
        date_default_timezone_set($this->default_time_zone);
        $this->autoRender = false;
        $this->layout = 'ajax';
        $id = $this->params->query['booking_id'];
        //$current_time = strtotime($this->params->query ['current_time']);

        $current_time = strtotime(date('Y-m-d H:i:s'));
        
        $this->loadModel('Split');
        //        $conditions = array("AND" => array('Split.booking_id' => $id, array('OR' => array('Split.status' => 'braintreehold')))); //edited by Manzoor 'Booking.status'=>'pending'
        //        $contain=array('contain'=>array('Club'));
        $sql = 'SELECT * FROM splits Split,bookings Booking,clubs Club WHERE'
                . ' Split.booking_id="' . $id . '" AND  Split.booking_id=Booking.id  AND Booking.`club_id`=Club.`id` ORDER BY Split.`booking_id` DESC';
        //$this->Split->Behaviors->load('Containable');

        $bookings = $this->Split->query($sql);
        
        
        if (isset($bookings[0]['Split']['splited_date'])) {
            $booking_time = strtotime($bookings[0]['Split']['splited_date']);
            $diff = round(abs($current_time - $booking_time) / 60);

            $data = $bookings[0];
            $data['MintLeft'] = $diff;
            $data['Success'] = 'Yes';
            $data['Splits']= $bookings;
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
        } else {
            $data['Success'] = 'No';
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
        }
    }

    function checkbookingcheckintine($booking_id) {

        $this->autoRender = false;
        $this->layout = 'ajax';
        date_default_timezone_set($this->default_time_zone);
        $this->loadModel('Booking');
        $booking_time = $this->Booking->find('first', array(
            'conditions' => array('Booking.id' => $booking_id),
            'fields' => array('Booking.booking_time', 'Booking.id'))
        );

        $chekin_time = date('Y-m-d H:i:s');
        $booking_time = $booking_time['Booking']['booking_time'];
        $diff = ($this->gtd($chekin_time, $booking_time));
        $flag = true;
        if (($diff['hours']) > 0) {
            $flag = false;
        } else if ((isset($diff['hours']) && ($diff['hours'] > 0))) {
            $flag = false;
        } else if ($diff['minutes'] > 30) {
            $flag = false;
        }
        if (!$flag) {
            $function_name = $this->params->query ['callback'];
            $data['Success'] = 'no';
            $data['reason'] = '30 mins excedded.';
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
            exit();
        } else {
            return true;
        }
    }

    function caneclbooking() {
        $this->autoRender = false;
        $this->layout = 'ajax';

        $this->Booking->id = $this->params->query['booking_id'];
        $this->checkbookingcheckintine($this->params->query['booking_id']);
        if ($this->Booking->saveField('status', 'cancelled') && ($this->check_update_split($this->params->query['booking_id'], 'cancelled'))) {
            $data['Success'] = 'yes';
            //$this->release_cancel_fund_braintree($this->params->query['booking_id'], 'cancel');
        } else
            $data['Success'] = 'no';

        $function_name = $this->params->query ['callback'];
        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    function check_update_split($booking_id, $status_booking) {
        $this->loadModel('Split');
        $options = array('conditions' => array('Split.booking_id' => $booking_id, 'Split.status' => 'braintreehold'));
        $counter = $this->Split->find('count', $options);
        if (isset($counter) && ($counter > 0)) {
            if (($this->Split->updateAll(
                            array('Split.status' => "'$status_booking'"), array('Split.booking_id' => $booking_id))))
                return true;
            return false;
        }
        return true; //no split bill
    }

    function clubinfo($booking_id) {

        $this->Booking->recursive = -1;
        $data = $this->Booking->findById($booking_id, array('fields' => 'Booking.club_id'));
        $club_id = $data['Booking']['club_id'];
        $this->Club->unBindModel(array('belongsTo' => array('User', 'ClubType')));
        $this->Club->unBindModel(array('hasMany' => array('ClubBottle', 'Booking', 'Photo')));
        $clubs = $this->Club->findById($club_id);

        return $clubs;
    }

    function cuurent_week_day() {
        date_default_timezone_set($this->default_time_zone);
        $jd = cal_to_jd(CAL_GREGORIAN, date("m"), date("d"), date("Y"));
        return(jddayofweek($jd, 1));
    }

    function check_in() {
        $this->loadModel('Transaction');
        date_default_timezone_set($this->default_time_zone);
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $this->autoRender = false;
        $this->layout = 'ajax';
        $split_bill = $this->params->query['split_bill'];
        if (isset($split_bill) && ($split_bill == 'true')) {
            $booking_id = $this->params->query['booking_id'];
            $this->loadModel('Split');
            $this->Split->recursive = -1;
            $transaction_ids = $this->Split->find('all', array(
                'conditions' =>
                array('Split.booking_id' => $booking_id, 'Split.status' => 'braintreehold'),
                'fields' => array('Split.transaction_id', 'Split.id', 'Split.splited_amount', 'Split.splited_user_id')
            ));

            $booking_info = $this->Booking->find("first", array("conditions" => array("Booking.id" => $booking_id)));
            //$this->Club->Behaviors->attach('Containable');
            //$this->Club->contain('ClubOpenDay');
//             $data['club']=$this->Club->find("all",
//                    array('conditions'=>array('Club.id'=>$booking_info['Booking']['club_id']),
//                          'contain' => array(
//                           'ClubOpenDay' => array(
//                            'conditions' => array('ClubOpenDay.days' =>  "Wednesday",'ClubOpenDay.club_id'=>$booking_info['Booking']['club_id']),
//
//                        ))));  
            //working 15

            $this->loadModel('ClubOpenDay');
            $data['club'] = $this->ClubOpenDay->find('first', array('conditions' => array('ClubOpenDay.days' => $this->cuurent_week_day(), 'ClubOpenDay.club_id' => $booking_info['Booking']['club_id'])));




//array('contain'=>array('ClubOpenDay'))));



            foreach ($transaction_ids as $tid) {
                $result = Braintree_Transaction::submitForSettlement($tid['Split']['transaction_id']);

                if ($result->success) {
                    $this->Split->id = $tid['Split']['id'];
                    $this->Split->saveField('status', 'check_in');
                } else {
                    $data['Success'] = 'no';
                    $data['message'] = $result->message;
                    $function_name = $this->params->query ['callback'];
                    echo "$function_name (\n";
                    echo json_encode($data);
                    echo ");\n";
                    exit();
                }


                $this->User->recursive = -1;

                //pre authorization processs// 

                $token = $this->User->find("first", array('conditions' => array('User.id' => $tid['Split']['splited_user_id'])));
                $this->Booking->id = $booking_id;
                $pre_authorization_amount = floatval(($booking_info["Booking"]["booking_price"] * 10) + (($booking_info["Booking"]["booking_price"] * 10) / 2));
                $pre_authorization_amount = $pre_authorization_amount * $tid['Split']['splited_amount'];
                $result_pre = Braintree_Transaction::sale(array(
                            'paymentMethodToken' => $token['User']['token'],
                            'amount' => $pre_authorization_amount,
                            'customFields' => array('comments' => "Preauthorization transaction"),
                            'options' => array(
                                'submitForSettlement' => false,
                            ),
                ));

                $trans_id = $result_pre->transaction->id;

                $this->Transaction->create();
                $this->Transaction->save(array('transaction_id' => $trans_id, 'booking_id' => $booking_id, 'status' => 'complete', 'user_id' => $tid['Split']['splited_user_id'], 'date' => date("Y-m-d H:i:s"), 'comments' => 'Split Bill ', 'split' => 'yes'));
            }
            //pre authorization processs//
            $data['Success'] = 'yes';
            $data['club_id'] = $booking_info["Booking"]["club_id"];
            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
            exit();
        }//if for splited user.
        else {
            $booking_id = $this->params->query['booking_id'];
            $this->Booking->recursive = -1;
            $booking_info = $this->Booking->find("first", array("conditions" => array("Booking.id" => $booking_id)));

            $result = Braintree_Transaction::submitForSettlement($booking_info["Booking"]["transaction_id"]);
            $this->User->recursive = -1;
            $token = $this->User->find("first", array('conditions' => array('User.id' => $this->params->query['user_id'])));
            $this->Booking->id = $booking_id;
            $pre_authorization_amount = floatval(($booking_info["Booking"]["booking_price"] * 10) + (($booking_info["Booking"]["booking_price"] * 10) / 2));


            if (($this->Booking->saveField('status', 'check_in') ) && ($this->check_update_split($booking_id, 'check_in')) && ($result->success)) {

                $result_pre = Braintree_Transaction::sale(array(
                            'paymentMethodToken' => $token['User']['token'],
                            'amount' => $pre_authorization_amount,
                            'customFields' => array('comments' => "Preauthorization transaction"),
                            'options' => array(
                                'submitForSettlement' => true,
                            ),
                ));

                if (true) {
                    $this->Booking->id = $booking_id;
                  //  $this->Booking->saveField("pre_auth_transaction_id", $result_pre->transaction->id);
                } else {
                    
                    $data=array();
                    $data['reason'] = 'Insufficient Balance  for pre-authization error! '.$result_pre->message;
                    $data['Success'] = 'no';
                    $this->Booking->id = $booking_id;
                    $this->Booking->saveField('status', 'cancelled');
                    $function_name = $this->params->query ['callback'];
                    echo "$function_name (\n";
                    echo json_encode($data);
                    echo ");\n";
                    exit();
                }



                $data['Success'] = 'yes';
                $this->Booking->recursive = -1;
                $data['club_info'] = $this->clubinfo($booking_id);
                $data['Club'] = $this->Booking->find('first', array('conditions' => array('Booking.id' => $booking_id), 'fields' => 'Booking.club_id'));
            } else {
                $data['Success'] = 'no';
                $data['reason'] = 'Could not save to database.';
            }

            $function_name = $this->params->query ['callback'];
            echo "$function_name (\n";
            echo json_encode($data);
            echo ");\n";
        }
    }

    function bookstatusfromuserid() {
        $this->autoRender = false;
        $this->layout = 'ajax';

        $user_id = $this->params->query['user_id'];
        $date = ($this->params->query['date']);

        date_default_timezone_set($this->default_time_zone);
        $this->Booking->recursive = -1;
        $options = array(
            'fields' => array('Booking.arrival_date', 'Booking.booking_price', 'Booking.status', 'Booking.id', 'Booking.user_id'),
            'conditions' => array('Booking.status' => 'braintreehold', 'Booking.user_id' => $user_id, 'Booking.arrival_date' => trim($date))
        );

        $info = $this->Booking->find("first", $options);


        if (isset($info['Booking']['id'])) {


            if (($info['Booking']['id'] > 0) && (strtotime($info['Booking']['arrival_date']) == strtotime($date))) {
                $data["Success"] = "yes";
                $data['hasBooking_id'] = $info['Booking']['id'];
                $data['booking_price'] = $info['Booking']['booking_price'];
            } else {
                $data["Success"] = "no";
            }
        } else
            $data["Success"] = "no";
        $function_name = $this->params->query ['callback'];

        echo "$function_name (\n";
        echo json_encode($data);
        echo ");\n";
    }

    public function addcards() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        //$this->debug = false;
        $function_name = $this->params->query['callback'];
        $id = $this->params->query['id'];
        $cards = $this->params->query['cards'];
        $user_id = $this->params->query['user_id'];
        if (!empty($id)) {
            $this->Card->id = $id;
        }
        $info['Card']['user_id'] = $user_id;
        $info['Card']['cards'] = $cards;
        if ($this->Card->save($info)) {
            $info['Success'] = 'Yes';
            $info['CardId'] = $this->Card->getLastInsertID();
            $info['id'] = $id;
        } else {
            $info['Success'] = 'No';
        }

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    public function displaycards() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        //$this->debug = false;
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $this->Card->unbindModel(array("belongsTo" => array('User')));
        $options = array(
            'conditions' => array('Card.user_id' => $user_id), //array of conditions
            'field' => array('Card.id,Card.cards'),
            "order" => array("Card.id DESC")
        );

        $info = $this->Card->find("all", $options);

        //pr($info);
        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    public function getCards() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $id = $this->params->query['id'];
        $this->Card->unbindModel(array("belongsTo" => array('User')));
        $options = array(
            'conditions' => array('Card.id' => $id), //array of conditions
            'field' => array('Card.id,Card.cards'),
        );

        $info = $this->Card->find("first", $options);
        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    public function uploaduserphoto() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->response->header(array('Access-Control-Allow-Origin: *', 'Content-type: image/jpeg', 'Content-type: image/jpg', 'Content-type: image/gif', 'Content-type: image/png'));


        $user_id = $this->params->data['user_id'];
        //$club_id=$this->params->data['club_id'];
        $conditions = array('conditions' => array('Photo.user_id' => $user_id, 'Photo.photo_type' => 'user'));
        $count = $this->Photo->find('count', $conditions);

        if ($count >= 3) {
            $info['msg'] = 'You cannot Upload more than 3 photos.';
            $info['code'] = 1;
            echo json_encode($info);
        } else {//else
            $filename = time() . '-' . $this->params->form['file']['name'];

            if (move_uploaded_file($this->params->form['file']['tmp_name'], WWW_ROOT . 'img/profile/' . $filename)) {
                $info['msg'] = 'You have uploaded picture sucessfully,Thank you.';
                $info['code'] = 2;
                $info['pic'] = 'img/profile/' . $filename;

                $array = array();
                $array['Photo']['user_id'] = $user_id;
                $array['Photo']['photos'] = $filename;
                $array['Photo']['photo_type'] = 'user';
                $array['Photo']['profile_picture'] = 'yes';
                $this->Photo->save($array);
                $info['pid'] = $this->Photo->getLastInsertID();
                echo json_encode($info);
            } else {
                $info['msg'] = 'Upload Failed,Sorry.';
                $info['code'] = 3;
                echo json_encode($info);
            }
        }//else
    }

    public function uploaduserphoto_reg() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->response->header(array('Access-Control-Allow-Origin: *', 'Content-type: image/jpeg', 'Content-type: image/jpg', 'Content-type: image/gif', 'Content-type: image/png'));



        $filename = time() . '-' . $this->params->form['file']['name'];

        if (move_uploaded_file($this->params->form['file']['tmp_name'], WWW_ROOT . 'img/profile/' . $filename)) {
            $info['msg'] = 'You have uploaded picture sucessfully,Thank you.';
            $info['code'] = 2;
            $info['pic'] = 'img/profile/' . $filename;


            $info['photos'] = $filename;

            echo json_encode($info);
        } else {
            $info['msg'] = 'Upload Failed,Sorry.';
            $info['code'] = 3;
            echo json_encode($info);
        }
    }

    function deleteprofilephoto() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $id = $this->params->query['p_id'];
        $this->Photo->id = $id;
        if ($this->Photo->delete()) {
            $info['Success'] = 'yes';
        } else
            $info['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    function viewallprofilephoto() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];

        $conditions = array("conditions" => array("Photo.user_id" => $user_id, 'Photo.photo_type' => 'user', 'Photo.profile_picture' => 'yes'), 'fields' => array('Photo.photos,Photo.id'));
        $information = $this->Photo->find('all', $conditions);

        if (count($information) > 0) {
            //        foreach($info as $information)
            //            foreach($information as $data)
            //                echo $data["photos"];
            //        
            $info['Success'] = 'yes';
            $info['information'] = $information;
        } else
            $info['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    function checkmobilenumberexists() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $mobile = array();
        $mobile = json_decode($this->params->query['mobile'], true);
        $mob_data = array();
        $k = 0;
        foreach ($mobile as $mob) {

            $mob_data[$k]["phone"] = $mob['phone'];
            $mob_data[$k]["u_name"] = $mob['name'];
            $k++;
        }
        $this->User->recursive = -1;
        $information['info'] = $this->User->find('all', array("fields" => array('User.phone_number', 'User.id', 'User.first_name', 'User.id'),
            'conditions' => array("User.phone_number NOT" => "null")));

        $all_data = $information['info'];

        $k = 0;
        $counter = count($mob_data);
        $m = 0;
        foreach ($all_data as $datam) {

            foreach ($mob_data as $tel) {

                if (($datam['User']['phone_number'] == $tel["phone"]) && ($user_id != $datam['User']['id'])) {
                    $info['info'][$k]['phone_number'] = $tel["phone"];
                    $info['info'][$k]['User_id'] = $datam['User']['id'];
                    $info['info'][$k]['first_name'] = $datam['User']['first_name'];
                    $mob_data[$k]["phone"] = ''; //user exits
                    $mob_data[$k]["u_name"] = '';
                    $k++;
                }
            }
        }

        if ($k > 0) {
            $t = 0;
            for ($i = 0; $i < count($mob_data); $i++) {
                if (isset($mob_data[$i]["phone"])) {
                    if ($mob_data[$i]["phone"] != '') {
                        $mob_info[$t]["phone"] = $mob_data[$i]["phone"];
                        $mob_info[$t]["u_name"] = $mob_data[$i]["u_name"];
                        $t++;
                    }
                }
            }
            $info['Success'] = 'yes';
            $info['size'] = $k + 1; //me

            array_shift($mob_info);

            $info['user_does_not_exists'] = $mob_info;
        } else
            $info['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    /*
     * Brain tree Payment processing...
     */

    function payment($comments, $user_id, $amount, $club_id, $booking_id) {

        $this->User->recursive = -1;
        $user = $this->User->findById($user_id);
        $token = $user['User']['token'];
        //$marchent_id = $user['User']['marchentid'];

        $this->Club->recursive = -1;
        $club = $this->Club->findById($club_id);
        $club_name = $club['Club']['club_name'];

        $this->autoRender = false;
        $this->layout = 'ajax';
        //print_r($this->params->query['info']);
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);

        // comments, tranction_id, club_name, user_name, userid, clubid
        $result = Braintree_Transaction::sale(array(
                    'paymentMethodToken' => $token,
                    'amount' => $amount,
                    'customFields' => array('comments' => $comments),
                    'options' => array(
                        'submitForSettlement' => false,
                    ),
        ));

        if (!$result->success) {

            $function_name = $this->params->query['callback'];
            $info['Success'] = 'No';
            $info['error'] = $result->message;

            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
            $this->loadModel('Booking');
            $this->Booking->delete($booking_id);
            exit();
        } else {


            if ($result->transaction->id) {
                //$info['transaction_id']=$result->transaction->id;
                $info['Success'] = 'yes';
                $info['transation_id'] = $result->transaction->id;
                $this->loadModel('Booking');
                $this->Booking->id = $booking_id;
                $this->Booking->saveField('transaction_id', $result->transaction->id);
                $this->Booking->saveField('status', 'braintreehold');
                $this->Booking->save();

                if ($comments == 'Payment') {
                    $this->loadModel('Order');
                    $this->recursive = -1;
                    $this->Order->unbindModel(
                            array('belongsTo' => array('User', 'Booking', 'ClubBottle'))
                    );
                    $this->Order->updateAll(
                            array('Order.transactionid' => $result->transaction->id), array('Order.user_id ' => $user_id, 'Order.booking_id ' => $booking_id)
                    );
                } else if ($comments == 'booking') {

                    $this->Booking->read(null, $booking_id);
                    $this->Booking->set('status', 'braintreehold');
                    $this->Booking->save();
                }
                return( $result->transaction->id);
            } else {
                $info['Success'] = 'No';
            }
        }
        $info['booking_id'] = $booking_id;
        $function_name = $this->params->query['callback'];
        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    function checkautopurchase() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $club_id = $this->params->query['club_id'];
        $this->Club->unbindModel(array('belongsTo' => array('User')));
        $this->Club->unbindModel(array('hasMany' => array('Booking', 'ClubBottle', 'ClubOpenDay', 'ClubTable', 'Deal', 'ClubException', 'Deal', 'Event', 'Photo')));
        $this->Club->unbindModel(array('belongsTo' => array('ClubType')));
        $conditions = array('fields' => array('Club.approve_auto_purchase', 'Club.id'), 'conditions' => array('Club.approve_auto_purchase' => 'yes', 'Club.id' => $club_id));
        $this->User->recursive = -1;
        $info = $this->Club->find('all', $conditions);
        if (count($info) > 0) {
            $info['Success'] = 'yes';
        } else
            $info['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
    }

    /* paymentspliter is the start of payment process for split bill
     * 
     * 
     */

    function update_status($status_splitbill, $splited_user_id, $status_booking, $booking_id) { //$status_splitbill update split table and  $status_booking update booking table
        if ($status_splitbill == 'completed' || 'braintreehold') {
            $this->Booking->id = $booking_id;
            $this->loadModel("Split");
            $this->Split->primaryKey = 'splited_user_id';
            $this->Split->id = $splited_user_id;
            if ($this->Booking->saveField('status', $status_booking) && ($this->Split->saveField('status', $status_splitbill))) {

                $data['Success'] = 'yes';
            } else {
                $data['Success'] = 'no';
            }
        }
    }

    //$function_name, $user_id, $flag, $club['booking_id'], $comments,$club_id
    function paymentspliter($function_name, $user_id, $flag, $booking_id, $comments, $club_id) { //split_bill_payment_gateway.html
        $end_time = time();
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Booking');
        $booking = $this->Booking->findById($booking_id);
        $booking_amount = $booking['Booking']['booking_price'];

        $this->loadModel('Split');
        $this->Split->unbindSplitAll();
        $this->Split->recursive = -1;

        if ($flag == 'others') {
            $Split = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => trim($user_id), 'Split.booking_id' => trim($booking_id), 'Split.status' => 'pending')));
            $start_time = $Split['Split']['server_time'];
        } else {
            $Split = $this->Split->find('first', array('conditions' => array('Split.booking_id' => $booking_id, 'Split.user_id' => $user_id, 'Split.user_id=Split.splited_user_id')));
            $start_time = $Split['Split']['server_time'];
        }

        //self splitter.
        if ($this->hasbookingexpired(60, $start_time)) {

            $perecentage = $Split['Split']['splited_amount'];

            $amount = (($booking_amount * $perecentage) / (100 * 10)); //10% of booking price

            if (!$this->haspaidbill($user_id, $booking_id, 'pending')) {
                $informations = $this->braintreeprocesstransaction($function_name, $user_id, $amount, $booking_id, $club_id, 'spliter-self', $flag);



                $message['booking_id'] = $booking_id;
                if ($informations['status']) {
                    $message['Success'] = 'yes';
                    $message['tid'] = $informations['transation_id'];
                } else
                    $message['Success'] = 'no';
                // update status///

                if ($informations['status']) {//true
                    if ($flag == 'others') {// Not me for others 
                        //$Split = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => trim($user_id), 'Split.booking_id' => trim($booking_id), 'Split.status' => 'pending')));
                        $id = $Split['Split']['id']; //get the id;
                        $start_time = $Split['Split']['server_time'];

                        $amount = (($booking_amount * $perecentage) / (100 * 10)); //10% of booking price
                        $this->update_status('braintreehold', $user_id, 'taken', $booking_id);
                    } else { //ME
                        $id = $Split['Split']['id']; //get the id;
                        $start_time = $Split['Split']['server_time'];
                        $perecentage = $Split['Split']['splited_amount'];
                        $amount = (($booking_amount * $perecentage) / (100 * 10)); //10% of booking price
                    }
                }//$message['Success']
                //update status///

                echo "$function_name (\n";
                echo json_encode($message);
                echo ");\n";
                exit();
            } else {
                $message['error'] = 'You have already paid your bill for this transaction';
                $message['Success'] = 'no';
                echo "$function_name (\n";
                echo json_encode($message);
                echo ");\n";
                exit();
            }
        } else {
            $club['Success'] = 'no';
            $club['error'] = 'time expired';
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
            exit();
        }
    }

    function paymentspliterothers() { //split_bill_payment_gateway.html
        $end_time = time();
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $booking_id = $this->params->query['booking_id'];
        $flag = $this->params->query['flag'];
        $this->loadModel('Booking');
        $booking = $this->Booking->findById($booking_id);
        $booking_amount = $booking['Booking']['booking_price'];
        $club_id = $booking['Booking']['club_id'];
        $this->loadModel('Split');
        $this->Split->unbindSplitAll();
        $this->Split->recursive = -1;
        $comments = $this->params->query['comments'];
        if ($flag == 'others') {
            $Split = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => trim($user_id), 'Split.booking_id' => trim($booking_id), 'Split.status' => 'pending')));
            $start_time = $Split['Split']['server_time'];
        } else {
            $Split = $this->Split->find('first', array('conditions' => array('Split.booking_id' => $booking_id, 'Split.user_id' => $user_id, 'Split.user_id=Split.splited_user_id')));
            $start_time = $Split['Split']['server_time'];
        }

        //self splitter.
        if ($this->hasbookingexpired(60, $start_time)) {

            $perecentage = $Split['Split']['splited_amount'];

            $table_price = $booking_amount * 10;
            $table_price = $table_price + ($table_price / 2);
            $amount = $table_price * ($perecentage / 100);

            if (!$this->haspaidbill($user_id, $booking_id, 'pending')) {
                $informations = $this->braintreeprocesstransaction($function_name, $user_id, $amount, $booking_id, $club_id, 'payment split for others', 'others'); //$function_name, $user_id, $amount, $booking_id,$club_id


                if ($informations)
                    $message['Success'] = 'yes';
                else
                    $message['Success'] = 'no';
                // update status///

                if ($informations['status']) {//true
                    if ($flag == 'others') {// Not me for others 
                        //$Split = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => trim($user_id), 'Split.booking_id' => trim($booking_id), 'Split.status' => 'pending')));
                        $id = $Split['Split']['id']; //get the id;
                        $start_time = $Split['Split']['server_time'];
                        $amount = (($booking_amount * $perecentage) / (100 * 10)); //10% of booking price
                        $this->update_status('braintreehold', $user_id, 'taken', $booking_id);
                    } else { //ME
                        $id = $Split['Split']['id']; //get the id;
                        $start_time = $Split['Split']['server_time'];
                        $perecentage = $Split['Split']['splited_amount'];
                        $amount = (($booking_amount * $perecentage) / (100 * 10)); //10% of booking price
                    }
                }//$message['Success']
                //update status///

                echo "$function_name (\n";
                echo json_encode($message);
                echo ");\n";
                exit();
            } else {
                $message['error'] = 'You have already paid your bill for this transaction';
                $message['Success'] = 'no';
                echo "$function_name (\n";
                echo json_encode($message);
                echo ");\n";
                exit();
            }
        } else {
            $club['Success'] = 'no';
            $club['error'] = 'time expired';
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
            exit();
        }
    }

    //       function hasbookingexpired($min,$start_time)
    //        {
    //        $this->autoRender = false;
    //       $this->layout = 'ajax'; 
    //        $date1 = new DateTime(date('Y-m-d H:i:s A'));
    //        $date2 = new DateTime($start_time);
    //        if(($date2->diff($date1)->h)>0)
    //            return false;
    //        return true;
    //        }

    function hasbookingexpired($min, $start_time) {
        $this->autoRender = false;
        $this->layout = 'ajax';
        // echo date('Y-m-d H:i:s A').'<br>'.$start_time.'<br>'.date('Y-m-d H:i:s ');
        //echo '--'.$start_time.'--';
        //echo"<br>";
        date_default_timezone_set($this->default_time_zone);
        $current_time = strtotime(gmdate('Y-m-d h:i:s A'));
        //return true;
        $start_time = strtotime($start_time);
        //echo $current_time.'--'.$start_time;
        //echo '<br>';
        //$diff = strtotime($date) - strtotime($start_time)/60;
        $diff = round(($current_time - $start_time) / 3600);

        return true;
        //echo $diff;
        if (($diff) > 0)
            return false; //expired
        else
            return true;
    }

    //$function_name, $user_id, $amount, $comments, 'spliter-self', true,$club_id
    function braintreeprocesstransaction($function_name, $user_id, $amount, $booking_id, $club_id, $comments, $flag) {

        $amount = round($amount, 2); //brain tree reqirement 
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);


        $this->User->recursive = -1;
        $user = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_id),
            'fields' => array('User.token'))
        );
        $token = $user['User']['token'];


        $this->autoRender = false;
        $this->layout = 'ajax';
        $result = Braintree_Transaction::sale(array(
                    'paymentMethodToken' => $token,
                    'amount' => $amount,
                    'customFields' => array('comments' => $comments),
                    'options' => array(
                        'submitForSettlement' => false,
                    ),
        ));


        if ($result->success) {

            $info['Success'] = 'yes';
            $info['transation_id'] = $result->transaction->id;
            $this->loadModel('Split');
            if ($flag == 'ME') {
                $this->loadModel('Split');
                $split_id = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => $user_id, 'Split.booking_id' => $booking_id)));
                $this->Split->id = $split_id['Split']['id'];
                $this->Split->saveField('transaction_id', $result->transaction->id);
                $this->Split->saveField('status', 'braintreehold');
                $info['status'] = true;
                return $info;
            } else {

                $this->loadModel('Split');
                $split_id = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => $user_id, 'Split.booking_id' => $booking_id)));
                $this->Split->id = $split_id['Split']['id'];
                $this->Split->saveField('transaction_id', $result->transaction->id);
                $this->Split->saveField('status', 'braintreehold');
                $info['status'] = true;
                return $info;
            }
        } else {
            $function_name = $this->params->query['callback'];
            $info['Success'] = 'No';
            $info['error'] = $result->message;
            $info['status'] = false;
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
            exit();
        }
    }

    function haspaidbill($user_id, $booking_id, $status) {
        $this->loadModel('Split');
        $tid = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => $user_id, 'Split.booking_id' => $booking_id, 'Split.status' => $status)));



        if (isset($tid['Split']['transaction_id'])) {// it is in panding status
            if ($tid['Split']['transaction_id'] > 0)
                return true;
            else
                return false;
        }
        return false; //I have not paid the bill
    }

    function updatesplitbillstatus($user_id, $status) {


        $flag1 = false;
        $flag2 = false;
        $flag = false;
        $this->Split->primaryKey = 'splited_user_id';
        $this->Split->id = $user_id;
        //$this->Split->saveField('transaction_id', $transactionid);
        if ($this->Split->saveField('status', $status))
            return true;


        //        if(strlen($token)>0)
        //        {
        //        $data = array('id' => $user_id, 'token' => $token);
        //
    //        if ($this->User->save($data))
        //            $flag2 = true;
        //        if ($flag1) {
        //            if ($flag2)
        //                $flag = true;
        //        }
        //        
        //        
        //        }
        //        if ($flag) {
        //            $info['Success'] = 'yes';
        //            $info['transaction_id'] = $transactionid;
        //            return $info;
        //        } else {
        //            $info['Success'] = 'no';
        //            if ($flag1 == false && $flag2 == false) {
        //                $info['error'] = 'Failed to update status flag1 and flag2';
        //                echo "$function_name (\n";
        //                echo json_encode($info);
        //                echo ");\n";
        //                exit();
        //            } else {
        //                if (!$flag1) {
        //                    $info['error'] = 'Failed to update status flag1';
        //                    $info['Success'] = 'no';
        //                    echo "$function_name (\n";
        //                    echo json_encode($info);
        //                    echo ");\n";
        //                    exit();
        //                } else if (!$flag2) {
        //                    $info['error'] = 'Failed to update status flag2';
        //                    $info['Success'] = 'no';
        //                    echo "$function_name (\n";
        //                    echo json_encode($info);
        //                    echo ");\n";
        //                    exit();
        //                }
        //            }
        //     }
    }

    function checkuserpincode() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $pincode = $this->params->query['pincode'];
        $user_id = $this->params->query['user_id'];

        $this->User->recursive = -1;
        $information = $this->User->find('first', array(
            'fields' => array('User.id', 'User.pincode', 'User.email_address'), 'conditions' => array('User.id' => $user_id, 'User.pincode' => trim($pincode))
        ));

        if (isset($information['User']['id'])) {
            $club['Success'] = 'Yes';
        } else {
            $club['Success'] = 'No';
        }

        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function split_check() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $this->loadModel('Split');
        $this->Split->unbindSplitAll();
        $this->Split->recursive = -1;
        $split_counter = $this->Split->find('first', array('conditions' => array('Split.splited_user_id' => $user_id, 'Split.status' => 'pending',
                'Split.splited_user_id !=Split.user_id')));



        if (!empty($split_counter['Split']['id'])) {
            $club['Split'] = 'yes';
            $club['spliter_booking_id'] = $split_counter['Split']['booking_id'];
        } else
            $club['Split'] = 'no';
        $club['Success'] = 'Yes';
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function paymentbycreditcardtoken() {
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $pre_authorization_amount = 9999999999999;
        $order_id = $this->params->query['order_id'];
        $amount = $this->params->query['total_amount'];
        $comments = $this->params->query['comments'];
        $booking_id = $this->params->query['booking_id'];
        $split_my_bill = $this->params->query['split_my_bill'];
        $this->autoRender = false;
        $this->layout = 'ajax';
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $this->loadModel('Order');
        $this->Order->Behaviors->load('Containable');
        $condition_pending = array('Order.booking_id' => $booking_id, 'Order.status' => 'pending');
        $condition = array('Order.booking_id' => $booking_id, 'Order.status' => 'completed');
        $fields = array('Order.id', 'Order.booking_id');
        $this->Order->recursive = 1;
        $this->Order->contain('OrderItem');
        $value = $this->Order->find("all", array('conditions' => $condition, 'fields' => $fields));

        $t_price = 0;
        $has_order = false;

        foreach ($value as $val) {
            foreach ($val['OrderItem'] as $item) {
                $t_price = $t_price + $item['price'] * $item['quantity'];
                $has_order = true;
            }
        }
        $t_price = $t_price + $amount;
        $info = array();


        if ($t_price <= $pre_authorization_amount) {
            $info['Success'] = 'Yes';
            $this->Order->id = $order_id;
            $this->Order->set('status', 'completed');
            $this->Order->save();
            if (isset($this->params->query['split_my_bill']) && ($this->params->query['split_my_bill'] == 'true')) { //split_my_bill
                $this->loadModel('Split');
                $released_amount = $t_price - $amount;
                $this->Split->recursive = -1;
                $splited_tid = $this->Split->find("all", array('conditions' => array("Split.booking_id" => $booking_id)));

                foreach ($splited_tid as $n_tid) {
                    $splited_amount_percentacge = $n_tid['Split']['splited_amount'];
                    $result = Braintree_Transaction::submitForSettlement($n_tid['Split']['transaction_id'], "$released_amount*$splited_amount_percentacge");
                }
            } else {
                $this->loadModel('Booking');
                $this->Booking->id = $booking_id;
                $tid = $this->Booking->field('pre_auth_transaction_id');
                $released_amount = $t_price; 
                $released_amount=number_format((float) $released_amount, 2, '.', '');
               // $result = Braintree_Transaction::submitForSettlement($tid, $released_amount);
                $this->insert_pre_auth_transaction_id_released($booking_id, $tid);
                
                $info['msg']="Successfully Trasaction";
                
                
                
              
            }
            
            
        } else {
            //re-re preauthorization
            $token = $this->User->find("first", array('conditions' => array('User.id' =>$user_id)));
            $result_pre = Braintree_Transaction::sale(array(
                            'paymentMethodToken' => $token['User']['token'],
                            'amount' => $pre_authorization_amount,
                            'customFields' => array('comments' => "Preauthorization transaction"),
                            'options' => array(
                                'submitForSettlement' => true,
                            ),
                ));
            
            
            if($result_pre->success)
            {
            $info['Success'] = 'Re';
            $info['msg'] = 'Total amount is greater than item purchase price.Your limit is : ' . $pre_authorization_amount;
            $this->insert_pre_auth_transaction_id_released($booking_id,$result_pre->transaction->id);
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
            exit();    
            }
            else {
            $info['Success'] = 'No';
            $info['error'] = 'Re re-authorization failed    ';
            //delete order table and order item table.
            $this->Order->id = $order_id;
            $this->Order->delete();
            $this->loadModel('OrderItem');
            $this->OrderItem->deleteAll(array('OrderItem.order_id' => $order_id), false);
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
            exit();
            }

        }

        echo "$function_name (\n";
        echo json_encode($info);
        echo ");\n";
        exit();
    }

    function insert_pre_auth_transaction_id_released($booking_id, $tid) {
        $this->loadModel('Booking');
        $this->Booking->id = $booking_id;
        $info = $this->Booking->field('pre_auto_transaction_id_released');
        if (!empty($info)) {
            $json_array = json_decode($info, true);
            if(array_search($tid, $json_array)>=0)
            {
                return true;
            }
            $counter = count($json_array);
            $json_array[$counter] = $tid;
            $json_array = json_encode($json_array);
            if ($this->Booking->saveField('pre_auto_transaction_id_released', $json_array))
                return true;
        }
        else {
            $json_array[0] = $tid;
            $json_array = json_encode($json_array);
            if ($this->Booking->saveField('pre_auto_transaction_id_released', $json_array))
                return true;
        }
        return false;
    }

    /*
     * paymement using credit card storing in the volt and using credit card token id
     * this will be used later;
     */

    function splitbillpaymentbytoken() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $info['Token']['user_id'] = $this->params->query['user_id'];
        $info['Token']['booking_id'] = $this->params->query['booking_id'];
        $info['Token']['comments'] = $this->params->query['comments'];
        $info['Token']['type'] = $this->params->query['status'];
        $info['Token']['transaction_id'] = $this->params->query['transaction_id'];
        $info['Token']['token'] = $this->params->query['token'];
        $info['Token']['server_time'] = date('Y-m-d H:i:s A');
        $this->loadModel('Token');

        if ($this->Token->save($info)) {
            $output['Success'] = 'Yes';
            $output['tranasction_id'] = $info['Token']['transaction_id'];
        } else
            $output['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($output);
        echo ");\n";
    }

    //splitbillpaymentbytoken


    function findtranasctionid() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $booking_id = $this->params->query['booking_id'];
        $type = $this->params->query['type'];

        $this->loadModel('Token');
        $this->Token->recursive = -1;
        $options = array('fields' => array('Token.user_id', 'Token.booking_id', 'Token.type', 'Token.transaction_id'), 'conditions' => array('Token.user_id' => $user_id, 'Token.booking_id' => $booking_id, 'Token.type' => $type));
        $info = $this->Token->find("first", $options);
        if (count($info["Token"]) > 0) {
            $output['transaction_id'] = $info['Token']['transaction_id'];
            $output['Success'] = 'Yes';
        } else
            $output['Success'] = 'No';

        echo "$function_name (\n";
        echo json_encode($output);
        echo ");\n";
    }

    /*
     * input->(user_id and booking_id)  returns  transaction_id
     * 
     */

    function gettransactionid() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $booking_id = $this->params->query['booking_id'];
        $this->loadModel('Token');
        $this->Token->recursive = -1;
        $conditions = array('conditions' => array('Token.user_id' => $user_id, 'Token.booking_id' => $booking_id));
        $info = $this->Token->find('first', $conditions);
        if ($info) {
            $output['transaction_id'] = $info['Token']['transaction_id'];
            $output['Success'] = 'Yes';
        } else {
            $output['Success'] = 'No';
        }



        echo "$function_name (\n";
        echo json_encode($output);
        echo ");\n";
    }

    function checkin_exists_by_today($booking_arrival_date) {

        date_default_timezone_set($this->default_time_zone);
        $current = date("Y-m-d");

        if (trim(strtotime($current)) == trim(strtotime(($booking_arrival_date))))
            return true;
        return false;
    }

    function checkpaymentstatusofsplitter($user_id, $hour, $min, $app_current_date, $function_name) {//$user_id, $hour, $min,$app_current_date
        $output = array();

        $this->loadModel('Split');
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        //            $user_id=$this->params->query['user_id'];
        //            $hour=$this->params->query['hour'];
        //            $min=$this->params->query['min'];
        //           $app_current_date=$this->params->query['app_arrival_date'];
        $options = array(
            'conditions' => array('Split.user_id' => $user_id, 'Split.status' => 'braintreehold', 'Split.user_id !=' => 'Split.splited_user_id'),
            'order' => array('Split.id DESC')
        );
        $user = $this->Split->find('first', $options);


        $this->Booking->recursive = -1;


        if (isset($user['Split']['booking_id']) && ($user['Split']['booking_id'] > 0)) { //if1
            $booking = $this->Booking->findById($user['Split']['booking_id']);

            if ($this->checkin_exists_by_today($booking['Booking']['arrival_date'])) {

                if (($user_id == $user['Split']['user_id']) && ($this->haseverybodyacceptedrequest($user['Split']['booking_id']))) {
                    $output['Success'] = 'yes';
                    $output['reason'] = 'Every body has paid accepted the request';
                    $output['booking_id'] = $user['Split']['booking_id'];
                    $output['tranasaction_id'] = $this->braintreeprocesstansaction($user['Split']['booking_id'], $function_name, $user_id);
                    return $output;
                } else {
                    $output['Success'] = 'no';
                    $output['reason'] = 'Not all member has not accepted the request';
                    //             echo "$function_name (\n";
                    //             echo json_encode($output);
                    //             echo ");\n";  
                    return $output;
                }
            } else {
                $output['Success'] = 'no';
                $output['reason'] = 'Booking time expired';
                //             echo "$function_name (\n";
                //             echo json_encode($output);
                //             echo ");\n";  
                //pr($output);
                return $output;
            }
        }//if1 no booking id
        else {
            $output['Success'] = 'no';
            $output['reason'] = 'No Booking';
            //             echo "$function_name (\n";
            //             echo json_encode($output);
            //             echo ");\n";  

            return $output;
        }
    }

    function check_time($arrival_time, $hour, $min) {
        $arrival_time = $this->bookingtimeformat($arrival_time);
        $min = $min / 60; //converted min to hours.
        $hour = $min + $hour;
        $time = false;
        if ($hour >= $arrival_time)
            $time = true;
        else
            $time = false;
        return $time;
    }

    function isbookintimegexists($arrival_time, $hour, $min, $booking_arrival_date, $app_current_date) { //javascript $hour $min $arrival_time=>booking table //2014-05-21
        if ($booking_arrival_date == $app_current_date) {
            if ($this->check_time($arrival_time, $hour, $min)) //check time since date are equal
                return true;
            return false;
        }
        else if ($booking_arrival_date <> $app_current_date) {
            $booking_arrival_date_array = explode('-', $booking_arrival_date);
            $app_arrival_date_array = explode('-', $app_current_date);
            if ($this->compare_date($booking_arrival_date_array, $app_arrival_date_array)) {
                if ($this->check_time($arrival_time, $hour, $min))
                    return true;
                else
                    return false;
            } else
                return false;
        }
    }

    function compare_date($booking_arrival_date, $app_current_date) {

        if ($app_current_date[0] > $booking_arrival_date[0])
            return false;
        if ($app_current_date[1] > $booking_arrival_date[1])
            return false;
        if ($app_current_date[2] > $booking_arrival_date[2])
            return false;
        return true;
    }

    function bookingtimeformat($arrival_time) {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $timeformat = '';
        $arrival_time = explode(' ', $arrival_time);
        $time = explode('.', $arrival_time[0]);
        if ($arrival_time[1] == 'PM') {
            $timeformat = $time[0] + 12;
            $timeformat+=($time[1] / 60);
        } else {
            $timeformat = $time[0];
            $timeformat+=($time[1] / 60);
        }
        return $timeformat;
    }

    function haseverybodyacceptedrequest($booking_id) {
        $this->loadModel('Split');
        //some user has not accepted yet it is in pendig state
        $options = array('conditions' => array('Split.booking_id' => $booking_id, 'Split.status' => 'cancelled'));
        $count = $this->Split->find('count', $options);
        if ($count > 0) {
            return false;
        } else {

            $options = array('conditions' => array('Split.booking_id' => $booking_id, 'Split.status' => 'pending', 'Split.splited_user_id !=' => 'Split.user_id'));
            $count = $this->Split->find('count', $options);


            if ($count > 0) //not every body has accepted.
                return false;
            return true;
        }
    }

    function waitrerss_table() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $function_name = $this->params->query['callback'];
        $club_id = $this->params->query['club_id'];
        $date = $this->params->query['date'];
        $this->Booking->unbindModel(
                array('belongsTo' => array('Club'))
        );
        $this->Booking->unbindModel(
                array('hasMany' => array('Order', 'Split'))
        );
        $conditions = array(
            'Booking.arrival_date ' => $date,
            'Booking.status' => 'check_in'
        );

        $order = array('Booking.booking_time ASC');

        $fields = array('Booking.*,User.id,User.first_name,User.last_name,ClubTable.*');

        $listing = $this->Booking->find('all', array(
            'conditions' => $conditions, 'order' => $order, 'fields' => $fields
                )
        );


        if ($listing) {
            $club['Success'] = 'Yes';
            $club["listing"] = $listing;
        } else {
            $club['Success'] = 'No';
        }

        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function fetch_booking_name() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $function_name = $this->params->query['callback'];
        $booking_id = $this->params->query['booking_id'];
        $this->Booking->unbindModel(
                array('belongsTo' => array('Club'))
        );
        $this->Booking->unbindModel(
                array('hasMany' => array('Order', 'Split'))
        );
        $conditions = array(
            'Booking.id' => $booking_id,
            'Booking.status' => 'check_in'
        );
        $fields = array('Booking.id,User.id,User.first_name,User.last_name,ClubTable.table_name');
        $listing = $this->Booking->find('all', array(
            'conditions' => $conditions, 'fields' => $fields
                )
        );
        //pr( $listing);
        if ($listing) {
            $club['Success'] = 'Yes';
            $club["listing"] = $listing[0];
        } else {
            $club['Success'] = 'No';
        }

        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
    }

    function promotorcodecomission($promoter_user_id) {
        $this->loadModel('reference');
        $counter = 0;
        $options = array('conditions' => array('reference.promoter_id' => $promoter_user_id, 'reference.status' => 'on'));
        $this->reference->recursive = -1;
        $counter = $this->reference->find('count', $options);
        if ($counter > 0) {
            $this->loadModel('Booking');
            $current_date = date('Y-m-d h:m:s');
            $options = array('conditions' => array('Booking.user_id' => $promoter_user_id, "Booking.booking_time <=" => $current_date, 'Booking.status' => 'check_in'));
            $booking_exists = $this->Booking->find('count', $options); //check booking exits before the current date, no future date.

            if ($booking_exists <= 0) { //no booking exists
                return true;
            } else
                return false;;
        }
    }

    function waintresspayment() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $function_name = $this->params->query['callback'];
        $info = $this->params->query['info'];
        $amount = $this->params->query['amount'];
        parse_str($info, $output);
        $date = explode('-', $output['date']);


        $result = Braintree_Transaction::sale(array(
                    'amount' => $amount,
                    'creditCard' => array(
                        'number' => $output['number'],
                        'expirationMonth' => $date[1],
                        'expirationYear' => $date[0],
                    )
        ));
        $info = array();

        if ($result->success) {
            $info['success'] = 'yes';
            $this->loadModel('Order');
            $order_id = $this->params->query['Order_id'];
            //        $this->order->id=$order_id;
            //        $this->order->save('transactionid',$result->transaction->id);

            $this->Order->read(null, $order_id);
            $this->Order->set(array(
                'transactionid' => $result->transaction->id));
            $this->Order->save();
            $info['tid'] = $result->transaction->id;
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
        } else {
            $info['success'] = 'no';
            $info['error'] = $result->message;
            echo "$function_name (\n";
            echo json_encode($info);
            echo ");\n";
        }
    }

    function usermultiplecard() {
        date_default_timezone_set($this->default_time_zone);
        $this->autoRender = false;
        $this->layout = 'ajax';
        $function_name = $this->params->query['callback'];
        $creditCard['credit_card'] = $this->params->query['credit_card'];
        $type=$this->params->query['card_type'];
        $creditCard['cciv'] = $this->params->query['cciv'];
        $date = date('Y-m-d H:m:s');
        $creditCard['expire_date'] = date('Y-m-d', strtotime($this->params->query['expire_date']));
        $user_id = $this->params->query['user_id'];
        $card = substr($creditCard['credit_card'], strlen($creditCard['credit_card']) - 4);
        $token = $this->create_token($user_id, $creditCard);
        if (strlen($token) > 0) {
            $this->loadModel('Card');
            $sql = 'INSERT INTO cards(id,user_id,card,token,date,type,status)' .
                    'VALUES(NULL,'
                    . '"' . $user_id . '",'
                    . '"' . $card . '",'
                    . '"' . $token . '",'
                    . '"' . $date . '",'
                    . '"' . $type . '",'
                    . "'off'" . ')';

            $this->Card->query($sql);


            //      var_dump($log);
            $club['token'] = $token;
            $club['Success'] = 'Yes';
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
            exit();
        } else {

            $club['Success'] = 'no';
            echo "$function_name (\n";
            echo json_encode($club);
            echo ");\n";
            exit();
        }
    }

    function create_token($user_id, $creditCard) {

        $this->layout = 'ajax';
        $this->autoRender = false;
        Braintree_Configuration::environment($this->environmemt);
        Braintree_Configuration::merchantId($this->marchentid);
        Braintree_Configuration::publicKey($this->publickey);
        Braintree_Configuration::privateKey($this->privatekey);
        $this->User->recursive = -1;
        $info = $this->User->findById($user_id);


        $exp = explode('-', $creditCard['expire_date']);
        $exp = $exp[1] . '/' . $exp[0];

        $result = Braintree_Customer::create(array(
                    'firstName' => $info['User']['first_name'],
                    'id' => 'reserved_' . $user_id
        ));

        $credit = $creditCard['credit_card'];
        $res = Braintree_CreditCard::create(array(
                    'customerId' => 'reserved_' . $user_id,
                    'number' => $creditCard['credit_card'],
                    'expirationDate' => $exp,
        ));


        if ($res->success) {
            $token = $res->creditCard->token;

            return $token;
        } else
            return false;
    }

    function changebookingsatus() {

        $this->layout = 'ajax';
        $this->autoRender = false;
        $function_name = $this->params->query['callback'];
        $booking_id = $this->params->query['booking_id'];
        $this->loadModel('Booking');
        $this->Booking->id = $booking_id;
        $this->Booking->set('status', 'club_closed');
        if ($this->Booking->save())
            $club['status'] = true;
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
        exit();
    }

    function listcreditcard() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $function_name = $this->params->query['callback'];
        $user_id = $this->params->query['user_id'];
        $this->loadModel('Card');
        $this->Card->recursive = -1;
        $Card["list"] = $this->Card->find("all", array('conditions' => array('Card.user_id' => $user_id)));
        $Card["Success"] = "Yes";
        echo "$function_name (\n";
        echo json_encode($Card);
        echo ");\n";
        exit();
    }

    function creditcardchange() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $id = $this->params->query['id'];
        $user_id = $this->params->query['user_id'];
        $this->loadModel('Card');
        $this->Card->recursive = -1;
        $array = $this->Card->find('all', array('conditions' =>
            array('Card.user_id' => $user_id, 'Card.status' => 'on'),
            'fields' => array('Card.id'))
        );

        foreach ($array as $item) {
            if ($id != $item['Card']['id']) {
                $this->Card->id = $item['Card']['id'];
                $this->Card->set('status', 'off');
                $this->Card->save();
            }
        }
        $function_name = $this->params->query['callback'];



        // $data = array('id' => $id, 'status' =>"on");
        $this->Card->id = $id;
        $this->Card->set('status', 'on');
        $this->Card->save();

        $token = $this->Card->field('token');
        $this->loadModel('User');
        $this->User->id = $user_id;
        $this->User->set('token', $token);
        $this->User->save();



        $Card["Success"] = "Yes";
        echo "$function_name (\n";
        echo json_encode($Card);
        echo ");\n";
        exit();
    }
    
     function credticarddelete()
    {
      $this->layout = 'ajax';
      $this->autoRender = false;  
      $card_id=$this->params->query['card_id'];
      if((!empty($card_id)))
      {
      $this->Card->id=$card_id;
      if($this->Card->delete())
      {
          $club['Success'] = 'Yes';
           
      
      }
 else {
        $club['Success'] = 'No';
              
      }
        $function_name = $this->params->query['callback'];
        
        echo "$function_name (\n";
        echo json_encode($club);
        echo ");\n";
      }
    }

}

?>