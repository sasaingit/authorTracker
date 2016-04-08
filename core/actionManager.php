<?php
class actionManager{
	
	public $manager = null;
	public $appFb = null;
	
	public function handleAction($user,$method,$params,$manager,$appFb){
		$this->manager 	= $manager;
		$this->appFb 	= $appFb;
				
		if(empty($method)){
			return new actionResponse(0, null);
		}else if(!method_exists($this,$method)){
			return new actionResponse(0, null);
		}else{
			return $this->$method($user,$params);
		}
	}
	
	private function getUser($user,$params){
		$fb_id 			= $params['fb_id'];
		$ret 			= new actionResponse(0, null);
		//check for invalid at
		if(empty($fb_id)){
			return $ret;
		}
		
		$ret->data 					= $this->manager->getUserByFbId($fb_id);
		if(!empty($ret->data)){
			$ret->status = '1';
				
			//write user to the session
			session_start();
			$json_encoded_user 					= json_encode($ret->data);
			$_SESSION[__APP_ID__.'_user'] 		= $json_encoded_user;
			session_write_close ();
		}else{
			$ret->status = '0';
		}
		return 	$ret;
	}
	
	
	private function createUser($user,$params){
		$init_user 		= new stdClass();
		$fb_id 			= $params['fb_id'];
		$access_token 	= $params['access_token'];
		$ret 			= new actionResponse(0, null);
				
		$me 			= $this->appFb->getMe($access_token);
		$access_token 	= $this->appFb->getExtendedAt($access_token);
		
		//check for invalid at
		if(empty($me['id']) || ($me['id']!=$fb_id)){
			$ret->status = '0';
			return $ret;
		}
		
		$init_user->fb_id 			= $fb_id;
		$init_user->access_token 	= $access_token;
		$init_user->email 			= isset($me['email']) ? $me['email'] : null;
		$init_user->name 			= isset($me['name']) ? $me['name'] : null;
		
		$ret->data 					= $this->manager->setupUser($init_user);
		if(!empty($ret->data)){
			$ret->status = '1';
			
			//write user to the session
			session_start();
			$json_encoded_user 					= json_encode($ret->data);
			$_SESSION[__APP_ID__.'_user'] 		= $json_encoded_user;
			session_write_close ();
		}else{
			$ret->status = '0';
		}
		return 	$ret;
	}
		
	private function registerUser($user,$params){
		$user_attrs = $user->getAttributeNames();
		$ret 			= new actionResponse(0, null);
		error_log("params:".print_r($params,true));
		foreach($params as $key=>$val){
			if(in_array($key, $user_attrs) && !empty($val)){
				$user->$key = $val;
			}
		}
		error_log("user for reg:".print_r($user,true));
		$ok = $user->save();
		if($ok){
			$ret->status = '1';
			$ret->data = $user;
		}else{
			$ret->status = '0';
			$ret->data = null;
		}
		return $ret;
	}
	
	
	
}



?>