<?php
/*echo "<pre>";
print_r( $_POST );
//print_r( $_FILES );
die();*/
//echo "<pre>";
//print_r( $ketObj );
//$ketObj->>runquery( "SELECT", "*", "ketechcat", array(), "" );
//die();
function addeditmanuf( $ketObj )
{
	$ketechManuf['mname']		=	$_POST['mname'];
	$ketechManuf['malias']	=	strtolower( $_POST['malias'] );
	$ketechManuf['mstatus']	=	$_POST['mstatus'];
	$hidmid					=	$_POST['hidmid'];
	
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "" );
    //echo "<pre>";
    //print_r( $allSet );
    //die();
	if( isset( $hidmid ) && $hidmid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechmanuf", $ketechManuf, "WHERE id=".$hidmid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechmanuf", $ketechManuf );
	
		
			mkdir("../images/c/".$allSet);
			$fp	=	fopen( "../images/c/".$allSet."/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/c/".$allSet."/big");
			$fp	=	fopen( "../images/c/".$allSet."/big/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/c/".$allSet."/thumb");
			$fp	=	fopen( "../images/c/".$allSet."/thumb/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			$hidcid	=	$allSet;
	}
	
	if( isset( $_FILES['manuthumbimg'] ) && $_FILES['manuthumbimg']['name'] != "" && $_FILES['manuthumbimg']['error'] < 1 && $hidmid > 0 )
	{
		//Thumb Image
		$max_cat_thmub_w	=	$_SESSION['config']['cat_full_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_full_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $_FILES['manuthumbimg']['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['manuthumbimg']['tmp_name'], "../images/c/".$hidmid."/thumb/thumb_".$hidmid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $_FILES['manuthumbimg']['tmp_name'], "../images/c/".$hidmid."/thumb/thumb_".$hidmid.".jpg" );
		}
	}
		
	if( isset( $_FILES['manuimg'] ) && $_FILES['manuimg']['name'] != "" && $_FILES['manuimg']['error'] < 1 && $hidmid > 0 )
	{	
		//Full Image
		$max_cat_full_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_full_h	=	$_SESSION['config']['cat_thmub_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$_FILES['catimg']['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['catimg']['tmp_name'], "../images/c/".$hidmid."/big/big_".$hidmid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $_FILES['catimg']['tmp_name'], "../images/c/".$hidmid."/big/big_".$hidmid.".jpg" );
		}
		
	}
	
	//echo "<pre>"; print_r($_SESSION);
	//echo "<pre>"; print_r($_FILES);
   //die();
	

	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
//$ketObj = new ketech(); 

//addeditmanuf( $ketObj );
?>