<?php  /* echo "<pre>";
print_r( $_POST );
echo "<hr/>";
print_r( $_FILES );
die();*/
function addeditprod( $ketObj )
{
	if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 ){
			$vid = $_REQUEST['vid'];
		
		}else{
			$vid = "";
		}
		if( isset( $_REQUEST['productCat'] ) && ($_REQUEST['productCat'] > 0 || $_REQUEST['productCat']="ap" )){
			$productCat = $_REQUEST['productCat'];
			
		
		}else{
			$productCat = "";
		}
		if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct'] != "" ){
			$searchbyproduct = $_REQUEST['searchbyproduct'];
			
		
		}else{
			$searchbyproduct = "";
		}if( isset( $_REQUEST['searchp'] ) && $_REQUEST['searchp'] != "" ){
			$searchp = $_REQUEST['searchp'];
			
		
		}else{
			$searchp = "";
		}
	
	
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
	
	if( isset( $_POST['buscatid'] ) && $_POST['buscatid']!="" )
	{
		$pcat = $_POST['buscatid'];
	}else {
			$pcat = $_POST['pide'];
	
	}
	$ketechProd['pname']    =	$_POST['pname'];
	$ketechProd['palias']	=	strtolower( $_POST['palias'] );
	$ketechProd['pcategory']=	$pcat;
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
			
			$hidpid	=	$allSet;
		}
	}
$prodmainimage =  $_FILES['prodmainimg'];
//echo "<pre>";
//print_r( $prodmainimage );
//die();

	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{
		//Thumb Image
		
		$max_cat_thmub_w	=	$_SESSION['config']['cat_prod_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_prod_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $prodmainimage['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			//$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
		}else
		{
			##move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg" );
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
		}
	}
		
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{	
		//Full Image
	   //echo "<pre>";
       //print_r( $prodmainimage );
       //die();

		$max_cat_full_w	=	$_SESSION['config']['prod_full_w'];
		$max_cat_full_h	=	$_SESSION['config']['prod_full_h'];
		
		$imgSize = $ketObj->imageresize($max_cat_full_w,$max_cat_full_h,$prodmainimage['tmp_name']);
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			//$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
		}else
		{
			##move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg" );
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
		}
		
	}
	$prodmainimage = $_FILES['prodotherimg1'];
	
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	$prodmainimage = $_FILES['prodotherimg2'];
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	
	$prodmainimage = $_FILES['prodotherimg3'];
	
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	$prodmainimage = $_FILES['prodotherimg4'];
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{	
		
		move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/other/".$prodmainimage['name']);
		
		
	}
	if( isset( $_REQUEST['buscatidS'] ) && $_REQUEST['buscatidS'] != "" ){
			$buscatidS = $_REQUEST['buscatidS'];
			
		
	}else{
			$buscatidS = "";
		}
	
	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$vid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid=".$buscatidS."" );
}
?>