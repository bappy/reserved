<?php
App::uses('AppController', 'Controller');
/**
 * UserRoles Controller
 *
 * @property UserRole $UserRole
 * @property PaginatorComponent $Paginator
 */
class ErrorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
	   $this->layout="reserved";
	   $info = $this->Auth->user();
        $id = $info['id'];
	    $club_name=parent::UGetClubName(parent::UGetClubId($id));
	    $this->set("club_name",$club_name);
	}


}
