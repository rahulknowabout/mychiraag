<?php
/*echo "<pre>";
print_r( $_POST );
die();*/
function addeditoffer( $ketObj )
{
	$ketechOffer['title']		=	$_POST['title'];
	$ketechOffer['odes']	=	    $_POST['odes'];
	$ketechOffer['ccode']	=	    $_POST['ccode'];
	$ketechOffer['s_date']	=	$_POST['s_date'];
	$ketechOffer['e_date']	=	$_POST['e_date'];
	$hidfid					=	$_POST['hidfid'];
	
	
	
		
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "" );
	if( isset( $hidfid	 ) && $hidfid	 > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechoffer", $ketechOffer, "WHERE id=".$hidfid	 );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "", "ketechoffer", $ketechOffer );
		/*if( $allSet > 0 )
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
			
			$hidfid		=	$allSet;
		}
	}
	
	if( isset( $_FILES['catthumbimg'] ) && $_FILES['catthumbimg']['name'] != "" && $_FILES['catthumbimg']['error'] < 1 && $hidfid	 > 0 )
	{
		//Thumb Image
		$max_cat_thmub_w	=	$_SESSION['config']['cat_full_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_full_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $_FILES['catthumbimg']['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['catthumbimg']['tmp_name'], "../images/c/".$hidfid	."/thumb/thumb_".$hidfid	.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $_FILES['catthumbimg']['tmp_name'], "../images/c/".$hidfid	."/thumb/thumb_".$hidfid	.".jpg" );
		}
	}
		
	if( isset( $_FILES['catimg'] ) && $_FILES['catimg']['name'] != "" && $_FILES['catimg']['error'] < 1 && $hidfid	 > 0 )
	{	
		//Full Image
		$max_cat_full_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_full_h	=	$_SESSION['config']['cat_thmub_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$_FILES['catimg']['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['catimg']['tmp_name'], "../images/c/".$hidfid	."/big/big_".$hidfid	.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $_FILES['catimg']['tmp_name'], "../images/c/".$hidfid	."/big/big_".$hidfid	.".jpg" );
		}
		
	}

	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
}
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>