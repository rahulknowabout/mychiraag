<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<style>
	#cke_1_contents
	{
		height:200px !important;
	}
</style>
<script>
var formSubmit="no";
function chkAlias()
{
	alert("fffff");
	uid	=	document.getElementById('hiduid').value;
	uemail	=	document.getElementById('uemail').value;
	
	/*if(/^[a-zA-Z0-9-]*$/.test(palias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&uid="+uid+"&chk=vemail&vemail="+uemail,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
				//alert(msg);
				if( msg == "no" )
				{
					formSubmit	=	"yes";
					$("#addeditc").submit();
					return true;
				}else
				{
					alert( "Email already exists!" )
					document.getElementById('vemail').focus();
					return false;
				}
			}
		})
		//return false;
}
</script>
<?php
$uid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechuser", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopu");
		
	}
if( isset( $_REQUEST['uid'] ) && $_REQUEST['uid'] > 0 )
{
	$mid	=	$_REQUEST['uid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechuser", array(), "where id = ".$_REQUEST['uid'].""  );
}
/*echo "<pre>";
print_r( $allSet );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$uname	=	  $allSet[0]['uname'];	
	$uaddress =   $allSet[0]['uaddress'];	
	$uphone	=	  $allSet[0]['uphone'];	
	$uemail =     $allSet[0]['uemail'];
	$upassword =  $allSet[0]['upassword'];	
	$urole  =     $allSet[0]['urole'];	
	$ucity  =     $allSet[0]['ucity'];	
	$uid = 	      $allSet[0]['id'];	
	
}else
{
	$uname	=	"";	
	$uaddress	=	"";	
	$uphone	=	"";	
	$uemail = "";
	$upassword = "";	
	$urole = "";	
	$ucity= "";	
	$uid = "";	
}

?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit User</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <div class="x_content">
                                    <br>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uname" name="uname" data-parsley-id="3686" value="<?php echo $uname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Email" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uemail" name="uemail" data-parsley-id="3686" value="<?php echo $uemail; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Phone" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uphone" name="uphone" data-parsley-id="3686" value="<?php echo $uphone; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Password" type="password" class="form-control col-md-7 col-xs-12" required="required" id="upassword" name="upassword" data-parsley-id="3686" value="<?php echo $upassword; ?>">
                                            </div>
                                        </div>
                                       <!-- <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Confirm Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="ucpasswoed" name="ucpassword" data-parsley-id="3686" value="<?php //echo $calias; ?>">
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Role<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="select2_single form-control" tabindex="-1" name="urole">
													<option value="superadmin"<?php if( $urole == "superadmin") { echo 'selected = "selected"';} ?>>Super Admin</option>
													<option value="manager"<?php if( $urole == "manager") { echo 'selected = "selected"';} ?>>Manager</option>
                                                    <option value="vendoe"<?php if( $urole == "vendor") { echo 'selected = "selected"';} ?>>Vendor</option>
                                                    <option value="pick"<?php if( $urole == "pick") { echo 'selected = "selected"';} ?>>Pick</option>
                                                    <option value="dispatch"<?php if( $urole == "dispatch") { echo 'selected = "selected"';} ?>>Dispatch</option>
                                                    <option value="pick&dispatch"<?php if( $urole == "pick&dispatch") { echo'selected = "selected"';} ?>> Pick&Dispatch </option>
												</select>
                                            </div>
                                        </div>
                                      <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Address" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uaddress" name="uaddress" data-parsley-id="3686" value="<?php echo $uaddress; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">City<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User City" type="text" class="form-control col-md-7 col-xs-12" required="required" id="ucity" name="ucity" data-parsley-id="3686" value="<?php echo $ucity; ?>">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-success" type="submit">Submit</button>
                                            </div>
                                        </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<input type="hidden" name="task" value="addedituser" />
	<input type="hidden" name="c" value="shopu" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hiduid" id="hiduid" value="<?php echo $uid; ?>" />
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>

<script type="text/javascript" src="js/wizard/jquery.smartWizard.js"></script>
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
	
	$("#addeditc").submit(function(e){
		if(formSubmit=="yes")
		{
			
		}else
		{
			e.preventDefault();
			chkAlias();
		}
});

 $(document).ready(function () {
            // Smart Wizard 	
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });

</script>