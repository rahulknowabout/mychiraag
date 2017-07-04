<?php
$allCustomFld = $ketObj->runquery( "SELECT", "*", "ketechfld", array(), ""  );
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    CustomFields List
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
                                        <li><a href="index.php?v=shopcf&f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Field Name</th>
                                                <th>Field Matrix</th>
                                                <th>Stockable</th>
												<th>Attribute</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$counter = 1;
												if( isset( $allCustomFld ) && is_array( $allCustomFld ) && count( $allCustomFld ) > 0 )
												{
													foreach( $allCustomFld as $allCustomFldK => $allCustomFldV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allCustomFldV['fldname']; ?></td>
															<td><?php echo $allCustomFldV['fldmatrix']; ?></td>
															<td><?php echo ( $allCustomFldV['fldstockable'] > 0 ? 'Yes' : 'No' ); ?></td>
															<td><?php echo ( $allCustomFldV['fldnotstockable'] > 0 ? 'Yes' : 'No' ); ?></td>
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