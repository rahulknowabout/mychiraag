<?php
/*echo "<pre>";
print_r( $_POST );
die();*/
function addeditcat( $ketObj )
{
	$ketechCat['cname']		=	$_POST['cname'];
	$ketechCat['calias']	=	strtolower( $_POST['calias'] );
	$ketechCat['clocation']	=	$_POST['clocation'];
	$ketechCat['cparent']	=	$_POST['cparent'];
	$ketechCat['cstatus']	=	$_POST['cstatus'];
	$ketechCat['cdesc']		=	$_POST['cdesc'];
	$ketechCat['cdate']		=	"NOW()";
	$hidcid					=	$_POST['hidcid'];
	
	
	
		
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "" );
	if( isset( $hidcid ) && $hidcid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "*", "ketechcat", $ketechCat, "WHERE id=".$hidcid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechcat", $ketechCat );
		if( $allSet > 0 )
		{
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
	}
	
	if( isset( $_FILES['catthumbimg'] ) && $_FILES['catthumbimg']['name'] != "" && $_FILES['catthumbimg']['error'] < 1 && $hidcid > 0 )
	{
		//Thumb Image
		$max_cat_thmub_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_thmub_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $_FILES['catthumbimg']['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['catthumbimg']['tmp_name'], "../images/c/".$hidcid."/thumb/thumb_".$hidcid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
		}else
		{
			move_uploaded_file( $_FILES['catthumbimg']['tmp_name'], "../images/c/".$hidcid."/thumb/thumb_".$hidcid.".jpg" );
		}
	}
		
	if( isset( $_FILES['catimg'] ) && $_FILES['catimg']['name'] != "" && $_FILES['catimg']['error'] < 1 && $hidcid > 0 )
	{	
		//Full Image
		$max_cat_full_w	=	$_SESSION['config']['cat_full_w'];;
		$max_cat_full_h	=	$_SESSION['config']['cat_full_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$_FILES['catimg']['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['catimg']['tmp_name'], "../images/c/".$hidcid."/big/big_".$hidcid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
		}else
		{
			move_uploaded_file( $_FILES['catimg']['tmp_name'], "../images/c/".$hidcid."/big/big_".$hidcid.".jpg" );
		}
		
	}

	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>