<?php
/*echo "<pre>";
print_r( $_POST );
//print_r( $_FILES );
die();*/
//echo "<pre>";
//print_r( $ketObj );
//$ketObj->>runquery( "SELECT", "*", "ketechcat", array(), "" );
//die();
function addeditdiscount( $ketObj )
{

	if( isset( $_POST['buscatid'] ) &&  $_POST['buscatid'] > 0 )
	{
		$buscatid =  $_POST['buscatid']; 
	
	}else{
			$buscatid =  ""; 
	
	}
	if( isset( $_POST['discount_type'] ) &&  $_POST['discount_type'] != "" )
	{
		$discount_type =  $_POST['discount_type']; 
	
	}else{
			$discount_type =  ""; 
	
	}
	
	$ketechdiscount['vid']		=	$_POST['vendor'];
	$ketechdiscount['discount_on']	=	 $_POST['discount_on'] ;
	$ketechdiscount['s_date']	=	 $_POST['s_date'] ;
	$ketechdiscount['e_date']	=	 $_POST['e_date'] ;
	$ketechdiscount['amt']	=	 $_POST['amt'];
	$ketechdiscount['coupencode']	=	 $_POST['coupencode'];
	$ketechdiscount['buscat']	=	 $buscatid;
	$ketechdiscount['discount']	=	 $_POST['discount'];
	$ketechdiscount['discount_type']	=	 $discount_type;
	$ketechdiscount['hmt']	=	 $_POST['hmt'];
	$ketechdiscount['max_discount']	=	 $_POST['mxd'];
	$ketechdiscount['admin_approval']	=	 1;
	
	$hiddisid					=	$_POST['hiddisid'];
	
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "" );
    //echo "<pre>";
    //print_r( $allSet );
    //die();
	if( isset( $hiddisid ) && $hiddisid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechdiscount", $ketechdiscount, "WHERE id=".$hiddisid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechdiscount", $ketechdiscount );
	}	
	
		
		
	
	//echo "<pre>"; print_r($_SESSION);
	//echo "<pre>"; print_r($_FILES);
   //die();
	

	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
//$ketObj = new ketech(); 

//addeditmanuf( $ketObj );
?>