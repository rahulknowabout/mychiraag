<?php ob_start();
session_start();
error_reporting(0);
/*echo "<pre>";
print_r( $_SESSION );
die();*/
require_once( "../condb.php" );
require_once( "control/shopfunction.php" );
$ketObj	=	new ketech();
if( !isset( $_SESSION['secure_admin'] ) )
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
<?php
//die();
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
                        <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>MYCHIRAAG</span></a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                         <img src="images/img.jpg" alt="..." class="img-circle profile_img"/>
                        </div>
                        <div class="profile_info">
                            <span ></i>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                           <!-- <h3>General</h3>-->
                            <ul class="nav side-menu">
                                <li><a  href="index.php"><i class="fa fa-home"></i>Home <span class="fa fa-chevron-down"></span></a>
                                    <!--<ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">Dashboard</a>
                                        </li>
                                        <li><a href="index2.html">Dashboard2</a>
                                        </li>
                                        <li><a href="index3.html">Dashboard3</a>
                                        </li>
                                    </ul>-->
                                </li>
                                 <li><a><i class="fa fa-home"></i>User<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopu">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopu&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-home"></i> Category <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopc">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopc&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-home"></i>Banner <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopb">List</a>
                                        </li>
                                        <li><a href="index.php?v=shopb&f=add">Add New</a>
                                        </li>
                                    </ul>
                                </li>
								<li><a><i class="fa fa-home"></i> Product <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopp">Product List</a>
                                        </li>
                                        <!--<li><a href="index.php?v=shopcf">Custom Field</a>
                                        </li>
										<li><a href="index.php?v=shopm">Manufacturers</a>
                                        </li>-->
                                     
                                     	
                                          <li><a href="index.php?v=shopv">Vendor</a>
                                          </li>
                                         <li><a href="index.php?v=shopvendorcity">Vendor City</a>
                                        </li>
                                         <li><a href="index.php?v=shopvendorarea">Vendor Area</a>
                                        </li>
                                        <!-- <li><a href="index.php?v=shopo">Offer</a>
                                        </li>-->
                                       
                                       
                                    </ul>
                                </li>
								 <li><a><i class="fa fa-home"></i>Vendor Approval<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopvendorapproval">Vendor Approval</a>
                                        </li>
								</ul>		
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
                                    </li><li><a><i class="fa fa-home"></i>Discount<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopdiscount">List</a></li>
										 <li><a href="index.php?v=shopdiscount&f=add">Add Rule</a></li>
								   </ul>
								   </li>
								   <li><a><i class="fa fa-home"></i>Set Delivery time<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=setdeliverytime">List</a></li>
										 <li><a href="index.php?v=setdeliverytime&f=add">Add New</a></li>
								   </ul>
								   </li>
                                   <!-- /* </li><li><a><i class="fa fa-home"></i>Product Discount <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.php?v=shopproductdiscount">List</a></li>
										 <li><a href="index.php?v=shopproductdiscount&f=add">Add Rule</a></li>
									</ul>	 
                                    </li>*/-->
										
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
                                </li>
                                <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
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
                                </li>
                                <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="tables.html">Tables</a>
                                        </li>
                                        <li><a href="tables_dynamic.html">Table Dynamic</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
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
                        <!--/*<div class="menu_section">
                            <h3>Live On</h3>
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
                            </ul>
                        </div>*/-->

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
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
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
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <!--<ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a>
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
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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

                        </ul>-->
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            
			<?php
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
			
            <!-- /page content -->
        </div>


    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>
    <!-- gauge js -->
    <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- sparkline -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>

    <script src="js/custom.js"></script>
    <!-- skycons -->
    <script src="js/skycons/skycons.js"></script>

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

    <script>
        //random data
        var d1 = [
        [0, 1], [1, 9], [2, 6], [3, 10], [4, 5], [5, 17], [6, 6], [7, 10], [8, 7], [9, 11], [10, 35], [11, 9], [12, 12], [13, 5], [14, 3], [15, 4], [16, 9]
    ];

        //flot options
        var options = {
            series: {
                curvedLines: {
                    apply: true,
                    active: true,
                    monotonicFit: true
                }
            },
            colors: ["#26B99A"],
            grid: {
                borderWidth: {
                    top: 0,
                    right: 0,
                    bottom: 1,
                    left: 1
                },
                borderColor: {
                    bottom: "#7F8790",
                    left: "#7F8790"
                }
            }
        };
        var plot = $.plot($("#placeholder3xx3"), [{
            label: "Registrations",
            data: d1,
            lines: {
                fillColor: "rgba(150, 202, 89, 0.12)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
                }], options);
    </script>
    <!-- /flot -->
    <!--  -->
    <script>
        $('document').ready(function () {
            $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                height: '40',
                barWidth: 9,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline_two").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'line',
                width: '200',
                height: '40',
                lineColor: '#26B99A',
                fillColor: 'rgba(223, 223, 223, 0.57)',
                lineWidth: 2,
                spotColor: '#26B99A',
                minSpotColor: '#26B99A'
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
            var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);


        })
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

    <!-- moris js -->
    <script src="js/moris/raphael-min.js"></script>
    <script src="js/moris/morris.js"></script>
    <script>
        $(function () {
            var day_data = [
                {
                    "period": "Jan",
                    "Hours worked": 80
                },
                {
                    "period": "Feb",
                    "Hours worked": 125
                },
                {
                    "period": "Mar",
                    "Hours worked": 176
                },
                {
                    "period": "Apr",
                    "Hours worked": 224
                },
                {
                    "period": "May",
                    "Hours worked": 265
                },
                {
                    "period": "Jun",
                    "Hours worked": 314
                }
    ];
            Morris.Bar({
                element: 'graph_bar',
                data: day_data,
                hideHover: 'always',
                xkey: 'period',
                barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                ykeys: ['Hours worked', 'sorned'],
                labels: ['Hours worked', 'SORN'],
                xLabelAngle: 60
            });
        });
    </script>
    <!-- skycons -->
    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>
    <script>
    
        var opts = {
            lines: 12, // The number of lines to draw
            angle: 0, // The length of each line
            lineWidth: 0.4, // The line thickness
            pointer: {
                length: 0.75, // The radius of the inner circle
                strokeWidth: 0.042, // The rotation offset
                color: '#1D212A' // Fill color
            },
            limitMax: 'false', // If true, the pointer will not go past the end of the gauge
            colorStart: '#1ABC9C', // Colors
            colorStop: '#1ABC9C', // just experiment with them
            strokeColor: '#F0F3F3', // to see which ones work best for you
            generateGradient: true
        };
        var target = document.getElementById('foo2'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        gauge.maxValue = 5000; // set max gauge value
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(3200); // set actual value
        gauge.setTextField(document.getElementById("gauge-text2"));
    </script>
</body>

</html>