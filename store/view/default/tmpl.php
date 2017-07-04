<?php
$VendorAll = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(),"");

$CatAll = $ketObj->runquery( "SELECT", "count(*) as catall", "ketechcat", array(),"");

$ProdAll = $ketObj->runquery( "SELECT", "count(*) as prodall", "ketechprod", array(),"");

$UserAll = $ketObj->runquery( "SELECT", "count(*) as userall", "ketechuser", array(),"");

if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
	$tstore = count( $VendorAll );
	##$tablejoin = "";
	
	foreach( $VendorAll as $VendorV ){
			/*$tablejoin[] = "ketechord_".$VendorV['id']." kord".$VendorV['id'];
			$getcolumn  = "kord".$VendorV['id'].".";*/
			$Order = $ketObj->runquery("SELECT", "status", "ketechord_".$VendorV['id']."", array()," where DATE(`order_time_stamp`) = CURDATE()");
			$OrderC = $ketObj->runquery("SELECT", "count(*) as ordc", "ketechord_".$VendorV['id']."", array()," where status = 'complete'");
			/*echo "<pre>";
			print_r( $OrderC );*/
			
			$orderstatus[$VendorV['id']] = $Order;
			$orderCount[$VendorV['id']] = count($Order);
			$ordC[$VendorV['id']] = $OrderC['0']['ordc'];
	
	}
	
	##$tablejoin = implode(" INNER JOIN ",$tablejoin);
	
	
	
	
	
}

/*echo $tablejoin;
die();*/
if( isset( $orderstatus ) && is_array( $orderstatus ) && count($orderstatus)>0 ){
	foreach( $orderstatus as $orderstatusK => $orderstatusVP ){
			
		if( isset( $orderstatusVP ) && is_array( $orderstatusVP ) && count($orderstatusVP)>0 ){
			$orderPending[$orderstatusK] = 0;
			$orderComplete[$orderstatusK] = 0;
			$orderCancel[$orderstatusK] = 0;
			$orderHold[$orderstatusK] = 0;
			$orderDispatch[$orderstatusK] = 0;
			foreach($orderstatusVP as $orderstatusV ){	
				
		
				if( $orderstatusV['status'] == "pending" ){
				
					$orderPending[$orderstatusK] +=1;
				
				}
				
				if( $orderstatusV['status'] == "complete" ){
				
					$orderComplete[$orderstatusK] +=1;
				
				}
				
				if( $orderstatusV['status'] == "cancel" ){
				
					$orderCancel[$orderstatusK] +=1;
				
				}
				if( $orderstatusV['status'] == "hold" ){
				
					$orderHold[$orderstatusK] +=1;
				
				}
				if( $orderstatusV['status'] == "dispatch" ){
				
					$orderDispatch[$orderstatusK] +=1;
				
				}
			}	

		}
	}
}
/*echo "<pre>";
print_r( $orderstatus );
print_r( $orderPending );
print_r( $orderComplete );
print_r( $orderCancel );
print_r( $orderHold );
print_r( $orderDispatch );
die();*/
/*echo "<pre>";
print_r( $VendorAll );
print_r( $CatAll );
print_r( $ProdAll );
print_r( $UserAll );
die();*/


