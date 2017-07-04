<?php
/*echo "<pre>";
print_r( $_POST );
//print_r( $_FILES );
die();*/
//echo "<pre>";
//print_r( $ketObj );
//$ketObj->>runquery( "SELECT", "*", "ketechcat", array(), "" );
//die();
function addeditshipping( $ketObj )
{
	$ketechshipping['vid']		=	$_POST['vendor'];
	$ketechshipping['minpa']	=	 $_POST['minpa'] ;
	$ketechshipping['maxpa']	=	$_POST['maxpa'];
	$ketechshipping['shipping_charges']	=	$_POST['shipping_charges'];
	$ketechshipping['admin_approval']	=	"0";
	$hidsid					=	$_POST['hidsid'];
	
	
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "" );
    //echo "<pre>";
    //print_r( $allSet );
    //die();
	if( isset( $hidsid ) && $hidsid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechshipping", $ketechshipping, "WHERE id=".$hidsid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechshipping", $ketechshipping );
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
	$path = $BaseUrl['0']['burl'].'/index.php?v=shopshipping&vid='.$vid.'&admin_approval=y';
	
	$toemail = $BaseUrl['0']['uemail'];
	$toname = $BaseUrl['0']['uname'];
	$fromemail= $VendorInfo['0']['vmail'];
	$fromname= $VendorInfo['0']['vname'];
	$subject = "Shipping Rule Approval For ".$fromname;
	$message = "Hello Admin <br/> Please find vendor detail below<br/><b>Vendror Id: ".$vid."<br/>Vendor City: ".$vcity."<br/>Vendor Area:  ".$varea."<br/>Vendor Phone: ".$vphone."<br/><a href = 'http://".$path."' target='_blank'>To  Approve Shipping Rule  Click Here</a>";
	
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