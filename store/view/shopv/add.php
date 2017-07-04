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
	uid	=	document.getElementById('hidvid').value;
	vemail	=	document.getElementById('vphone').value;
	
	/*if(/^[a-zA-Z0-9-]*$/.test(palias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&uid="+uid+"&chk=vemail&vemail="+vemail,
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
					alert( "Number already exists!" )
					document.getElementById('vemail').focus();
					return false;
				}
			}
		})
		//return false;
}
</script>
<script>
function areaajax( str )
{
	//alert("ffggf");
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('chk',"areanamev");
	document.getElementById("varea").innerHTML = "";
	//alert(data);
	//alert("xjcjcjcjc");
	
	//var params = "aj=y&artc="+str;
	//alert( str );
	 if (str == "") {
	                    
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
	
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				/*alert(xmlhttp.responseText);*/
				document.getElementById("varea").innerHTML = xmlhttp.responseText;
			}else{
			
			}
        }
		//alert( "index.php?aj=y&artc="+str);
		
        xmlhttp.open("POST","index.php",true);
	
        xmlhttp.send(data);
    }
	
}
	

</script>
<?php
$vid = 0;
$uid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechvendor", array(), "WHERE id=".$_REQUEST['del'] );
		$allSet = $ketObj->runquery( "DELETE", "", "ketechuser", array(), "WHERE id=".$_REQUEST['uid'] );
		$querydt = "DROP TABLE ketechvp_".$_REQUEST['del'].",ketechord_".$_REQUEST['del']."";
		mysql_query( $querydt );
		header("Location: index.php?v=shopv");
		
	}
if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 )
{
	$vid	=	$_REQUEST['vid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechvendor", array(), "where id = ".$_REQUEST['vid'].""  );
}
$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), ""  );
/*echo "<pre>";
print_r($allSet);
die();*/
foreach( $allCat as $allCatKey => $allCatValue)
{
	if( $allCatValue['cparent'] == 0 )
	{
		$allCatParent['parent'][] = $allCatValue['cname']."/".$allCatValue['id'];
	
		
	}
}
 // $CatNameIdArray = explode("/",$allCatParent['parent']['0']);
  
//echo "<pre>";
//print_r(  $CatNameIdArray  );
//die();

$allVcity = $ketObj->runquery( "SELECT", "*", "ketechvendorcity", array(), ""  );

/*echo "<pre>";
print_r( $allVcity );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$vname	=	    $allSet[0]['vname'];	
	$vaddress	=	$allSet[0]['vaddress'];	
	$vphone		=	$allSet[0]['vphone'];	
	$vmail		=	$allSet[0]['vmail'];
	$vcity = 	    $allSet[0]['vcity'];
	$varea = 	    $allSet[0]['varea'];
	$vcityid = 	    $allSet[0]['vcityid'];
	$vareaid = 	    $allSet[0]['vareaid'];
	$vcname		=	$allSet[0]['vcname'];	
	$vcaddress	=	$allSet[0]['vcaddress'];	
	$vcphone	=	$allSet[0]['vcphone'];	
	$vcmail	=	    $allSet[0]['vcmail'];	
	$uid =          $allSet[0]['uid'];
	$allVarea = $ketObj->runquery( "SELECT", "*", "ketechvendorarea", array(), "where vcity = ".$vcityid.""  );
	$exparea =  explode(",",rtrim($vareaid,","));
	/*echo "<pre>";
	print_r($exparea);
	die();*/
	
	
}else
{
	
	$vname	 =	   "";	
	$vaddress =	   "";
	$vcityid = 	   "";
	$vareaid  = 	"";	
	$vphone		=	"";	
	$vmail		=	"";	
	$vcname		=	"";	
	$vcaddress	=	"";	
	$vcphone	=	"";	
	$vcmail	=   "";	
	$vcity = "";
	$exparea = array();
}
?>

