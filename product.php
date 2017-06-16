<?php
$incpath = dirname(__FILE__).'/Product/';
require_once($incpath.'productDetails.php');
$productType=$_GET['type'];
$product	= new ProductDetails();
$authenticate	= new Authentication();
global $product;
global $authenticate;
$userRole       = $authenticate->authenticate($_GET['username']);
if($userRole==1){
switch($productType)
	{
		case "addProduct":
			$product->addProduct($_GET['name'],$_GET['description'],$_GET['price'],$_GET['discount'],$_GET['category_id']);
		break;
		case "updateProduct":
			$product->updateProduct($_GET['name'],$_GET['description'],$_GET['price'],$_GET['discount'],$_GET['category_id']$_GET['productUpdateId']);
		break;
		case "deleteProduct":
			$product->deleteProduct($_GET['productDeleteId']);
		break;
        case "readProducts":
			$product->readProduct($_GET['productReadId']);
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
