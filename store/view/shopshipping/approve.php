<?php /*echo "<pre>";
print_r( $_REQUEST );
die();*/
$where = " where id = ".$_REQUEST['sid']."";
$ketechAp['admin_approval'] = 1;
$resultlog = $ketObj->runquery( "UPDATE", "", "ketechshipping", $ketechAp,$where,"");
header('location:index.php?v=shopshipping&vid='.$_REQUEST['vid'].'&admin_approval=y'); 
?>