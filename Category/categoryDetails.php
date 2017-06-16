<?php
$incpath = dirname(__FILE__).'/';
require_once('db.php');
//$db=new DB();
class CategoryDetails{
    public $table_name ;
	public $name;
	public $description;
	public $tax;
		 
	function addCategory($name,$description,$tax){
		global $db;
        $table_name    = "categories";
        $categoryField = array(
			"name"			=> $name,
			"description"	=> $description,
			"tax"			=> $tax,
			"created_date"	=> date('Y-m-d H:i:s')
		);
        $categoryId=$db->insert_get_id($categoryField,$table_name);
		if($categoryId!=''){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Category Add';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
		
	function updateCategory($name,$description,$tax,$categoryUpdateId){
		global $db;
        $table_name     = "categories";
		$categoryField  = array(
			"name"			=> $name,
			"description"	=> $description,
			"tax"			=> $tax,
		);
        $count  =   $db->update($categoryField,"id=".$categoryUpdateId,$table_name);
		if($count>0){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Category Update';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
		
	function deleteCategory($categoryDeleteId){
		global $db;
		$table_name = "categories";
        $count      = $db->query("delete  from $table_name where id='".$categoryDeleteId."' limit 1 ");
        if($count>0){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Category Delete';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
        
    function readCategory($categoryReadId){
        global $db;
        $table_name         = "categories";
        $categoryListAll    = array();
		$count              = $db->query("select * from $table_name where id='".$categoryReadId."' order by  name asc");
		while($categoryList = $db->getrec()){
			$categoryListAll    = $categoryList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['category_list'] 	= $categoryListAll;
			$output['message'] 			= 'Successfully Category Read';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
        
	function listCategories(){
        global $db;
        $table_name         = "categories";
        $categoryListAll    = array();
		$count              = $db->query("select * from $table_name where 1 order by  name asc");
		while($categoryList = $db->getrec()){
			$categoryListAll[]  =   $categoryList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['category_list'] 	= $categoryListAll;
			$output['message'] 			= 'Successfully Category List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
		}
}
$category	= new CategoryDetails();
?>
