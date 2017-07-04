<?php
/*echo "<pre>";
print_r( $_POST );
die();*/
function savesetting( $ketObj )
{
	$ketechset['cat_thmub_w']	=	$_POST['cat_thmub_w'];
	$ketechset['cat_thmub_h']	=	$_POST['cat_thmub_h'];
	$ketechset['cat_full_w']	=	$_POST['cat_full_w'];
	$ketechset['cat_full_h']	=	$_POST['cat_full_h'];
	$ketechset['cat_prod_w']	=	$_POST['cat_prod_w'];
	$ketechset['cat_prod_h']	=	$_POST['cat_prod_h'];
	$ketechset['prod_full_w']	=	$_POST['prod_full_w'];
	$ketechset['prod_full_h']	=	$_POST['prod_full_h'];
	$ketechset['uname']			=	$_POST['uname'];
	$ketechset['uphone']		=	$_POST['uphone'];
	$ketechset['upassword']		=	$_POST['upassword'];
	$ketechset['uemail']		=	$_POST['uemail'];
	$ketechset['emailcc']		=	$_POST['emailcc'];
	$ketechset['burl']		    =	$_POST['burl'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechset", array(), "" );
	if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "*", "ketechset", $ketechset );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechset", $ketechset );
	}
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>