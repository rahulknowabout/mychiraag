<?php  
/*echo "<pre>";
print_r( $_REQUEST );
die();*/

?>

<style>
table{
   /* border: 1px solid black;*/
   /* table-layout: fixed;
    width: 100%;*/
}

th, td {
   /* border: 1px solid black;*/
   /* overflow: hidden;*/
    /*width: 60px;*/
}
</style>
<?php 
if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
{
$VendorUser =  $ketObj->runquery( "SELECT", "id,uname,urole", "ketechuser", array()," where vid = ".$_REQUEST['vid']." AND (urole = 'pick' OR urole = 'dispatch')");

if( isset( $VendorUser ) && is_array( $VendorUser ) && count( $VendorUser )>0  ){
	foreach( $VendorUser as $VendorUserV ){
		if( $VendorUserV['urole'] == 'pick' ){
			$UPArray[$VendorUserV['id']]['id'] = $VendorUserV['id'];
			$UPArray[$VendorUserV['id']]['uname'] = $VendorUserV['uname'];
			$UPArray[$VendorUserV['id']]['urole'] = $VendorUserV['urole'];
		
		}
		if( $VendorUserV['urole'] == 'dispatch' ){
			$UDArray[$VendorUserV['id']]['id'] = $VendorUserV['id'];
			$UDArray[$VendorUserV['id']]['uname'] = $VendorUserV['uname'];
			$UDArray[$VendorUserV['id']]['urole'] = $VendorUserV['urole'];
		
		}
	
	}

}

/*echo "<pre>";
print_r( $UPArray );
print_r( $UDArray );
die();*/

}


function paginate( $path,$hold ) {
	if( ( $hold%10 ) == 0 ){
		$total = $hold/10;
	}
    else {
    	$total = ($hold/10)+1;
     }
	 $returnp =   '<ul class = "pagination">';
	 if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>1 ) {
	 	$pre = $_REQUEST['avid']-1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$pre.'">Previous</a></li>';
	}
     for( $i = 1; $i <= $total; $i++ ) {
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$i.'">'.$i.'</a></li>';
	 }
	if( isset( $_REQUEST['avid'] ) &&  $_REQUEST['avid']<=($total-1) ) {
		$nex = $_REQUEST['avid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}

if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
{
	$where = array();
	if( isset($_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus']!="" )
    {
		$where[] = "status = '".$_REQUEST['orderstatus']."'";
	}
	if( isset($_REQUEST['searchorderid'] ) && $_REQUEST['searchorderid']!="" )
    {
		$where[] = "id = ".$_REQUEST['searchorderid']."";
	}
	if( isset($where) && is_array($where) && count($where)>0){
		$where = " where ".implode(" AND ",$where );
	
	}else{
			$where = "";
	}
	$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechord_".$_REQUEST['vid'], array(), $where  );
	$hold = $Count['0']['count(*)']; 
	$counter = 1;
	if(isset($_GET['avid']) && $_GET['avid']!="") {
			$vid1 = ($_GET['avid']-1)*10;
			$counter= $vid1+1;
			$vid1 = ($_GET['avid']-1)*10;
			$allCat = $ketObj->runquery( "SELECT", "*", "ketechord_".$_REQUEST['vid'], array(),$where." limit ".$vid1.",10");
		}
		else
		{
		
			$allCat = $ketObj->runquery( "SELECT", "*", "ketechord_".$_REQUEST['vid'], array(),$where." limit 0,10");
		}	
		
	
	
	
}else
{
		$where = "";

		if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder']!="" ){
			$where = " where vname like '%".$_REQUEST['searchbyorder']."%'";
		}	
		$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechvendor", array(), $where  );
		$hold = $Count['0']['count(*)']; 
		$counter = 1; 	
		if(isset($_GET['avid']) && $_GET['avid']!="") {
			$vid1 = ($_GET['avid']-1)*10;
			$counter= $vid1+1;
			$vid1 = ($_GET['avid']-1)*10;
			$allVendor = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(),$where." limit ".$vid1.",10"  );
		}
		else
		{
		
			$allVendor = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), $where." limit 0,10"  );
		}

}


