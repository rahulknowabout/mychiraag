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
	//alert("fffff");
	del_from	=	document.getElementById('from').value;
	del_to	=	document.getElementById('to').value;
	id = document.getElementById('hidid').value;
	
	/*if(/^[a-zA-Z0-9-]*$/.test(palias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&id="+id+"&chk=deliverytime&del_from="+del_from+"&del_to="+del_to,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
				//alert(msg);
				if( msg == "no" )
				{
					if( del_from == del_to ){
			          alert("Delivery From time And Delivery To time are  Identical" );
			          return false;
		           }else{
					
						formSubmit	=	"yes";
						$("#addeditc").submit();
						return true;
				   }	
				
				
					
				}else
				{
					alert( "This Time Slot already exists!" )
					//document.getElementById('vemail').focus();
					return false;
				}
			}
		})
		
		/*del_from = document.getElementById('from').value;
		del_to = document.getElementById('to').value;*/
		
		
		
		//return false;
}
</script>
<?php
$allVendor = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), ""  );


$uid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechdelivery_time", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=setdeliverytime");
		
	}
if( isset( $_REQUEST['id'] ) && $_REQUEST['id'] > 0 )
{
	$id	=	$_REQUEST['id'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechdelivery_time", array(), "where id = ".$_REQUEST['id'].""  );
}
/*echo "<pre>";
print_r( $allSet );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$del_from	= $allSet[0]['from_time'];	
	$del_to =     $allSet[0]['to_time'];	
		
	
}else
{
	$id = "";
	$del_from	= "";	
	$del_to =    "";	
	
}

?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Set Delivery Time Slot</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <div class="x_content">
                                    <br>
									
									<!--<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="vid" class="form-control">
												<option value="0">Choose Vendor</option>
												<?php
														foreach( $allVendor as  $allVendorV )
														{
												?>
												
												<option value="<?php echo $allVendorV['id'];?>"<?php if( $vid == $allVendorV['id'] ) { echo 'selected = "selected"';} ?>><?php echo $allVendorV['vname'];?></option>
											  <?php		
														}
												
												
												?>
													
												
												</select>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">From<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <!-- <input placeholder="From" type="text" class="form-control col-md-7 col-xs-12" required="required" id="from" name="from" data-parsley-id="3686" value="<?php echo $fromd; ?>">-->
												
									<select name="from" class="form-control" id = "from">
												<option value="0"></option>
										<option value="10AM"<?php if( $del_from == '10AM'){ echo "selected='selected'";}?> >10AM</option>
										<option value="11AM"<?php if( $del_from == '11AM'){ echo "selected='selected'";}?>>11AM</option>
										<option value="12PM"<?php if( $del_from == '12PM'){ echo "selected='selected'";}?>>12PM</option>
										
										<option value="1PM"<?php if( $del_from == '1PM'){ echo "selected='selected'";}?>>1PM</option>
										<option value="2PM"<?php if( $del_from == '2PM'){ echo "selected='selected'";}?>>2PM</option>
										<option value="3PM"<?php if( $del_from == '3PM'){ echo "selected='selected'";}?>>3PM</option>
										<option value="4PM"<?php if( $del_from == '4PM'){ echo "selected='selected'";}?>>4PM</option>
										<option value="5PM"<?php if( $del_from == '5PM'){ echo "selected='selected'";}?>>5PM</option>
										<option value="6PM"<?php if( $del_from == '6PM'){ echo "selected='selected'";}?>>6PM</option>
										<option value="7PM"<?php if( $del_from == '7PM'){ echo "selected='selected'";}?>>7PM</option>
										<option value="8PM"<?php if( $del_from == '8PM'){ echo "selected='selected'";}?>>8PM</option>
										<option value="9PM"<?php if( $del_from == '9PM'){ echo "selected='selected'";}?>>9PM</option>
										<option value="10PM"<?php if( $del_from == '10PM'){ echo "selected='selected'";}?>>10PM</option>
								</select>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">To<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <!--  <input placeholder="To" type="text" class="form-control col-md-7 col-xs-12" required="required" id="to" name="to" data-parsley-id="3686" value="<?php echo $tod; ?>">-->
												
												<select name="to" class="form-control" id = "to">
												<option value="0"></option>
											<option value="10AM"<?php if( $del_from == '10AM'){ echo "selected='selected'";}?> >10AM</option>
										<option value="11AM"<?php if( $del_to == '11AM'){ echo "selected='selected'";}?>>11AM</option>
										<option value="12PM"<?php if( $del_to == '12PM'){ echo "selected='selected'";}?>>12PM</option>
										
										<option value="1PM"<?php if( $del_to == '1PM'){ echo "selected='selected'";}?>>1PM</option>
										<option value="2PM"<?php if( $del_to == '2PM'){ echo "selected='selected'";}?>>2PM</option>
										<option value="3PM"<?php if( $del_to == '3PM'){ echo "selected='selected'";}?>>3PM</option>
										<option value="4PM"<?php if( $del_to == '4PM'){ echo "selected='selected'";}?>>4PM</option>
										<option value="5PM"<?php if( $del_to == '5PM'){ echo "selected='selected'";}?>>5PM</option>
										<option value="6PM"<?php if( $del_to == '6PM'){ echo "selected='selected'";}?>>6PM</option>
										<option value="7PM"<?php if( $del_to == '7PM'){ echo "selected='selected'";}?>>7PM</option>
										<option value="8PM"<?php if( $del_to == '8PM'){ echo "selected='selected'";}?>>8PM</option>
										<option value="9PM"<?php if( $del_to == '9PM'){ echo "selected='selected'";}?>>9PM</option>
										<option value="10PM"<?php if( $del_to == '10PM'){ echo "selected='selected'";}?>>10PM</option>
											</select>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Phone" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uphone" name="uphone" data-parsley-id="3686" value="<?php echo $uphone; ?>">
                                            </div>
                                        </div>-->
                                        <!--<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="User Password" type="password" class="form-control col-md-7 col-xs-12" required="required" id="upassword" name="upassword" data-parsley-id="3686" value="<?php echo $upassword; ?>">
                                            </div>
                                        </div>-->
                                       <!-- <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Confirm Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="ucpasswoed" name="ucpassword" data-parsley-id="3686" value="<?php //echo $calias; ?>">
                                            </div>
                                        </div>-->
                                        <!--<div class="form-group">
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
                                        </div>-->
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
	<input type="hidden" name="c" value="setdeliverytime" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidid" id="hidid" value="<?php echo $id; ?>" />
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