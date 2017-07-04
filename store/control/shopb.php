<?php
/*echo "<pre>";
print_r( $_FILES );*/
/*
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
		$max_cat_thmub_w	=	1200;
		$max_cat_thmub_h	=	600;
		$tempname = $_FILES['bimg']['tmp_name'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $tempname );
		/*echo "<pre>";
		print_r( $imgSize );
		die();*/
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			//$ketObj->createThumbnail( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
			//die("ifb");
			
			$ketObj->createThumbnail( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
			###move_uploaded_file( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg" );
		}else
		{
			//die("elseb");
			##move_uploaded_file( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg" );
			$ketObj->createThumbnail( $_FILES['bimg']['tmp_name'], "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
			
		}
	}
	/*echo "<hr/>"; 
	echo "<pre>";
	print_r( $_FILES);*/
		
	if( isset( $_FILES['bimg'] ) && $_FILES['bimg']['name'] != "" && $_FILES['bimg']['error'] < 1 && $hidbid > 0 )
	{	
		//Full Image
		$max_cat_full_w	=	1200;
		$max_cat_full_h	=	600;
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$tempname);
		
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			/*echo "<pre>";
			print_r( $imgSize );*/
			//die("if");
			//$ketObj->createThumbnail( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 90);
			$ketObj->createThumbnail( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
			##move_uploaded_file( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg" );
		}else
		{
			//die("else");
			//move_uploaded_file( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg" );
			##copy( "../images/b/".$hidbid."/thumb/thumb_".$hidbid.".jpg","../images/b/".$hidbid."/big/big_".$hidbid.".jpg" );
			$ketObj->createThumbnail( $tempname, "../images/b/".$hidbid."/big/big_".$hidbid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
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