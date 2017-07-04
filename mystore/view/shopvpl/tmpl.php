<script>
function CatAjax( str,par )
{
	//alert("dffff");
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('search', 'y');
	data.append('idcc',str);
	if( par == 'p' ){
			document.getElementById("div123").innerHTML = "";
	}
	//alert(data);
	//alert("xjcjcjcjc");
	
	//var params = "aj=y&artc="+str;
	//alert( str );
	 if (str == "") {
	                    
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
	
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
		//document.getElementById("div123c").style.display ="block";
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert(xmlhttp.responseText);
				     try
                        {
                            chkJson            =    JSON.parse( xmlhttp.responseText );
                        } catch( exception )
                        {
                            chkJson            =    null;
                        }
                        if(chkJson['sel'] == "")
                        {
							
							busscatid = chkJson['selid'];
							var input = document.createElement("input");

                            input.setAttribute("type", "hidden");

                            input.setAttribute("name", "buscatid");

                            input.setAttribute("value", busscatid);
							document.getElementById("addeditc").appendChild(input);
                            //append to form element that you want .

                        	
                        }else
                        {
                        	document.getElementById("div123").innerHTML+=chkJson['sel'];
							document.getElementById("div123c").style.display ="block";
                        }
				            
						}else
			            {
			
			            }
        }
		//alert( "index.php?aj=y&artc="+str);
		
        xmlhttp.open("POST","index.php",true);
	
        xmlhttp.send(data);
    }
	
}
</script>
<?php
if( isset($_REQUEST['status'] )  && isset($_REQUEST['ids']) && $_REQUEST['ids']>0){
		if( $_REQUEST['status'] < 1  ){
			$ketechloc['status'] = 1;
			$allSet = $ketObj->runquery("UPDATE", "", "ketechvp_".$_SESSION['vid'], $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
		}else{
			$ketechloc['status'] = 0;
			$allSet = $ketObj->runquery("UPDATE", "", "ketechvp_".$_SESSION['vid'], $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
		}

	}
function paginate( $path,$hold ) {
	if( ( $hold%25 ) == 0 ){
		$total = $hold/25;
	}
    else {
    	$total = ($hold/25)+1;
     }
	 $returnp =   '<ul class = "pagination">';
	 if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>1 ) {
	 	$pre = $_REQUEST['avid']-1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$pre.'">Previous</a></li>';
	}
     for( $i = 1; $i <= $total; $i++ ) {
	 	$iset = strlen( (string)$i );
		if( $iset<3 && $iset>1 ){
			$iset = "0".$i;
		}else if( $iset<3 ){
			$iset = "00".$i;
		}else{
				$iset = $i;
		}
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$i.'">'.$iset.'</a></li>';
	 }
	if( isset( $_REQUEST['avid'] ) &&  $_REQUEST['avid']<=($total-1) && $_REQUEST['avid']!="" ) {
		$nex = $_REQUEST['avid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}

$searchbyproduct = "";
$p_parent_cat = "";
$buscatid = "";
$allPcat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), "where cstatus = 1"  );
if( isset( $allPcat ) && count( $allPcat )>0 )
{

foreach( $allPcat as $allCatKey => $allCatValue)
{
	if( $allCatValue['cparent'] == 0 )
	{
		$allCatParent['parent'][] = $allCatValue['cname']."/".$allCatValue['id'];
	
		
	}
	
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 )
{	
	if( $allCatValue['id'] == $_REQUEST['productCat'] ) {
	
			$p_parent_cat = $allCatValue['cname'];
	}		
}

if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] > 0 )
{
	
	if( $allCatValue['id'] == $_REQUEST['buscatid'] ) {
	
			$buscatid = $allCatValue['cname'];
	}	
	
}
	
	
	
}
}

$where = array();
if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct']!="" )
{
	$searchbyproduct = $_REQUEST['searchbyproduct'];
	
	$where[] = "kp.pname like '%".$_REQUEST['searchbyproduct']."%'";
}	
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 )
{	
	$where[] = "kp.p_parent_cat = '".$_REQUEST['productCat']."'";
}
	
		/*if( isset( $_POST['Catsecond'] ) && is_array($_POST['Catsecond']) && count( $_POST['Catsecond'] )  > 0 )
		{
			$arraysearch = $_POST['Catsecond'];
			foreach( $arraysearch as $ASV  )
			{
				if( $ASV > 0 )
				{
				
				}
			}
		}*/
		
if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] > 0 )
{
	$where[] = "kp.pcategory = '".$_REQUEST['buscatid']."'";
}

