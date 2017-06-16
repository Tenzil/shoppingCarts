<?PHP
// -- SITE SETTINGS --
ini_set('memory_limit', '-1');
ini_set("display_errors", 2);


define("ADMIN","Administratie Panel");

// -- DATABASE SETTINGS --
define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD",'');
define("DB_DATABASE","shopping_cart");

define('PERPAGE',9);
define( "SEO" ,0);
define("FILE_PATH",dirname(__FILE__)."/");

// -- TABLES --
define("TABLE_PREFIX","");
define("TBL_PREFIX","");


date_default_timezone_set("Asia/Kolkata"); 

?>