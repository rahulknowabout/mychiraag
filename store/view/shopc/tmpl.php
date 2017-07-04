<script>
function CatAjax( str )
{
	//alert("dffff");
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('search', 'y');
	data.append('idcc',str);
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
/*echo "<pre>";
print_r( $_REQUEST );
die();*/

?>
<?php 
if( isset($_REQUEST['status'] )  && isset($_REQUEST['ids']) && $_REQUEST['ids']>0 ){
	if( $_REQUEST['status'] < 1  ){
		$ketechloc['cstatus'] = 1;
		$allSet = $ketObj->runquery("UPDATE", "", "ketechcat", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
	}else{
		$ketechloc['cstatus'] = 0;
		$allSet = $ketObj->runquery("UPDATE", "", "ketechcat", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
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
	 if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>1 ) {
	 	$pre = $_REQUEST['vid']-1;
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$pre.'">Previous</a></li>';
	}
     for( $i = 1; $i <= $total; $i++ ) {
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$i.'">'.$i.'</a></li>';
	 }
	if( isset( $_REQUEST['vid'] ) &&  $_REQUEST['vid']<=($total-1) && $_REQUEST['vid']!="" ) {
		$nex = $_REQUEST['vid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}

/*echo "<pre>";
print_r( $Count );
die();*/
$searchbyproduct = "";
$p_parent_cat = "";

$where = array();
if( isset( $_REQUEST['searchp'] ) && $_REQUEST['searchp'] == "searchp" )
{
/*echo  "hello";
die();*/
if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct']!="" )
{
	$searchbyproduct = $_REQUEST['searchbyproduct'];
	$where[] = "cname like '%".$_REQUEST['searchbyproduct']."%'";
}	
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] > 0 )
{	
	$where[] = "cparent = '".$_REQUEST['productCat']."'";
}
if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] == "ap" )
{	
	$where[] = "cparent = 0";
}

}

if( count( $where ) > 0 )
{
		$where = " WHERE ".implode( " AND ", $where );
		##$where .= " AND cstatus = 1";	
}else{
		##$where = " cstatus = 1 ";
		$where = "";
}


$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechcat", array(), $where  );
$hold = $Count['0']['count(*)']; 
$counter = 1;

if(isset($_GET['vid']) && $_GET['vid']!="") {
	$vid1 = ($_GET['vid']-1)*25;
	$counter= $vid1+1;
	$vid1 = ($_GET['vid']-1)*25;
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), $where." limit ".$vid1.",25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit ".$vid1.",10");
    //$count= $vid1+1;
	}
	else {
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), $where." limit 0,25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit 0,10");
   // $count = 1;
	}
//$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), ""  );


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
	
}
}
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Category List
                </h3>
                        </div>

                        <div class="title_right">
                             <form name="searchorder" id = "addeditc" action="index.php" method="post">
                        <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search By Name..." name = "searchbyproduct" value="<?php if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct']!=""){echo $_REQUEST['searchbyproduct'];} ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopc">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "searchp" value="searchp">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
							
							   <div class="form-group">
                                            
                                            <div>
											<div class="input-group">
                                            <?php //echo $p_parent_cat; ?><select name="productCat" onchange="CatAjax(this.value)" class="form-control">
											  
                                              							<option value="0"> Search By Parent Category </option>
																		<option value="ap" <?php if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] ==  "ap" ){ echo "selected = 'selected'";} ?>> All Parent Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 																  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option <?php if( isset( $_REQUEST['productCat'] ) && $_REQUEST['productCat'] ==  $CatNameIdArray['1'] ){ echo "selected = 'selected'";} ?>value="<?php echo  $CatNameIdArray['1']; ?>"><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
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
										 <div  id = "div123c" style="display:none">
                                           
                                            <div id = "div123" class="input-group"  style="display:none">
                                           
										   
                                            </div>
											
                                        </div>
										
						</form>	
                        </div>
                    </div>
