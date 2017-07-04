<script>
var formSubmit="no";
function chkAlias()
{
	cid	=	document.getElementById('hidcid').value;
	fldname	=	document.getElementById('fldname').value;
	if(/^[a-zA-Z0-9 ]*$/.test(fldname) == false) {
		alert('No special characters are allowed!');
		return false;
	}
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&cid="+cid+"&chk=customfld&fldname="+fldname,
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
					alert( "Field name already exists!" );
					document.getElementById('calias').focus();
					return false;
				}
			}
		})
		//return false;	
}

</script>
<?php
$cid = 0;
if( isset( $_REQUEST['cid'] ) && $_REQUEST['cid'] > 0 )
{
	$cid	=	$_REQUEST['cid'];
}
$allCat = $ketObj->runquery( "SELECT", "*", "ketechfld", array(), " WHERE id = ".$cid  );
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$fldname			=	$allSet[0]['fldname'];	
	$calias				=	$allSet[0]['cat_thmub_h'];	
	$fldmatrix			=	$allSet[0]['fldmatrix'];	
	$fldstockable		=	$allSet[0]['fldstockable'];	
	$fldnotstockable	=	$allSet[0]['fldnotstockable'];	
}else
{
	$fldname			=	"";	
	$calias				=	"";	
	$fldmatrix			=	"";	
	$fldstockable		=	"";	
	$fldnotstockable	=	"";	
}
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit CustomField</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Field Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Field Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="fldname" name="fldname" data-parsley-id="3686" value="<?php echo $fldname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Field Matrix<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Field Matrix" type="text" class="form-control col-md-7 col-xs-12" required="required" id="fldmatrix" name="fldmatrix" data-parsley-id="3686" value="<?php echo $fldmatrix; ?>"> (For Eg. size,color)
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Field Stockable<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="checkbox" class="" id="fldstockable" name="fldstockable" data-parsley-id="3686" value="1" <?php echo ( $fldstockable > 0 ? 'checked="checked"' : '' ) ?>>
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Field Attribute<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="checkbox" class="" id="fldnotstockable" name="fldnotstockable" data-parsley-id="3686" value="1" <?php echo ( $fldnotstockable > 0 ? 'checked="checked"' : '' ) ?>>
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
	<input type="hidden" name="task" value="addeditcustomfld" />
	<input type="hidden" name="c" value="shopcf" />
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