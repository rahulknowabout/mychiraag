<?php  /*echo "<pre>";
 print_r( $_POST ); die();*/
if( isset( $_POST['chk'] ) && $_POST['chk'] == "catalias" )
{
	$cid	=	$_POST['cid'];
	$calias	=	$_POST['calias'];
	$allCat = $ketObj->runquery( "SELECT", "id", "ketechcat", array(), " WHERE calias='".$calias."' AND id<>'".$cid."'"  );
	if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else if( isset( $_POST['chk'] ) && $_POST['chk'] == "palias") 
{

	$pid	=	$_POST['pid'];
	$palias	=	$_POST['palias'];
	$allProd = $ketObj->runquery( "SELECT", "id", "ketechprod", array(), " WHERE palias='".$palias."' AND id<>'".$pid."'");
	if( isset( $allProd ) && is_array( $allProd ) && count( $allProd ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else if( isset( $_POST['chk'] ) && $_POST['chk'] == "customfld" )
{
	$cid		=	$_POST['cid'];
	$fldname	=	$_POST['fldname'];
	$allCat = $ketObj->runquery( "SELECT", "id", "ketechfld", array(), " WHERE fldname='".$fldname."' AND id<>'".$cid."'"  );
	if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else if( isset( $_POST['chk'] ) && $_POST['chk'] == "manfufalias" )
{
	$mid		=	$_POST['cid'];
	$malias	=	$_POST['malias'];
	$allManuf = $ketObj->runquery( "SELECT", "id", "ketechmanuf", array(), " WHERE malias='".$malias."' AND id<>'".$mid."'"  );
	if( isset( $allManuf ) && is_array( $allManuf ) && count( $allManuf ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else if( isset( $_POST['chk'] ) && $_POST['chk'] == "balias" )
{
	$bid		=	$_POST['bid'];
	$balias	=	$_POST['balias'];
	$allb = $ketObj->runquery( "SELECT", "id", "ketechbanner", array(), " WHERE alias='".$balias."' AND id<>'".$bid."'"  );
	if( isset( $allb ) && is_array( $allb ) && count( $allb ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else if( isset( $_POST['chk'] ) && $_POST['chk'] == "shipping" )
{
	$sid		=	$_POST['sid'];
	$minpa		=	$_POST['minpa'];
	$maxpa     =    $_POST['maxpa'];
	$vid     =    $_POST['vid'];
	//$balias	=	$_POST['balias'];
	$allb = $ketObj->runquery( "SELECT", "*", "ketechshipping", array(), " WHERE minpa ='".$minpa."' AND id<>'".$sid."' AND maxpa = '".$maxpa."' AND vid = ".$vid.""  );
	if( isset( $allb ) && is_array( $allb ) && count( $allb ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}else 	if( isset( $_POST['chk'] ) && $_POST['chk'] == "discount" )
{

	/*echo "<pre>";
    print_r( $_POST ); die();*/
	$sid		=	$_POST['sid'];
	$s_date		=	$_POST['s_date'];
	$e_date     =    $_POST['e_date'];
	if( $_POST['buscatid'] != "" )
	{
		
		$buscatid     =    $_POST['buscatid'];
	}else{
			$buscatid = "**".$sid."**";
	}
	if( $_POST['coupencode'] != "" )
	{
		
		$coupencode     =    $_POST['coupencode'];
	}else{
			$coupencode = "**".$sid."**";
	}
	if( $_POST['amt'] != "" )
	{
		
		$amt     =    $_POST['amt'];
	}else{
			$amt = "**".$sid."**";
	}$vid     =    $_POST['vid'];
	/*echo $buscatid."/".$coupencode."/".$amt."/".$vid ;
	die();*/
	//$balias	=	$_POST['balias'];
	$allb = $ketObj->runquery( "SELECT", "*", "ketechdiscount", array(), " WHERE s_date ='".$s_date."' AND id<>'".$sid."' AND e_date = '".$e_date."' AND (buscat = '".$buscatid."' OR coupencode = '".$coupencode."' OR amt = '".$amt."') AND vid = ".$vid.""  );
	//die();
	if( isset( $allb ) && is_array( $allb ) && count( $allb ) > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}
/*if( !isset( $_POST['idcp'] ) )
{
	$opt = "";
    $selbox = "";
	$pvalue = "";
	*/
/*if( isset( $_POST['idcc'])  ){
	//echo "<pre>"; print_r($_POST);
	
	//echo $_POST['productCat'];
	$opt = "";
    $selbox = "";
	
	$whe = "where cparent = ".$_POST['idcc']."";
	
	$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), $whe  );
	if( isset( $allCat ) && count( $allCat ) > 0 && !isset( $flag ))
	{
	 foreach( $allCat as $CatParentKey => $CatParentValue ) {  			
       $opt = $opt.'<option value="'.$CatParentValue['id'].'">'.$CatParentValue['cname'].'</option>';
	   }
	
	 $selbox = '<select name="Catsecond[]" onchange="CatAjax(this.value)">
                <option value="0"> Chosse Category </option>'.$opt.'</select>';
				
}
	$returnc['sel'] = $selbox;
    $returnc['selid'] = $_POST['idcc'];
	echo json_encode( $returnc );

}*/

if( isset( $_POST['idcc']) &&  $_POST['idcc']>0  ){
	//echo "<pre>"; print_r($_POST);
	
	//echo $_POST['productCat'];
	$opt = "";
    $selbox = "";
	
	$whe = "where cparent = ".$_POST['idcc']."";
	
	$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), $whe  );
	if( isset( $allCat ) && count( $allCat ) > 0 && !isset( $flag ))
	{
	 foreach( $allCat as $CatParentKey => $CatParentValue ) {  			
       $opt = $opt.'<option value="'.$CatParentValue['id'].'">'.$CatParentValue['cname'].'</option>';
	   }
	  if( isset( $_POST['search'] ) && $_POST['search'] == "y" )
	  { $selbox = '<select name="Catsecond[]" onchange="CatAjax(this.value)" class = "form-control">
	  	<option value="0"> Chosse Sub Category </option>'.$opt.'</select>';
	  }else { $selbox = '<select name="Catsecond[]" onchange="CatAjax(this.value) ">
	  		  <option value="0"> Chosse Sub Category </option>'.$opt.'</select>';
	 } 
	}
	if( isset( $_POST['search'] ) && $_POST['search'] == "y" ){
		if( $selbox != "" )
		{
			$returnc['sel'] = $selbox.'	<span class="input-group-btn"><button class="btn btn-default" type="submit">Go!</button></span>';
		}else{
				$returnc['sel'] = $selbox;
		
		}	
	}else{
		$returnc['sel'] = $selbox;
	}
	
    $returnc['selid'] = $_POST['idcc'];
	echo json_encode( $returnc );

}


if( isset( $_POST['idc'])  ){
	//echo "<pre>"; print_r($_POST);
	//echo $_POST['productCat'];
	$opt = "";
    $selbox = "";
	$pvalue = "";
	$whe = "where cparent = ".$_POST['idc']." AND cstatus = 1";
	
	$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), $whe  );
	if( isset( $allCat ) && count( $allCat ) > 0 && !isset( $flag ))
	{
	 foreach( $allCat as $CatParentKey => $CatParentValue ) {  			
       $opt = $opt.'<option value="'.$CatParentValue['id'].'">'.$CatParentValue['cname'].'</option>';
	   }
	
	 $selbox = '<select name="Catsecond[]" onchange="CatAjax(this.value)" class = "form-control">
                <option value="0"> Chosse Category </option>'.$opt.'</select>';
	}

	else
	{
		//$selbox = "dfffffffffffffff";
		$flag = 1;
		$whe = "where pcategory = '".$_POST['idc']."' AND pstatus = 1	";
		$allProd = $ketObj->runquery( "SELECT", "id,pname", "ketechprod", array(), $whe );
		
			if( isset( $allProd ) && count( $allProd )>0 )
			{
				foreach( $allProd as $ProdParentKey => $ProdParentValue ) {  			
                $opt = $opt.'<option value="'.$ProdParentValue['id'].'">'.$ProdParentValue['pname'].'</option>';
		    }
			    $selbox = '<option value="0"> Chosse Product </option>'.$opt;
				$pvalue = "yes";
				
	   }
	  
	   
	}
	$return['product'] = $pvalue;
	$return['sel'] = $selbox;
    $return['selid'] = $_POST['idc'];
	echo json_encode( $return );
}		
if( isset( $_POST['chk'] ) && $_POST['chk'] == "vemail" )
{
	$uid	=	$_POST['uid'];
	$vemail	=	$_POST['vemail'];
	$totalu = $ketObj->runquery( "SELECT", "uemail", "ketechuser", array(), " WHERE uphone='".$vemail."' AND id<>'".$uid."'","num_rows");
	if( $totalu > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}
if( isset( $_POST['vp'] ) && $_POST['vp'] == "vendor" )
{  /* echo "<pre>";print_r( $_POST);die();*/
	$pid	=	$_POST['pid'];
	$vid =      $_POST['vid'];
	$vpid =     $_POST['vpid'];
	//$vemail	=	$_POST['vemail'];
	$totalu = $ketObj->runquery( "SELECT", "pid", "ketechvp_".$vid."", array(), " WHERE pid='".$pid."' AND id<>'".$vpid."'","num_rows");
	if( $totalu > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}
if( isset( $_POST['chk'] ) && $_POST['chk'] == "cityname" )
{   /*echo "<pre>";print_r( $_POST);die();*/
	$cid	=	$_POST['cid'];
	$cityname =      $_POST['cityname'];
	//$vemail	=	$_POST['vemail'];
	$totalu = $ketObj->runquery( "SELECT", "city_name", "ketechvendorcity", array(), " WHERE city_name='".$cityname."' AND id<>'".$cid."'","num_rows");
	if( $totalu > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}
if( isset( $_POST['chk'] ) && $_POST['chk'] == "areaname" )
{  /* echo "<pre>";print_r( $_POST);die();*/
	$cid	=	$_POST['cid'];
	$areaname =      $_POST['areaname'];
	//$vemail	=	$_POST['vemail'];
	$totalu = $ketObj->runquery( "SELECT", "area_name", "ketechvendorarea", array(), " WHERE area_name='".$areaname."' AND id<>'".$cid."'","num_rows");
	if( $totalu > 0 )
	{
		echo "yes";
	}else
	{
		echo "no";
	}
}
?>