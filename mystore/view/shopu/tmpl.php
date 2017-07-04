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

$where = " where vid = '".$_SESSION['vid']."'";
if( isset($_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder']!="" )
{
	if( $_REQUEST['searchbyorder'] == 'pick' || $_REQUEST['searchbyorder'] == 'dispatch' ){
		$where .= " AND( uname like '%".$_REQUEST['searchbyorder']."%' OR urole like '%".$_REQUEST['searchbyorder']."%' )";
	}else{
			$where .= " AND( uname like '%".$_REQUEST['searchbyorder']."%' OR urole <> 'vendor' )";
	}	
}else{
		$where .= " AND urole <> 'vendor'";
}
$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechuser", array(), $where  );
$hold = $Count['0']['count(*)']; 
$counter = 1; 	
if(isset($_GET['vid']) && $_GET['vid']!="") {
	$vid1 = ($_GET['vid']-1)*10;
	$counter= $vid1+1;
	$vid1 = ($_GET['vid']-1)*10;
	$allUser = $ketObj->runquery( "SELECT", "*", "ketechuser", array(), $where." limit ".$vid1.",10"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit ".$vid1.",10");
    //$count= $vid1+1;
	}
else {
	$allUser = $ketObj->runquery( "SELECT", "*", "ketechuser", array(), $where." limit 0,10"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit 0,10");
   // $count = 1;
	}
	

/*echo "<pre>";

print_r( $allUser );*/
/*echo $_SESSION['vid'];
die();*/
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                              Staff List
                </h3>
                        </div>

                        <div class="title_right">
                            <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder" value="<?php if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder']!="" ){ echo $_REQUEST['searchbyorder']; } ?>">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopu">
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
                                       
                                                <li><a href="index.php?v=shopu&f=add">Add New</a>
                                                </li>
                                            
                                      
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                            
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$counter = 1;
												if( isset( $allUser ) && is_array( $allUser ) && count( $allUser ) > 0 )
												{
													foreach( $allUser as $allUserK=> $allUserV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allUserV['uname']; ?></td>
															<td><?php echo $allUserV['urole']; ?></td>
                                                            <td><a href = "index.php?v=shopu&f=add&uid=<?php echo $allUserV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopu&f=add&del=<?php echo $allUserV['id'];?>" class="btn btn-danger">Delete</a></td>
															<!--<td><?php echo ( $allCatV['cstatus'] > 0 ? 'Active' : 'In-Active' ); ?></td>-->
														</tr>
											<?php			
														$counter++;
													}
													
													$path = 'index.php?v=shopu';
													
													if( isset( $_REQUEST['searchbyorder'] ) && $_REQUEST['searchbyorder'] != "" ){
														$path = 'index.php?v=shopu&searchbyorder='.$_REQUEST['searchbyorder'].'';
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