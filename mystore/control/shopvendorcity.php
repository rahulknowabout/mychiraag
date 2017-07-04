<?php /* echo "<pre>";
print_r( $_POST );
die();*/
function addeditvendorcity( $ketObj )
{
	//vendor table array
	$ketechVendorCity['city_name']    =	$_POST['city_name'];
	
	$hidvid				  =	    $_POST['hidvid'];
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hidvid ) && $hidvid > 0 && isset( $hidvid ) && $hidvid > 0 )
	{
		 
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechvendorcity", $ketechVendorCity, "WHERE id=".$hidvid );
		
		
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechvendorcity", $ketechVendorCity);
		
	}
		
	   header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );

}
?>