<?php ob_start();
session_start();
error_reporting(E_ALL);
require_once( "../condb.php" );
require_once( "control/shopfunction.php" );
require_once( '../PHPExcel/Classes/PHPExcel/IOFactory.php' );
$ketObj	=	new ketech();
if( !isset( $_SESSION['secure'] ) )
{
	header('location:login.php' );
	die();
}
if( isset( $_POST['aj'] ) && $_POST['aj'] == "y" )
{
	include( "view/ajax/tmpl.php" );
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MYCHIRAAG|ShoppersStop</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>
<script>
	$(document).ready(function () {
		$(".select2_single").select2({
			placeholder: "Select a category",
			allowClear: true
		});
		$(".select2_group").select2({});
		$(".select2_multiple").select2({
			maximumSelectionLength: 4,
			placeholder: "With Max Selection limit 4",
			allowClear: true
		});
	});
	
	/*$("#addeditc").submit(function(e){
		if(formSubmit=="yes")
		{
			
		}else
		{
			e.preventDefault();
			chkAlias();
		}*/
});

</script>
    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<?php
$allOrder = $ketObj->runquery( "SELECT", "count(*) as total,status", "ketechord_".$_SESSION['vid'], array(), "GROUP BY status"  );
/*$allOrderp = $ketObj->runquery( "SELECT", "count(*)", "ketechord_".$_SESSION['vid'], array(), "where status = 'pending'"  );*/
$allOrderL = $ketObj->runquery( "SELECT", "*", "ketechord_".$_SESSION['vid'], array(), "ORDER BY ordid DESC LIMIT 5"  );

$allProd = $ketObj->runquery( "SELECT", "count(*)", "ketechvp_".$_SESSION['vid'], array(), ""  );

$allOrderW = $ketObj->runquery( "SELECT", "finalamount,DATE(`order_time_stamp`)", "ketechord_".$_SESSION['vid'], array(), " where status = 'complete' AND DATE(`order_time_stamp`) >= DATE_ADD(CURDATE(), INTERVAL -6 DAY) ORDER BY DATE(`order_time_stamp`) ASC"  );

$allOrdertF = $ketObj->runquery( "SELECT", "SUM(finalamount) as total,status", "ketechord_".$_SESSION['vid'], array(), "GROUP BY status"  );

$allStaff = $ketObj->runquery( "SELECT", "count(*) as totalstaff", "ketechuser", array(), "where (urole = 'pick' OR urole = 'dispatch') AND vid = '".$_SESSION['vid']."'");

$topshopper = $ketObj->runquery( "SELECT", "sum(grossamount),userid", "ketechord_".$_SESSION['vid'], array(), " GROUP BY userid ORDER BY sum(grossamount) DESC LIMIT 5"  );

/*
echo "<pre>";
print_r( $allStaff );
die();*/
//$shopuserid = "";

if( isset( $topshopper ) && is_array( $topshopper ) && count($topshopper)>0 ){
	foreach( $topshopper as $topshopperV ){
		$shopuserid[] = $topshopperV['userid'];
		$shopper_grossamount[$topshopperV['userid']] = $topshopperV['sum(grossamount)'];
	
	}
	
	$shopuserid = implode(",",$shopuserid);





$topshoppername = $ketObj->runquery( "SELECT", "ku.uname,ku.id,kadd.ucity,kadd.uarea", "ketechuser as ku INNER JOIN ketechuseraddress as kadd ON ku.id = kadd.userid", array(), "where ku.id IN(".$shopuserid.") AND kadd.udefault = 1 "  );

if( isset( $topshoppername ) && is_array( $topshoppername ) && count($topshoppername)>0 ){
	foreach( $topshoppername as  $topshoppernameK => $topshoppernameV ){
		if( isset( $topshopper ) && is_array( $topshopper ) && count($topshopper)>0 ){
				foreach( $shopper_grossamount as $topshopperK => $topshopperV ){
							if( $topshoppernameV['id'] == $topshopperK ){
								$topshoppername[$topshoppernameK]['grossamount'] = $topshopperV;
							
							}
				
				}
		}
	
	}
	
	

}
if( isset( $topshoppername ) && is_array($topshoppername) && count($topshoppername)>0){
usort($topshoppername, function($a, $b) {
    return $a['grossamount'] < $b['grossamount'];
});
}
}


