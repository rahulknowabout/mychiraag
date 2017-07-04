<?php ob_start();
session_start();
if( isset( $_REQUEST['act'] ) && $_REQUEST['act'] == "logout" )
{
	unset( $_SESSION['secure'] );
}
include('../condb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MYCHIRAAG(Vendor)</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


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

<body style="background:#F7F7F7;">
<?php
	     
		 
		 	$cls = "alert alert-danger alert-dismissible fade in";

			if( isset( $_POST['un'] ) && $_POST['un'] != "" && isset( $_POST['pw'] ) && $_POST['pw'] != "" ){
				$result = mysql_query("SELECT * FROM ketechuser where urole = 'vendor' AND uemail = '".$_POST['un']."' AND upassword = '".$_POST['pw']."'");
				$count = mysql_num_rows($result);
				if( $count > 0 ){
					$row = mysql_fetch_array($result);
					
					/*echo "<pre>";
					print_r( $row );
					die();*/
					
					$_SESSION['secure']	=	"yes";
					$_SESSION['vid']	=	$row['vid'];
					$_SESSION['vendorname']	=	$row['uname'];
					header( 'location:index.php' );
			  }
			  else{
	?>
					<div class="<?php echo $cls; ?>" role="alert">
						username and password do not match or you do not have an account yet.
					</div>
<?php      	 }
         }else{   ?>


			<div class="alert alert-success alert-dismissible fade in" role="alert">
					Please Fill username and Password.
			</div>
		<?php } ?>




	
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="post" action="login.php">
                        <h1>Secure Login</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="username" name="un" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="pw" required="" />
                        </div>
                        <div>
							<input type="submit" class="btn btn-default submit" value="Login">
                                                  </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-book" style="font-size: 26px;"></i>MYCHIRAAG<sub>(Vendor)</sub> </h1>

                                <p>©<?php echo date("Y"); ?> All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>