<?php
/*echo "<pre>";
print_r( $_POST );
print_r( $_FILES );
die();*/
//echo "<pre>";
//print_r( $ketObj );
//$ketObj->>runquery( "SELECT", "*", "ketechcat", array(), "" );
//die();
function addeditbanner( $ketObj )
{
	$ketechb['title']		=	$_POST['title'];
	$ketechb['alias']	=	strtolower( $_POST['balias'] );
	$ketechb['order_b']	=	$_POST['order_b'];
	$ketechb['status']	=	$_POST['bstatus'];
	$hidbid					=	$_POST['hidbid'];
	
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "" );
    //echo "<pre>";
    //print_r( $allSet );
    //die();
	if( isset( $hidbid ) && $hidbid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechbanner", $ketechb, "WHERE id=".$hidbid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechbanner", $ketechb );
	
		
			mkdir("../images/b/".$allSet);
			$fp	=	fopen( "../images/b/".$allSet."/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/b/".$allSet."/big");
			$fp	=	fopen( "../images/b/".$allSet."/big/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/b/".$allSet."/thumb");
			$fp	=	fopen( "../images/b/".$allSet."/thumb/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			$hidbid	=	$allSet;
	}
	
	if( isset( $_FILES['bimg'] ) && $_FILES['bimg']['name'] != "" && $_FILES['bimg']['error'] < 1 && $hidbid > 0 )
	{
		//Thumb Image
		$max_cat_thmub_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_thmub_h'];
		$tempname = $_FILES['bimg']['tmp_name'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $_FILES['bimg']['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
		}else
		{
			move_uploaded_file( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg" );
		}
	}
		
	if( isset( $_FILES['bimg'] ) && $_FILES['bimg']['name'] != "" && $_FILES['bimg']['error'] < 1 && $hidbid > 0 )
	{	
		//Full Image
		$max_cat_full_w	=	$_SESSION['config']['cat_full_w'];
		$max_cat_full_h	=	$_SESSION['config']['cat_full_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$_FILES['catimg']['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
		}else
		{
			move_uploaded_file( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg" );
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