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
//alert( document.getElementById('buscatid').value );
if( document.getElementById('discount_on').value == "cat" )
 {

 	buscatid = document.getElementById('buscatid').value;
	// alert("jjjjjjjjjjg");
 }else {
 		buscatid = "";
 }
 if( document.getElementById('discount_on').value == "amt" )
 {

 	amt = document.getElementById('amt').value;
	// alert("jjjjjjjjjjg");
 }else {
 		amt = "";
 }
 if( document.getElementById('discount_on').value == "coupencode" )
 {

 	coupencode = document.getElementById('coupencode').value;
	// alert("jjjjjjjjjjg");
 }else {
 		coupencode = "";
 }
	sid	    =	document.getElementById('hiddisid').value;
	s_date	=	document.getElementById('single_cal2').value;
	e_date	=	document.getElementById('single_cal1').value;
    vid	=	    document.getElementById('vendorh').value;
    coupencode = document.getElementById('coupencode').value;
    amt =  document.getElementById('amt').value;
	
	
	/*alert( sid );
	alert( s_date );
	alert( e_date );
	alert( vid );
	alert( coupencode );
	alert( amt );
	alert( buscatid );*/
	/*if(/^[a-zA-Z0-9-]*$/.test(calias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&sid="+sid+"&chk=discount&s_date="+s_date+"&e_date="+e_date+"&vid="+vid+"&buscatid="+buscatid+"&coupencode="+coupencode+"&amt="+amt,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
			//console.log( msg );
			//alert(msg);
				if( msg == "no" )
				{
					formSubmit	=	"yes";
					$("#addeditc").submit();
					return true;
				}else
				{
					alert("Discount Rule already exists!" )
					//document.getElementById('calias').focus();
					return false;
				}
			}
		})
		//return false;	
}

function showbox( str )
{
//alert(str);
	//discount_on	    =	document.getElementById('discont_on').value;
	if( str == "cat" )
	{
		document.getElementById("catdiv").style.display ="block";
		var xselect = document.getElementById("discount_type");
		document.getElementById("dis_type123").style.display ="none";
				/*alert(xselect.length);*/
			if (xselect.length > 3) {
				xselect.remove(xselect.length-1);
			}
			
			
	}else { document.getElementById("catdiv").style.display ="none";
			document.getElementById("div123c").style.display ="none";
			document.getElementById("dis_type123").style.display ="block"; 
	} 
	if( str == "amt" ){
						document.getElementById("amtdiv").style.display ="block";
						var xselect = document.getElementById("discount_type");
				/*alert(xselect.length);*/
			if (xselect.length > 3) {
				xselect.remove(xselect.length-1);
			}
	}else{  document.getElementById("amtdiv").style.display ="none"; } 
	if( str == "coupencode" ) {   
						document.getElementById("coupencodediv").style.display ="block";
						document.getElementById("discount_type").innerHTML +='<option value="first_time_shopping">First Time Shopping</option>';
	}else{
			document.getElementById("coupencodediv").style.display ="none";
			
	}
}

function CatAjax( str,par )
{
	var formData =  document.getElementById("addeditc");
	var data = new FormData( formData);
    data.append('aj', 'y');
	data.append('idcc',str)
	if( par == "p" )
	{
	  document.getElementById("div123").innerHTML="";
	} 
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
							input.setAttribute("id", "buscatid");
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

$allVendor = $ketObj->runquery( "SELECT", "id,vname", "ketechvendor", array(), ""  );
/*echo "<pre>";
print_r( $allVendor );
die()*/; 
$disid = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechdiscount", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopdiscount");
		
	}
if( isset( $_REQUEST['sid'] ) && $_REQUEST['sid'] > 0 )
{
	$disid	=	$_REQUEST['sid'];
	$allSet = $ketObj->runquery( "SELECT", "*", "ketechdiscount", array(), "where id = ".$_REQUEST['sid'].""  );
}
//s$allCat = $ketObj->runquery( "SELECT", "id,cname,calias", "ketechmanuf", array(), ""  );

/*echo "<pre>";
print_r( $allSet  );
die();*/

if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$discount_on	=	$allSet[0]['discount_on'];	
	$s_date	=	$allSet[0]['s_date'];	
	$e_date	=	$allSet[0]['e_date'];
	$discount_type	=	$allSet[0]['discount_type'];
	$amt =      $allSet[0]['amt'];
	$coupencode =      $allSet[0]['coupencode'];
	$vendor	=	$allSet[0]['vid'];
	$discount = $allSet[0]['discount'];
	$pcategory   =     "";
			
	
}else
{
	$discount_on	=	"";	
	$s_date	=	"";
	$e_date	=	"";
	$discount_type = "";
	$vendor	=	"";	
	$discount = "";	
	$pcategory   =     "";
	$coupencode="";
	$amt="";
	$discount="";
	
}

if( isset( $allSet[0]['buscat'] ) && $allSet[0]['buscat']!="" )
{
	$busid = $allSet[0]['buscat']; 
}
else{
$busid = 0;
}

