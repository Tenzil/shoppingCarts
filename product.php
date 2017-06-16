<?php
$incpath = dirname(__FILE__).'/Product/';
require_once($incpath.'productDetails.php');
require_once('authentication.php');
$productType=$_POST['type'];
$product	= new ProductDetails();
$authenticate	= new Authentication();
global $product;
global $authenticate;
$userRole       = $authenticate->authenticate($_POST['username']);
if($userRole==1){
switch($productType)
	{
		case "addProduct":
			$product->addProduct($_POST['name'],$_POST['description'],$_POST['price'],$_POST['discount'],$_POST['category_id']);
		break;
		case "updateProduct":
			$product->updateProduct($_POST['name'],$_POST['description'],$_POST['price'],$_POST['discount'],$_POST['category_id'],$_POST['productUpdateId']);
		break;
		case "deleteProduct":
			$product->deleteProduct($_POST['productDeleteId']);
		break;
        case "readProduct":
			$product->readProduct($_POST['productReadId']);
		break;
		case "listProducts":
			$product->listProducts();
		break;
	}
}else{
    $output['iserr'] 			= 0;
	$output['message'] 			= 'Invalid User';
	echo json_encode($output);
		
}


?>
