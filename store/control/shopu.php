<?php /*echo "<pre>";
print_r( $_POST );
die();*/
/*
print_r( $_FILES );
die();*/

function addedituser( $ketObj )
{
	$ketechUser['uname']    =	$_POST['uname'];
	$ketechUser['upassword']=	$_POST['upassword'];
	$ketechUser['uemail'] =	    $_POST['uemail'];
	$ketechUser['urole']	=	$_POST['urole'];
	$ketechUser['uaddress'] =	$_POST['uaddress'];
	$ketechUser['ucity'] =	    $_POST['ucity'];
	$ketechUser['uphone'] =	    $_POST['uphone'];
	$ketechUser['vid'] =	    $_POST['vid'];
	$hiduid				  =	    $_POST['hiduid'];
	
	if( isset( $_REQUEST['vid']) && $_REQUEST['vid']>0){
		$vid = $_REQUEST['vid'];
	}else{
			$vid = "";
	}
	
   // echo "<pre>";
   // print_r( $_POST );
    //die();
	
	//$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "" );
	if( isset( $hiduid ) && $hiduid > 0 )
	{
		$allSet = $ketObj->runquery( "UPDATE", "", "ketechuser",$ketechUser, "WHERE id=".$hiduid );
	}else
	{
		$allSet = $ketObj->runquery( "INSERT", "*", "ketechuser", $ketechUser );
	}
	header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$vid );
}
?>