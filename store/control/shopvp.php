<?php  /*echo "<pre>";
print_r( $_POST );
die();*/
function addeditvendorProduct( $ketObj )
{ 

	if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid'] > 0 ){
			$avid = $_REQUEST['avid'];
		
	}else{
			$avid = "";
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
		}if( isset( $_REQUEST['buscatidS'] ) && $_REQUEST['buscatidS'] != "" ){
			$buscatidS = $_REQUEST['buscatidS'];
		}else{
			$buscatidS = $_REQUEST['buscatidS'];
		}if( isset( $_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] != "" ){
			$admin_approval = $_REQUEST['admin_approval'];
		}else{
			$admin_approval = "";
		}
	
  $Cattext = "";
  $busCat = "";
	if( isset( $_POST['Catsecond'] ) && is_array( $_POST['Catsecond'] ) && count( $_POST['Catsecond']  ) > 0 )
	{
		
		$subCattext = $_POST['Catsecond'];
		
		foreach( $subCattext as $sub )
		{
			$Cattext = $Cattext."*".$sub."*,";
			$busCat = $sub;
		}
		
}else {
			$Cattext = $_POST['sub_cat_text'];
			$busCat = $_POST['b_cat'];
	
	
	}
	
	if( isset( $_POST['productCat'] ) && $_POST['productCat'] > 0 ){ 
		$parent_cat = $_POST['productCat'];
	}else {
			$parent_cat = $_POST['parent_cat'];
	
	}
	
	if( isset( $_POST['f_product'] ) &&  $_POST['f_product'] > 0 ){
			$mpq_fp = $_POST['mpq_fp'];
	
	}else {
			$mpq_fp = 1;
	
	}
 
	if( isset( $_POST['product'] ) && $_POST['product'] != "") { $pide = $_POST['product'];}else{$pide =  $_POST['pide']; }
	$ketechVendorP['vid']  =    $_POST['vid'];
	$ketechVendorP['b_cat']  =    $busCat;
	$ketechVendorP['p_cat']  =   $parent_cat;
	$ketechVendorP['sub_cat_text']  =    $Cattext;
	$ketechVendorP['pid']  =    $pide;
	if( isset( $_POST['modbasep']) && isset( $_POST['modsellp']) )
	{
		$ketechVendorP['modify_baseprice'] = "";
	    $ketechVendorP['modify_sellprice'] = "";
		$ketechVendorP['admin_approval'] = 0;
	}
	$ketechVendorP['baseprice'] = $_POST['baseprice'];
	$ketechVendorP['sellprice'] = $_POST['sellprice'];
	$ketechVendorP['f_product'] = $_POST['f_product'];
	$ketechVendorP['mpq_fp'] = $mpq_fp;
	$ketechVendorP['stock'] = $_POST['stock'];
	$ketechVendorP['status']  =	$_POST['status'];
	$ketechVendorP['max_buy_limit']  =	$_POST['mblpq'];
	$hidcid				  =	    $_POST['hidcid'];
	
   // echo "<pre>";
   // print_r( $_POST );
    //die();
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hidcid ) && $hidcid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechvp_".$_POST['hidchild']."", $ketechVendorP, "WHERE id=".$hidcid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechvp_".$_POST['hidchild']."", $ketechVendorP );
	}
	if( isset( $_POST['modbasep']) && isset( $_POST['modsellp']) )
	    {
			
			header( "Location: index.php?v=".$_POST['v']."&f=".$_POST['f']."&vid=".$ketechVendorP['vid']."&avid=".$avid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid=".$buscatidS."&admin_approval=y" );
		}else{
				header( "Location: index.php?v=".$_POST['v']."&f=".$_POST['f']."&vid=".$ketechVendorP['vid']."&avid=".$avid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid=".$buscatidS."&admin_approval=".$admin_approval."" );
		}
}
?>