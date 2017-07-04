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
if( isset($_REQUEST['status'] )  && isset($_REQUEST['ids']) && $_REQUEST['ids']>0 ){
	if( $_REQUEST['status'] < 1  ){
		$ketechloc['pstatus'] = 1;
		$allSet = $ketObj->runquery("UPDATE", "", "ketechprod", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
	}else{
		$ketechloc['pstatus'] = 0;
		$allSet = $ketObj->runquery("UPDATE", "", "ketechprod", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
	}

}
function paginate( $path,$hold ) {
	if( ( $hold%25 ) == 0 ){
		$total = $hold/25;
	}
    else {
    	$total = ($hold/25)+1;
     }
	 if( $total > 0 ) {
	 	$totaltill = 10;
	 
	 }else{
	 		$totaltill = 0;
	 }
	 
	 $returnp =   '<ul class = "pagination">';
	 if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>1 ) {
	 	$pre = $_REQUEST['vid']-1;
		if( $totaltill >= 10 ) {
			$totaltill-=10;
			
		
		}
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$pre.'">Previous</a></li>';
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
		
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$i.'">'.$iset.'</a></li>';
	 }
	if( isset( $_REQUEST['vid'] ) &&  $_REQUEST['vid']<=($total-1) && $_REQUEST['vid']!="") {
		$nex = $_REQUEST['vid']+1;
		if( $totaltill <= $total ) {
			$totaltill+=10;
			
			
		
		}
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}
/*echo "<pre>";
print_r( $_POST );
die();*/
//$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechprod", array(), ""  );


$searchbyproduct = "";
$p_parent_cat = "";
$buscatid = "";
$where = "";
if( isset( $_REQUEST['searchp'] ) && $_REQUEST['searchp'] == "searchp" )
{
$where = array();
if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct']!="" )
{
	$searchbyproduct = $_REQUEST['searchbyproduct'];
	
	$where[] = "pname like '%".$_REQUEST['searchbyproduct']."%'";
}	
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 )
{	
	$where[] = "p_parent_cat = '".$_REQUEST['productCat']."'";
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
	$where[] = "pcategory = '".$_REQUEST['buscatid']."'";
}

if( count( $where ) > 0 )
{
		$where = " WHERE ".implode( " AND ", $where );	
}else{
		$where = "";
}
}
$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechprod", array(), $where  );
$hold = $Count['0']['count(*)'];
$counter = 1; 
if(isset($_GET['vid']) && $_GET['vid']!="") {
	$vid1 = ($_GET['vid']-1)*25;
	$counter= $vid1+1;
	$vid1 = ($_GET['vid']-1)*25;
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), $where." limit ".$vid1.",25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit ".$vid1.",10");
    //$count= $vid1+1;
	}
	else {
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), $where." limit 0,25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit 0,10");
   // $count = 1;
	}
	

/*echo "<pre>";
print_r( $allCat );*/


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
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Product List
                </h3>
                        </div>

                        <div class="title_right">
                           <form name="searchorder" id = "addeditc" action="index.php" method="post">
                        <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search By Name..." name = "searchbyproduct" value="<?php if( isset( $_REQUEST['searchbyproduct'] )) {echo $_REQUEST['searchbyproduct'];} ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopp">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "searchp" value="searchp">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
							
							   <div class="form-group">
                                            
                                            <div>
											<div class="input-group">
                                              <?php ##echo $p_parent_cat; ?><select name="productCat" onchange="CatAjax(this.value,'p')" class="form-control">
											  
                                              							<option value=""> Search By Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 																  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option value="<?php echo  $CatNameIdArray['1']; ?>" <?php if(isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] == $CatNameIdArray['1'] ){ echo "selected='selected'";} ?>><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
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
										<?php ##echo $buscatid; ?>
										 <div  id = "div123c" >
                                           
                                            <div id = "div123" class="input-group">
                                           	<?php
													if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0   )
													{
														$allChcat = $ketObj->runquery( "SELECT", "id,cname", "ketechcat", array(), " where cparent = ".$_REQUEST['productCat'].""  );
														
														if( isset( $allChcat ) && is_array( $allChcat ) && count( $allChcat ) > 0  ){
														?>
														<select name="buscatid" class="form-control">
															<option value=""> Search By Sub Category </option>
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
										<?php 
											/*if( isset( $allChcat ) && is_array( $allChcat ) && count( $allChcat ) > 0  ){
										?>
										<span class="input-group-btn">
                                         	<button class="btn btn-default" type="submit">Go!</button>
                                         </span>			
										<?php
										
										}	*/			
										?>
										
						</form>	
                        </div>
                    </div>
<?php
$path = 'index.php?v=shopp';
if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchp'] ) {
$path = 'index.php?v=shopp&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp='.$_REQUEST['searchp'].'';
$qstring ='&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp='.$_REQUEST['searchp'].'';

}
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 ){
$path = 'index.php?v=shopp&searchbyproduct='.$_REQUEST['searchbyproduct'].'&productCat='.$_REQUEST['productCat'].'&searchp='.$_REQUEST['searchp'].'';
$qstring = '&searchbyproduct='.$_REQUEST['searchbyproduct'].'&productCat='.$_REQUEST['productCat'].'&searchp='.$_REQUEST['searchp'].'';
}
if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] > 0 ){
$path = 'index.php?v=shopp&searchbyproduct='.$_REQUEST['searchbyproduct'].'&productCat='.$_REQUEST['productCat'].'&buscatid='.$_REQUEST['buscatid'].'&searchp='.$_REQUEST['searchp'].'';
$qstring = '&searchbyproduct='.$_REQUEST['searchbyproduct'].'&productCat='.$_REQUEST['productCat'].'&buscatid='.$_REQUEST['buscatid'].'&searchp='.$_REQUEST['searchp'].'';
}

?>					
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopp&amp;f=add&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 ){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php echo $qstring; ?>">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
												<th>Image</th>
                                                <th>Product Alias</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												//$counter = 1;
												if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
												{
													foreach( $allCat as $allCatK => $allCatV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allCatV['pname']; ?></td>
														   <td><a href="../images/p/<?php echo $allCatV['id'];?>/big/big_<?php echo $allCatV['id'];?>.jpg" target="_blank"><img src="../images/p/<?php echo $allCatV['id'];?>/thumb/thumb_<?php echo $allCatV['id'];?>.jpg" width="100px" height="100px"/></a></td>
														   
														   	<td><?php echo $allCatV['palias']; ?></td>
														   
															<td><a href="index.php?v=shopp&status=<?php echo $allCatV['pstatus'];?>&ids=<?php echo $allCatV['id'];  ?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 ){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php echo $qstring; ?>"><?php echo ( $allCatV['pstatus'] > 0 ? 'Active' : 'In-Active' ); ?></a></td>
                                                            <td><a href = "index.php?v=shopp&f=add&pid=<?php echo $allCatV['id'];?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 ){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php echo $qstring; ?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopp&f=add&del=<?php echo $allCatV['id'];?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 ){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php echo $qstring; ?>" class="btn btn-danger">Delete</a></td>
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