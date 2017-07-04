<?php /* echo "<pre>";
print_r( $_POST );
die();*/
/*
print_r( $_FILES );
die();*/
function addedituser( $ketObj )
{
	$ketechUser['from_time']    =	$_POST['from'];
	$ketechUser['to_time']=	$_POST['to'];
	
	$hiduid				  =	    $_POST['hidid'];
	
   // echo "<pre>";
   // print_r( $_POST );
    //die();
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hiduid ) && $hiduid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechdelivery_time",$ketechUser, "WHERE id=".$hiduid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechdelivery_time", $ketechUser );
	}
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>