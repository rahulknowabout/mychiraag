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
		}if( isset( $_REQUEST['orderstatusS'] ) && $_REQUEST['orderstatusS'] != "" ){
			$orderstatusS = $_REQUEST['orderstatusS'];
		}else{
			$orderstatusS = "";
		}


  $Cattext = "";
  $busCat = "";
	if( isset( $_POST['Catsecond'] ) && is_array( $_POST['Catsecond'] ) && count( $_POST['Catsecond']  ) > 0 ){
		
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
 
	if( isset( $_POST['product'] ) && $_POST['product'] != "") { $pide = $_POST['product'];}else{$pide =  $_POST['pide']; }
	
	if( isset( $_POST['productCat'] ) && $_POST['productCat'] > 0 ){ 
		$parent_cat = $_POST['productCat'];
	}else {
			$parent_cat = $_POST['parent_cat'];
	
	}
	
	
	$ketechVendorP['vid']  =    $_POST['vid'];
	$ketechVendorP['b_cat']  =    $busCat;
	$ketechVendorP['p_cat']  =    $parent_cat;
	$ketechVendorP['sub_cat_text']  =    $Cattext;
	$ketechVendorP['pid']  =    $pide;
	//$ketechVendorP['baseprice'] = $_POST['baseprice'];
	//$ketechVendorP['sellprice'] = $_POST['sellprice'];
	$ketechVendorP['modify_baseprice'] = $_POST['modifybaseprice'];
	$ketechVendorP['modify_sellprice'] = $_POST['modifysellprice'];
	$ketechVendorP['admin_approval'] = 1;
	$ketechVendorP['stock'] = $_POST['stock'];
	$ketechVendorP['status'] = $_POST['status'];
	$ketechVendorP['ART_NO']  =	$_POST['art_no'];
	$ketechVendorP['SUPPL_NO']  =	$_POST['sup_no'];
	$ketechVendorP['SUPPL_NAME']  =	$_POST['sup_name'];
	$ketechVendorP['SUPPL_ART_NO']  =	$_POST['suppl_art_no'];
	$ketechVendorP['BUYER_UID']  =	$_POST['buyer_uid'];
	$ketechVendorP['CONT_BUY_UNIT']  =	$_POST['count_buy_unit'];
	$ketechVendorP['ART_GRP_NO']  =	$_POST['art_grp_no'];
	$ketechVendorP['ART_GRP_DESCR']  =	$_POST['art_grp_descr'];
	$ketechVendorP['ART_GRP_SUB_NO']  =	$_POST['art_grp_sub_no'];
	$ketechVendorP['ART_GRP_SUB_DESCR']  =	$_POST['art_grp_sub_descr'];
	$ketechVendorP['DEPT_NO']  =	$_POST['dept_no'];
	$ketechVendorP['DEPT_DESCR']  =	$_POST['dept_descr'];
	$ketechVendorP['SELL_PR']  =	$_POST['sell_pr'];
	$ketechVendorP['SELL_VAT']  =	$_POST['sell_vat'];
	$ketechVendorP['SPAT']  =	$_POST['spat'];
	$ketechVendorP['MRP_PRICE']  =	$_POST['mrp_price'];
	$ketechVendorP['VAT_MY']  =	$_POST['vat_my'];
	$ketechVendorP['BUY_VAT_NO']  =	$_POST['buy_vat_no'];
	$ketechVendorP['BUY_VAT_PERC']  =	$_POST['buy_vat_perc'];
	$ketechVendorP['Offer_No']  =	$_POST['offer_no'];
	$ketechVendorP['DMS']  =	$_POST['dms'];
	$ketechVendorP['ON_ORDER']  =	$_POST['on_order'];
	$ketechVendorP['LAST_DELDAY']  =	$_POST['last_delday'];
	$ketechVendorP['LAST_SALEDAY']  =	$_POST['last_saleday'];
	$ketechVendorP['MFG_Date']  =	$_POST['mfg_date'];
	$ketechVendorP['Exp_Date']  =	$_POST['exp_date'];
	$ketechVendorP['ART_STATUS']  =	$_POST['art_status'];
	$ketechVendorP['STORE']  =	$_POST['store'];
	
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
	$VendorInfo = $ketObj->runquery( "SELECT", "*", "ketechvendor", array()," where id = ".$_SESSION['vid']."" );
	$BaseUrl = $ketObj->runquery( "SELECT", "burl,uemail,uname", "ketechset", array(),"" );
	
	$vid= $VendorInfo['0']['id'];
	$vcity= $VendorInfo['0']['vcity'];
	$varea= $VendorInfo['0']['varea'];
	$vphone= $VendorInfo['0']['vphone'];
	$path = $BaseUrl['0']['burl'].'/index.php?v=shopvpl&f=tmpl&vid='.$vid.'&admin_approval=y';
	
	$toemail = $BaseUrl['0']['uemail'];
	$toname = $BaseUrl['0']['uname'];
	$fromemail= $VendorInfo['0']['vmail'];
	$fromname= $VendorInfo['0']['vname'];
	$subject = "Product Approval For ".$fromname;
	$message = "Hello Admin <br/> Please find vendor detail below<br/><b>Vendror Id: ".$vid."<br/>Vendor City: ".$vcity."<br/>Vendor Area:  ".$varea."<br/>Vendor Phone: ".$vphone."<br/><a href = 'http://".$path."' target='_blank'>To  Approve Product Click Here</a>";
	
	/*echo $message;
	die();*/
		
	$ketObj->emailSend($toemail,$toname,$fromemail ,$fromname,$subject ,$message );	
		
	
		
	   ##header("Location: index.php?v=".$_POST['v']."&f=".$_POST['f']."&vid=".$ketechVendorP['vid']."" );
	   
	   header( "Location: index.php?v=".$_POST['v']."&f=".$_POST['f']."&vid=".$ketechVendorP['vid']."&avid=".$avid."&productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid=".$buscatidS."&orderstatus=".$orderstatusS."" );

}
?>