/*echo "<pre>";
print_r( $allCat );
//print_r( $UDArray );
die();	*/
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Order History
                </h3>
				<!--<a href = "" target="_blank" class="btn btn-primary">Genrate Report</a>-->
                        </div>

                        <div class="title_right">
						<?php 
							if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
							{
							
						?>	
							
                            <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div>
							<div class="input-group">
                                   <input type="number" class="form-control" placeholder="Search By Order Id" name = "searchorderid" min="0" value = "<?php if( isset( $_REQUEST['searchorderid'] ) && $_REQUEST['searchorderid']>0 ){ echo $_REQUEST['searchorderid']; }?>"/>
									
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                                <div class="input-group">
                                    <select name = "orderstatus" class="form-control">
										<option value="">Search By Status</option>
										<option value="packaging"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "packaging") { echo "selected='selected'";}?>>packaging</option>
										<option value="pending"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "pending") { echo "selected='selected'";}?>>pending</option>
										<option value="dispatch"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "dispatch") { echo "selected='selected'";}?>>dispatch</option>
										<option value="complete"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "complete") { echo "selected='selected'";}?>>complete</option>
										<option value="hold"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "hold") { echo "selected='selected'";}?>>hold</option>
									
									</select>
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_REQUEST['vid']; ?>">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </form>
							<form  name="genratereport" id = "genratereport" action="view/shopoh/genratereport.php" method="post">
							<div>
                                    <select name = "useridreport" class="form-control">
										<option value="">Generate Report By Staff Name</option>
									<?php if( isset( $VendorUser ) && is_array( $VendorUser ) && count( $VendorUser ) > 0 ){
										  	foreach( $VendorUser as $VendorUserV ) { ?>	
										<option value="<?php echo $VendorUserV['id']; ?>"><?php echo $VendorUserV['uname']."(".$VendorUserV['urole'].")"; ?></option>
										
										<!--<option value="dispatch"<?php if( isset($_REQUEST['orderstatus']) && $_REQUEST['orderstatus'] == "dispatch") { echo "selected='selected'";}?>>dispatch staff</option>-->
									<?php 
											}
										} ?>	
										
									
									</select>
									
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_REQUEST['vid']; ?>">
                                    <!--<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">Genrate Report</button>
                        			</span>-->
                                </div>
								<div>
								 <select name = "orderstatusR" class="form-control">
										<option value="">Genrate Report By Status</option>
										<option value="packaging"<?php if( isset($_REQUEST['orderstatusR']) && $_REQUEST['orderstatusR'] == "packaging") { echo "selected='selected'";}?>>packaging</option>
										<option value="pending"<?php if( isset($_REQUEST['orderstatusR']) && $_REQUEST['orderstatusR'] == "pending") { echo "selected='selected'";}?>>pending</option>
										<option value="dispatch"<?php if( isset($_REQUEST['orderstatusR']) && $_REQUEST['orderstatusR'] == "dispatch") { echo "selected='selected'";}?>>dispatch</option>
										<option value="complete"<?php if( isset($_REQUEST['orderstatusR']) && $_REQUEST['orderstatusR'] == "complete") { echo "selected='selected'";}?>>complete</option>
										<option value="hold"<?php if( isset($_REQUEST['orderstatusR']) && $_REQUEST['orderstatusR'] == "hold") { echo "selected='selected'";}?>>hold</option>
									
									</select>
									<!--<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">Genrate Report</button>
                           				
                        			</span>-->
								</div>	
								 <input type="text" id="single_cal2" style="line-height:30px;"  placeholder="Start Date  M/D/Y" name="s_date" value="<?php if( isset($_REQUEST['s_date']) && $_REQUEST['s_date']!="" ){ echo $_REQUEST['s_date'];} ?>"/>
                                                          
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                       
							
                                 
								   
                      					
                                                
                                                            <input type="text" id="single_cal1" style="line-height:30px;"  placeholder="End Date  M/D/Y"  name="e_date" value="<?php if( isset($_REQUEST['e_date']) && $_REQUEST['e_date']!="" ){ echo $_REQUEST['e_date'];}?>"/>
                                                            
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        
                                         
						
                            <button class="btn btn-primary" type="submit" style="padding:15px;">Genrate Report</button>
                            </div>
							
						</form>
						<?php 
							}else {
							
						?>
						
						<form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder" value="<?php if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){ echo $_REQUEST['searchbyorder'];} ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
						</form>
						<?php				
							
							}
						?>		
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <!--<ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <!--<li><a href="index.php?v=shopo&f=add">Add New</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
<?php	if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
{

?>
					
<table class="table table-hover">
	<form name="setstatus" method="post" action="index.php">
								<thead>
									<tr>
										<th>#</th>
										<th>UserId</th>
										
										
										<th>GrossAmount</th>
										<th>Discount</th>
										<th>FinalAmount</th>
										<th>OTS</th>
										<th>Status</th>
										<th>Pack Staff</th>
										<th>Del Staff</th>
										<th>Bill</th>
									   <!-- <th colspan="4">Action</th>-->
									</tr>
								</thead>
								<tbody>
									<?php
										//$counter = 1;
										if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
										{
											foreach( $allCat as $allCatK => $allCatV )
											{
												$arraypd = explode(":",$allCatV['productdetails'] );
												
												if( is_array( $arraypd  ) && count( $arraypd ) > 0 )
												{
													foreach( $arraypd as $arraypdV  )
													{
														$arraypdd = explode(",",$arraypdV );
													
													foreach( $arraypdd as $k => $v )
												   {
												
													if( $k == 5 )
													{
														$arraypname[] = $v;
													}
												}	
												}
												}
									?>
												<tr>
													<th scope="row"><?php echo $counter; ?></th>
													<td><?php echo $allCatV['userid']; ?></td>
													
													<!--<td width="10px"><?php if( is_array( $arraypname ) && count( $arraypname )>0 ){ //echo implode(",",$arraypname);
													}else{##echo $allCatV['productdetails'];
													}?></td>-->
													<td><?php echo $allCatV['grossamount']; ?></td>
													<td><?php echo $allCatV['discount'];  ?></td>
													<td><?php echo $allCatV['finalamount'];  ?></td>
													<td><?php echo $allCatV['order_time_stamp'];  ?></td>
												
													
															<td>
														
															<select name="status[<?php echo $allCatV['id']; ?>]">
																<option <?php if( $allCatV['status'] == "packaging" ){ echo "selected='selected'";} ?> value="packaging">packaging</option>
																<option <?php if( $allCatV['status'] == "pending" ){ echo "selected='selected'";} ?>  value="pending">pending</option>
																<option <?php if( $allCatV['status'] == "dispatch" ){ echo "selected='selected'";} ?> value="dispatch">dispatch</option>
																<option <?php if( $allCatV['status'] == "complete" ){ echo "selected='selected'";} ?> value="complete">complete</option>
																<option <?php if( $allCatV['status'] == "hold" ){ echo "selected='selected'";} ?> value="hold">hold</option>
															
															</select></td>
															<td>
														
													<select name="packstaff[<?php echo $allCatV['id']; ?>]]">
																
														<option  value="0">Choose Staff</option>
															<?php if( isset( $UPArray ) && is_array( $UPArray ) && count( $UPArray )>0 )	{ 																		
																	foreach( $UPArray as $UPArrayV ){ ?>
																	
																	<option  value="<?php echo $UPArrayV['id'];?>"  <?php if( $allCatV['pack_staff'] == $UPArrayV['id'] ){ echo "selected='selected'";} ?>><?php echo $UPArrayV['uname'];  ?></option>
																	
															<?php
																  }																
															}
															?>
																
																
															
															</select>
															
															</td>
															<td>
															
														
															<select name="delstaff[<?php echo $allCatV['id']; ?>]]">
																
														<option  value="0">Choose Staff</option>
															<?php if( isset( $UDArray ) && is_array( $UDArray ) && count( $UDArray )>0 )	{ 																		
																	foreach( $UDArray as $UDArrayV ){ ?>
																	
																	<option  value="<?php echo $UDArrayV['id'];  ?>"<?php if( $allCatV['del_staff'] == $UDArrayV['id'] ){ echo "selected='selected'";} ?>><?php echo $UDArrayV['uname'];?></option>
																	
															<?php
																  }																
															}
															?>
																
																
															
															</select></td>
															
															
															<td><a href="view/shopoh/billinginfo.php?id=<?php echo $allCatV['id'];?>&vid=<?php echo $_REQUEST['vid'];?>" target="_blank" class="btn btn-info">Bill Info</a></td>
												   
													<!--<td><a href = "index.php?v=shopo&f=add&cid=<?php echo $allCatV['id'];?>" class="btn btn-info">Edit</a></td>
													<td><a href = "index.php?v=shopo&f=add&del=<?php echo $allCatV['id'];?>" class="btn btn-danger">Delete</a></td>-->
												</tr>
									<?php			
												$counter++;
											}
											
											 
									?>
									<tr>
											<td colspan="10" align="right">
											<span class="input-group-btn">
                                               <button class="btn btn-default" type="submit">Save</button>
                                            </span>
											</td>
									</tr>
											<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh"/>
											<input type="hidden" name="c" value="shopoh" />
											<input type="hidden" name="vid" value="<?php echo $_REQUEST['vid']; ?>" />
											<input type="hidden" name="task" value="addeditstatus"/>
											</form>
											<?php 
													$path = 'index.php?v=shopoh&vid='.$_REQUEST['vid'].'';
															
													if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] != "" ){
													
													$path = 'index.php?v=shopoh&orderstatus='.$_REQUEST['orderstatus'].'&vid='.$_REQUEST['vid'].'';
															}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>';
										}
											?>
								</tbody>
							</table>