?>
<div class="right_col" role="main">
                <div class="">

                    <div class="row top_tiles" style="margin: 10px 0;">
                        <div class="col-md-3 col-sm-3 col-xs-6 tile">
						<span aria-hidden="true" class="glyphicon glyphicon-hdd"></span>
                            <span style="font-style:oblique;font-weight:550;font-size:18px;">Total Store</span>
                            <h2><?php if( isset( $tstore ) && $tstore>0 ){echo $tstore;}else{ echo "0";} ?></h2>
                           
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 tile">
						<span aria-hidden="true" class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                            <span style="font-style:oblique;font-weight:550;font-size:18px;">Total Category</span>
                            <h2><?php  if( isset( $CatAll['0']['catall'] ) && $CatAll['0']['catall']>0 ){echo $CatAll['0']['catall'];}else{ echo "0";} ?></h2>
                            
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 tile">
							<span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"></span>
                            <span style="font-style:oblique;font-weight:550;font-size:18px;">Total Product</span>
                            <h2><?php if( isset( $ProdAll['0']['prodall'] ) && $ProdAll['0']['prodall']>0 ){echo $ProdAll['0']['prodall'];}else{ echo "0";}?></h2>
                            
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 tile">
							<span aria-hidden="true" class="glyphicon glyphicon-thumbs-up"></span>
                            <span style="font-style:oblique;font-weight:550;font-size:18px;">Total User</span>
                            <h2><?php if( isset( $UserAll['0']['userall'] ) && $UserAll['0']['userall']>0 ){echo $UserAll['0']['userall'];}else{ echo "0";}?></h2>
                            
                        </div>
                    </div>
                    <br />


                    <!--<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard_graph x_panel">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>Network Activities <small>Graph title sub-title</small></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div class="demo-container" style="height:250px">
                                        <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->


                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Today's Order</h2>
									 <div class="clearfix"></div>
							   </div>
                                    <!--<ul class="nav navbar-right panel_toolbox">
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
									
                                   
                               
                                <div class="x_content">
                                    <h4>Store <span style="padding-left:120px">Today's Order</span></h4>
									
                                  
                                   <?php
								   $Vendorcount = 0; 
								   if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
								   		foreach(  $VendorAll as $VendorV ){ 
											$Vendorcount++;
										
										
										
										?>
									    <div class="widget_summary">	    
                                    	<div class="w_left w_25">
                                            <span><?php echo  $Vendorcount.".".$VendorV['vname']; ?></span>
                                       </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php echo $orderCount[$VendorV['id']]; ?></span></span>
                                        </div>
										</div>
										
							  <?php    }
								   }
							  ?>		
                                        <div class="clearfix"></div>
										
                         </div>
                        </div>
						</div>
                                  

                                    <!--<div class="widget_summary">
                                        <div class="w_left w_25">
                                            <span>1.5.3</span>
                                        </div>
                                        <div class="w_center w_55">
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w_right w_20">
                                            <span>53k</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>-->
                                   <!-- <div class="widget_summary">
                                        <div class="w_left w_25">
                                            <span>1.5.4</span>
                                        </div>
                                        <div class="w_center w_55">
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w_right w_20">
                                            <span>23k</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>-->
                                    <!--<div class="widget_summary">
                                        <div class="w_left w_25">
                                            <span>1.5.5</span>
                                        </div>
                                        <div class="w_center w_55">
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w_right w_20">
                                            <span>3k</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="widget_summary">
                                        <div class="w_left w_25">
                                            <span>0.1.5.6</span>
                                        </div>-->
                                       <!-- <div class="w_center w_55">
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w_right w_20">
                                            <span>1k</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>-->

                                

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Today's Pending Order</h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
										<h4>Store <span style="padding-left:120px">Today's Order</span></h4>
                                   
                                       
									   
									 <?php if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
									 		 $Vendorcount = 0; 
								   				foreach(  $VendorAll as $VendorV ){ 
												$Vendorcount++; 
												
												?> 
								    <div class="widget_summary">
                                    <div class="w_left w_25">
                                            <span><?php echo  $Vendorcount.".".$VendorV['vname']; ?></span>
                                    </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php if( isset( $orderPending[$VendorV['id']] ) && $orderPending[$VendorV['id']] > 0 ){ echo $orderPending[$VendorV['id']];}else{ echo "0";} ?></span></span>
                                        </div>
									</div>
									<?php 		}
											}?>	
                                        <div class="clearfix"></div>
                                   
                                   
                                </div>
                            </div>
                        </div>


                       <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Today's Complete Order</h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
										<h4>Store <span style="padding-left:120px">Today's Order</span></h4>
                                   
                                       
									   
									 <?php if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
									 			$Vendorcount = 0; 
								   				foreach(  $VendorAll as $VendorV ){ 
												$Vendorcount++; 
												
												?> 
								    <div class="widget_summary">
                                    <div class="w_left w_25">
                                            <span><?php echo  $Vendorcount.".".$VendorV['vname']; ?></span>
                                    </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php if( isset( $orderComplete[$VendorV['id']] ) && $orderComplete[$VendorV['id']] > 0 ){ echo $orderComplete[$VendorV['id']];}else{ echo "0";} ?></span></span>
                                        </div>
									</div>
									<?php 		}
											}?>	
                                        <div class="clearfix"></div>
                                   
                                   
                                </div>
                            </div>
                        </div>

                         <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Today's Cancel Order</h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
										<h4>Store <span style="padding-left:120px">Today's Order</span></h4>
                                   
                                       
									   
									 <?php if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
									 		$Vendorcount = 0; 
								   				foreach(  $VendorAll as $VendorV ){ 
												$Vendorcount++;
												
												?> 
								    <div class="widget_summary">
                                    <div class="w_left w_25">
                                            <span><?php echo $Vendorcount.".".$VendorV['vname']; ?></span>
                                    </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php if( isset( $orderCancel[$VendorV['id']] ) && $orderCancel[$VendorV['id']] > 0 ){ echo $orderCancel[$VendorV['id']];}else{ echo "0";} ?></span></span>
                                        </div>
									</div>
									<?php 		}
											}?>	
                                        <div class="clearfix"></div>
                                   
                                   
                                </div>
                            </div>
                        </div>

                        <!-- start of weather widget -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Today's Hold Order</h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
										<h4>Store <span style="padding-left:120px">Today's Order</span></h4>
                                   
                                       
									   
									 <?php if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
									 			$Vendorcount = 0; 
								   				foreach(  $VendorAll as $VendorV ){ 
												$Vendorcount++; 
												?> 
								    <div class="widget_summary">
                                    <div class="w_left w_25">
                                            <span><?php echo $Vendorcount.".".$VendorV['vname']; ?></span>
                                    </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php if( isset( $orderHold[$VendorV['id']] ) && $orderHold[$VendorV['id']] > 0 ){ echo $orderHold[$VendorV['id']];}else{ echo "0";} ?></span></span>
                                        </div>
									</div>
									<?php 		}
											}?>	
                                        <div class="clearfix"></div>
                                   
                                   
                                </div>
                            </div>
                        </div>
                        <!-- end of weather widget -->


                         <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="x_panel fixed_height_320">
                                <div class="x_title">
                                    <h2>Overall Complete Order</h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
										<h4>Store <span style="padding-left:120px">Today's Order</span></h4>
                                   
                                       
									   
									 <?php if( isset( $VendorAll ) && is_array( $VendorAll ) && count( $VendorAll )>0 ){
									 			$Vendorcount = 0; 
								   				foreach(  $VendorAll as $VendorV ){ 
												$Vendorcount++; 
												
												?>
													
								    <div class="widget_summary">
                                    <div class="w_left w_25">
                                            <span><?php echo $Vendorcount.".".$VendorV['vname']; ?></span>
                                    </div>    
                                        <div class="w_right w_20">
                                            <span><span style="padding-left:120px"><?php if( isset( $ordC[$VendorV['id']] ) && $ordC[$VendorV['id']] > 0 ){ echo $ordC[$VendorV['id']];}else{ echo "0";} ?></span></span>
                                        </div>
									</div>
									<?php 		}
											}?>	
                                        <div class="clearfix"></div>
                                   
                                   
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">My Chiraag Admin |
                            <span class="lead"> <i class="fa fa-paw"></i>MY CHIRAAG!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>