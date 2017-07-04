<?php if( isset($allOrdertF) && is_array($allOrdertF) && count($allOrdertF) > 0 ){
			foreach( $allOrdertF as  $allOrdertFV ){
						if($allOrdertFV['status'] == 'complete'){
								$OrderComT = $allOrdertFV['total'];
						}
						if($allOrdertFV['status'] == 'pending'){
								$OrderPT = $allOrdertFV['total'];
						}
						if($allOrdertFV['status'] == 'cancel'){
								$OrderCacT = $allOrdertFV['total'];
						}
			
			}

	  }	

if( isset($allOrder) && is_array($allOrder) && count($allOrder) > 0 ){
	$allOrderCount = 0;
	foreach( $allOrder as  $allOrderV ){
		if($allOrderV['status'] == 'pending'){
			$OrderCP = $allOrderV['total'];
		}
		$allOrderCount+=$allOrderV['total'];
				
	}

}	

?>








<div class="right_col" role="main">

                <br />
                <div class="">

                    <div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-book"></i>
                                </div>
                                <div class="count"><?php if( isset( $allOrderCount ) && $allOrderCount>0 ){ echo $allOrderCount;}else{ echo "0";} ?></div>

                                <h3>Total</h3>
                                <p>Order</p>
                            </div>
                        </div>
						
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-bell-o"></i><i class="fa fa-book"></i>
                                </div>
                                <div class="count"><?php if( isset( $OrderCP ) && $OrderCP>0 ){ echo $OrderCP;}else{ echo "0";}?></div>

                                <h3>Pending</h3>
                                <p>Order</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cubes"></i>
                                </div>
                                <div class="count"><?php if( isset( $allProd['0']['count(*)'] ) && is_array($allProd['0']['count(*)']) && count($allProd['0']['count(*)'])>0 ){ echo  $allProd['0']['count(*)'];}else{ echo "0";}?></div>

                                <h3>Total</h3>
                                <p>Product</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-male"></i>
                                </div>
                                <div class="count"><?php if( isset( $allStaff ) && is_array($allStaff) && count($allStaff)>0 ){ echo $allStaff['0']['totalstaff'];}else{ echo "0";}?></div>

                                <h3>Total</h3>
                                <p>Staff</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Transaction Summary <small>Weekly progress</small></h2>
                                    <!--<div class="filter">
                                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="demo-container" style="height:280px">
                                            <div id="placeholder33x" class="demo-placeholder"></div>
                                        </div>
                                        <div class="tiles">
                                            <div class="col-md-4 tile">
                                                <span>Total Recieve</span>
                                                <h2>INR <?php if( isset( $OrderComT ) && $OrderComT>0 ){ echo $OrderComT;}else{ echo "0";} ?></h2>
                                               <!-- <span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>-->
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Total Cancel</span>
                                                <h2>INR <?php if( isset( $OrderCacT ) && $OrderCacT>0 ){ echo $OrderCacT;}else{ echo "0";} ?></h2>
                                                <!--<span class="sparkline22 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>-->
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Total Pending</span>
                                                <h2>INR <?php  if( isset( $OrderPT ) && $OrderPT>0 ){ echo $OrderPT;}else{ echo "0";}?></h2>
                                                <!--<span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>-->
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div>
                                            <div class="x_title">
                                                <h2>Latest Order</h2>
                                               <!-- <ul class="nav navbar-right panel_toolbox">
												
                                                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Settings 1</a>
                                                            </li>
                                                            <li><a href="#">Settings 2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#"><i class="fa fa-close"></i></a>
                                                    </li>
                                                </ul>-->
                                                <div class="clearfix"></div>
                                            </div>
                                            <ul class="list-unstyled top_profiles scroll-view">
											   <?php
											   if( isset( $allOrderL ) && is_array($allOrderL) && count($allOrderL)>0){
												    foreach( $allOrderL as $allOrderLV  ) {
												 		$pdarray = json_decode($allOrderLV['same_productdetails'],true);
														/*echo "<pre>";
														print_r($pdarray);*/
														
												 ?>
                                                <li class="media event">
                                                   <!-- <a class="pull-left border-aero profile_thumb">
                                                        <i class="fa fa-user aero"></i>
                                                    </a>-->
                                                    <div class="media-body">
                                                        <a class="title" href="view/shopoh/billinginfo.php?id=<?php echo $allOrderLV['id'];?>&vid=<?php echo $_SESSION['vid']; ?>"><?php /*if( isset( $pdarray['0'] ) && is_array($pdarray['0']) && count($pdarray['0'])>0 ){ foreach( $pdarray['0'] as $pdarrayV ){ echo $pdarrayV['name']."(".$pdarrayV['quantity']."),";  }}*/ echo $allOrderLV['id']; ?></a>
                                                        <p><strong><?php echo $allOrderLV['grossamount'];?>/ </strong> <?php echo $allOrderLV['finalamount'];?> </p>
                                                        <p> <small>OrderDate:<?php echo $allOrderLV['order_time_stamp'];?></small>
                                                        </p>
														<p> <small>DeliveryDate:<?php echo $allOrderLV['order_time_stamp'];?></small>
                                                        </p>
                                                    </div>
                                                </li>
												
												<?php }
												}
												 ?>
                                                
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <!--<div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Weekly Summary <small>Activity shares</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                                        <div class="col-md-7" style="overflow:hidden;">
                                            <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                                            <h4 style="margin:18px">Weekly sales progress</h4>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="row" style="text-align: center;">
                                                <div class="col-md-4">
                                                    <canvas id="canvas1i" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                                    <h4 style="margin:0">Bounce Rates</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <canvas id="canvas1i2" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                                    <h4 style="margin:0">New Traffic</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <canvas id="canvas1i3" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                                    <h4 style="margin:0">Device Share</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->



                    <div class="row">
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Top<small>Shopper</small></h2>
                                   <!-- <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>-->
                                 <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style = "height:300px;">
								
								<?php if( isset( $topshoppername ) && is_array($topshoppername) && count($topshoppername)>0){
												$topshoppercount = 0;
											foreach( $topshoppername as $topshoppernameV ){
											$topshoppercount++;
								?>
								 <article class="media event">
                                        <!--<a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>-->
                                        <div class="media-body">
                                            <?php echo $topshoppercount; ?>.<a class="title" href="#"><?php echo $topshoppernameV['uname']; ?></a>
                                            <p><?php echo $topshoppernameV['uarea'].",".$topshoppernameV['ucity']."(".$topshoppernameV['grossamount'].")"; ?></p>
                                        </div>
                                    </article>
								
								<?php			
											
											}
										}	
								
								
								
								
								 ?>
                                    
                                   
                                    
                                   
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Pack<small>Staff</small></h2>
                                   <!-- <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style = "height:300px;">
								<?php if( isset( $PackStaffOrder ) && is_array( $PackStaffOrder )  && count( $PackStaffOrder )>0 ){
										$packcount = 0;
										foreach( $PackStaffOrder as $VendorStaffV ){
										$packcount++;
							    ?>
                                    <article class="media event">
                                        <!--<a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>-->
                                        <div class="media-body">
                                             <?php echo $packcount; ?>.<a class="title" href="#"><?php echo $VendorStaffV['uname']."(".$VendorStaffV['ordcomplete'].")"; ?></a>
                                            <p><?php ##echo $VendorStaffV['urole']; ?></p>
                                        </div>
                                    </article>
								<?php
										}
									}
								
								?>	
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Delivery<small>Staff</small></h2>
                                   <!-- <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style = "height:300px;">
								<?php if( isset( $DelStaffOrder ) && is_array( $DelStaffOrder )  && count( $DelStaffOrder )>0 ){
										$delcount = 0;
										foreach( $DelStaffOrder as $VendorStaffV ){
										$delcount++;
							    ?>				
                                    <article class="media event">
                                        <!--<a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>-->
                                        <div class="media-body">
                                            <?php echo $delcount; ?>.<a class="title" href="#"><?php echo $VendorStaffV['uname']."(".$VendorStaffV['ordcomplete'].")"; ?></a>
                                            <p><?php ##echo $VendorStaffV['urole']; ?></p>
                                        </div>
                                    </article>
								<?php
										}
									}
								
								?>	
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">MyChiraag
                            <span class="lead"> <i class="fa fa-paw"></i>Vendor!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>