<?php 
error_reporting(0);
include('condb.php');
	/*echo "<pre>";
	print_r( $_FILES );
	die();*/

	
                        $inputFileName = $_FILES['xlsFile']['tmp_name'];
                        //  Read your Excel workbook
                        try {
                            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                            $objPHPExcel = $objReader->load($inputFileName);
                        } catch (Exception $e) {
                            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' . $e->getMessage());
                        }

                        $sheet            =    $objPHPExcel->getSheet(0);
                        $highestRow        =    $sheet->getHighestRow();
                        $highestColumn    =    $sheet->getHighestColumn();
						
						

                        $headingFlg            =    0;
                        $headChkColumn        =    0;
                        $headingData        =    array();
                        $dataCounter        =   1;
                        for ( $row = 2; $row <= $highestRow; $row++ )
                        {
							if( ( $dataCounter%2 ) == 0 )
							{
								$clocation = "left";
							
							}else{
									$clocation = "right";
							
							}
							$dataCounter++; 
                            $fileData        =    $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE );
							
							$pcat = $fileData[0][8];
							$pcat_alias = trim(str_replace(" ","-",$fileData[0][8]));
							$sqlcatdup = "select * from ketechcat where calias = '".$pcat_alias."'";
							$result = mysql_query( $sqlcatdup );
							$total = mysql_num_rows(  $result );
							//$total = 0;
							
							if( $total > 0 )
							{
								
								$Pcat = mysql_fetch_assoc( $result);
								$pcat_id = $Pcat['id']; 
							}else
							{
								//insert parent cat
								$sqlcat = "insert into ketechcat( cname,calias,clocation,cparent,cdate,cstatus )values('".$pcat."','".$pcat_alias."','".$clocation."',0 ,NOW(),1)";
								//echo $sqlcat."<br/>";
								//echo "<hr/>p";
								mysql_query( $sqlcat );
								$pcat_id = mysql_insert_id();
							}
							
							
							
							$ccat = $fileData[0][10];
							$ccat_alias = str_replace(" ","-",$ccat);
							$sqlcatdup = "select * from ketechcat where calias = '".$ccat_alias."'";
							//echo $sqlcatdup;
							//echo "<hr/>sqlcatdupC";
							$result = mysql_query( $sqlcatdup );
							$total = mysql_num_rows(  $result );
							//
							if( $total > 0 )
							{
								$Ccat = mysql_fetch_assoc( $result);
								$Ccat_id = $Ccat['id'];
								
							}else
							{
								//insert parent cat
								$sqlcat = "insert into ketechcat( cname,calias,clocation,cparent,cdate,cstatus  )values('".$ccat."','".$ccat_alias."','".$clocation."',".$pcat_id.",NOW(),1 )";
								//echo $sqlcat;
								//echo "<hr/>c";	
								mysql_query( $sqlcat );
								$Ccat_id = mysql_insert_id();
							   //$pcat_id = mysql_insert_id();
							}
							
							$pname = $fileData[0][1];
							$palias  = trim(str_replace(" ","-",$fileData[0][1]));
							$sqlproddup = "select * from ketechprod where palias = '".$palias."'";
							//echo $sqlproddup;
							//echo "<br/>";
							$resultp = mysql_query( $sqlproddup );
							$total = mysql_num_rows(  $resultp );
							/*echo "<hr/>";
							echo $total;*/
							if( $total > 0 )
							{
								$ProductArray = mysql_fetch_assoc( $resultp);
								/*echo "<pre>";
								print_r( $ProductArray );*/
								$p_id = $ProductArray['id'];
								
							}else
							{
								//insert parent cat
								$sqlprod = "insert into ketechprod( pname,palias,pcategory,p_parent_cat,sub_cat_text )values('".$pname."','".$palias."',".$Ccat_id." ,'".$pcat_id."','*".$Ccat_id."*')";
								//echo $sqlcat;
								//echo "<hr/>c";	
								mysql_query( $sqlprod );
								$p_id = mysql_insert_id();
							  
							}
							
