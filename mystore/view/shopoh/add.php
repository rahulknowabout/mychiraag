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
<!--<script>
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

</script>-->
<?php
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechoffer", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopo");
		
	}
$fid = 0;
if( isset( $_REQUEST['cid'] ) && $_REQUEST['cid'] > 0 )
{
	$fid	=	$_REQUEST['cid'];
	$allSet =  $ketObj->runquery( "SELECT", "*", "ketechoffer", array(), "where id = ".$_REQUEST['cid'].""  );
}
/*echo "<pre>";
print_r( $allSet );
die();
*///$allCat = $ketObj->runquery( "SELECT", "id,cname,calias", "ketechcat", array(), ""  );
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$ftitle	 =	$allSet[0]['title'];	
	$fodes =	$allSet[0]['odes'];	
	$fccode =	$allSet[0]['ccode'];	
	$fs_date =	$allSet[0]['s_date'];
	$fe_date = $allSet[0]['e_date'];
	
	
}else
{
	$ftitle	 =	"";	
	$fodes =	"";	
	$fccode =	"";	
	$fs_date =	"";
	$fe_date = "";
	
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Category Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="title" name="title" data-parsley-id="3686" value="<?php echo $ftitle; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Offer Description
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="ckeditor" id="odes" name="odes" data-parsley-id="3686"><?php  echo $fodes; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Offer Thumb <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Offer Image" type="file" class="form-control col-md-7 col-xs-12" id="offerhumbimg" name="offerthumbimg" data-parsley-id="3686" value="">
                                            </div>
                                        </div>
                                        
                                         
                                        
                                        <!-- <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              
                                                
                                                <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Disbursal Date" aria-describedby="inputSuccess2Status2" name="disbursal_date" value="<?php //if(isset($_GET['agreement_no']) ) { echo $rows['0']['disbursal_date'];} ?>" required>
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date*</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								   
                      					<fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Start Date  M/D/Y" aria-describedby="inputSuccess2Status2" name="s_date" value="<?php echo $fs_date; ?>" required>
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
							</div>
						</div> 
                                         
                                  <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">End Date*</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								   
                      					<fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="End Date  M/D/Y" aria-describedby="inputSuccess2Status2" name="e_date" value="<?php echo $fe_date; ?>" required>
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
							</div>
						</div> 
                                      <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Coupen Code <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Coupen Code" type="text" class="form-control col-md-7 col-xs-12" required="required" id="ccode" name="ccode" data-parsley-id="3686" value="<?php echo $fccode; ?>">
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
	<input type="hidden" name="task" value="addeditoffer" />
	<input type="hidden" name="c" value="shopo"/>
	<input type="hidden" name="f" value="tmpl"/>
	<input type="hidden" name="hidfid" id="hidfid" value="<?php echo $fid; ?>" />
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>
<!--<script>
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
<script>
CKEDITOR.replace( 'content', {
    filebrowserBrowseUrl: './browser/browse.php',
    filebrowserUploadUrl: './index.php?onlyupload=y'
});
var editor = CKEDITOR.replace( 'editor1' );
CKFinder.setupCKEditor( editor, '/images/' );
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>