if( count( $where ) > 0 )
{
		$where = " WHERE ".implode( " AND ", $where );	
}else{
		$where = "";
}
	
	if(  isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] == "publish"){
		
		if( $where != "" ){
			$where .= " AND kvp.status = 1";
		}else{
				$where = " where kvp.status = 1";
		}
			
		
	}else if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] == "lowstock") {
	
				if( $where != "" ){
					$where .= " AND kvp.stock < 10 AND kvp.stock > 0 ";
		}else{
				$where = " where kvp.stock < 10 AND kvp.stock > 0 ";
		}
				
		 }else if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] == "empty" ) {		
					
					if( $where != "" ){
					$where .= " AND kvp.stock = 0 ";
					}else{
							$where = " where kvp.stock = 0";
					}
					
				}
	
if( is_array($where) && !(count($where)>0) ) {
	$where = "";
}
	


$Count = $ketObj->runquery( "SELECT","count(*)", "ketechvp_".$_SESSION['vid']." kvp INNER JOIN ketechprod kp ON kvp.pid = kp.id", array(),$where);
$hold = $Count['0']['count(*)'];
$counter = 1;
if(isset($_GET['avid']) && $_GET['avid']!="") {
	$vid1 = ($_GET['avid']-1)*25;
	$counter= $vid1+1;
	$vid1 = ($_GET['avid']-1)*25;
	$allprod = $ketObj->runquery( "SELECT","kvp.id,kp.pname,kvp.vid,kvp.status,kvp.baseprice,kvp.sellprice,kvp.modify_baseprice,kvp.modify_sellprice", "ketechvp_".$_SESSION['vid']." kvp INNER JOIN ketechprod kp ON kvp.pid = kp.id", array(),$where." limit ".$vid1.",25" );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit ".$vid1.",10");
    //$count= $vid1+1;
	}
	else {
	$allprod = $ketObj->runquery( "SELECT","kvp.id,kp.pname,kvp.vid,kvp.status,kvp.baseprice,kvp.sellprice,kvp.modify_baseprice,kvp.modify_sellprice", "ketechvp_".$_SESSION['vid']." kvp INNER JOIN ketechprod kp ON kvp.pid = kp.id", array(),$where." limit 0,25" );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit 0,10");
   // $count = 1;
	}


	/*$allprod = $ketObj->runquery( "SELECT","kvp.id,kp.pname,kvp.vid,kvp.status,kvp.baseprice,kvp.sellprice", "ketechvp_".$_SESSION['vid']." kvp INNER JOIN ketechprod kp ON kvp.pid = kp.id", array(),$where );*/



/*echo "<pre>";
print_r( $allVprod );
die();*/


//echo $arrc;
//echo "<pre>";
//print_r(  $arrayPidStatus );
//print_r( $allVprod );
//print_r($allprod);
//die();



?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Vendor Product List
                </h3>
                        </div>

                        <div class="title_right">
						<form name="addeditc" id = "addeditc" action="index.php" method="post">
                            <div>
							<div class="input-group">
                                   
									 <select name = "orderstatus" class="form-control">
										<option value="">Search</option>
										<option value="publish"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "publish") { echo "selected='selected'";}?>>Publish</option>
										<option value="lowstock"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "lowstock") { echo "selected='selected'";}?>>Low Stock Product </option>
										<option value="empty"<?php if( isset( $_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "empty") { echo "selected='selected'";}?>>Empty Stock  Product</option>
									
									</select>
									
									
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopvpl">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "searchp" value="searchp"><input type="hidden" class="form-control" placeholder="Search for..." name = "admin_approval" value="y">
<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_SESSION['vid']; ?>">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
							<div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search By Name..." name = "searchbyproduct" value="<?php if( isset( $_REQUEST['searchbyproduct'] ) &&  $_REQUEST['searchbyproduct']!=""){ echo $_REQUEST['searchbyproduct'];} ?>">
									
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                                
                            </div>
							
							
							<div class="form-group">
                                            
                                            <div>
											<div class="input-group">
                                              <?php #echo $p_parent_cat; ?><select name="productCat" onchange="CatAjax(this.value,'p')" class="form-control">
											  
                                              							<option value="0"> Search By Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 																  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option value="<?php echo  $CatNameIdArray['1']; ?>"<?php if( isset($_REQUEST['productCat']) && $_REQUEST['productCat'] ==  $CatNameIdArray['1'] ) { echo "selected='selected'";} ?>><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
                                                                        <?php
																		   }
																		?>		  		
                                             </select>
                                            <span class="input-group-btn">
                                         <button class="btn btn-default" type="submit">Go!</button>
                                          </span>
                                           </div>
                                            </div>
                                        </div>
										<?php #echo $buscatid; ?>
										 <div  id = "div123c" >
                                           
                                            <div id = "div123" class="input-group">
                                           		<?php if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0   )
													{
														$allChcat = $ketObj->runquery( "SELECT", "id,cname", "ketechcat", array(), " where cparent = ".$_REQUEST['productCat'].""  );
														
														if( isset( $allChcat ) && is_array( $allChcat ) && count( $allChcat ) > 0  ){
														?>
														<select name="buscatid" class="form-control">
															<option value="0">Search By Sub Category </option>
														<?php 
															foreach( $allChcat as $allChcatV ){
															?>
															<option value="<?php echo  $allChcatV['id']; ?>" <?php if(isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] == $allChcatV['id'] ){ echo "selected='selected'";} ?>><?php echo  $allChcatV['cname']; ?></option>
															<?php
															
															}
															?>
														</select>
														<span class="input-group-btn">
                                         					<button class="btn btn-default" type="submit">Go!</button>
											 		   </span>
										   <?php		
														
														}
													
													
													}
											
											?>	
										   
                                            </div>
											
                                        </div>
						</form>	
                        </div>
                    </div>
