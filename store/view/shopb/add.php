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
	//alert("gghhghghg");
	bid	=	document.getElementById('hidbid').value;
	balias	=	document.getElementById('balias').value;
	/*if(/^[a-zA-Z0-9-]*$/.test(calias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&bid="+bid+"&chk=balias&balias="+balias,
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
					document.getElementById('balias').focus();
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
		$allSet = $ketObj->runquery( "DELETE", "", "ketechbanner", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopb");
		
	}
if( isset( $_REQUEST['bid'] ) && $_REQUEST['bid'] > 0 )
{
	$bid	=	$_REQUEST['bid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechbanner", array(), "where id = ".$_REQUEST['bid'].""  );
}
//$allCat = $ketObj->runquery( "SELECT", "id,title,order_b", "ketechbanner", array(), ""  );

/*echo "<pre>";
print_r( $allSet  );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$btitle	=	$allSet[0]['title'];	
	$balias	=	$allSet[0]['alias'];
	$order_b	=	$allSet[0]['order_b'];		
	$bstatus	=	$allSet[0]['status'];	
	
}else
{
	
	$btitle	=	"";	
	$balias	=	"";
	$order_b	=	"";		
	$bstatus	=	"";	
	$bid = "";
}
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Banner</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Title" type="text" class="form-control col-md-7 col-xs-12" required="required" id="title" name="title" data-parsley-id="3686" value="<?php echo $btitle; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Alias<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="balias" name="balias" data-parsley-id="3686" value="<?php echo $balias; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Order<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Order" type="text" class="form-control col-md-7 col-xs-12" required="required" id="order_b" name="order_b" data-parsley-id="3686" value="<?php echo $order_b; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div data-toggle="buttons" class="btn-group" id="cstatus">
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-default parsley-success <?php if( isset($bstatus ) && $bstatus == 0){ echo "active";} ?>">
                                                        <input type="radio" value="0" name="bstatus" data-parsley-multiple="mstatus" data-parsley-id="5564"<?php if( isset($bstatus ) && $bstatus == 0){ echo 'checked ="checked"';} ?>> &nbsp; In-Active &nbsp;
                                                    </label><ul class="parsley-errors-list" id="parsley-id-multiple-cstatus"></ul>
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-primary <?php if( isset($bstatus ) && $bstatus == 1 ){ echo "active";} ?>">
                                                        <input type="radio" checked="" value="1" name="bstatus" data-parsley-multiple="mstatus" data-parsley-id="5564"<?php if( isset($bstatus ) && $bstatus == 1 ){ echo 'checked ="checked"';} ?>> Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">image<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Manufacturer Icon" type="file" class="form-control col-md-7 col-xs-12" id="bimg" name="bimg" data-parsley-id="3686" value="">1200x600
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
	<input type="hidden" name="task" value="addeditbanner" />
	<input type="hidden" name="c" value="shopb" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidbid" id="hidbid" value="<?php echo $bid; ?>" />
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