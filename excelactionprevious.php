<?php 
error_reporting(E_ALL);
include('condb.php');
	/*echo "<pre>";
	print_r( $_FILES );
	die();*/

	require_once( 'PHPExcel/Classes/PHPExcel/IOFactory.php' );
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
							$pcatlower = strtolower($fileData[0][8]);
							$pcatlower = $pcatlower."jpg";
							$pcat_alias = trim(str_replace(" ","-",$fileData[0][8]));
							$sqlcatdup = "select * from ketechcatclone where calias = '".$pcat_alias."'";
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
								$sqlcat = "insert into ketechcatclone( cname,calias,clocation,cparent,cdate,cstatus )values('".$pcat."','".$pcat_alias."','".$clocation."',0 ,NOW(),1)";
								//echo $sqlcat."<br/>";
								//echo "<hr/>p";
								mysql_query( $sqlcat );
								$pcat_id = mysql_insert_id();
								
							   mkdir("../images/c/".$pcat_id);
							   $fp	=	fopen( "../images/c/".$pcat_id."/index.html", 'w');
							   fwrite($fp, '<!DOCTYPE html><title></title>');
				
							  mkdir("../images/c/".$pcat_id."/big");
							  $fp	=	fopen( "../images/c/".$allSet."/big/index.html", 'w');
							  fwrite($fp, '<!DOCTYPE html><title></title>');
								
							mkdir("../images/c/".$pcat_id."/thumb");
							$fp	=	fopen( "../images/c/".$pcat_id."/thumb/index.html", 'w');
							fwrite($fp, '<!DOCTYPE html><title></title>');
								
							
							
							$filePath='cimg/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$filetolower = strtolower( $file );
							//echo $file."<br>";
							//$count++;	
							$ext = pathinfo($file, PATHINFO_EXTENSION);
								
							if( $ext ==  "jpg")
							{
								if( $filetolower == $pcatlower )
								{	
									copy('cimg/'.$file,'images/c/'.$pcat_id.'/thumb/thumb_'.$pcat_id.'.jpg');
									echo "yes/<br/>";
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
							}
							
							/*if($dataCounter>10)
							{
								echo $dataCounter; die();
							}*/
							
							$ccat = $fileData[0][10];
							$ccat_alias = str_replace(" ","-",$ccat);
							$sqlcatdup = "select * from ketechcatclone where calias = '".$ccat_alias."'";
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
								$sqlcat = "insert into ketechcatclone( cname,calias,clocation,cparent,cdate,cstatus  )values('".$ccat."','".$ccat_alias."','".$clocation."',".$pcat_id.",NOW(),1 )";
								//echo $sqlcat;
								//echo "<hr/>c";	
								mysql_query( $sqlcat );
								$Ccat_id = mysql_insert_id();
							   //$pcat_id = mysql_insert_id();
							}
							
							$pname = $fileData[0][1];
							$palias = $pcat_alias = trim(str_replace(" ","-",$fileData[0][1]));
							$sqlproddup = "select * from ketechprodclone where palias = '".$palias."'";
							$resultp = mysql_query( $sqlproddup );
							$total = mysql_num_rows(  $resultp );
							if( $total > 0 )
							{
								$ProductArray = mysql_fetch_assoc( $result);
								$p_id = $ProductArray['id'];
								
							}else
							{
								//insert parent cat
								$sqlprod = "insert into ketechprodclone( pname,palias,pcategory,p_parent_cat,sub_cat_text )values('".$pname."','".$palias."',".$Ccat_id." ,'".$pcat_id."','*".$Ccat_id."*')";
								//echo $sqlcat;
								//echo "<hr/>c";	
								mysql_query( $sqlprod );
								$p_id = mysql_insert_id();
							   //$pcat_id = mysql_insert_id();
							}
								if( $dataCounter >  15 )
								{
								   die();
								 }  
							
                        }
						
						
						
						/*echo "<pre>";
						print_r( $arrayCatPandC );
						echo "<hr/>";*/
						

?>

