<?php
if( isset( $_POST['searchbyproduct'] ) && $_POST['searchbyproduct']!="" )
{
	$where = " where status = '".$_POST['searchbyproduct']."'";
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechprod_".$_SESSION['vid'], array(),$where  );

}else 
{
	$allCat = $ketObj->runquery( "SELECT", "*", "ketechprod_".$_SESSION['vid'], array(), ""  );
}
//$allCat = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), ""  );
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
						<form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name = "searchbyoproduct">
									<input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopp">
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
                                    <h2>Results</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopp&amp;f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Product Alias</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$counter = 1;
												if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
												{
													foreach( $allCat as $allCatK => $allCatV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allCatV['pname']; ?></td>
															<td><?php echo $allCatV['palias']; ?></td>
															<td><?php echo ( $allCatV['pstatus'] > 0 ? 'Active' : 'In-Active' ); ?></td>
                                                            <td><a href = "index.php?v=shopp&f=add&pid=<?php echo $allCatV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopp&f=add&del=<?php echo $allCatV['id'];?>" class="btn btn-danger">Delete</a></td>
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