/*if( isset( $VendorStaff ) && is_array( $VendorStaff ) && count($VendorStaff)>0 ){
	foreach( $VendorStaff as $VendorStaffK => $VendorStaffV ){
		if( $VendorStaffV['urole'] == 'pick' ){
			$packorder = $ketObj->runquery( "SELECT", "count(*) as pdc", "ketechord_".$_SESSION['vid'], array(), " where status = 'complete' AND  pack_staff = '".$VendorStaffV['id']."'"  );
			$VendorStaff[$VendorStaffK]['pdcount'] = $packorder['0']['pdc'];
			
		}
		if( $VendorStaffV['urole'] == 'dispatch' ){
			$dispatchorder = $ketObj->runquery( "SELECT", "count(*) as pdcd", "ketechord_".$_SESSION['vid'], array(), " where status = 'complete' AND  del_staff = '".$VendorStaffV['id']."'"  );
			$VendorStaff[$VendorStaffK]['pdcount'] = $dispatchorder['0']['pdcd'];
			
		}		
	
	}

}*/
$PackStaffOrder = $ketObj->runquery( "SELECT", "COUNT( kord.id ) AS ordcomplete,kord.pack_staff,ku.uname",  "ketechord_".$_SESSION['vid']." kord INNER JOIN ketechuser ku ON kord.pack_staff = ku.id", array(), " WHERE  kord.`pack_staff` >0 AND kord.`pack_status` > 0 GROUP BY  kord.`pack_staff` limit 5"  );

$DelStaffOrder = $ketObj->runquery( "SELECT", "COUNT( kord.id ) AS ordcomplete,kord.del_staff,ku.uname",  "ketechord_".$_SESSION['vid']." kord INNER JOIN ketechuser ku ON kord.del_staff = ku.id", array(), " WHERE  kord.`del_staff` >0 AND kord.`del_status` > 0 GROUP BY  kord.`del_staff` limit 5"  );
 
/*echo "<pre>";
print_r( $DelStaffOrder );
die();*/
##print_r( array_merge($shopper_grossamount,$topshoppername) );



function sortFunction( $a, $b ) {
    return strtotime($a['DATE(`order_time_stamp`)']) - strtotime($b['DATE(`order_time_stamp`)']);
}
if( isset( $allOrderW ) && is_array( $allOrderW ) && count( $allOrderW )>0 ){
	$ord  = usort($allOrderW, "sortFunction"); 
	$length = count( $allOrderW );
	$count = 0;
	for( $i = 0;$i<$length;$i++ ){
		if( $i > 0  ){
			if( $allOrderW[$i]['DATE(`order_time_stamp`)'] !=  $allOrderW[$i-1]['DATE(`order_time_stamp`)'] ){
				$count++;
				$arrayfstore[date('d',strtotime($allOrderW[$i]['DATE(`order_time_stamp`)']))] = $allOrderW[$i]['finalamount'];
			
			}else{
					$arrayfstore[date('d',strtotime($allOrderW[$i]['DATE(`order_time_stamp`)']))] += $allOrderW[$i]['finalamount'];
			
			}
		
		}else{
				$arrayfstore[date('d',strtotime($allOrderW[$i]['DATE(`order_time_stamp`)']))] =  $allOrderW[$i]['finalamount'];
		
		
		}
	
	
	}
}

/*echo json_encode($allOrderW);
die();	*/
/*echo "<pre>";
print_r( $arrayfstore );
die();*/
/*$topShopper = $ketObj->runquery( "SELECT", "MAX(finalamount)", "ketechord_".$_SESSION['vid'], array(), "GROUP BY userid");*/
/*echo "<pre>";
print_r($VendorStaff);
/*print_r($allOrderp);
print_r($allProd);
print_r($allOrderL);
print_r($topShopper);*/
##die();

