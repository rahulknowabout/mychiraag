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
	pid	=	document.getElementById('hidpid').value;
	palias	=	document.getElementById('palias').value;
	
	if(/^[a-zA-Z0-9-]*$/.test(palias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&pid="+pid+"&chk=palias&palias="+palias,
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
					alert( "Alias already exists!" )
					document.getElementById('palias').focus();
					return false;
				}
			}
		})
		//return false;
}

function CatAjax( str )
{
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('idcc',str)
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
		//document.getElementById("div123c").style.display ="block";
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert(xmlhttp.responseText);
				     try
                        {
                            chkJson            =    JSON.parse( xmlhttp.responseText );
                        } catch( exception )
                        {
                            chkJson            =    null;
                        }
                        if(chkJson['sel'] == "")
                        {
							
							busscatid = chkJson['selid'];
							var input = document.createElement("input");

                            input.setAttribute("type", "hidden");

                            input.setAttribute("name", "buscatid");

                            input.setAttribute("value", busscatid);
							document.getElementById("addeditc").appendChild(input);
                            //append to form element that you want .

                        	
                        }else
                        {
                        	document.getElementById("div123").innerHTML+=chkJson['sel'];
							document.getElementById("div123c").style.display ="block";
                        }
				            
						}else
			            {
			
			            }
        }
		//alert( "index.php?aj=y&artc="+str);
		
        xmlhttp.open("POST","index.php",true);
	
        xmlhttp.send(data);
    }
	
}
	

</script>
<?php
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechprod", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location:index.php?v=shopp");
		
	}
$pid = 0;
if( isset( $_REQUEST['pid'] ) && $_REQUEST['pid'] > 0 )
{
	$pid	=	$_REQUEST['pid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechprod", array(), "where id = ".$_REQUEST['pid'].""  );
	$allSetC =  $ketObj->runquery( "SELECT", "cname", "ketechcat", array(), "where id = ".$allSet['0']['pcategory'].""  );
}
/*echo "<pre>";
print_r( $allSetC );
die();*/
$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), ""  );

if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$pname	=	        $allSet[0]['pname'];	
	$palias	   =	    $allSet[0]['palias'];	
	$pcategory =        $allSet[0]['pcategory'];	
	$p_sdesc	=	    $allSet[0]['p_sdesc'];
	$p_fdesc	=	    $allSet[0]['p_fdesc'];	
	$pmanufacturer = 	$allSet[0]['pmanufacturer'];
	$pstatus =          $allSet[0]['pstatus'];
	
}else
{
	$pname	     =	   "";	
	$palias	     =	   "";	
	$pcategory   =     "";	
	$p_sdesc	 =	   "";
	$p_fdesc	 =	   "";	
	$pmanufacturer =   "";
}
//echo "<pre>";
//print_r( $allCat);
//die();
foreach( $allCat as $allCatKey => $allCatValue)
{
	if( $allCatValue['cparent'] == 0 )
	{
		$allCatParent['parent'][] = $allCatValue['cname']."/".$allCatValue['id'];
	
		
	}
	if( $allCatValue['id'] == $pcategory  && isset( $_REQUEST['pid'] ) && $_REQUEST['pid'] > 0 )
	{
		$pcatname = $allCatValue['cname'];
	}
	else
	{
		$pcatname = "";
	}
	
	
}
 // $CatNameIdArray = explode("/",$allCatParent['parent']['0']);
  
//echo "<pre>";
//print_r(  $CatNameIdArray  );
//die();



?>



