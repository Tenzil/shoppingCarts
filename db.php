<?PHP
date_default_timezone_set("Asia/Kolkata"); 
require_once("config.php");

function print_sql($sql)

{
	echo "<div style=\"border:1px solid black;background:#FFFFDD;";
	echo "font:small 'Courier new',monospace;padding:5px;\">";
	echo "<b>SQL STATEMENT:</b><br/>$sql</div>";

}
function print_result($rcount,$qtm)
{
	echo "<div style=\"border:1px solid black;border-top:0;background:#EEFFFF;";
	echo "font:small 'Courier new',monospace;padding:4px;margin-bottom:10px;\">";
	echo "<b>RESULT:</b><br/>".mysql_info()."<br/>";
	echo "<span style=\"color:blue\">$rcount</span> records affected</br>";
	echo "Query runtime: <span style=\"color:blue\">$qtm</span> seconds.</div>"; 
}

class DB

{

	function DB($db=DB_DATABASE,$username=DB_USERNAME,$password=DB_PASSWORD,$host=DB_HOST)
	{

		$this->conn = mysql_connect($host,$username,$password,false,2) or
		die("<h3 align=\"center\" style=\"color:red\"> Please try again after 2 min. </h3>".mysql_error($this->conn));//Unable to Connect to MySQL Server
		$this->query('SET NAMES utf8'); 
		@mysql_select_db($db,$this->conn) or 
		die("<h3 align=\"center\" style=\"color:red\">Please try again after some time.</h3>");//Unable to find the database
		$this->rs = null;
		$this->recordcount = null;
		$this->totrecs=null;
		$this->lastquery = "";
		$this->debug_mode =false;
		mysql_query('SET names=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_results=utf8');
		mysql_query('SET collation_connection=utf8_general_ci');
	}
	 
function query($SQL)
	{		
		if(strlen($SQL)==0) return false;
		$SQL = preg_replace('/`(.+?)`/',TABLE_PREFIX.'$1',$SQL);
		if($this->debug_mode)
	{

		print_sql($SQL);		
		 	$t1=microtime(true);
			$this->rs =@mysql_query($SQL,$this->conn);
		$qtm = microtime(true)-$t1;
		}
		else $this->rs =@mysql_query($SQL,$this->conn);

		$this->recordcount = mysql_affected_rows($this->conn);
		$this->lastquery = $SQL;
		if($this->debug_mode) print_result($this->recordcount,$qtm);
		return ($this->recordcount);
	}

  	function getrec($rec_type='assoc')
	{
		if(!$this->rs) return false;

	switch($rec_type)
		{
			case 'row':
			return mysql_fetch_row($this->rs);
			case 'array':
				return mysql_fetch_array($this->rs);

		case 'object':			
				return mysql_fetch_object($this->rs);
			default:
				return mysql_fetch_assoc($this->rs);
		}
	}

	 
function get_insert_sql($flds,$tblname)
	{
	   $SQL1 = "INSERT INTO $tblname(";
	   $SQL2 = " VALUES(";
	
	   foreach($flds as $fld=>$val)
	   {
			$SQL1 .= $fld.",";
			$SQL2 .= $this->safestr($val).",";
	   }
	  	  
	   $SQL1[strlen($SQL1)-1]=")";
	   $SQL2[strlen($SQL2)-1]=")";
	   return $SQL1.$SQL2;	
	}
	function get_field($SQL,$col=0,$row=0)

	{

		$this->query($SQL);

		if($this->recordcount == 0) return false;

		for($r = 0;($flds = @mysql_fetch_row($this->rs));$r++)

			if(($r == $row) && isset($flds[$col]))

				switch(mysql_field_type($this->rs,$col))

				{	

					case 'int':

						return intval($flds[$col]);

						

					case 'real':

						return floatval($flds[$col]);

						

					default:

						return $flds[$col];

				}

	

		return false;

	}	
	function insert($flds,$tblname)
	{
	   return $this->query($this->get_insert_sql($flds,$tblname));
	}
	
	function insert_get_id($flds,$tblname)
	{
		$SQL = $this->get_insert_sql($flds,$tblname);
		//$this->debug_mode=true;
		if($this->query($SQL))
		{
		//exit;

		return(mysql_insert_id($this->conn));
		}	
		return false;	

	}
 function safestr($val,$striptags=true)

{
		if(is_null($val)) return "NULL";
		if(is_string($val))
		{
		   if($striptags) $val=strip_tags($val);
		   $val = addslashes($val);		
		   $val = str_replace('\\\\','\\',str_replace('\\\"','\"',str_replace("\\\\\\'","\\'",$val)));
		   $val = "'$val'";
		}
		return $val;

}
function update($flds,$WHERE,$tblname)

	{

		$SQL = "UPDATE $tblname SET ";

		

		foreach($flds as $fld=>$val)

		{

	   		$striptags = !preg_match("/^<\w*>$/",$fld);

			if($striptags) $SQL .= "$fld=";

			else $SQL .= substr($fld,1,-1)."=";

			$SQL .= $this->safestr($val,false).",";			

		}

		

		$SQL = substr($SQL,0,-1);

		$SQL .= " WHERE ".$WHERE;

			

		return  $this->query($SQL);



	}

	

 }
$db 	= new DB();