<?php function paginate( $path,$hold ) {
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
	$where = " where vid = ".$_REQUEST['vid']."";

	if( isset($_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] == "y" )
	{
		$where .= " AND admin_approval = 0";
	}
	
	if( isset( $_REQUEST['mxp'] )  && $_REQUEST['mxp']!="" ){
		$where .= " AND maxpa = '".$_REQUEST['mxp']."'";
	}

	if( isset( $_REQUEST['minp'] )  && $_REQUEST['minp']!="" ){
		$where .= " AND minpa = '".$_REQUEST['minp']."'";
	}
	$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechshipping", array(), $where  );
	$hold = $Count['0']['count(*)']; 
	$counter = 1;
	if(isset($_GET['avid']) && $_GET['avid']!="") {
			$vid1 = ($_GET['avid']-1)*10;
			$counter= $vid1+1;
			$vid1 = ($_GET['avid']-1)*10;
			$allManuf = $ketObj->runquery( "SELECT", "*", "ketechshipping", array(),$where." limit ".$vid1.",10");
	}else{
		$allManuf = $ketObj->runquery( "SELECT", "*", "ketechshipping", array(),$where." limit 0,10");
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

?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                   <?php if( isset($_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] == "y" )
	{
		echo "Shipping Rule List For Approval";
	}else{
			echo "Shipping Rule List";
	}	?>	
                </h3>
                        </div>

                        <div class="title_right">
						<?php
							if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
							{
						?>	
                            <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div>
                                <div class="input-group">
                                    <select name = "admin_approval" class="form-control">
										<option value="0"></option>
										<option value="y"<?php if( isset($_REQUEST['admin_approval']) && $_REQUEST['admin_approval'] == "y") { echo "selected='selected'";}?>>Shipping Rules for Approval</option>
										<option value="all"<?php if( isset($_REQUEST['admin_approval']) && $_REQUEST['admin_approval'] != "y") { echo "selected='selected'";}?>>All Shipping Rules</option>
										
									</select>
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopshipping">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_REQUEST['vid']; ?>">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
							
							 <input type="number"   placeholder="Minimum Purchasing Amount"   name="minp" value="<?php if( isset($_REQUEST['minp']) && $_REQUEST['minp']!="" ){ echo $_REQUEST['minp'];} ?>" style="line-height:30px;width:220px;" min="0"/>
                                                           
                                                       
                            <input type="number"   placeholder="Maxmimum Purchasing Amount" name="mxp"value="<?php if( isset($_REQUEST['mxp']) && $_REQUEST['mxp']!="" ){ echo $_REQUEST['mxp'];}?>" style="line-height:30px;;width:220px;" min="0"/>
                                                          
                             <button class="btn btn-default" type="submit">Go!</button>
                                                        
                                         
						</form>	
					<?php }else{ ?>	
					
					<form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder" value="<?php if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){ echo $_REQUEST['searchbyorder'];} ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopshipping">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
						</form>	
					
					<?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                   <?php	if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
									{
									
									?>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopshipping&f=add">Add New</a></li>
                                    </ul>
								<?php } ?>	
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="x_content">
<?php	if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" )
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
												<?php if( isset($_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] == "y" )
	{ ?>			 <td><a href = "index.php?v=shopshipping&f=approve&sid=<?php echo $allManufV['id'];?>&vid=<?php echo $_REQUEST['vid']; ?>" class="btn btn-round btn-warning">Approve Rule</a></td><?php } ?>
															
                                                            <td><a href = "index.php?v=shopshipping&f=add&del=<?php echo $allManufV['id'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											<?php			
														$counter++;
													}
												}
												$path = 'index.php?v=shopshipping&vid='.$_REQUEST['vid'].'';
												$adminapproval = "";
												if( isset( $_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] == "y"){
													$path .=  '&admin_approval='.$_REQUEST['admin_approval'].'';
												}
												
												
															
													if( isset( $_REQUEST['minp'] ) && $_REQUEST['minp'] != "" ){
													
													$path .= '&minp='.$_REQUEST['minp'].'';
															}
															
																		
													if( isset( $_REQUEST['mxp'] ) && $_REQUEST['mxp'] != "" ){
													
													$path .= '&mxp='.$_REQUEST['mxp'].'';
															}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>';
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
										<?php $counter = 1;
											if( isset( $allVendor ) && is_array( $allVendor ) && count( $allVendor ) > 0 )
											{
											
													foreach( $allVendor as $allVendorV )
													{
													
													
										?>			<tr>
														<td><?php echo $counter; ?></td>
														<td><?php echo $allVendorV['vname']; ?></td>
														<td><?php echo $allVendorV['varea']; ?></td>
														<td><?php echo $allVendorV['vcity']; ?></td>
														<td><a href = "index.php?v=shopshipping&vid=<?php echo  $allVendorV['id']; ?>" class = "btn btn-primary" >Shipping Rules</a></td>
													</tr>
													
										<?php				
													
													$counter++;
													}
													$path = 'index.php?v=shopshipping';
													
													if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){
														$path = 'index.php?v=shopshipping&searchbyorder='.$_REQUEST['searchbyorder'].'';
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