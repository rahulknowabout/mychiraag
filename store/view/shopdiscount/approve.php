<?php /*echo "<pre>";
print_r( $_REQUEST );
die();*/
$where = " where id = ".$_REQUEST['sid']."";
$ketechAp['admin_approval'] = 1;
$resultlog = $ketObj->runquery( "UPDATE", "", "ketechdiscount", $ketechAp,$where,"");
header('location:index.php?v=shopdiscount&vid='.$_REQUEST['vid'].'&admin_approval=y'); 
?>