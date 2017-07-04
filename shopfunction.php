<?php
class ketech
{
	function ketech()
	{
		$allSet = $this->runquery( "SELECT", "*", "ketechset"  );
		$_SESSION['config']	=	$allSet[0];
	}
	function runquery( $qtype="",$scol = "",$tablename="",$sva = array(),$whe="",$extra = "" )
	{
		if($qtype == "SELECT") {
			 $sql = $qtype." ".$scol." FROM ".$tablename." ".$whe."";
			/* echo $sql;
			 echo "<hr/>";	*/
			 //die();
			 $qry = mysql_query($sql);
			 if( $extra == "num_rows") {
				return mysql_num_rows($qry);
			 }
			 else {
			 	if( mysql_num_rows( $qry ) > 0 )
				{
					//$results = mysql_fetch_assoc($qry);
					while ( $row = mysql_fetch_assoc( $qry ) )
					{
						$rowa[] = $row;
					}
				}
				
				if( isset( $rowa ) ) {
				return $rowa;	
				}
			}					 
		}							  
									   
		if($qtype == "INSERT") {
			 foreach($sva as $k => $v) {
				$colf[] = trim($k);
				if( $v == "NOW()" )
				{
					$colv[] =  addslashes(trim($v));	
				}else
				{
					$colv[] = "'".trim($v)."'";	
				}
			 }	
			$strf = implode(",",$colf);
			ltrim($strf,",");
			$strv = implode(",",$colv);
			ltrim($strv,",");
			$qer = $qtype.' INTO '.$tablename.'('.$strf.')VALUES('.$strv.')';
			//echo $qer;
			//die();
			
			$result = mysql_query($qer);
			$result	=	mysql_insert_id();
			return $result;
			}
		  if($qtype == "UPDATE") {
			foreach($sva as $k => $v) {
				$sup[] = trim($k)."=".trim("'".$v."'");
			}
			$svp = implode(",",$sup);
			ltrim($svp,",");
			$qer = ''.$qtype.' '.$tablename.' SET '.$svp.' '.$whe.'';
			//echo $qer;
			//die();
			$result = mysql_query($qer);
			}
	
		if($qtype == "DELETE") {
		$qer = "".$qtype." ".$scol." FROM ".$tablename." ".$whe."";	
		//echo $qer;
		//die();
		$result = mysql_query($qer);
		}
		if( $qtype == "ALTER") {
		$qer = "".$qtype." TABLE ".$scol." ".$tablename." ".$whe."";
		$result = mysql_query($qer);
		}
		//echo "<pre>"; print_r($_REQUEST);
		//echo $qer."<hr><hr>";
	}
	function imageresize($max_width,$max_height,$image){

		$dimensions=getimagesize($image);
		if( $dimensions[0] < $max_width )
		{
			return "noChange";
		}
		$width_percentage=$max_width/$dimensions[0];
		$height_percentage=$max_height/$dimensions[1];
		if($width_percentage <= $height_percentage){

		$new_width=$width_percentage*$dimensions[0];

		$new_height=$width_percentage*$dimensions[1];

		}else{

		$new_width=$height_percentage*$dimensions[0];

		$new_height=$height_percentage*$dimensions[1];

		}

		

		$new_image=array($new_width,$new_height);

		return $new_image;

	}
	function createThumbnail($img, $imgPath, $suffix, $newWidth, $newHeight, $quality)
	{
		//echo "<pre>"; print_r($img); die();
	  // Open the original image.
	
	  $original = imagecreatefromjpeg("$img") or die("Error Opening original (<em>$imgPath/$img</em>)");
	
	  list($width, $height, $type, $attr) = getimagesize("$img");
	
	 
	
	  // Resample the image.
	
	  $tempImg = imagecreatetruecolor($newWidth, $newHeight) or die("Cant create temp image");
	
	  imagecopyresized($tempImg, $original, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height) or die("Cant resize copy");
	
	 
	
	  // Save the image.
	
	  imagejpeg($tempImg, "$imgPath", $quality) or die("Cant save image");
	
	 
	
	  // Clean up.
	
	  imagedestroy($original);
	
	  imagedestroy($tempImg);
	
	  return true;
	
	}
}
?>