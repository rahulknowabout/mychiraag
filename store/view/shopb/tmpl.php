<?php if( isset($_REQUEST['status'] )  && isset($_REQUEST['ids']) && $_REQUEST['ids']>0 ){
		if( $_REQUEST['status'] < 1  ){
			$ketechloc['status'] = 1;
			$allSet = $ketObj->runquery("UPDATE", "", "ketechbanner", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
		}else{
			$ketechloc['status'] = 0;
			$allSet = $ketObj->runquery("UPDATE", "", "ketechbanner", $ketechloc, "WHERE id=".$_REQUEST['ids']	 );
		}

	}

$allb = $ketObj->runquery( "SELECT", "*", "ketechbanner", array(), ""  );
/*echo "<pre>";
print_r( $allb );
die();*/
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Banner List
                </h3>
                        </div>

                        <div class="title_right">
                            <!--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopb&f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
												<th>Image</th>
                                                <th>ORDER</th>
                                                <th>Status</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$counter = 1;
												if( isset( $allb ) && is_array( $allb ) && count( $allb ) > 0 )
												{
													foreach( $allb as $allbK => $allbV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allbV['title']; ?></td>
															<td><a href="../images/b/<?php echo $allbV['id'];?>/big/big_<?php echo $allbV['id'];?>.jpg" target="_blank"><img src="../images/b/<?php echo $allbV['id'];?>/thumb/thumb_<?php echo $allbV['id'];?>.jpg" width="100px" height="100px"/></a></td>
															<td><?php echo $allbV['order_b']; ?></td>
															<td><a href ="index.php?v=shopb&status=<?php echo $allbV['status'];?>&ids=<?php echo $allbV['id'];?>"><?php echo ( $allbV['status'] > 0 ? 'Active' : 'In-Active' ); ?></a></td>
                                                            <td><a href = "index.php?v=shopb&f=add&bid=<?php echo $allbV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopb&f=add&del=<?php echo $allbV['id'];?>" class="btn btn-danger">Delete</a></td>
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