<?php
require_once('db.php');
$db = new DB();
class CartDetails{
    private $table_name;
    public $productId;
    public $userId;
	public $name;
	public $total;
	public $totalDiscount;
    public $totalWithDiscount;
    public $totalTax;
    public $totalWithTax;
    public $grandTotal;
	
		
	function addCart($name,$total,$totalDiscount,$totalWithDiscount,$totalTax,$totalWithTax,$grandTotal,$productId,$userId){
		global $db;
        $table_name = "carts";	
		$cartField  = array(
            "user_id"               => $userId,
            "product_id"            => $productId,
			"name"			        => $name,
			"total"	                => $total,
			"total_discount"	    => $totalDiscount,
            "total_with_discount"	=> $totalWithDiscount,
            "total_tax"	            => $totalTax,
            "total_with_tax"	    => $totalWithTax,
            "grand_total"	        => $grandTotal,
			"created_date"	        => date('Y-m-d H:i:s')
		);

		$cartId = $db->insert_get_id($cartField,$table_name);
		if($cartId!=''){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'SuccessfullyCart Add';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
        }
		echo json_encode($output);
		exit();
	}
		
	function updateCart($name,$total,$totalDiscount,$totalWithDiscount,$totalTax,$totalWithTax,$grandTotal,$productId,$cartUpdateId,$userId){
        global $db;
        $table_name = "carts";
		$cartField  = array(
            //"product_id"            => $productId,
			"name"			        => $name,
			"total"	                => $total,
			"total_discount"	    => $totalDiscount,
            "total_with_discount"	=> $totalWithDiscount,
            "total_tax"	            => $totalTax,
            "total_with_tax"	    => $totalWithTax,
            "grand_total"	        => $grandTotal,
			"created_date"	        => date('Y-m-d H:i:s')
		);
        $count  = $db->update($cartField,"id=".$cartUpdateId,$table_name);
		if($count>0){
			
			$output['iserr'] 			= 1;
			$output['message'] 			= 'SuccessfullyCart Update';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
		
	function deleteCart($cartDeleteId){
		global $db;
        $table_name = "carts";
        $count      = $db->query("delete *  $table_name where id='".$cartDeleteId."' ");        
		if($count>0){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'SuccessfullyCart Update';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
		}
    function readCart($cartReadId){
        global $db;
        $table_name   = "carts";
		$cartListAll  = array();
		$count        = $db->query("select * from $table_name where id='".$cartReadId."' order by asc name");
		while($cartList=$db->getrec()){
			$cartListAll=$CartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
	function listCarts(){
        global $db;
        $table_name     = "carts";
		$cartListAll    = array();
		$count          = $db->query("select * from $table_name where 1 order by name asc");
		while($cartList=$db->getrec()){
			$cartListAll[]=$cartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
    function showCarts($cartUserId){
        global $db;
        $table_name     = "carts";
		$cartListAll    = array();
		$count          = $db->query("select cart.*,product.name from  $cartTable as cart,$productTable product where cart.user_id='".$cartUserId."' and cart.produce_id = product.id order by name asc");
		while($cartList=$db->getrec()){
			$cartListAll[]=$cartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
    function getCartTotal($cartUserId){
        global $db;
        $cartTable      = "carts";
        $productTable   = "products";
		$cartListAll    = array();
		$count          = $db->query("select id,user_id,total from  $cartTable as cart,$productTable product where cart.user_id='".$cartUserId."' and cart.produce_id = product.id order by name asc");
		while($cartList=$db->getrec()){
			$cartListAll[]=$cartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
    function getCartTotalDiscount($cartUserId){
        global $db;
        $table_name     = "carts";
		$cartListAll    = array();
		$count          = $db->query("select id,user_id,total_discount,total_with_discount from $table_name where user_id='".$cartUserId."' order by name asc");
		while($cartList=$db->getrec()){
			$cartListAll[]=$cartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
    function getCartTotalTax($cartUserId){
        global $db;
        $table_name     = "carts";
		$cartListAll    = array();
		$count          = $db->query("select id,user_id,total_tax,total_with_tax from $table_name where user_id='".$cartUserId."' order by name asc");
		while($cartList=$db->getrec()){
			$cartListAll[]=$cartList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['cart_list'] 	    = $cartListAll;
			$output['message'] 			= 'SuccessfullyCart List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
    function addUser($username,$firstName,$lastName,$dob,$mobile){
		global $db;
        $table_name = "users";	
		$userField  = array(
            "username"              => $username,
            "first_name"            => $firstName,
			"last_name"			    => $lastName,
			"dob"	                => $dob,
			"mobile_no"	            => $mobile,
            "role_id"               => 2,
			"created_date"	        => date('Y-m-d H:i:s')
		);

		$userId = $db->insert_get_id($userField,$table_name);
		if($userId!=''){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'SuccessfullyCart Add';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
        }
		echo json_encode($output);
		exit();
	}
}
$cart	= new CartDetails();
?>