if( isset( $_POST['c'] ) && $_POST['c'] != "" )
{
	include( "control/".$_POST['c'].".php" );
	$_POST['task']( $ketObj );
	//echo "<pre>"; print_r($_POST); die("asasasasas");
}
?>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title"><i class="fa fa-paw"></i><span>MYCHIRAAG</span></a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                         <img src="images/img.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome</span>
                            <h2><?php echo $_SESSION['vendorname']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                           <!-- <h3>General</h3>-->
                            <ul class="nav side-menu">
                                <li><a href="index.php"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                   <!-- <ul class="nav child_menu" style="display: none">
                                       <!-- <li><a href="index.html">Dashboard</a>
                                        </li>-->
                                        <!--<li><a href="index2.html">Dashboard2</a>
                                        </li>
                                        <li><a href="index3.html">Dashboard3</a>
                                        </li>
                                    </ul>-->
                                </li>
                                 <li><a><i class="fa fa-home"></i>Staff<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopu">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopu&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                               <!-- <li><a><i class="fa fa-home"></i> Category <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopc">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopc&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>-->
                               <!-- <li><a><i class="fa fa-home"></i> Banner <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopb">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopb&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>-->
								<li><a><i class="fa fa-home"></i> Product <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopvpl">Product List</a>
                                        </li>
										 <li><a href="index.php?v=shopvpc&f=add&vid=<?php echo $_SESSION['vid'];?>">Add New</a>
                                        </li>
										 <li><a href="index.php?v=shopuploadp&f=add&vid=<?php echo $_SESSION['vid'];?>">Upload Product</a>
                                        </li>
									<!--	
                                        <li><a href="index.php?v=shopcf">Custom Field</a>
                                        </li>
										<li><a href="index.php?v=shopm">Manufacturers</a>
                                        </li>
                                     
                                     	
                                          <li><a href="index.php?v=shopv">Vendor</a>
                                          </li>
                                         <li><a href="index.php?v=shopvendorcity">Vendor City</a>
                                        </li>
                                         <li><a href="index.php?v=shopvendorarea">Vendor Area</a>
                                        </li>
                                         <li><a href="index.php?v=shopo">Offer</a>
                                        </li>-->
                                       
                                       
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-home"></i>Manage Order <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopoh">Order History</a>
                                        </li>
										
                                      <!--  <li><a href="index.php?v=shopcf">Custom Field</a>
                                        </li>
										<li><a href="index.php?v=shopm">Manufacturers</a>
                                        </li>
                                     
                                     	
                                          <li><a href="index.php?v=shopv">Vendor</a>
                                          </li>
                                         <li><a href="index.php?v=shopvendorcity">Vendor City</a>
                                        </li>
                                         <li><a href="index.php?v=shopvendorarea">Vendor Area</a>
                                        </li>
                                         <li><a href="index.php?v=shopo">Offer</a>
                                        </li>-->
                                       
                                       
                                    </ul>
                                </li>
								  <li><a><i class="fa fa-home"></i>Shippping <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopshipping">List</a></li>
										 <li><a href="index.php?v=shopshipping&f=add">Add Rule</a></li>
									</ul>	 
									
                                    </li>
									<li><a><i class="fa fa-home"></i>Discount<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopdiscount">List</a></li>
										 <li><a href="index.php?v=shopdiscount&f=add">Add Rule</a></li>
								   </ul>
                                     </li>
										
								<!--<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="form.html">General Form</a>
                                        </li>
                                        <li><a href="form_advanced.html">Advanced Components</a>
                                        </li>
                                        <li><a href="form_validation.html">Form Validation</a>
                                        </li>
                                        <li><a href="form_wizards.html">Form Wizard</a>
                                        </li>
                                        <li><a href="form_upload.html">Form Upload</a>
                                        </li>
                                        <li><a href="form_buttons.html">Form Buttons</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <!--<li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="general_elements.html">General Elements</a>
                                        </li>
                                        <li><a href="media_gallery.html">Media Gallery</a>
                                        </li>
                                        <li><a href="typography.html">Typography</a>
                                        </li>
                                        <li><a href="icons.html">Icons</a>
                                        </li>
                                        <li><a href="glyphicons.html">Glyphicons</a>
                                        </li>
                                        <li><a href="widgets.html">Widgets</a>
                                        </li>
                                        <li><a href="invoice.html">Invoice</a>
                                        </li>
                                        <li><a href="inbox.html">Inbox</a>
                                        </li>
                                        <li><a href="calender.html">Calender</a>
                                        </li>
                                    </ul>
                                </li>-->
								
                                <!--<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="tables.html">Tables</a>
                                        </li>
                                        <li><a href="tables_dynamic.html">Table Dynamic</a>
                                        </li>
                                    </ul>
                                </li>-->
								
                                <!--<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="chartjs.html">Chart JS</a>
                                        </li>
                                        <li><a href="chartjs2.html">Chart JS2</a>
                                        </li>
                                        <li><a href="morisjs.html">Moris JS</a>
                                        </li>
                                        <li><a href="echarts.html">ECharts </a>
                                        </li>
                                        <li><a href="other_charts.html">Other Charts </a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                        </div>
                        <div class="menu_section">
                            <!--<h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="e_commerce.html">E-commerce</a>
                                        </li>
                                        <li><a href="projects.html">Projects</a>
                                        </li>
                                        <li><a href="project_detail.html">Project Detail</a>
                                        </li>
                                        <li><a href="contacts.html">Contacts</a>
                                        </li>
                                        <li><a href="profile.html">Profile</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="page_404.html">404 Error</a>
                                        </li>
                                        <li><a href="page_500.html">500 Error</a>
                                        </li>
                                        <li><a href="plain_page.html">Plain Page</a>
                                        </li>
                                        <li><a href="login.html">Login Page</a>
                                        </li>
                                        <li><a href="pricing_tables.html">Pricing Tables</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                                </li>
                            </ul>-->
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" href="index.php?v=shopset" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top"  title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" href="login.php?act=logout" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <!--<div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i>Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>-->
            <!-- /top navigation -->


            <!-- page content -->
			
			<?php /* 
			?>
            <div class="right_col" role="main">

                <br />
                <div class="">

                    <div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-book"></i>
                                </div>
                                <div class="count"><?php echo $allOrder['0']['count(*)'];?></div>

                                <h3>Total</h3>
                                <p>Order</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-bell-o"></i><i class="fa fa-book"></i>
                                </div>
                                <div class="count"><?php echo $allOrderp['0']['count(*)'];?></div>

                                <h3>Pending</h3>
                                <p>Order</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cubes"></i>
                                </div>
                                <div class="count"><?php echo $allProd['0']['count(*)'];?></div>

                                <h3>Total</h3>
                                <p>Product</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-male"></i>
                                </div>
                                <div class="count">0</div>

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
                                                <h2>INR 231,809</h2>
                                               <!-- <span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>-->
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Total Cancel</span>
                                                <h2>INR 231,809</h2>
                                                <!--<span class="sparkline22 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>-->
                                            </div>
                                            <div class="col-md-4 tile">
                                                <span>Total Pending</span>
                                                <h2>INR 231,809</h2>
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
                                                <ul class="nav navbar-right panel_toolbox">
												
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
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <ul class="list-unstyled top_profiles scroll-view">
											   <?php
												    foreach( $allOrderL as $allOrderLV  ) {
												 
												 ?>
                                                <li class="media event">
                                                    <a class="pull-left border-aero profile_thumb">
                                                        <i class="fa fa-user aero"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#"><?php echo $allOrderLV['ordid'];?></a>
                                                        <p><strong><?php echo $allOrderLV['grossamount'];?>. </strong> <?php echo $allOrderLV['finalamount'];?> </p>
                                                        <p> <small><?php echo $allOrderLV['order_time_stamp'];?></small>
                                                        </p>
                                                    </div>
                                                </li>
												
												<?php } ?>
                                                
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
                                    <h2>Product  <small>In Demand</small></h2>
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
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Product1</a>
                                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Product1</a>
                                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Product1</a>
                                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Product1</a>
                                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                       <div class="media-body">
                                            <a class="title" href="#">Product1</a>
                                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Top<small>Shopper</small></h2>
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
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Shopper1</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Shopper1</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                       <div class="media-body">
                                            <a class="title" href="#">Shopper1</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                       </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Shopper1</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                       </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Shopper1</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Staff<small>Support</small></h2>
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
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Staff1</a>
                                            <p>Packer</p>
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                      <div class="media-body">
                                            <a class="title" href="#">Staff1</a>
                                            <p>Packer</p>
                                      </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                       <div class="media-body">
                                            <a class="title" href="#">Staff1</a>
                                            <p>Packer</p>
                                       </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                        <div class="media-body">
                                            <a class="title" href="#">Staff1</a>
                                            <p>Packer</p>
                                        </div>
                                    </article>
                                    <article class="media event">
                                        <a class="pull-left date">
                                            <p class="month">April</p>
                                            <p class="day">23</p>
                                        </a>
                                       <div class="media-body">
                                            <a class="title" href="#">Staff1</a>
                                            <p>Packer</p>
                                       </div>
                                    </article>
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
            <!-- /page content -->
			
		
            
			<?php
			*/
				if( isset( $_REQUEST['v'] ) && $_REQUEST['v'] != "" )
				{
					if( isset( $_REQUEST['f'] ) && $_REQUEST['f'] != "" )
					{
						include( "view/".$_REQUEST['v']."/".$_REQUEST['f'].".php" );
					}else
					{
						include( "view/".$_REQUEST['v']."/tmpl.php" );
					}
				}else
				{
					include( "view/default/tmpl.php" );
				}
			?>
			
          
        </div>


    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- sparkline -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>

    <script src="js/custom.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="js/flot/date.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>

    <!-- flot -->
    <script type="text/javascript">
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];
		var  Weekarray = <?php if( isset( $arrayfstore ) && is_array( $arrayfstore ) && count($arrayfstore)>0){ echo json_encode($arrayfstore);}?>;
		//alert(Weekarray['23']);
        //generate random number for charts
        function toconvertsg(number) {
		  var stra = new Date(number);
		  var strad   =    stra.getDate();
		  
		 
		/*  alert(Weekarray['23']);*/
		   /*alert(arrssdd['0']);*/
		   for( var xstr in Weekarray ){
		   		/*alert(xstr);*/
		   	
		   	if( xstr == strad ){
				/*alert(strad);*/
				return Weekarray[xstr];
			
			}
		     
		  }
			
			return 0;
            
        }

        $(function () {
            var d1 = [];
            //var d2 = [];
			
            //here we generate data for chart
            for (var i = 0; i < 7; i++) {
				
				/*alert(i);*/
                d1.push([new Date(Date.today().add(i-6
			).days()).getTime(), toconvertsg(new Date(Date.today().add(i-6
			).days()).getTime())]);
                //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
				
				/*d1.push([30,randNum() + i + i + 10]);*/
            }

            var chartMinDate = d1[0][0]; //first day
            var chartMaxDate = d1[6][0]; //last day

            var tickSize = [1, "day"];
            var tformat = "%d/%m/%y";

            //graph options
            var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 2,
                        steps: false
                    },
                    points: {
                        show: true,
                        radius: 4.5,
                        symbol: "circle",
                        lineWidth: 3.0
                    }
                },
                legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                        // just add some space to labes
                        return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                },
                colors: chartColours,
                shadowSize: 0,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                        x: -30,
                        y: -50
                    },
                    defaultTheme: false
                },
                yaxis: {
                    min: 0,
					max: <?php echo max($arrayfstore); ?>
                },
                xaxis: {
                    mode: "time",
                    minTickSize: tickSize,
                    timeformat: tformat,
                    min: chartMinDate,
                    max: chartMaxDate
                }
            };
            var plot = $.plot($("#placeholder33x"), [{
                label: "Revenue",
                data: d1,
                lines: {
                    fillColor: "rgba(150, 210, 89, 0.12)"
                }, //#96CA59 rgba(150, 202, 89, 0.42)
                points: {
                    fillColor: "#fff"
                }
            }], options);
        });
    </script>
    <!-- /flot -->
    <!--  -->
    <script>
        $('document').ready(function () {
            $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                height: '125',
                barWidth: 13,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
                type: 'bar',
                height: '40',
                barWidth: 8,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
                type: 'line',
                height: '40',
                width: '200',
                lineColor: '#26B99A',
                fillColor: '#ffffff',
                lineWidth: 3,
                spotColor: '#34495E',
                minSpotColor: '#34495E'
            });

            var doughnutData = [
                {
                    value: 30,
                    color: "#455C73"
                },
                {
                    value: 30,
                    color: "#9B59B6"
                },
                {
                    value: 60,
                    color: "#BDC3C7"
                },
                {
                    value: 100,
                    color: "#26B99A"
                },
                {
                    value: 120,
                    color: "#3498DB"
                }
        ];
            var myDoughnut = new Chart(document.getElementById("canvas1i").getContext("2d")).Doughnut(doughnutData);
            var myDoughnut = new Chart(document.getElementById("canvas1i2").getContext("2d")).Doughnut(doughnutData);
            var myDoughnut = new Chart(document.getElementById("canvas1i3").getContext("2d")).Doughnut(doughnutData);
        });
    </script>
    <!-- -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->
</body>

</html>