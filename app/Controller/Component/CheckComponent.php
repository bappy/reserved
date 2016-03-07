<?php
App::uses('Component', 'Controller');

class CheckComponent extends Component {
	var $uses = array("UserRole","Club","User");
	public function checkACl($id,$userRoles) {
	
	$id=$id['id'];
	
	
	if(count($userRoles)>0)
 	{
 	return true;
    }
	else if($id)
	{
	return false;
	}
}

}
