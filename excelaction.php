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
							
							/*echo "<pre>";
							print_r( $fileData );
							die();*/
							$pcat = $fileData[0][12];
							$pcatlower = strtolower($fileData[0][12]);
							$pcatlower = $pcatlower.".jpg";
							$pcat_alias = trim(str_replace(" ","-",$fileData[0][12]));
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
								$sqlcat = "insert into ketechcat( cname,calias,clocation,cparent,cdate,cstatus )values('".$pcat."','".$pcat_alias."','".$clocation."',0 ,NOW(),0)";
								//echo $sqlcat."<br/>";
								//echo "<hr/>p";
								mysql_query( $sqlcat );
								$pcat_id = mysql_insert_id();
								if( file_exists("images/c/".$pcat_id."/index.html") ){
								
								}else{
							  			 mkdir("images/c/".$pcat_id);
							  			 $fp	=	fopen( "images/c/".$pcat_id."/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/c/".$pcat_id."/big/index.html") ){
								
								}else{
										mkdir("images/c/".$pcat_id."/big");
									   $fp	=	fopen( "images/c/".$pcat_id."/big/index.html", 'w');
									   fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/c/".$pcat_id."/thumb/index.html") ){
								
								}else{
										mkdir("images/c/".$pcat_id."/thumb");
							  			$fp	=	fopen( "images/c/".$pcat_id."/thumb/index.html", 'w');
							  			fwrite($fp, '<!DOCTYPE html><title></title>');
								}		
										
				
							   
								
							  
								
							
							
							$filePath='cimg/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$filetolower = strtolower( $file );
							/*echo $filetolower."<br>";
							echo $pcatlower."<br>";*/
							$count++;	
							$ext = pathinfo($file, PATHINFO_EXTENSION);
								
							if( $ext ==  "jpg")
							{
								if( $filetolower == $pcatlower )
								{	
									/*copy('cimg/'.$file,'images/c/'.$pcat_id.'/thumb/thumb_'.$pcat_id.'.jpg');
									copy('cimg/'.$file,'images/c/'.$pcat_id.'/big/big_'.$pcat_id.'.jpg');*/
									//echo "yes/<br/>";
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
							
							$ccat = $fileData[0][8];
							$ccatlower = strtolower($fileData[0][8]);
							$ccatlower = $ccatlower.".jpg";
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
								$sqlcat = "insert into ketechcat( cname,calias,clocation,cparent,cdate,cstatus  )values('".$ccat."','".$ccat_alias."','".$clocation."',".$pcat_id.",NOW(),0 )";
								//echo $sqlcat;
								//echo "<hr/>c";
								
								
								
									
								mysql_query( $sqlcat );
								$Ccat_id = mysql_insert_id();
								
								if( file_exists("images/c/".$Ccat_id."/index.html") ){
								
								}else{
										mkdir("images/c/".$Ccat_id);
							   			$fp	=	fopen( "images/c/".$Ccat_id."/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}		
								
								if( file_exists("images/c/".$Ccat_id."/big/index.html") ){
								
								}else{
										 mkdir("images/c/".$Ccat_id."/big");
							   			 $fp	=	fopen( "images/c/".$Ccat_id."/big/index.html", 'w');
							   			 fwrite($fp, '<!DOCTYPE html><title></title>');
								}		
								if( file_exists("images/c/".$Ccat_id."/thumb/index.html") ){
								
								}else{
										mkdir("images/c/".$Ccat_id."/thumb");
							  			$fp	=	fopen( "images/c/".$Ccat_id."/thumb/index.html", 'w');
							  			fwrite($fp, '<!DOCTYPE html><title></title>');
								}		
							   
								
							  
								
							
							
							$filePath='cimg/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$filetolower = strtolower( $file );
							/*echo $filetolower."<br>";
							echo $pcatlower."<br>";*/
							$count++;	
							$ext = pathinfo($file, PATHINFO_EXTENSION);
								
							if( $ext ==  "jpg")
							{
								if( $filetolower == $ccatlower )
								{	
									/*copy('cimg/'.$file,'images/c/'.$Ccat_id.'/thumb/thumb_'.$Ccat_id.'.jpg');
									copy('cimg/'.$file,'images/c/'.$Ccat_id.'/big/big_'.$Ccat_id.'.jpg');*/
									
									//echo "yes/<br/>";
									
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
								
								
								
							   //$pcat_id = mysql_insert_id();
							}
							
							$epname = explode(" ",$fileData[0][1]);
							$length = count( $epname  );
							if( $length > 1 ) 
							{
								$k = ( $length - 1 );
								unset( $epname[$k] );
								$pname = implode(" ",$epname );
							
							}
							
							$palias  = addslashes(trim(str_replace(" ","-",$fileData[0][1])));
							$prodlower = strtolower($pname);
							
							
							$pname = $fileData[0][1];
							$sqlproddup = "select * from ketechprod where palias = '".$palias."'";
							$resultp = mysql_query( $sqlproddup );
							if( !$resultp ) {
							//echo $sqlproddup;
							//echo "<hr/>"; 
							
							}
							$total = mysql_num_rows(  $resultp );
							if( $total > 0 )
							{
								$ProductArray = mysql_fetch_assoc( $result);
								$p_id = $ProductArray['id'];
								
								if( file_exists("images/p/".$p_id."/index.html") ){
								
								}else{
										mkdir("images/p/".$p_id);
							   			$fp	=	fopen( "images/p/".$p_id."/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/p/".$p_id."/big/index.html") ){
								
								}else{
										mkdir("images/p/".$p_id."/big");
							   			$fp	=	fopen( "images/p/".$p_id."/big/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/p/".$p_id."/thumb/index.html") ){
								
								}else{
									 	mkdir("images/p/".$p_id."/thumb");
							  			$fp	=	fopen( "images/p/".$p_id."/thumb/index.html", 'w');
							  			fwrite($fp, '<!DOCTYPE html><title></title>');
								}					
								
								
				
							  
								
							 
								
							
							
							$filePath='pimgb/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$tmpfile = str_replace("-"," ",$file);
							$filetolower = strtolower( $tmpfile );
							//echo $file."<br>";
							//echo $prodlower."<br>";
							$count++;	
							$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
								
							if( $ext ==  "jpg" || $ext ==  "png" || $ext ==  "jpeg")
							{
								if( $filetolower == $prodlower.".".$ext )
								{	
								
									
									copy('pimgb/'.$file,'images/p/'.$p_id.'/big/big_'.$p_id.'.jpg');
									echo "yes/b<br/>";
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
							
							$filePath='pimgt/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$tmpfile = str_replace("-"," ",$file);
							$filetolower = strtolower( $tmpfile );
							
							//echo $file."<br>";
							//echo $prodlower."<br>";
							$count++;	
							$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
								
							if( $ext ==  "jpg" || $ext ==  "png" || $ext ==  "jpeg")
							{
								if( $filetolower == $prodlower.".".$ext )
								{	
								
									copy('pimgt/'.$file,'images/p/'.$p_id.'/thumb/thumb_'.$p_id.'.jpg');
									
									echo "yes/t<br/>";
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
								
							}else
							{
								//insert parent cat
								$pname = addslashes( $pname );
								$sqlprod = "insert into ketechprod( pname,palias,pcategory,pstatus,p_parent_cat,sub_cat_text )values('".$pname."','".$palias."',".$Ccat_id." ,'0','".$pcat_id."','*".$Ccat_id."*')";
								//echo $sqlcat;
								//echo "<hr/>c";	
							$resultest	= mysql_query(  $sqlprod  );
								if( !$resultest ){
									/*echo $sqlprod;
									echo "</hr/>";*/
								}
								$p_id = mysql_insert_id();
								
								if( file_exists("images/p/".$p_id."/index.html") ){
								
								}else{
										mkdir("images/p/".$p_id);
							   			$fp	=	fopen( "images/p/".$p_id."/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/p/".$p_id."/big/index.html") ){
								
								}else{
										mkdir("images/p/".$p_id."/big");
							   			$fp	=	fopen( "images/p/".$p_id."/big/index.html", 'w');
							   			fwrite($fp, '<!DOCTYPE html><title></title>');
								}if( file_exists("images/p/".$p_id."/thumb/index.html") ){
								
								}else{
									 	mkdir("images/p/".$p_id."/thumb");
							  			$fp	=	fopen( "images/p/".$p_id."/thumb/index.html", 'w');
							  			fwrite($fp, '<!DOCTYPE html><title></title>');
								}					
								
								
				
							  
								
							 
								
							
							
							$filePath='pimgb/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$tmpfile = str_replace("-"," ",$file);
							$filetolower = strtolower( $tmpfile );
							//echo $file."<br>";
							//echo $prodlower."<br>";
							$count++;	
							$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
								
							if( $ext ==  "jpg" || $ext ==  "png" || $ext ==  "jpeg")
							{
								if( $filetolower == $prodlower.".".$ext )
								{	
								
									
									copy('pimgb/'.$file,'images/p/'.$p_id.'/big/big_'.$p_id.'.jpg');
									echo "yes/b<br/>";
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
							
							$filePath='pimgt/';
							//$dest = opendir('demoimag');  
							$dir = opendir($filePath);
							$count = 0;
							while ($file = readdir($dir)) { 
							$tmpfile = str_replace("-"," ",$file);
							$filetolower = strtolower( $tmpfile );
							
							//echo $file."<br>";
							//echo $prodlower."<br>";
							$count++;	
							$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
								
							if( $ext ==  "jpg" || $ext ==  "png" || $ext ==  "jpeg")
							{
								if( $filetolower == $prodlower.".".$ext )
								{	
								
									copy('pimgt/'.$file,'images/p/'.$p_id.'/thumb/thumb_'.$p_id.'.jpg');
									
									echo "yes/t<br/>";
								}
							}	
							
								//print_r( $file );
								//die();
							   
							  // $string[] = $file;
							
							}
								
							   //$pcat_id = mysql_insert_id();
							}
								/*if( $dataCounter > 150)
								{
								   die();
								 }  */
							
                        }
						
						
						
						/*echo "<pre>";
						print_r( $arrayCatPandC );
						echo "<hr/>";*/
						

?>

