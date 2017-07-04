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
	
	}if( isset( $_POST['discount_type'] ) &&  $_POST['discount_type'] != "" )
	{
		$discount_type =  $_POST['discount_type']; 
	
	}else{
			$discount_type =  ""; 
	
	}
	
	$ketechdiscount['vid']		=	$_POST['vendorh'];
	$ketechdiscount['discount_on']	=	 $_POST['discount_on'] ;
	$ketechdiscount['s_date']	=	 $_POST['s_date'] ;
	$ketechdiscount['e_date']	=	 $_POST['e_date'] ;
	$ketechdiscount['amt']	=	 $_POST['amt'];
	$ketechdiscount['coupencode']	=	 $_POST['coupencode'];
	$ketechdiscount['buscat']	=	 $buscatid;
	$ketechdiscount['discount']	=	 $_POST['discount'];
	$ketechdiscount['discount_type']	=	 $discount_type;
	$ketechdiscount['admin_approval']	=	"0";
	
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
	
	$VendorInfo = $ketObj->runquery( "SELECT", "*", "ketechvendor", array()," where id = ".$_SESSION['vid']."" );
	$BaseUrl = $ketObj->runquery( "SELECT", "burl,uemail,uname", "ketechset", array(),"" );
	/*echo "<pre>";
	print_r( $BaseUrl );
	die();*/
	//www.mychiraag/store/index.php?v=shopdiscount&vid=26&admin_approval='y'
	
	
	$vid= $VendorInfo['0']['id'];
	$vcity= $VendorInfo['0']['vcity'];
	$varea= $VendorInfo['0']['varea'];
	$vphone= $VendorInfo['0']['vphone'];
	$path = $BaseUrl['0']['burl'].'/index.php?v=shopdiscount&vid='.$vid.'&admin_approval=y';
	
	$toemail = $BaseUrl['0']['uemail'];
	$toname = $BaseUrl['0']['uname'];
	$fromemail= $VendorInfo['0']['vmail'];
	$fromname= $VendorInfo['0']['vname'];
	$subject = "Discount Rule Approval For ".$fromname;
	$message = "Hello Admin <br/> Please find vendor detail below<br/><b>Vendror Id: ".$vid."<br/>Vendor City: ".$vcity."<br/>Vendor Area:  ".$varea."<br/>Vendor Phone: ".$vphone."<br/><a href = 'http://".$path."' target='_blank'>To  Approve Discount Rule  Click Here</a>";
	/*echo $message;
	die();*/ 
	
	$ketObj->emailSend($toemail,$toname,$fromemail ,$fromname,$subject ,$message );	
	
		
		
	
	//echo "<pre>"; print_r($_SESSION);
	//echo "<pre>"; print_r($_FILES);
   //die();
	

	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f'] );
}
//$ketObj = new ketech(); 

//addeditmanuf( $ketObj );
?>