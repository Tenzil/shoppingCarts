<?php
require_once('db.php');
$db = new DB();
class ProductDetails{
    private $table_name;
	public $name;
	public $description;
	public $price;
    public $discount;
		
	function addProduct($name,$description,$price,$discount,$categoryId){
		global $db;
        $table_name = "categories";	
		$productField=array(
            "category_id"   => $categoryId,
			"name"			=> $name,
			"description"	=> $description,
			"price"			=> $price,
            "discount"		=> $discount,
			"created_date"	=> date('Y-m-d H:i:s')
		);

		$productId=$db->insert_get_id($productField,$table_name);
		if($productId!=''){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Product Add';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
        }
		echo json_encode($output);
		exit();
	}
		
	function updateProduct($name,$description,$price,$discount,$categoryId,$productUpdateId){
		global $db;
        $table_name = "products";
		$productField=array(
			"name"			=> $name,
			"description"	=> $description,
			"price"			=> $price,
            "discount"		=> $discount,
		);
        $count=$db->update($productField,"id=".$productUpdateId,$table_name);
		if($count>0){
			
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Product Update';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
		
	function deleteProduct($productDeleteId){
		global $db;
        $table_name = "products";
        $count      = $db->query("delete * $table_name where id='".$productDeleteId."' ");      
		if($count>0){
			$output['iserr'] 			= 1;
			$output['message'] 			= 'Successfully Product Update';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
		}
    function readProduct($productReadId){
        global $db;
        $table_name = "products";
		$productListAll  = array();
		$count=$db->query("select * from $table_name where id='".$productReadId."' order by name asc");
		while($productList=$db->getrec()){
			$productListAll=$productList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['product_list'] 	= $productListAll;
			$output['message'] 			= 'Successfully Product List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
	function listProducts(){
        global $db;
        $table_name = "products";
		$productListAll  = array();
		$count=$db->query("select * from $table_name where 1 order by name asc");
		while($productList=$db->getrec()){
			$productListAll[]=$productList;
		}
		if($count>0){
			$output['iserr'] 			= 1;
			$output['product_list'] 	= $productListAll;
			$output['message'] 			= 'Successfully Product List';
		}else{
			$output['iserr'] 			= 0;
			$output['message'] 			= 'Invalid Entry';
		}
		echo json_encode($output);
		exit();
	}
}
$product	= new ProductDetails();
?>
