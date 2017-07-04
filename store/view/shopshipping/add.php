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
//alert("hhhhh");
	sid	=	document.getElementById('hidsid').value;
	minpa	=	document.getElementById('minpa').value;
	maxpa	=	document.getElementById('maxpa').value;
	vid	=	    document.getElementById('vendor').value;

	/*if(/^[a-zA-Z0-9-]*$/.test(calias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&sid="+sid+"&chk=shipping&minpa="+minpa+"&maxpa="+maxpa+"&vid="+vid,
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
					alert( "Shipping Rule already exists!" )
					//document.getElementById('calias').focus();
					return false;
				}
			}
		})
		//return false;	
}

</script>
<?php

$allVendor = $ketObj->runquery( "SELECT", "id,vname", "ketechvendor", array(), ""  );
/*echo "<pre>";
print_r( $allVendor );
die()*/; 
$sid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechshipping", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopshipping");
		
	}
if( isset( $_REQUEST['sid'] ) && $_REQUEST['sid'] > 0 )
{
	$sid	=	$_REQUEST['sid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechshipping", array(), "where id = ".$_REQUEST['sid'].""  );
}
//$allCat = $ketObj->runquery( "SELECT", "id,cname,calias", "ketechmanuf", array(), ""  );

/*echo "<pre>";
print_r( $allSet  );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$minpa	=	$allSet[0]['minpa'];	
	$maxpa	=	$allSet[0]['maxpa'];	
	$shipping_charges	=	$allSet[0]['shipping_charges'];
	$vendor	=	$allSet[0]['vid'];		
	
}else
{
	$minpa	=	"";
	$maxpa	=	"";	
	$shipping_charges	=	"";
	$vendor	=	"";				
}
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Shipping Rule</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Minimum Purchasing Amount <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Minimum Purchasing Amount" type="number" class="form-control col-md-7 col-xs-12" required="required" id="minpa" name="minpa" data-parsley-id="3686" value="<?php echo $minpa; ?>" min="0" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Maximum Purchasing Amount <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Maximum Purchasing Amount" type="number" class="form-control col-md-7 col-xs-12" required="required" id="maxpa" name="maxpa" data-parsley-id="3686" value="<?php echo $maxpa; ?>" min="0"/>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Shipping Charges<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Shipping Charges" type="number" class="form-control col-md-7 col-xs-12" required="required" id="shipping_charges" name="shipping_charges" data-parsley-id="3686" value="<?php echo $shipping_charges; ?>" min="0"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Choose Vendor<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="vendor" id = "vendor" >
                                              							<option value="0"> Chosse Vendor </option>
											  
											  								<?php foreach( $allVendor as $allVendorV  ) 
											  								  {
																				
																		?>			
                                                                        	<option value="<?php echo  $allVendorV['id']; ?>"<?php if( $allVendorV['id'] == $vendor ) { echo "selected='selected'"; } ?>><?php echo  $allVendorV ['vname']; ?></option>
                                                                        		
                                                                        <?php
																		   }
																		?>		  		
                                             </select>
                                           
                                           
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
	<input type="hidden" name="task" value="addeditshipping" />
	<input type="hidden" name="c" value="shopshipping" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidsid" id="hidsid" value="<?php echo $sid; ?>" />
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