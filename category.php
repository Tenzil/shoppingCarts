<?php
$incpath = dirname(__FILE__).'/Category/';
//require_once('db.php');
require_once($incpath.'categoryDetails.php');
require_once('authentication.php');
$categoryType   = $_GET['type'];
$category	    = new CategoryDetails();
$authenticate	= new Authentication();
global $category;
global $authenticate;
$userRole       = $authenticate->authenticate($_GET['username']);
if($userRole==1){
switch($categoryType)
			{
				case "addCategory":
                    $category->addCategory($_GET['name'],$_GET['description'],$_GET['tax']);
				break;
				case "updateCategory":
					 $category->updateCategory($_GET['name'],$_GET['description'],$_GET['tax'],$_GET['categoryUpdateId']);
				break;
				case "deleteCategory":
					 $category->deleteCategory($_GET['categoryDeleteId']);
				break;
                case "readCategory":
					 $category->readCategory($_GET['categoryReadId']);
				break;
				case "listCategories":
					 $category->listCategories();
				break;
			}
            
}else{
    $output['iserr'] 			= 0;
	$output['message'] 			= 'Invalid User';
	echo json_encode($output);
		
}


?>
