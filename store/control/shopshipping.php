<?php
/*echo "<pre>";
print_r( $_POST );
//print_r( $_FILES );
die();*/
//echo "<pre>";
//print_r( $ketObj );
//$ketObj->>runquery( "SELECT", "*", "ketechcat", array(), "" );
//die();
function addeditshipping( $ketObj )
{
	$ketechshipping['vid']		=	$_POST['vendor'];
	$ketechshipping['minpa']	=	 $_POST['minpa'] ;
	$ketechshipping['maxpa']	=	$_POST['maxpa'];
	$ketechshipping['shipping_charges']	=	$_POST['shipping_charges'];
	$ketechshipping['admin_approval']	=	1;
	$hidsid					=	$_POST['hidsid'];
	
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "" );
    //echo "<pre>";
    //print_r( $allSet );
    //die();
	if( isset( $hidsid ) && $hidsid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechshipping", $ketechshipping, "WHERE id=".$hidsid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechshipping", $ketechshipping );
	}	
	
		
		
	
	//echo "<pre>"; print_r($_SESSION);
	//echo "<pre>"; print_r($_FILES);
   //die();
	

	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
//$ketObj = new ketech(); 

//addeditmanuf( $ketObj );
?>