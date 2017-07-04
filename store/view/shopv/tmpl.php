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
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(),$where." limit ".$vid1.",10"  );
}
else
{

	$allCat = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), $where." limit 0,10"  );
}
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Vendor List
                </h3>
                        </div>

                        <div class="title_right">
                              <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder" value = <?php if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){ echo $_REQUEST['searchbyorder'];} ?>>
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopv">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                                </div>
                            </div>
						</form>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopv&amp;f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Vendor Name</th>
                                                <th>Vendor Company</th>
                                                <th colspan="4">Action</th>
												
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												//$counter = 1;
												if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
												{
													foreach( $allCat as $allCatK => $allCatV )
													{
														$where = " where admin_approval = 1";
														$allAp = $ketObj->runquery( "SELECT", "count(*)", "ketechvp_".$allCatV['id'], array(),$where,"" );
													
													
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><a href = "index.php?v=shopv&f=add&vid=<?php echo $allCatV['id'];?>"><?php echo $allCatV['vname']; ?></a></td>
															<td><?php echo $allCatV['vcname']; ?></td>
															<!--<td><a  href="index.php?v=shopvp&f=add"><button class="btn btn-round btn-primary" type="button">Add New Product</button></a></td>--><td><a  href="index.php?v=shopvpl&f=tmpl&vid=<?php echo  $allCatV['id'];?>"><button class="btn btn-round btn-primary" type="button">Add/Edit Product</button></a><?php if( $allAp['0']['count(*)'] > 0 ){?> <a href="index.php?v=shopvpl&f=tmpl&vid=<?php echo  $allCatV['id'];?>&admin_approval=y"><?php echo $allAp['0']['count(*)']; ?></a><?php }else{echo $allAp['0']['count(*)'];}?></td><td><a href = "index.php?v=shopv&f=add&del=<?php echo $allCatV['id'];?>&uid=<?php echo $allCatV['uid'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											<?php			
														$counter++;
													}
													
													$path = 'index.php?v=shopv';
													
													if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){
														$path = 'index.php?v=shopv&searchbyorder='.$_REQUEST['searchbyorder'].'';
													}
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>'; 
												}
											?>
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>