/*

			For MyStore work Start

*/

$ART_NO = $fileData[0][0];
$SUPPL_NO = $fileData[0][2];
$SUPPL_NAME = $fileData[0][3];
$SUPPL_ART_NO = $fileData[0][4];
$BUYER_UID = $fileData[0][5];
$CONT_BUY_UNIT = $fileData[0][6];
$ART_GRP_NO = $fileData[0][7];
$ART_GRP_DESCR = $fileData[0][8];
$ART_GRP_SUB_NO = $fileData[0][9];
$ART_GRP_SUB_DESCR = $fileData[0][10];
$DEPT_NO	 = $fileData[0][11];
$DEPT_DESCR = $fileData[0][12];
$SELL_PR	 = $fileData[0][13];
$SELL_VAT = $fileData[0][14];
$SPAT	 = $fileData[0][15];
$MRP_PRICE = $fileData[0][16];
$VAT_MY = $fileData[0][17];
$BUY_VAT_NO = $fileData[0][18];
$BUY_VAT_PERC = $fileData[0][19];
$Offer_No = $fileData[0][20];
$DMS = $fileData[0][21];
$stock = $fileData[0][22];
$ON_ORDER = $fileData[0][23];
$LAST_DELDAY = $fileData[0][24];
$LAST_SALEDAY = $fileData[0][25];
$MFG_Date = $fileData[0][26];
$Exp_Date = $fileData[0][27];
$ART_STATUS = $fileData[0][28];
$STORE = $fileData[0][29];

							$sqlcatdup = "select * from ketechvp_".$_SESSION['vid']." where pid = '".$p_id."'";
							$result = mysql_query( $sqlcatdup );
							$total = mysql_num_rows(  $result );
							if( $total > 0 )
							{
								
								
							}else
							{
							
$vpArray['pid'] = 	    $p_id;
$vpArray['b_cat'] = 	$Ccat_id;
$vpArray['p_cat'] = 	$pcat_id;
$vpArray['sub_cat_text'] = 	"*".$Ccat_id."*";
$vpArray['vid'] = 	$_SESSION['vid'];
$vpArray['baseprice'] = 	$MRP_PRICE;
$vpArray['sellprice'] = 	$MRP_PRICE;
$vpArray['modify_baseprice'] = 	0;
$vpArray['modify_sellprice'] = 	0;
$vpArray['admin_approval'] = 	1;
$vpArray['f_product'] = 	0;
$vpArray['mpq_fp'] = 	1;
$vpArray['stock'] = 	$stock;
$vpArray['status'] = 	$p_id;
$vpArray['max_buy_limit'] = 	100;
$vpArray['ART_NO'] = 	$ART_NO;
$vpArray['SUPPL_NO'] = 	$SUPPL_NO;
$vpArray['SUPPL_NAME'] = 	$SUPPL_NAME;
$vpArray['SUPPL_ART_NO'] = 	$SUPPL_ART_NO;
$vpArray['BUYER_UID'] = 	$BUYER_UID;
$vpArray['CONT_BUY_UNIT'] = 	$CONT_BUY_UNIT;
$vpArray['ART_GRP_NO'] = 	$ART_GRP_NO;
$vpArray['ART_GRP_DESCR'] = 	$ART_GRP_DESCR;
$vpArray['ART_GRP_SUB_NO'] = 	$ART_GRP_SUB_NO;
$vpArray['ART_GRP_SUB_DESCR'] = 	$ART_GRP_SUB_DESCR;
$vpArray['DEPT_NO'] = 	$DEPT_NO;
$vpArray['DEPT_DESCR'] = 	$DEPT_DESCR;
$vpArray['SELL_PR'] = 	$SELL_PR;
$vpArray['SELL_VAT'] = 	$SELL_VAT;
$vpArray['SPAT'] = 	$SPAT;
$vpArray['MRP_PRICE'] = 	$MRP_PRICE;
$vpArray['VAT_MY'] = 	$VAT_MY;
$vpArray['BUY_VAT_NO'] = 	$BUY_VAT_NO;
$vpArray['BUY_VAT_PERC'] = 	$BUY_VAT_PERC;
$vpArray['Offer_No'] = 	$Offer_No;
$vpArray['DMS'] = 	$DMS;
$vpArray['ON_ORDER'] = 	$ON_ORDER;
$vpArray['LAST_DELDAY'] = 	$LAST_DELDAY;
$vpArray['LAST_SALEDAY'] = 	$LAST_SALEDAY;
$vpArray['MFG_Date'] = 	$MFG_Date;
$vpArray['Exp_Date'] = 	$Exp_Date;
$vpArray['ART_STATUS'] = 	$ART_STATUS;
$vpArray['STORE'] = 	$STORE;
$vpK = array();
$vpV = array();
foreach(  $vpArray as $vpArrayK => $vpArrayV )
{
	$vpK[] = $vpArrayK;
	$vpV[] = "'".$vpArrayV."'";

}

$queryk =implode(",",$vpK);
$queryv = implode(",",$vpV);

/*echo $queryk;
echo "<hr/>";
echo $queryv;
echo "<pre>";*/
/*echo count( $vpArray );
print_r( $vpV );*/
					
								//insert parent cat
								/*$sqlVprod = "insert into ketechvp_clone( pid,b_cat,p_cat,sub_cat_text,baseprice,sellprice,modify_baseprice,modify_sellprice,admin_approval,stock,status,ART_NO,SUPPL_NO,SUPPL_NAME,SUPPL_ART_NO,BUYER_UID,CONT_BUY_UNIT,ART_GRP_NO,ART_GRP_DESCR,ART_GRP_SUB_NO,ART_GRP_SUB_DESCR,DEPT_NO,DEPT_DESCR,SELL_PR,SELL_VAT,SPAT,MRP_PRICE,VAT_MY,BUY_VAT_NO,BUY_VAT_PERC,Offer_No,DMS,ON_ORDER,LAST_DELDAY,LAST_SALEDAY,MFG_Date,Exp_Date,ART_STATUS,STORE)values(".$p_id.",'".$Ccat_id."','".$pcat_id."','*".$Ccat_id."*',".$MRP_PRICE.",".$MRP_PRICE.",'0','0',1,'".$stock."',1,'".$ART_NO."','".$SUPPL_NO."','".$SUPPL_NAME."','".$BUYER_UID."','".$CONT_BUY_UNIT."','".$ART_GRP_NO."','".$ART_GRP_DESCR."','".$ART_GRP_SUB_NO."','".$ART_GRP_SUB_DESCR."','".$DEPT_NO."','".$DEPT_DESCR."','".$SELL_PR."','".$SELL_VAT."','".$SPAT."','".$MRP_PRICE."','".$VAT_MY."','".$BUY_VAT_NO."','".$BUY_VAT_PERC."','".$Offer_No."','".$DMS."','".$ON_ORDER."','".$LAST_DELDAY."','".$LAST_SALEDAY."','".$MFG_Date."','".$Exp_Date."','".$ART_STATUS."','".$STORE."')";*/
								
								$sqlVprod = "insert into ketechvp_".$_SESSION['vid']."(".$queryk.")values(".$queryv.")";
								
								/*echo $sqlVprod;
								echo "<hr/>";	*/
								mysql_query( $sqlVprod );
								//$p_id = mysql_insert_id();
							   //$pcat_id = mysql_insert_id();
							}
							
							
							/*echo "<pre>";
							print_r( $fileData );*/
							//die();
							
							/*echo "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$_SESSION['vid']."";
							echo "<hr/>";*/
						  
							
								if( $dataCounter >  15 )
								{
								   die();
								 }  
							
                        }
						
						header( "Location: index.php?v=".$_POST['c']."&f=".$_POST['f']."&vid=".$_SESSION['vid']."" );
						
						/*echo "<pre>";
						print_r( $arrayCatPandC );
						echo "<hr/>";*/
						

?>

