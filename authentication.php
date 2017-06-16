<?php
require_once('db.php');
$db = new DB();
class Authentication{
    public $username ;
	function authenticate($username){
		global $db;
        $table_name    = "users";
        
        $db->query("select id,username,role_id from $table_name where username='".$username."'  ");
		$userDetails = $db->getrec();
        $userId      = $userDetails['id'];
        $roleId      = $userDetails['role_id'];
		return $roleId;
	}
		
}
$authenticate = new Authentication();
?>
