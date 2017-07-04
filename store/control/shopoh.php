<?php
/*echo "<pre>";
print_r( $_POST );
die();*/
function addeditstatus( $ketObj )
{
$arraystatus = $_POST['status'];
$arraypack = $_POST['packstaff'];
$arraydel = $_POST['delstaff'];
foreach( $arraystatus as $arraystatusK => $arraystatusV ){
	
	$ketechstatus['status'] = $arraystatusV;
		
	$allSet = $ketObj->runquery("UPDATE", "", "ketechord_".$_REQUEST['vid'], $ketechstatus, "WHERE id=".$arraystatusK	 );
}
foreach( $arraypack as $arraypackK => $arraypackV ){
	
	$ketechpack['pack_staff'] = $arraypackV;
		
	$allSet = $ketObj->runquery("UPDATE", "", "ketechord_".$_REQUEST['vid'], $ketechpack, "WHERE id=".$arraypackK	 );
}
foreach( $arraydel as $arraydelK => $arraydelV ){
	
	$ketechdel['del_staff'] = $arraydelV;
		
	$allSet = $ketObj->runquery("UPDATE", "", "ketechord_".$_REQUEST['vid'], $ketechdel, "WHERE id=".$arraydelK	 );
}					
			/*$ketechoh['status']		=	$_POST['status'];
			$hidfid					=	$_POST['hidfid'];*/
	
	//die();
	
	
		
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "" );
	header( "Location: index.php?v=".$_POST['c']."&vid=".$_REQUEST['vid']."" );
}	
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

	
?>