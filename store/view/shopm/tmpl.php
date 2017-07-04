<?php
if( isset( $_POST['searchbyorder'] ) && $_POST['searchbyorder']!="" )
{
	$where = " where mname like '%".$_POST['searchbyorder']."%'";
	$allManuf = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(),$where  );

}else
{

	$allManuf = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), ""  );
}
##$allManuf = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), ""  );
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Manufacturers List
                </h3>
                        </div>

                       
                            <div class="title_right">
                              <form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyorder">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopm">
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
                                        <li><a href="index.php?v=shopm&f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Manufacturer Name</th>
                                                <th>Manufacturer Alias</th>
                                                <th>Status</th>
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
															<td><?php echo $allManufV['mname']; ?></td>
															<td><?php echo $allManufV['malias']; ?></td>
															<td><?php echo ( $allManufV['mstatus'] > 0 ? 'Active' : 'In-Active' ); ?></td>
                                                            <td><a href = "index.php?v=shopm&f=add&mid=<?php echo $allManufV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopm&f=add&del=<?php echo $allManufV['id'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											<?php			
														$counter++;
													}
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