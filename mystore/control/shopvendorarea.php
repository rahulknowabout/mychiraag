<?php /* echo "<pre>";
print_r( $_POST );
die();*/
function addeditvendorarea( $ketObj )
{
	//vendor table array
	$ketechVendorArea['area_name']    =	$_POST['area_name'];
	$ketechVendorArea['vcity']    =	$_POST['vcity'];
	$hidvid				  =	    $_POST['hidvid'];
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hidvid ) && $hidvid > 0 && isset( $hidvid ) && $hidvid > 0 )
	{
		 
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechvendorarea", $ketechVendorArea, "WHERE id=".$hidvid );
		
		
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechvendorarea", $ketechVendorArea);
		
	}
		
	   header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );

}
?>