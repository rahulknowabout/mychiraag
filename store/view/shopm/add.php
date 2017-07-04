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
	cid	=	document.getElementById('hidcid').value;
	malias	=	document.getElementById('malias').value;
	if(/^[a-zA-Z0-9-]*$/.test(calias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&cid="+cid+"&chk=manfufalias&malias="+calias,
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
$mid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechmanuf", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopm");
		
	}
if( isset( $_REQUEST['mid'] ) && $_REQUEST['mid'] > 0 )
{
	$mid	=	$_REQUEST['mid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechmanuf", array(), "where id = ".$_REQUEST['mid'].""  );
}
//$allCat = $ketObj->runquery( "SELECT", "id,cname,calias", "ketechmanuf", array(), ""  );

/*echo "<pre>";
print_r( $allSet  );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$mname	=	$allSet[0]['mname'];	
	$malias	=	$allSet[0]['malias'];	
	$mstatus	=	$allSet[0]['mstatus'];	
	
}else
{
	$mname	=	"";	
	$malias	=	"";	
	$mstatus =	"";	
}
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Manufacturer</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Manufacturer Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="mname" name="mname" data-parsley-id="3686" value="<?php echo $mname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Alias <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Manufacturer Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="malias" name="malias" data-parsley-id="3686" value="<?php echo $malias; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div data-toggle="buttons" class="btn-group" id="cstatus">
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-default parsley-success">
                                                        <input type="radio" value="0" name="mstatus" data-parsley-multiple="mstatus" data-parsley-id="5564"<?php if( isset($pstatus ) && $pstatus == 0){ echo 'checked ="checked"';} ?>> &nbsp; In-Active &nbsp;
                                                    </label><ul class="parsley-errors-list" id="parsley-id-multiple-cstatus"></ul>
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-primary active">
                                                        <input type="radio" checked="" value="1" name="mstatus" data-parsley-multiple="mstatus" data-parsley-id="5564"<?php if( isset($pstatus ) && $pstatus == 1 ){ echo 'checked ="checked"';} ?>> Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Thumb <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Manufacturer Icon" type="file" class="form-control col-md-7 col-xs-12" id="manuthumbimg" name="manuthumbimg" data-parsley-id="3686" value="">
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
	<input type="hidden" name="task" value="addeditmanuf" />
	<input type="hidden" name="c" value="shopm" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidmid" id="hidmid" value="<?php echo $mid; ?>" />
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<!--<script src="js/select/select2.full.js"></script>
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

</script>-->