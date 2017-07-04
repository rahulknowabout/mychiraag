<?php
function addeditcustomfld( $ketObj )
{
	$ketechCat['fldname']			=	$_POST['fldname'];
	$ketechCat['fldmatrix']			=	strtolower( $_POST['fldmatrix'] );
	$ketechCat['fldstockable']		=	( $_POST['fldstockable'] ) ? $_POST['fldstockable'] : '0';
	$ketechCat['fldnotstockable']	=	( $_POST['fldnotstockable'] ) ? $_POST['fldnotstockable'] : '0';
	$hidcid							=	$_POST['hidcid'];
	
	
	
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechfld", array(), " WHERE id=".$hidcid );
	if( isset( $hidcid ) && $hidcid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "*", "ketechfld", $ketechCat, "WHERE id=".$hidcid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechfld", $ketechCat );
	}
	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>