<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left"  >
                            <h3>Add/Edit Product</h3>
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
                                            <small>Information</small>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-2">
                                                    <span class="step_no">2</span>
                                                    <span class="step_descr">
                                            Step 2<br />
                                            <small>Step 2 description</small>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-3">
                                                    <span class="step_no">3</span>
                                                    <span class="step_descr">
                                            Step 3<br />
                                            <small>Images</small>
                                        </span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                        <div id="step-1">
                                                <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="pname" name="pname" data-parsley-id="3686" value="<?php echo $pname; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Alias <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Alias" type="text" class="form-control col-md-7 col-xs-12" required="required" id="palias" name="palias" data-parsley-id="3686" value="<?php echo $palias; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Category <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="productCat" onchange="CatAjax(this.value)">
                                              							<option value="0"> Chosse Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 
											  								  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option value="<?php echo  $CatNameIdArray['1']; ?>"<?php if( $pcategory > 0 && $pcategory == $CatNameIdArray['1']) { echo "selected='selected'"; } ?>><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
                                                                        <?php
																		   }
																		?>		  		
                                             </select>
                                             <?php if( isset( $allSetC ) && count( $allSetC  ) >0 ){  ?>
										              <input type="hidden" name="pide" value="<?php echo $allSetC['0']['id']; ?>"/>
                                               <?php echo "".$allSetC['0']['cname']."";
											   
											 }?>    
                                           
                                            </div>
                                        </div>
                                         <div class="form-group" id = "div123c" style="display:none">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product SubCategory <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" id = "div123">
                                           
                                            </div>
                                        </div>
                                        
                                      
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div data-toggle="buttons" class="btn-group" id="cstatus">
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-default parsley-success">
                                                    <input type="radio" value="0" name="status" data-parsley-multiple="pstatus" data-parsley-id="5564" <?php if( isset($pstatus ) && $pstatus == 0 ){ echo 'checked ="checked"';} ?>> &nbsp; In-Active &nbsp;
                                                    </label><ul class="parsley-errors-list" id="parsley-id-multiple-cstatus"></ul>
                                                    <label data-toggle-passive-class="btn-default" data-toggle-class="btn-primary" class="btn btn-primary active">
                                                        <input type="radio" checked="" value="1" name="status" data-parsley-multiple="status" data-parsley-id="5564" <?php if( isset($pstatus ) && $pstatus == 1 ){ echo 'checked ="checked"';} ?>> Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Manufacturer Name" type="text" class="form-control col-md-7 col-xs-12" id="pmanufacturer" name="pmanufacturer" data-parsley-id="3686" value="<?php echo $pmanufacturer; ?>">
                                            </div>
                                        </div>
                                       
                                        </div>
                                        <div id="step-2">
                                            <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Short Description
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control" name="pshortdesc" id="pshortdesc"><?php echo $p_sdesc; ?></textarea>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Full Description
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="ckeditor" name="pfulldesc" id="pfulldesc"><?php echo $p_fdesc; ?></textarea>
                                            </div>
                                        </div>

                                        </div>
                                        <div id="step-3">
                                            <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Main Image
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Main Image" type="file" class="form-control col-md-7 col-xs-12" id="prodmainimg" name="prodmainimg" data-parsley-id="3686" value="">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Image1
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Other Image1" type="file" class="form-control col-md-7 col-xs-12" id="prodotherimg1" name="prodotherimg1" data-parsley-id="3686" value="">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Image2
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Other Image2" type="file" class="form-control col-md-7 col-xs-12" id="prodotherimg2" name="prodotherimg2" data-parsley-id="3686" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Image3
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Other Image3" type="file" class="form-control col-md-7 col-xs-12" id="prodotherimg3" name="prodotherimg3" data-parsley-id="3686" value="">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Other Image4
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Other Image4" type="file" class="form-control col-md-7 col-xs-12" id="prodotherimg4" name="prodotherimg4" data-parsley-id="3686" value="">
                                            </div>
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
	<input type="hidden" name="task" value="addeditprod" />
	<input type="hidden" name="c" value="shopp" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hidpid" id="hidpid" value="<?php echo $pid; ?>" />
  
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>

<script type="text/javascript" src="js/wizard/jquery.smartWizard.js"></script>
<script>
	/*$(document).ready(function () {
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
	*/
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