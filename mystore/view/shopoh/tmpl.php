<?php // session_start(); 
/*echo "<pre>";
print_r( $_POST );
die();
*/
$VendorUser =  $ketObj->runquery( "SELECT", "id,uname,urole", "ketechuser", array()," where vid = ".$_SESSION['vid']." AND (urole = 'pick' OR urole = 'dispatch')");

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
	$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechord_".$_SESSION['vid'], array(), $where  );
	$hold = $Count['0']['count(*)']; 
	$counter = 1;
	if(isset($_GET['avid']) && $_GET['avid']!="") {
			$vid1 = ($_GET['avid']-1)*10;
			$counter= $vid1+1;
			$vid1 = ($_GET['avid']-1)*10;
			$allCat = $ketObj->runquery( "SELECT", "*", "ketechord_".$_SESSION['vid'], array(),$where." limit ".$vid1.",10");
			
		}
		else
		{
		
			$allCat = $ketObj->runquery( "SELECT", "*", "ketechord_".$_SESSION['vid'], array(),$where." limit 0,10");
		}	


//OR order_time_stamp like '%".$_POST['searchbyorder']."%'
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Order History
                </h3>
                        </div>

                        <div class="title_right">
						 <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div>
								<div class="input-group">
                                   <input type="number" class="form-control" placeholder="Search By Order Id" name = "searchorderid" min="0" value = "<?php if( isset( $_REQUEST['searchorderid'] ) && $_REQUEST['searchorderid']>0 ){ echo $_REQUEST['searchorderid']; }?>"/>
									
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                                <div  class="input-group">
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
                                   <!-- <span class="input-group-btn">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
								<form name="setstatus" method="post" action="index.php">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>UserId</th>
                                                <!--<th>DeviceId</th>
                                                <th>Mobile</th>-->
                                                <!--<th>ProductDetails</th>-->
                                                <th>GrossAmount</th>
                                                <th>Discount</th>
                                                <th>FinalAmount</th>
                                                <th>OTS</th>
                                                <th>Status</th>
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
															<!--<td><?php echo $allCatV['did']; ?></td>
															<td><?php echo $allCatV['mobile'];  ?></td>
                                                            <td><?php # if( isset( $arraypname ) && is_array( $arraypname ) && count( $arraypname )>0 ){ echo implode(",",$arraypname);}else{ echo $allCatV['productdetails'];}?></td>-->
                                                            <td><?php echo $allCatV['grossamount']; ?></td>
                                                            <td><?php echo $allCatV['discount'];  ?></td>
                                                            <td><?php echo $allCatV['finalamount'];  ?></td>
                                                            <td><?php echo $allCatV['order_time_stamp'];  ?></td>
                                                            <td><select name="status[<?php echo $allCatV['id']; ?>]">
																<option <?php if( $allCatV['status'] == "packaging" ){ echo "selected='selected'";} ?> value="packaging">packaging</option>
																<option <?php if( $allCatV['status'] == "pending" ){ echo "selected='selected'";} ?>  value="pending">pending</option>
																<option <?php if( $allCatV['status'] == "dispatch" ){ echo "selected='selected'";} ?> value="dispatch">dispatch</option>
																<option <?php if( $allCatV['status'] == "complete" ){ echo "selected='selected'";} ?> value="complete">complete</option>
																<option <?php if( $allCatV['status'] == "hold" ){ echo "selected='selected'";} ?> value="hold">hold</option></select></td>
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
															<td><a href="view/shopoh/billinginfo.php?id=<?php echo $allCatV['id'];?>&vid=<?php echo $_SESSION['vid'];?>" target="_blank" class="btn btn-info">Bill Info</a></td>
												</tr>			
										<!-- <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">SET</button>
                        </span>-->
						
										
																<?php //echo $allCatV['status'];  ?></td>
                                                           
                                                            <!--<td><a href = "index.php?v=shopo&f=add&cid=<?php echo $allCatV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopo&f=add&del=<?php echo $allCatV['id'];?>" class="btn btn-danger">Delete</a></td>-->
														
											<?php			
														$counter++;
													}
												}
												$path = 'index.php?v=shopoh&vid='.$_SESSION['vid'].'';
															
													if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] != "" ){
													
													$path = 'index.php?v=shopoh&orderstatus='.$_REQUEST['orderstatus'].'&vid='.$_SESSION['vid'].'';
															}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>';
											?>
										
											<tr>
											<td colspan="10" align="right">
											<span class="input-group-btn">
                                               <button class="btn btn-default" type="submit">Save</button>
                                            </span>
											</td>
											</tr>
											<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh">
											<input type="hidden" name="c" value="shopoh" />
											<input type="hidden" name="task" value="addeditstatus"/>
											</form>
                                        </tbody>
                                    </table>
<!--<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopoh">
										<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_REQUEST['vid']; ?>"><input type="submit" class="form-control" placeholder="Search for..." name = "subsetstatus" value="<?php echo "submit" ?>">-->
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