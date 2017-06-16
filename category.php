<?php
$incpath = dirname(__FILE__).'/Category/';
//require_once('db.php');
require_once($incpath.'categoryDetails.php');
require_once('authentication.php');
$categoryType   = $_POST['type'];
$category	    = new CategoryDetails();
$authenticate	= new Authentication();
global $category;
global $authenticate;
$userRole       = $authenticate->authenticate($_POST['username']);
if($userRole==1){
switch($categoryType)
			{
				case "addCategory":
                    $category->addCategory($_POST['name'],$_POST['description'],$_POST['tax']);
				break;
				case "updateCategory":
					 $category->updateCategory($_POST['name'],$_POST['description'],$_POST['tax'],$_POST['categoryUpdateId']);
				break;
				case "deleteCategory":
					 $category->deleteCategory($_POST['categoryDeleteId']);
				break;
                case "readCategory":
					 $category->readCategory($_POST['categoryReadId']);
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
