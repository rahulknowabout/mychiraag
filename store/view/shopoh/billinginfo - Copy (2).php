<?php
require_once("../../control/condb.php" );
require_once("../../control/shopfunction.php" );
$ketObj	=	new ketech();
?>

<?php
/*echo "<pre>";
print_r( $_REQUEST );
die();*/
function GenrateBill($id = array(),$vid = array(),$ketObj ){
$where = " where kord.id = ".$id."";
$BillInfo= $ketObj->runquery( "SELECT", "kord.same_productdetails,kord.mobile,kord.order_time_stamp,kord.shipping_value,kord.oaddress,kord.grossamount,kord.discount,kord.finalamount,kord.payment,kord.dis_type,kord.dis_method,kord.dis_value,kord.coupon_code,kord.tqty,ku.uname", "ketechord_".$vid." kord INNER JOIN ketechuser ku ON ku.id = kord.userid", array(),$where );

$arrayPD = json_decode($BillInfo['0']['same_productdetails'],true);
/*echo "<pre>";
print_r( $arrayPD );
die();*/

if( $BillInfo['0']['dis_method'] == "instant" ){ 
							$discount =  $BillInfo['0']['dis_value'];
					  }else{
					  		$discount =  "0";
					  }
$finalamount = 	$BillInfo['0']['grossamount'] + $BillInfo['0']['shipping_value'] - $discount;				  

$pdfBill = "<table width=\"70%\">
	<thead>
		<th align=\"right\">
			Bill Information
		</th>
	</thead>	
	
	<tbody>
		<tr>
			<td><table width = \"100%\">
					<tr>
						<td>
							NAME
						</td>
						<td>
							".$BillInfo['0']['uname']."
						</td>
					</tr>
					
					<tr>
			<td>
				ADDRESS
			</td>
			<td>
				".$BillInfo['0']['oaddress']."
			</td>
		</tr>
		
		<!--<tr>
			<td>
				Shipping 
			</td>
			<td>
				".$BillInfo['0']['shipping_value']."
			</td>
		</tr>-->
		
		<tr>
			<td>
				Order Date
			</td>
			<td>
				".$BillInfo['0']['order_time_stamp']."
		</tr>
			</table>
			</td>
			
			<td><table width = \"100%\">
				<tr>
					<td>
						Company Name:
					</td>
					<td>
						MYCHIRAAG
					</td>
				</tr>
				<tr>
					<td>
						Address:
					</td>
					<td>
						MYCHIRAAG Address
					</td>
			 </tr>
				
				</table>
			</td>
		</tr>
		
	</tbody>
</table>

<table  border=\"1\" style = \"border-collapse:collapse;width:70%\">
	<thead>
		<tr>	
			<th>
				Product Name
			</th>
			<!--<th>
				 Category
			</th>-->
			<!--<th>
				Base Price
			</th>-->
			
			<th>
				Sell Price
			</th>
			
			<th>
				Qty
				
			</th>
			<th>
				Total
			</th>
			
		</tr>	
	</thead>
	
	<tbody>";
	
	$tmphold_first = "";
				foreach( $arrayPD['0'] as $arrayPDV  ) {
				
				
				$singlePtotal = $arrayPDV['quantity']*$arrayPDV['saleprice'];
		
		$tmphold_first .= "<tr>
				<td>
					 ".$arrayPDV['name']."  
				</td>
				
				
				
				<td>
					".$arrayPDV['saleprice']." 
				</td>
				
				<td>
					 ".$arrayPDV['quantity']." 
				</td>
				
				<td>
					".$singlePtotal."
				</td>
		</tr>";
		
		
				
		
}
		
		
		$tmphold_second = "<tr>
			<td colspan=\"3\" align=\"right\">
				Total
			</td>
			<td>
				 ".$BillInfo['0']['grossamount']."
			</td>
		</tr>
		<tr>
			<td colspan=\"3\" align=\"right\">
				Discount
			</td>
			<td>
				
				".$discount."
			</td>
		</tr>
		
		<tr>
			<td colspan=\"3\" align=\"right\">
				Shipping
			</td>
			<td>
				".$BillInfo['0']['shipping_value']."
			</td>
		</tr>
		<tr>
			<td colspan=\"3\" align=\"right\">
				Payable
			</td>
			<td>
				".$finalamount."
			</td>
		</tr>			
			
		
		
	</tbody>	

</table>";

return $pdfBill."".$tmphold_first.""."".$tmphold_second;
}

echo GenrateBill($_REQUEST['id'],$_REQUEST['vid'],$ketObj);
?>