<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left"  >
                            <h3>Add/Edit Vendor</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <!-- Smart Wizard -->
                                    <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        <ul class="wizard_steps">
                                            <li>
                                                <a href="#step-1">
                                                    <span class="step_no">1</span>
                                                    <span class="step_descr">
                                            Step 1<br />
                                            <small>Personal Information</small>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-2">
                                                    <span class="step_no">2</span>
                                                    <span class="step_descr">
                                            Step 2<br />
                                            <small>Company Description</small>
                                        </span>
                                                </a>
                                            </li>
                                            </ul>
                                        <div id="step-1">
                                                <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Vendor Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="vname" name="vname" data-parsley-id="3686" value="<?php echo $vname; ?>">
                                            </div>
                                        </div>
									
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Vendor email" type="email" class="form-control col-md-7 col-xs-12" required="required" id="vemail" name="vemail" data-parsley-id="3686" value="<?php echo $vmail; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Phone<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Vendor Phone" type="number" class="form-control col-md-7 col-xs-12" required="required" id="vphone" name="vphone" data-parsley-id="3686" value="<?php echo $vphone; ?>" min="0">
                                            </div>
                                        </div>
                                       	<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Address<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Vendor Address" type="text" class="form-control col-md-7 col-xs-12" required="required" id="vaddress" name="vaddress" data-parsley-id="3686" value="<?php echo $vaddress; ?>">
                                            </div>
                                        </div>
                                        	
                                        <!-- Vendor City -->
                                           <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor City<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  id="vcity" name="vcity" class="form-control col-md-7 col-xs-12" onchange = "areaajax(this.value)" required="required">
													<option value="">Choose City</option>
													<?php
														if( isset( $allVcity ) && is_array( $allVcity ) && count($allVcity ) > 0 )
														{
															foreach( $allVcity as $allCatK => $allCatV )
															{
													?>
																<option value="<?php echo $allCatV['id']."/".$allCatV['city_name']; ?>"<?php if( isset( $vcityid ) && $vcityid == $allCatV['id'] ) { echo "selected = \"selected\"";} ?>><?php echo $allCatV['city_name'].""; ?></option>
													<?php			
															}
														}
													?>
												</select>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Area<span class="required">*</span>
                                            </label>
											 <div class="col-md-6 col-sm-6 col-xs-12">
											 
                                                <select  id="varea" name="varea[]" class="form-control col-md-7 col-xs-12"  multiple="multiple" required="required">
													<option value="">Choose Area</option>
													<?php
														if( isset( $allVarea ) && is_array( $allVarea ) && count( $allVarea ) > 0 && isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
														{
															foreach( $allVarea as $allCatK => $allCatV )
															{
													?>
																<option value="<?php echo $allCatV['id']."/".$allCatV['area_name']; ?>"<?php if( isset( $exparea ) &&  in_array($allCatV['id'],$exparea ) ) { echo "selected = \"selected\"";} ?>><?php echo $allCatV['area_name'].""; ?></option>
													<?php			
															}
														}
													?>
													
												</select>
												
                                            </div>
                                        </div>
                                        </div>
                                        <div id="step-2">
                                              <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Company Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="vcname" name="vcname" data-parsley-id="3686" value="<?php echo $vcname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company Address<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input placeholder="Company Address" type="text" class="form-control col-md-7 col-xs-12" required="required" id="vcaddress" name="vcaddress" data-parsley-id="3686" value="<?php echo $vcaddress; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Company email" type="email" class="form-control col-md-7 col-xs-12" required="required" id="vcemail" name="vcemail" data-parsley-id="3686" value="<?php echo $vcmail; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Company Phone" type="number" class="form-control col-md-7 col-xs-12" required="required" id="vcphone" name="vcphone" data-parsley-id="3686" value="<?php echo $vcphone; ?>" min="0">
                                            </div>

                                        </div>
                                        </div>
                                        
                                   
                                    <!-- End SmartWizard Content -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
	<input type="hidden" name="task" value="addeditvendor" />
	<input type="hidden" name="c" value="shopv"/>
	<input type="hidden" name="f" value="tmpl"/>
	<input type="hidden" name="hidvid" id="hidvid" value="<?php echo $vid; ?>" />
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