$buscatnameE = "";

$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), ""  );

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
	if( $busid > 0 && $allCatValue['id'] == $busid ){
	
	     $buscatnameE = $allCatValue['cname'];
	
	}
	
	
	
}

/*echo "<pre>";
print_r( $allCatParent );
die();*/
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Add/Edit Discount Rule</h3>
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
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discount On<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="discount_on" id = "discount_on"  onchange = "showbox(this.value)">
                                              							<option value="0">Select</option>
											  							<option value="cat"<?php if( $discount_on == "cat") { echo "selected=selected";} ?>>Category</option>
																		<option value="amt"<?php if( $discount_on == "amt") { echo "selected=selected";} ?>>Amount</option>
																		<option value="coupencode"<?php if( $discount_on == "coupencode") { echo "selected=selected";} ?>>Coupencode</option>
											  							 		
                                             </select>
                                           
                                           
                                         </div>
										 </div>
										 
										 <div class="form-group" id = "catdiv" <?php if( isset( $allSet[0]['buscat'] ) && $allSet[0]['buscat']!="" ){}else{ echo 'style="display:none"'; } ?>>
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="productCat" onchange="CatAjax(this.value,'p')">
                                              							<option value="0"> Chosse Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 
											  								  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option value="<?php echo  $CatNameIdArray['1']; ?>"<?php if( $pcategory > 0 && $pcategory == $CatNameIdArray['1']) { echo "selected='selected'"; } ?>><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
                                                                        <?php
																		   }
																		?>		  		
                                             </select> <?php  echo $buscatnameE; ?>
                                             <?php if( isset( $allSetC ) && count( $allSetC  ) >0 ){  ?>
										              <input type="hidden" name="pide" value="<?php echo $allSetC['0']['id']; ?>"/>
                                               <?php echo "".$allSetC['0']['cname']."";
											   
											 }?>    
                                           
                                            </div>
                                        </div>
										
										<div class="form-group" id = "div123c" style="display:none">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">SubCategory <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" id = "div123">
                                           
                                            </div>
                                        </div>
										
										 <div class="form-group" id = "coupencodediv" <?php if( $coupencode != "" ){}else{echo 'style="display:none"';}?>>
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">CoupenCode<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="CoupenCode" type="text" class="form-control col-md-7 col-xs-12"  id="coupencode" name="coupencode" data-parsley-id="3686" value="<?php echo $coupencode; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group" id = "amtdiv"  <?php if( $amt != "" ){}else{echo 'style="display:none"';}?>>
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Amount" type="number" class="form-control col-md-7 col-xs-12"  id="amt" name="amt" data-parsley-id="3686" value="<?php echo $amt; ?>" min="0">
                                            </div>
                                        </div>
										<div class="form-group" id = "dis_type123" <?php if( isset( $discount_type ) && $discount_type != ""){}else{echo "style='display:none;'";} ?>>
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discount Type<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="discount_type" id = "discount_type" onchange="firstshop(this.value)" class="form-control">
                                              							<option value="">Select</option>
											  							<option value="instant"<?php if( $discount_type == "instant") { echo "selected=selected";} ?>>Instant</option>
																		<option value="cash_back"<?php if( $discount_type == "cash_back") { echo "selected=selected";} ?>>Cash Back</option>
																		<!--<option value="first_time_shopping"<?php if( $discount_type == "first_time_shopping") { echo "selected=selected";} ?>>First Time Shopping</option>-->
																		<?php if( isset( $discount_on ) && $discount_on == "coupencode"){?> <option value="first_time_shopping"<?php if( $discount_type == "first_time_shopping") { echo "selected=selected";} ?>>First Time Shopping</option> <?php }else{ echo "";} ?>
											  							 		
                                             </select>
                                           
                                           
                                         </div>
										 </div>
                                        
										 <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date*</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								   
                      					<fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Start Date  M/D/Y" aria-describedby="inputSuccess2Status2" name="s_date" value="<?php echo $s_date; ?>" required>
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
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="End Date  M/D/Y" aria-describedby="inputSuccess2Status2" name="e_date" value="<?php echo $e_date; ?>" required>
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
							</div>
						</div> 
										
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discount(%)<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Discount(%)" type="number" class="form-control col-md-7 col-xs-12" required="required" id="discount" name="discount" data-parsley-id="3686" value="<?php echo $discount; ?>" min="0">
                                            </div>
                                        </div>
							<input type="hidden" name="vendorh" id="vendorh" value="<?php echo $_SESSION['vid']; ?>" />
                                        
                                        <!--<div class="form-group">
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
                                        </div>-->
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
	<input type="hidden" name="task" value="addeditdiscount" />
	<input type="hidden" name="c" value="shopdiscount" />
	<input type="hidden" name="f" value="tmpl" />
	<input type="hidden" name="hiddisid" id="hiddisid" value="<?php echo $disid; ?>" />
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