<?php 
}else
	{
?>						   <table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Vendor Name</th>
											<th>Vendor Area</th>
											<th>Vendor City</th>
											<th>Action</th>
											
											
										   <!-- <th colspan="4">Action</th>-->
										</tr>
									</thead>
									<tbody>
										<?php //$counter = 1;
											if( isset( $allVendor ) && is_array( $allVendor ) && count( $allVendor ) > 0 )
											{
											
													foreach( $allVendor as $allVendorV )
													{
													
													
										?>			<tr>
														<td><?php echo $counter; ?></td>
														<td><?php echo $allVendorV['vname']; ?></td>
														<td><?php echo $allVendorV['varea']; ?></td>
														<td><?php echo $allVendorV['vcity']; ?></td>
														<td><a href = "index.php?v=shopoh&vid=<?php echo  $allVendorV['id']; ?>"  class = "btn btn-info">Order Details</a></td>
													</tr>
													
										<?php				
													
													$counter++;
													}
													$path = 'index.php?v=shopoh';
													
													if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){
														$path = 'index.php?v=shopoh&searchbyorder='.$_REQUEST['searchbyorder'].'';
													}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>';
											
											}
										
										?>
									</tbody>
								</table>
							
<?php
}
?>		
			  
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
<script>
CKEDITOR.replace( 'content', {
    filebrowserBrowseUrl: './browser/browse.php',
    filebrowserUploadUrl: './index.php?onlyupload=y'
});
var editor = CKEDITOR.replace( 'editor1' );
CKFinder.setupCKEditor( editor, '/images/' );
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
</script>						