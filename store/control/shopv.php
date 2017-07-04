<?php  /* echo "<pre>";
print_r( $_POST );
die();*/
function createtable($tname="")
{
$queryct ="SELECT COLUMN_NAME,DATA_TYPE,character_maximum_length as 'Max Length' FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$tname."' AND table_schema = 'mychiraagdemo'";
$result = mysql_query( $queryct );
	while( $row = mysql_fetch_array( $result ) )
	{
		if( $row['Max Length'] != "" )
		{
			$Mcoloumn[] = "".$row['COLUMN_NAME']." ".$row['DATA_TYPE']."(".$row['Max Length'].")";
		}else
		{
		  if( $row['COLUMN_NAME'] == "id" )
		  {
		  	$Mcoloumn[] = "".$row['COLUMN_NAME']." ".$row['DATA_TYPE']."  NOT NULL AUTO_INCREMENT,
PRIMARY KEY (".$row['COLUMN_NAME'].")";
		  
		  }else
		  {
			$Mcoloumn[] = "".$row['COLUMN_NAME']." ".$row['DATA_TYPE'];
		  }	
		}	
	
	
	}
		$strimp = implode( "," ,$Mcoloumn );
		return $strimp;
}

	
   /* echo "<pre>";
    print_r( $Mcoloumn );
    echo $querycreatetable;*/
	
	//echo $strimp;
	//die();
	
function addeditvendor( $ketObj )
{
	//vendor table array
	$strimp = createtable("ketechvp");
	$strimpord = createtable("ketechproductorder");
	$VendorCityArray = explode( "/",$_POST['vcity'] );
	
	$areaid = "";
	$areaname = "";
	
	##$VendorAreaArray = explode( "/",$_POST['varea'] );
	
	if( isset($_POST['varea'] ) && is_array( $_POST['varea'] ) && count( $_POST['varea'] )>0  ){
		$VendorAreaArray = explode( "/",$_POST['varea']['0'] );
		foreach( $_POST['varea'] as $vareaK => $vareaV  ){
			$exp = explode("/",$vareaV);
			$areaid .= $exp['0'].",";
			$areaname .= $exp['1'].",";
		
		
		}
	
	}
	
	/*echo "<pre>";
	print_r( $areaid  );
	print_r( $areaname  );
	die();*/
	
	$ketechVendor['vname']    =	$_POST['vname'];
	$ketechVendor['vaddress'] =	strtolower( $_POST['vaddress'] );
	$ketechVendor['vmail']   =	$_POST['vemail'];
	$ketechVendor['vphone']	 =	$_POST['vphone'];
	$ketechVendor['vcname']  =	$_POST['vcname'];
	$ketechVendor['vcaddress'] =	$_POST['vcaddress'];
	$ketechVendor['vcmail'] =	$_POST['vcemail'];
	$ketechVendor['vcphone'] =	$_POST['vcphone'];
	$ketechVendor['varea'] =	$areaname;
	$ketechVendor['vareaid'] =	$areaid;
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
	$hiduid	 =	$_POST['hidvid'];
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hiduid ) && $hiduid > 0 && isset( $hiduid ) && $hiduid > 0 )
	{
		 /*echo "<pre>";
        print_r( $_POST );
        die();*/
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechvendor", $ketechVendor, "WHERE id=".$hidvid );
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechuser", $ketechUser, "WHERE vid=".$hiduid );
		
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechvendor", $ketechVendor );
		$ketechUser['vid'] =	mysql_insert_id();
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechuser", $ketechUser );
		$querycreatetableprd = "CREATE TABLE IF NOT EXISTS ketechvp_".$ketechUser['vid']." (".$strimp.")";
		$querycreatetableord = "CREATE TABLE IF NOT EXISTS ketechord_".$ketechUser['vid']." (".$strimpord.")";
		mysql_query( $querycreatetableprd );
		mysql_query( $querycreatetableord );
		/*echo $querycreatetable;
		die();*/
	}
		
	   header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );

}
?>