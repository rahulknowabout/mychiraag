<?php
$allCat = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), ""  );
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
															<td><?php echo $allCatV['vname']; ?></td>
															<td><?php echo $allCatV['vcname']; ?></td>
															<td><a href="" >Add new Product</a></td>
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