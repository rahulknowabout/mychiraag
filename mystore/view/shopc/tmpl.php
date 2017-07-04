<?php 
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
	if( isset( $_REQUEST['vid'] ) &&  $_REQUEST['vid']<=($total-1) ) {
		$nex = $_REQUEST['vid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&vid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}
$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechcat", array(), ""  );
/*echo "<pre>";
print_r( $Count );
die();*/

$hold = $Count['0']['count(*)']; 
$counter = 1;
if(isset($_GET['vid']) && $_GET['vid']!="") {
	$vid1 = ($_GET['vid']-1)*25;
	$counter= $vid1+1;
	$vid1 = ($_GET['vid']-1)*25;
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "limit ".$vid1.",25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit ".$vid1.",10");
    //$count= $vid1+1;
	}
	else {
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "limit 0,25"  );
	//$rowe = runquery("SELECT","*","artical","","".$where."limit 0,10");
   // $count = 1;
	}
//$allCat = $ketObj->runquery( "SELECT", "*", "ketechcat", array(), ""  );
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
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <li><a href="index.php?v=shopc&f=add">Add New</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Category Alias</th>
                                                <th>Status</th>
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
															<td><?php echo $allCatV['calias']; ?></td>
															<td><?php echo ( $allCatV['cstatus'] > 0 ? 'Active' : 'In-Active' ); ?></td>
                                                            <td><a href = "index.php?v=shopc&f=add&cid=<?php echo $allCatV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopc&f=add&del=<?php echo $allCatV['id'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											
													<?php	$counter++;
													}
                                                    
                                                    			$path = 'index.php?v=shopc';
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