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
/*
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
*/
/*
function CatAjax( str )
{
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('idc',str)
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
		document.getElementById("div123c").style.display ="block";
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert("jjjj")
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
							document.getElementById("s123").style.display ="block";
                            //append to form element that you want .

                        	
                        }else
                        {
                        	document.getElementById("div123").innerHTML+=chkJson['sel'];
                        }
				            document.getElementById("div123c").style.display ="block";
						}else
			            {
			
			            }
        }
		//alert( "index.php?aj=y&artc="+str);
		
        xmlhttp.open("POST","index.php",true);
	
        xmlhttp.send(data);
    }
	
}*/
	function getvaluetab()
	{
	 alert(document.getElementById("variationtheme").value);
		   vartion = document.getElementById("variationtheme").value;
		   var res =  vartion.split(" ");
		   if( res.length>1 )
		   {
			   document.getElementById("addvariationid2").style.display = "block";
			   document.getElementById("addvariationid1").innerHTML = res[0];
			   document.getElementById("addvariationid1").innerHTML+='<span><input type = "text" name="xxx1" id = "xxx1" value="" style="margin:10px; line-height:5px;"/><i class="fa fa-plus-square" onclick = "ajaxbox1(\'xxx1\')"></i></span>'; 
			   document.getElementById("addvariationid2").innerHTML = res[2];
			   document.getElementById("addvariationid2").innerHTML+='<span><input type = "text" name="xxx2" id = "xxx2" value="" style="margin:8px; line-height:5px;""/><i class="fa fa-plus-square" onclick = "ajaxbox2(\'xxx2\')"></i></span>'; 
		   }
		   else
		   {
			   //alert( vartion );
			  
			  document.getElementById("addvariationid1").innerHTML = vartion;
			  document.getElementById("addvariationid1").innerHTML+='<span><input type = "text" name="xxx1" id = "xxx1" value="" style="margin:10px; line-height:5px;""/><i class="fa fa-plus-square" onclick = "ajaxbox1(\'xxx1\')"></i></span>'; 
			  document.getElementById("addvariationid2").style.display = "none";
		   }
		   
		   
		
	}
var count = 0;
var count2 = 0;
function ajaxbox1( idr )
	{
			 count++;
			 alert(  count );
			 //alert(idr ); 
			 temps = document.getElementById(idr).value;	
			  document.getElementById("addvariationid1").innerHTML+='<span><input type = "text" name="xxx11'+count+'" id = "xxx11'+count+'" value="" style="margin:10px; line-height:5px;"/> <i class="fa fa-plus-square" onclick = "ajaxbox1(\'xxx11'+count+'\')"></i></span>';
			  document.getElementById(idr).value = temps;
		
		
	}
function ajaxbox2( idr )
	{
		
				count2++;
				alert( idr );
							// alert( document.getElementById(idr).value ); 
					 temps = document.getElementById(idr).value;
			  document.getElementById("addvariationid2").innerHTML+='<span><input type = "text" name="xxx22'+count2+'" id = "xxx22'+count2+'" value="" style="margin:10px; line-height:5px;"/> <i class="fa fa-plus-square" onclick = "ajaxbox2(\'xxx11'+count2+'\')"></i></span>';
			  	document.getElementById(idr).value = temps; 
		
}

</script>
<?php
/*echo "<pre>";
print_r( $_POST );
die();*/
$vid = 0;
if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 )
{
	$vid	=	$_REQUEST['vid'];
}
$allFld = $ketObj->runquery( "SELECT", "id,fldname", "ketechfld", array(), ""  );
//echo "<pre>";
//print_r( $allFld );
//die();

 // $CatNameIdArray = explode("/",$allCatParent['parent']['0']);
  
//echo "<pre>";
//print_r(  $CatNameIdArray  );
//die();


if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$cname	=	        $allSet[0]['cat_thmub_w'];	
	$calias	=	        $allSet[0]['cat_thmub_h'];	
	$cat_full_w		=	$allSet[0]['cat_full_w'];	
	$cat_full_h		=	$allSet[0]['cat_full_h'];	
	$cat_prod_w		=	$allSet[0]['cat_prod_w'];	
	$cat_prod_h		=	$allSet[0]['cat_prod_h'];	
	$prod_full_w	=	$allSet[0]['prod_full_w'];	
	$prod_full_h	=	$allSet[0]['prod_full_h'];	
}else
{
	$cname	=	"";	
	$calias	=	"";	
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
                        <div class="title_left"  >
                            <h3>Add Product</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">

										<div style="display:none" id="s123">
											<button class="btn btn-success xcxc" type="submit">Submit</button>
                                        </div>
                                        
                                        <div data-example-id="togglable-tabs" role="tabpanel" class="">
                                        <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
                                            <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home-tab" href="#tab_content1">Vital Info</a>
                                            </li>
                                            <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" id="profile-tab" role="tab" href="#tab_content2" onclick="getvaluetab()">Variations</a>
                                            </li>
                                            <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" id="profile-tab2" role="tab" href="#tab_content3">Offer</a>
                                            </li>
                                        </ul>
                                        <div>
                                       
                                        <div class="tab-content" id="myTabContent">
                                            <div aria-labelledby="home-tab" id="tab_content1" class="tab-pane fade active in" role="tabpanel">
                                             <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Part Number<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="mpartnumber" name="mpartnumber" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="itemname" name="itemname" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Brand Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="brandname" name="brandname" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="manufacturer" name="manufacturer" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Package Quantity<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="packagequantity" name="packagequantity" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Department<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="department" name="department" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Colour<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Product Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="colour" name="colour" data-parsley-id="3686" value="<?php //echo $pname; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Variation Theme<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="variationtheme" name="variationtheme"  class="form-control">
                                            <?php 
													foreach( $allFld as $allFldKey => $allFldValue)
													{
											?>
                                            <option value="<?php echo $allFldValue['fldname'];  ?>"><?php echo $allFldValue['fldname'];  ?></option>
                                            <?php		
														
													}
											?>
                                            </select>
                                            </div>
                                        </div>
                                            </div>
                                            <div aria-labelledby="profile-tab" id="tab_content2" class="tab-pane fade" role="tabpanel">
                                                <div id = "addvariationid1"  style="padding:10px;margin:10px;">
                                                	
                                                </div>
                                                <div id = "addvariationid2" style="display:none; padding:10px;margin:10px;">
                                                	
                                                </div>
                                            </div>
                                            <div aria-labelledby="profile-tab" id="tab_content3" class="tab-pane fade" role="tabpanel">
                                                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
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
    <input type="hidden" name="postcategory" value="<?php if( isset( $_POST['buscatid'] ) && $_POST['buscatid']!= "") { echo $_POST['buscatid'];  } ?>"/>
	<input type="hidden" name="task" value="addvendorproduct" />
	<input type="hidden" name="c" value="shopvp"/>
	<input type="hidden" name="f" value="add"/>
	<input type="hidden" name="hidpid" id="hidpid" value="<?php echo $vid; ?>" />
    
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
	
	$("#addeditc").submit(function(e){
		if(formSubmit=="yes")
		{
			
		}else
		{
			e.preventDefault();
			chkAlias();
		}
});*/

 $(document).ready(function () {
            // Smart Wizard 	
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });

</script>