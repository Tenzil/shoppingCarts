<?php
$incpath = dirname(__FILE__).'/Cart/';
require_once($incpath.'cartDetails.php');
$cartType=$_GET['type'];
$cart	= new CartDetails();
$authenticate	= new Authentication();
global $cart;
global $authenticate;
$userRole       = $authenticate->authenticate($_GET['username']);
if($userRole==1||$userRole==2){
switch($cartType)
	{
		case "addCart":
			$cart->addCart($_GET['name'],$_GET['description'],$_GET['price'],$_GET['discount'],$_GET['category_id']);
		break;
		case "updateCart":
			$cart->updateCart($_GET['name'],$_GET['description'],$_GET['price'],$_GET['discount'],$_GET['category_id']$_GET['cartUpdateId']);
		break;
		case "deleteCart":
			$cart->deleteCart($_GET['cartDeleteId']);
		break;
        case "readCart":
			$cart->readCart($_GET['cartReadId']);
		break;
		case "listCarts":
			$cart->listCarts();
		break;
        case "showCarts":
			$cart->showCarts($_GET['user_id']);
		break;
        case "getCartTotal":
			$cart->getCartTotal($_GET['user_id']);
		break;
        case "getCartTotalDiscount":
			$cart->getCartTotalDiscount($_GET['user_id']);
		break;
        case "getCartTotalTax":
			$cart->getCartTotalTax($_GET['user_id']);
		break;
        case "addUser":
			$cart->addUser($_GET['username'],$_GET['first_name'],$_GET['last_name'],$_GET['dob'],$_GET['mobile']);
		break;
	}
}else{
    $output['iserr'] 			= 0;
	$output['message'] 			= 'Invalid User';
	echo json_encode($output);
		
}


?>
