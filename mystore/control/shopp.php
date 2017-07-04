<?php /* echo "<pre>";
print_r( $_POST );
echo "<hr/>";
print_r( $_FILES );
die();*/
function addeditprod( $ketObj )
{
	$Cattext = "";
	if( isset( $_POST['Catsecond'] ) && is_array( $_POST['Catsecond'] ) && count( $_POST['Catsecond']  ) > 0 )
	{
		
		$subCattext = $_POST['Catsecond'];
		
		foreach( $subCattext as $sub )
		{
			$Cattext = $Cattext."*".$sub."*,";
		}
		
		
	}
	/*echo "<pre>";
	print_r( $Cattext );
	die();*/
	
	$ketechProd['pname']    =	$_POST['pname'];
	$ketechProd['palias']	=	strtolower( $_POST['palias'] );
	$ketechProd['pcategory']=	$_POST['buscatid'];
	$ketechProd['pcategory']=	$_POST['buscatid'];
	$ketechProd['pstatus']	=	$_POST['status'];
	$ketechProd['pmanufacturer'] = $_POST['pmanufacturer'];
	$ketechProd['p_sdesc'] =	$_POST['pshortdesc'];
	$ketechProd['p_fdesc'] =	$_POST['pfulldesc'];
	$ketechProd['p_parent_cat']= $_POST['productCat'];
	$ketechProd['sub_cat_text']=	$Cattext;
	$hidpid				  =	    $_POST['hidpid'];
	
   // echo "<pre>";
   // print_r( $_POST );
    //die();
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hidpid ) && $hidpid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "*", "ketechprod", $ketechProd, "WHERE id=".$hidpid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechprod", $ketechProd );
		if( $allSet > 0 )
		{
			
			mkdir("../images/p/".$allSet);
			$fp	=	fopen( "../images/p/".$allSet."/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/p/".$allSet."/big");
			$fp	=	fopen( "../images/p/".$allSet."/big/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			mkdir("../images/p/".$allSet."/thumb");
			$fp	=	fopen( "../images/p/".$allSet."/thumb/index.html", 'w');
			fwrite($fp, '<!DOCTYPE html><title></title>');
			
			$hidcid	=	$allSet;
		}
	}
$prodmainimage =  $_FILES['prodmainimg'];
//echo "<pre>";
//print_r( $prodmainimage );
//die();

	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{
		//Thumb Image
		
		$max_cat_thmub_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_thmub_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $prodmainimage['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidcid."/thumb/thumb_".$hidcid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidcid."/thumb/thumb_".$hidcid.".jpg" );
		}
	}
		
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{	
		//Full Image
	   //echo "<pre>";
       //print_r( $prodmainimage );
       //die();

		$max_cat_full_w	=	$_SESSION['config']['cat_full_w'];
		$max_cat_full_h	=	$_SESSION['config']['cat_full_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$prodmainimage['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidcid."/big/big_".$hidcid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
		}else
		{
			move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidcid."/big/big_".$hidcid.".jpg" );
		}
		
	}
	$prodmainimage = $_FILES['prodotherimg1'];
	
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	$prodmainimage = $_FILES['prodotherimg2'];
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	
	$prodmainimage = $_FILES['prodotherimg3'];
	
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	$prodmainimage = $_FILES['prodotherimg4'];
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidcid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	
	
	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
?>