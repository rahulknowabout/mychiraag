<?php
/*echo "<pre>";
print_r( $_POST );
print_r( $_FILES );
die();*/
function addeditcat( $ketObj )
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
	if( isset( $_POST['order']) && $_POST['order'] == "order" ){
		$arrayord = $_POST['ord'];
		$arrayloc = $_POST['location'];
	
			foreach( $arrayord as $arrayordK => $arrayordV ){
			
			$ketechord['cord'] = $arrayordV;
				
			$allSet = $ketObj->runquery("UPDATE", "", "ketechcat", $ketechord, "WHERE id=".$arrayordK	 );
			
			}
			foreach( $arrayloc as $arraylocK => $arraylocV ){
			
			$ketechloc['clocation'] = $arraylocV;
				
			$allSet = $ketObj->runquery("UPDATE", "", "ketechcat", $ketechloc, "WHERE id=".$arraylocK	 );
			
			}
		
			
			header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$vid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."" );
			die();
				
	}

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
	
	
	/*
	echo "<pre>"; print_r($_SESSION);
	echo "<pre>"; print_r($_FILES);
 die();
	*/
	
$hidpid	= $hidcid;
$prodmainimage =  $_FILES['catthumbimg'];
//echo "<pre>";
//print_r( $prodmainimage );
//die();

	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
	{
		//Thumb Image
		
		$max_cat_thmub_w	=	$_SESSION['config']['cat_thmub_w'];
		$max_cat_thmub_h	=	$_SESSION['config']['cat_thmub_h'];
		
		$imgSize = $ketObj->imageresize( $max_cat_thmub_w, $max_cat_thmub_h, $prodmainimage['tmp_name'] );
		if( isset( $imgSize ) && is_array( $imgSize ) && count( $imgSize ) > 0 )
		{
			//$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/c/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
		}else
		{
			##move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/thumb/thumb_".$hidpid.".jpg" );
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/c/".$hidpid."/thumb/thumb_".$hidpid.".jpg", "-thumb", $max_cat_thmub_w, $max_cat_thmub_h, 100);
		}
	}
		
	if( isset( $prodmainimage ) && $prodmainimage['name'] != "" && $prodmainimage['error'] < 1 && $hidpid > 0 )
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
			//$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $imgSize[0], $imgSize[1], 100);
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/c/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
		}else
		{
			##move_uploaded_file( $prodmainimage['tmp_name'], "../images/p/".$hidpid."/big/big_".$hidpid.".jpg" );
			$ketObj->createThumbnail( $prodmainimage['tmp_name'], "../images/c/".$hidpid."/big/big_".$hidpid.".jpg", "-thumb", $max_cat_full_w, $max_cat_full_h, 100);
		}
		
	}
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$vid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."" );
}
?>