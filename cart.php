<?php
$incpath = dirname(__FILE__).'/Cart/';
require_once($incpath.'cartDetails.php');
require_once('authentication.php');
$cartType=$_POST['type'];
$cart	= new CartDetails();
$authenticate	= new Authentication();
global $cart;
global $authenticate;
$userRole       = $authenticate->authenticate($_POST['username']);
if(($userRole==1)||($userRole==2)){
switch($cartType)
	{
		case "addCart":
			$cart->addCart($_POST['name'],$_POST['total'],$_POST['total_discount'],$_POST['total_with_discount'],$_POST['total_tax'],$_POST['total_with_tax'],$_POST['grand_total'],$_POST['product_id'],$_POST['user_id']);
		break;
		case "updateCart":
			$cart->updateCart($_POST['name'],$_POST['total'],$_POST['total_discount'],$_POST['total_with_discount'],$_POST['total_tax'],$_POST['total_with_tax'],$_POST['grand_total'],$_POST['cartUpdateId']);
		break;
		case "deleteCart":
			$cart->deleteCart($_POST['cartDeleteId']);
		break;
        case "readCart":
			$cart->readCart($_POST['cartReadId']);
		break;
		case "listCarts":
			$cart->listCarts();
		break;
        case "showCarts":
			$cart->showCarts($_POST['user_id']);
		break;
        case "getCartTotal":
			$cart->getCartTotal($_POST['user_id']);
		break;
        case "getCartTotalDiscount":
			$cart->getCartTotalDiscount($_POST['user_id']);
		break;
        case "getCartTotalTax":
			$cart->getCartTotalTax($_POST['user_id']);
		break;
        case "addUser":
			$cart->addUser($_POST['username_add'],$_POST['first_name'],$_POST['last_name'],$_POST['dob'],$_POST['mobile']);
		break;
	}
}else{
    $output['iserr'] 			= 0;
	$output['message'] 			= 'Invalid User';
	echo json_encode($output);
		
}


?>
