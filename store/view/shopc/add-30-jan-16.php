<?php ob_start(); ?>
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
	//alert("hello");
	cid	=	document.getElementById('hidcid').value;
	calias	=	document.getElementById('calias').value;
	if(/^[a-zA-Z0-9-]*$/.test(calias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&cid="+cid+"&chk=catalias&calias="+calias,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
				if( msg == "no" )
				{
					formSubmit	=	"yes";
					$("#addeditc").submit();
					return true;
				}else
				{
					alert( "Alias already exists!" )
					document.getElementById('calias').focus();
					return false;
				}
			}
		})
		//return false;	
}

</script>
<?php
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechcat", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopc");
		
	}
$cid = 0;
if( isset( $_REQUEST['cid'] ) && $_REQUEST['cid'] > 0 )
{
	$cid	=	$_REQUEST['cid'];
	$allSet =  $ketObj->runquery( "SELECT", "*", "ketechcat", array(), "where id = ".$_REQUEST['cid'].""  );
}
/*echo "<pre>";
print_r( $allSet );
die();
*/$allCat = $ketObj->runquery( "SELECT", "id,cname,calias", "ketechcat", array(), "cstatus = 1"  );
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$cname	 =	$allSet[0]['cname'];	
	$calias	 =	$allSet[0]['calias'];
	$clocation = $allSet[0]['clocation'];	
	$cat_des =	$allSet[0]['cdesc'];
	$cat_status = $allSet[0]['cstatus'];
	$cat_parent = $allSet[0]['cparent'];
	
}else
{
	$cname	=	"";	
	$calias	=	"";	
	$cat_des =	"";
	$clocation = "";
	$cat_full_w		=	"";	
	$cat_full_h		=	"";	
	$cat_prod_w		=	"";	
	$cat_prod_h		=	"";	
	$prod_full_w	=	"";	
	$prod_full_h	=	"";	
}



?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Category</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cname" name="cname" data-parsley-id="3686" value="<?php echo $cname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Alias <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="calias" name="calias" data-parsley-id="3686" value="<?php echo $calias; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Order <span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="select2_single form-control" tabindex="-1" name="cparent">
													<option value="0">Top Level</option>
													<?php
														if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 )
														{
															foreach( $allCat as $allCatK => $allCatV )
															{
													?>
																<option value="<?php echo $allCatV['id'] ?>" <?php if( isset( $cat_parent ) && $cat_parent == $allCatV['id'] ) { echo "selected = \"selected\"";} ?>><?php echo $allCatV['cname']." ( ".$allCatV['calias']." ) " ?></option>
													<?php			
															}
														}
													?>
												</select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Location<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  class="form-control" name="clocation">
													<option value="left" <?php if( $clocation == "left" ) { echo 'selected = "selected"';} ?>>Left</option>
													<option value="right"<?php if( $clocation == "right" ) { echo 'selected = "selected"';} ?>>Right</option>
													
												</select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div data-toggle="buttons" class="btn-group" id="cstatus">
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-default parsley-success <?php if( isset( $cat_status ) &&  $cat_status == 0 ){ echo "active"; } ?>">
                                                        <input type="radio" value="0" name="cstatus" data-parsley-multiple="cstatus" data-parsley-id="5564" <?php if( isset( $cat_status ) &&  $cat_status == 0 ){ echo "checked = 'checked'"; } ?>/> &nbsp; Un-Publish &nbsp;
                                                    </label><ul class="parsley-errors-list" id="parsley-id-multiple-cstatus"></ul>
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-primary <?php if( isset( $cat_status ) &&  $cat_status == 1 ){ echo "active"; } ?>">
                                                        <input type="radio" <?php if( isset( $cat_status ) &&  $cat_status == 1 ){ echo "checked = 'checked'"; } ?> value="1" name="cstatus" data-parsley-multiple="cstatus" data-parsley-id="5564"> Publish
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
										
										
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Thumb <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Image" type="file" class="form-control col-md-7 col-xs-12" id="catthumbimg" name="catthumbimg" data-parsley-id="3686" value=""><?php echo $_SESSION['config']['cat_thmub_w']." x ".$_SESSION['config']['cat_thmub_h']; ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Full <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Image" type="file" class="form-control col-md-7 col-xs-12" id="catimg" name="catimg" data-parsley-id="3686" value=""><?php echo $_SESSION['config']['cat_full_w']." x ".$_SESSION['config']['cat_full_w']; ?>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Description
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="ckeditor" id="cdesc" name="cdesc" data-parsley-id="3686"><?php  echo $cat_des; ?></textarea>
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
	<input type="hidden" name="task" value="addeditcat" />
	<input type="hidden" name="c" value="shopc" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidcid" id="hidcid" value="<?php echo $cid; ?>" />
</form>
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
	
	$("#addeditc").submit(function(e){
		if(formSubmit=="yes")
		{
			
		}else
		{
			e.preventDefault();
			chkAlias();
		}
});

</script>