<?php
$path = 'index.php?v=shopc';
if( isset( $_REQUEST['productCat'] ) && ( $_REQUEST['productCat'] > 0 ||  $_REQUEST['productCat'] == "ap" ) ){
$path = 'index.php?v=shopc&productCat='.$_REQUEST['productCat'].'&searchp=searchp';
$qstring = '&productCat='.$_REQUEST['productCat'].'&searchp=searchp';
}
if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct'] != ""){
$path = 'index.php?v=shopc&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp=searchp';
$qstring = '&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp=searchp';
}
if( isset( $_REQUEST['productCat'] ) && ($_REQUEST['productCat'] > 0 || $_REQUEST['productCat'] == "ap") && isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct'] != ""){

$path = 'index.php?v=shopc&productCat='.$_REQUEST['productCat'].'&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp=searchp';
$qstring = '&productCat='.$_REQUEST['productCat'].'&searchbyproduct='.$_REQUEST['searchbyproduct'].'&searchp=searchp';

}


?>					
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="index.php?v=shopc&f=add&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>0){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php if( isset($qstring) && $qstring!=""){ echo $qstring;} ?>">Add New</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
								 <form name="setstatus" method="post" action="index.php?v=shopc&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>0){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php if( isset($qstring) && $qstring!=""){ echo $qstring;} ?>">
                                    <table class="table table-hover">
									 
                                        <thead>
											
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
												<th>Image</th>
                                                <th>Category Alias</th>
                                                <th>Status</th>
												<th>Order</th>
												<th>Location</th>
                                                <th colspan="4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												
												if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
												{
													foreach( $allCat as $allCatK => $allCatV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allCatV['cname']; ?></td>
															<td><a href="../images/c/<?php echo $allCatV['id'];?>/big/big_<?php echo $allCatV['id'];?>.jpg" target="_blank"><img src="../images/c/<?php echo $allCatV['id'];?>/thumb/thumb_<?php echo $allCatV['id'];?>.jpg" width="100px" height="100px"/></a></td>
															<td><?php echo $allCatV['calias']; ?></td>
															<td><a href = "index.php?v=shopc&status=<?php echo $allCatV['cstatus'];  ?>&ids=<?php echo $allCatV['id'];?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>0){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php if( isset($qstring) && $qstring!=""){ echo $qstring;} ?>"><?php echo ( $allCatV['cstatus'] > 0 ? 'Active' : 'In-Active' ); ?></a></td>
															<td> <input type="number" name="ord[<?php echo $allCatV['id']; ?>]" value="<?php echo $allCatV['cord']; ?>" min="0"/></td><td><select name="location[<?php echo $allCatV['id'];?>]" id="location_"<?php echo $allCatV['id']; ?>><option value="left" <?php if( $allCatV['clocation'] == "left" ){ echo "selected='selected'"; } ?>>left</option>
																						<option value="right" <?php if( $allCatV['clocation'] == "right" ){ echo "selected='selected'"; } ?>>right</option></select></td>
                                                            <td><a href = "index.php?v=shopc&f=add&cid=<?php echo $allCatV['id'];?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>0){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php if( isset($qstring) && $qstring!=""){ echo $qstring;} ?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopc&f=add&del=<?php echo $allCatV['id'];?>&vid=<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>0){ echo $_REQUEST['vid'];}else{ echo "";} ?><?php if( isset($qstring) && $qstring!=""){ echo $qstring;} ?>"class="btn btn-danger">Delete</a></td>
														</tr>
														
											
													<?php	$counter++;
													}
													
													?>
										 <tr>
												<td colspan="10" align="right">
												<span class="input-group-btn">
												   <button class="btn btn-default" type="submit">Save</button>
												</span>
												</td>
									     </tr>
												
													
													
													
													
													<?php
													
													
																echo '<tr><td align = "center" colspan = "15">'; 
																echo paginate($path,$hold);
																echo '</td></tr>'; 
												}
											?>
											
                                        </tbody>
                                    </table>
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopc">
											<input type="hidden" name="c" value="shopc" />
											<input type="hidden" name="f" value="tmpl" />
											<input type="hidden" name="order" value="order" />
											<input type="hidden" name="task" value="addeditcat"/>
											</form>	
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>