<?php
$admin_approval = "";
$qstring = '';
$path = 'index.php?v=shopvpl&vid='.$_SESSION['vid'].'&f=tmpl&admin_approval='.$admin_approval.'';
if(isset( $_REQUEST['searchp'] ) &&  $_REQUEST['searchp']!="" ){
$path .= '&searchp='.$_REQUEST['searchp'].'';
$qstring .= '&searchp='.$_REQUEST['searchp'].'';	
}

if( isset( $_REQUEST['searchbyproduct'] )  ) {
$path .= '&searchbyproduct='.$_REQUEST['searchbyproduct'].'';
$qstring .= '&searchbyproduct='.$_REQUEST['searchbyproduct'].'';
}

if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 ){
$path .= '&productCat='.$_REQUEST['productCat'].'';
$qstring .= '&productCat='.$_REQUEST['productCat'].'';
}

if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] > 0 ){
$path .= '&buscatid='.$_REQUEST['buscatid'].'';
$qstring .= '&buscatid='.$_REQUEST['buscatid'].'';
}
if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] != "" ){
$path .= '&orderstatus='.$_REQUEST['orderstatus'].'';
$qstring .= '&orderstatus='.$_REQUEST['orderstatus'].'';
}

?>					
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopvpc&f=add&vid=<?php echo $_SESSION['vid']; ?>">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>BasePrice</th>
												<th>SellPrice</th>
                                                <th>Status</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												//$counter = 1;
												if( isset( $allprod ) && is_array( $allprod ) && count( $allprod ) > 0 )
												{
													foreach( $allprod as $allprodK => $allprodV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allprodV['pname']; ?></td>
                                                            <td><?php echo $allprodV['baseprice']; ?></td>
															<td><?php echo $allprodV['sellprice']; ?></td>
															<td><a href ="index.php?v=shopvpl&status=<?php echo $allprodV['status'];?>&ids=<?php echo $allprodV['id'];?>&avid=<?php if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>0 ){ echo $_REQUEST['avid']; } ?><?php if( isset( $qstring ) && $qstring != "" ){ echo $qstring;}?>"><?php echo ( $allprodV['status'] > 0 ? 'Active' : 'In-Active' ); ?></a></td>
                                                             <td><a href = "index.php?v=shopvpc&f=add&id=<?php echo $allprodV['id'];?>&vid=<?php echo $allprodV['vid'];?>&avid=<?php if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>0 ){ echo $_REQUEST['avid']; } ?><?php if( isset( $qstring ) && $qstring != "" ){ echo $qstring;}?>" class="btn btn-info">Edit</a></td>
                                                             <td><a href = "index.php?v=shopvpc&f=add&del=<?php echo $allprodV['id'];?>&vid=<?php echo $allprodV['vid'];?>&avid=<?php if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>0 ){ echo $_REQUEST['avid']; } ?><?php if( isset( $qstring ) && $qstring != "" ){ echo $qstring;}?>" class="btn btn-danger">Delete</a></td>
															<!--<td><?php echo $allprodV['malias']; ?></td>
															<td><?php //echo ( $allManufV['mstatus'] > 0 ? 'Active' : 'In-Active' ); ?></td>-->
														</tr>
											<?php			
														$counter++;
													}
												
												
													}
																echo '<tr><td align = "center" colspan = "15">'; 
																echo paginate($path,$hold);
																echo '</td></tr>';
											?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>