<?php session_start();
require_once("../../../condb.php" );
require_once("../../control/shopfunction.php" );
$ketObj	=	new ketech();
$s_date = date('Y-m-d',strtotime($_REQUEST['s_date']));
$e_date = date('Y-m-d',strtotime($_REQUEST['e_date']));
/*echo $s_date;
echo $e_date;*/
$where = array();
if( isset( $_REQUEST['s_date'] ) && $_REQUEST['s_date']!="" && isset( $_REQUEST['e_date'] ) && $_REQUEST['e_date']!="" ){
	$where[] = "DATE(`order_time_stamp`) >= '".$s_date."' AND DATE(`order_time_stamp`) <= '".$e_date."'";

}
if( isset( $_REQUEST['orderstatusR'] ) && $_REQUEST['orderstatusR']!=""){
	$where[] = "status = '".$_REQUEST['orderstatusR']."'";

}
if( isset( $_REQUEST['useridreport'] ) && $_REQUEST['useridreport']!=""){
	$where[] = "(pack_staff = '".$_REQUEST['useridreport']."' OR del_staff = '".$_REQUEST['useridreport']."')";

}


if( isset( $where ) && is_array( $where ) && count( $where ) > 0 ){
	$where = "where ".implode(" AND ",$where );

}else{
		$where = "";

}


$allSet = $ketObj->runquery("SELECT", "id,userid,DATE(order_time_stamp),grossamount,discount,oaddress,status,pack_staff,del_staff,dis_method","ketechord_".$_SESSION['vid'], array(),$where );
/*$allSet = $ketObj->runquery("SELECT", "kord.id,DATE(kord.order_time_stamp),kord.grossamount,kord.discount,kord.oaddress,kord.status,kord.pack_staff,kord.del_staff,kord.dis_method,ku.uname,ku.uphone,ku.uemail", "ketechuser ku INNER JOIN ketechord_".$_REQUEST['vid']." kord ON ku.id = kord.userid", array(), " where ( DATE('kord.order_time_stamp') >= CURDATE( ) AND DATE('kord.order_time_stamp') <= CURDATE( ) ) OR kord.pack_staff = '".$_REQUEST['useridreport']."' OR kord.del_staff = '".$_REQUEST['useridreport']."' OR kord.status = '".$_REQUEST['orderstatusR']."'");*/
/*echo "<pre>";
print_r($allSet);
die();*/
if( isset( $allSet ) && is_array( $allSet)  && count( $allSet ) ){
	foreach( $allSet as $allSetV ){
		$OrderArray[$allSetV['id']]['orderid'] = $allSetV['id'];
		$OrderArray[$allSetV['id']]['date'] = $allSetV['DATE(order_time_stamp)'];
		$OrderArray[$allSetV['id']]['grossamount'] = $allSetV['grossamount'];
		if( $allSetV['dis_method'] == "instant" ){
			$OrderArray[$allSetV['id']]['discount'] = $allSetV['discount'];	
		}else{
			$OrderArray[$allSetV['id']]['discount'] = 0;		
		}
		
		$OrderArray[$allSetV['id']]['status'] = $allSetV['status'];
		$OrderArray[$allSetV['id']]['oaddress'] = $allSetV['oaddress']; 
	}
}

/*echo "<pre>";
print_r($OrderArray);
die();*/
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$list = array(
"OrderID,Date,GrossAmount,Discount,Status,UserAddress,PackingStaff,DeliveryStaff"
);
/*echo "<pre>";
print_r( $list );
die();*/
$file = fopen('php://output', 'w');
fputcsv($file,explode(',',$list['0']));
if( isset ( $OrderArray ) && is_array( $OrderArray ) && count( $OrderArray ) ){
foreach ($OrderArray as $line){
	fputcsv($file,$line);
}
}
fclose($file);

?>