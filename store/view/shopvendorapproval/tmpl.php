<?php
function paginate( $path,$hold ) {
	if( ( $hold%10 ) == 0 ){
		$total = $hold/10;
	}
    else {
    	$total = ($hold/10)+1;
     }
	 $returnp =   '<ul class = "pagination">';
	 if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']>1 ) {
	 	$pre = $_REQUEST['vid']-1;
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$pre.'">Previous</a></li>';
	}
     for( $i = 1; $i <= $total; $i++ ) {
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$i.'">'.$i.'</a></li>';
	 }
	if( isset( $_REQUEST['vid'] ) &&  $_REQUEST['vid']<=($total-1) ) {
		$nex = $_REQUEST['vid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}
$where = "";

if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder']!="" )
{
	$where = " where vname like '%".$_REQUEST['searchbyorder']."%'";
}	
$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechvendor", array(), $where  );
$hold = $Count['0']['count(*)']; 
$counter = 1; 	
if(isset($_GET['vid']) && $_GET['vid']!="") {
	$vid1 = ($_GET['vid']-1)*10;
	$counter= $vid1+1;
	$vid1 = ($_GET['vid']-1)*10;
	$allVendor = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(),$where." limit ".$vid1.",10"  );
}
else
{

	$allVendor = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), $where." limit 0,10"  );
}

?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Vendor Approval
                </h3>
                        </div>

                        <div class="title_right">
                             <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder" value="<?php if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){ echo $_REQUEST['searchbyorder'];} ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopvendorapproval">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
						</form>	
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <!--<ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopshipping&f=add">Add New</a></li>
                                    </ul>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="x_content">
<?php	/*if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
{

?>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Minimum Purchasing Amount</th>
                                                <th>Maxmimum Purchasing Amount</th>
                                                <th>Shipping Charges</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$counter = 1;
												if( isset( $allManuf ) && is_array( $allManuf ) && count( $allManuf ) > 0 )
												{
													foreach( $allManuf as $allManufK => $allManufV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allManufV['minpa']; ?></td>
															<td><?php echo $allManufV['maxpa']; ?></td>
															<td><?php echo $allManufV['shipping_charges']; ?></td>
                                                            <td><a href = "index.php?v=shopshipping&f=add&sid=<?php echo $allManufV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopshipping&f=add&del=<?php echo $allManufV['id'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											<?php			
														$counter++;
													}
												}
											?>
                                        </tbody>
                                    </table>
<?php 
}else
	{*/
?>						   <table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Vendor Name</th>
											<th>Vendor Area</th>
											<th>Vendor City</th>
											<th colspan="3" align="center">Action</th>
											
											
										   <!-- <th colspan="4">Action</th>-->
										</tr>
									</thead>
									<tbody>
										<?php //$counter = 1;
											if( isset( $allVendor ) && is_array( $allVendor ) && count( $allVendor ) > 0 )
											{
											
													foreach( $allVendor as $allVendorV )
													{
													 $where = " where admin_approval = 1";
									                $allAp = $ketObj->runquery( "SELECT", "count(*)", "ketechvp_".$allVendorV['id'], array(),$where,"" );
													 $where = " where admin_approval = 0 AND vid = ".$allVendorV['id']."";
													 $allApS = $ketObj->runquery( "SELECT", "count(*)", "ketechshipping", array(),$where,"" );
													 $allApD = $ketObj->runquery( "SELECT", "count(*)", "ketechdiscount", array(),$where,"" );
													
										?>			<tr>
														<td><?php echo $counter; ?></td>
														<td><?php echo $allVendorV['vname']; ?></td>
														<td><?php echo $allVendorV['varea']; ?></td>
														<td><?php echo $allVendorV['vcity']; ?></td>
														<td><a href = "index.php?v=shopvpl&f=tmpl&vid=<?php echo  $allVendorV['id']; ?>&admin_approval=y"  target="_blank" class="btn btn-dark">Product Approval(<?php echo $allAp['0']['count(*)']; ?>)</a></td>
														<td><a href = "index.php?v=shopshipping&vid=<?php echo  $allVendorV['id']; ?>&admin_approval=y"  target="_blank" class="btn btn-dark">Shipping Approval(<?php echo $allApS['0']['count(*)']; ?>)</a></td>
														<td><a href = "index.php?v=shopdiscount&vid=<?php echo  $allVendorV['id']; ?>&admin_approval=y"  target="_blank" class="btn btn-dark">Discount Approval(<?php echo $allApD['0']['count(*)']; ?>)</a></td>
													</tr>
													
										<?php				
													
													$counter++;
													}
											       $path = 'index.php?v=shopvendorapproval';
													
													if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){
														$path = 'index.php?v=shopvendorapproval&searchbyorder='.$_REQUEST['searchbyorder'].'';
													}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>'; 
											}
										
										?>
									</tbody>
								</table>
							
<?php
###}
?>		

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>