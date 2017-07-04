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
	cid	        =	document.getElementById('hidvid').value;
	areaname	=	document.getElementById('area_name').value;
	
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&cid="+cid+"&chk=areaname&areaname="+areaname,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
				//alert( msg );
				if( msg == "no" )
				{
					formSubmit	=	"yes";
					$("#addeditc").submit();
					return true;
				}else
				{
					alert( "Area already exists!" )
					//document.getElementById('calias').focus();
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
		$allSet = $ketObj->runquery( "DELETE", "", "ketechvendorarea", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopvendorarea");
		
	}
$cid = 0;
if( isset( $_REQUEST['cid'] ) && $_REQUEST['cid'] > 0 )
{
	$cid	=	$_REQUEST['cid'];
	$allSet =  $ketObj->runquery( "SELECT", "*", "ketechvendorarea", array(), "where id = ".$_REQUEST['cid'].""  );
}
/*echo "<pre>";
print_r( $allSet );
die();*/
$allVcity = $ketObj->runquery( "SELECT", "*", "ketechvendorcity", array(), ""  );
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$area_name	 =	$allSet[0]['area_name'];
	$vcity	 =	    $allSet[0]['vcity'];	
	
	
}else
{
	$area_name	=	"";	
	$vcity = "";
}

?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Vendor Area</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <div class="x_content">
                                    </br>
                                         <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Area Name*</label>
							
							<div class="col-md-9 col-sm-9 col-xs-12">
								   
                       <input type="text" class="form-control" placeholder="Area Name" name="area_name" id = "area_name" value="<?php echo $area_name;?>"  required/>
					   
							</div>
							
						</div>
						   <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor City<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  id="vcity" name="vcity" class="form-control col-md-7 col-xs-12">
													<option value="0">Choose City</option>
													<?php
														if( isset( $allVcity ) && is_array( $allVcity ) && count($allVcity ) > 0 )
														{
															foreach( $allVcity as $allCatK => $allCatV )
															{
													?>
																<option value="<?php echo $allCatV['id'] ?>"<?php if( isset( $vcity ) && $vcity == $allCatV['id'] ) { echo "selected = \"selected\"";} ?>><?php echo $allCatV['city_name'].""; ?></option>
													<?php			
															}
														}
													?>
												</select>
                                            </div>
                                        </div>
						   <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								
								<button type="reset" class="btn btn-primary">Reset</button>
								<button type="submit" class="btn btn-success xcxc" >Submit</button>
								
							</div>
						</div>  
                     
					   
							</div>
							
						</div>  
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<input type="hidden" name="task" value="addeditvendorarea" />
	<input type="hidden" name="c" value="shopvendorarea" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidvid" id="hidvid" value="<?php echo $cid; ?>" />
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