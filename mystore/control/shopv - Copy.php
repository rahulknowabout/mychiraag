<?php  /* echo "<pre>";
print_r( $_POST );
die();*/
if( $_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == '192.168.0.100') {
	$con	=	mysql_connect("localhost","root","");
	mysql_select_db("mychiraag",$con);
}
else {
		mysql_connect("localhost","neelneco_tech","Na82HAHOt~d5");
		mysql_query("SET NAMES utf8");
		mysql_select_db("neelneco_teach");
}
$queryct ="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'ketechvp' AND table_schema = 'mychiraag'";
$result = mysql_query( $queryct );
	while( $row = mysql_fetch_array( $result ) )
	{
		$Mcoloumn[] = $row['COLUMN_NAME'];
	
	
	}
 
	
    echo "<pre>";
    print_r( $Mcoloumn );
    die();
function addeditvendor( $ketObj )
{
	//vendor table array
	$VendorCityArray = explode( "/",$_POST['vcity'] );
	
	$VendorAreaArray = explode( "/",$_POST['varea'] );
	
	/*echo "<pre>";
	print_r( $VendorCityArray  );
	print_r( $VendorAreaArray  );
	die();*/
	
	$ketechVendor['vname']    =	$_POST['vname'];
	$ketechVendor['vaddress'] =	strtolower( $_POST['vaddress'] );
	$ketechVendor['vmail']   =	$_POST['vemail'];
	$ketechVendor['vphone']	 =	$_POST['vphone'];
	$ketechVendor['vcname']  =	$_POST['vcname'];
	$ketechVendor['vcaddress'] =	$_POST['vcaddress'];
	$ketechVendor['vcmail'] =	$_POST['vcemail'];
	$ketechVendor['vcphone'] =	$_POST['vcphone'];
	$ketechVendor['varea'] =	$VendorAreaArray['1'];
	$ketechVendor['vareaid'] =	$VendorAreaArray['0'];
	$ketechVendor['vcity'] =	$VendorCityArray['1'];
	$ketechVendor['vcityid'] =	$VendorCityArray['0'];
	$hidvid				  =	    $_POST['hidvid'];
	
	//usertable array
	$ketechUser['uname']    =	$_POST['vname'];
	$ketechUser['uaddress'] =	strtolower( $_POST['vaddress'] );
	$ketechUser['uemail']   =	$_POST['vemail'];
	$ketechUser['uphone']	 =	$_POST['vphone'];
	$ketechUser['upassword'] = substr($_POST['vphone'],6);
	$ketechUser['urole'] =	   'vendor';
	$ketechUser['ucity'] =	   $VendorCityArray['1'];
	$ketechUser['ucityid'] =   $VendorCityArray['0'];
	$ketechUser['uarea'] =	   $VendorAreaArray['1'];
	$ketechUser['uareaid'] =   $VendorAreaArray['0'];
	$hiduid	 =	$_POST['hiduid'];
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hiduid ) && $hiduid > 0 && isset( $hiduid ) && $hiduid > 0 )
	{
		 /*echo "<pre>";
        print_r( $_POST );
        die();*/
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechvendor", $ketechVendor, "WHERE id=".$hidvid );
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechuser", $ketechUser, "WHERE id=".$hiduid );
		
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechuser", $ketechUser );
		$ketechVendor['uid'] =	mysql_insert_id();
		
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechvendor", $ketechVendor );
	}
		
	   header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );

}
?>