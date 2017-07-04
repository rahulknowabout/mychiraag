<?php
function savesetting( $ketObj )
{
	$ketechset['kv.vname']		=	$_POST['uname'];
	$ketechset['kv.vphone']		=	$_POST['uphone'];
	$ketechset['kv.vmail']		=	$_POST['uemail'];
	$ketechset['ku.uname']		=	$_POST['uname'];
	$ketechset['ku.uphone']		=	$_POST['uphone'];
	$ketechset['ku.uemail']		=	$_POST['uemail'];
	$ketechset['ku.upassword']	=	$_POST['upassword'];
	
	
	$allSet = $ketObj->runquery( "UPDATE", "", "ketechvendor kv INNER JOIN ketechuser ku ON ku.vid = kv.id", $ketechset,"where kv.id = ".$_SESSION['vid']."" );
		header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>