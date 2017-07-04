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
	
}
	

</script>
<?php
$vid = 0;
if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid'] > 0 )
{
	$vid	=	$_REQUEST['vid'];
}
$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), ""  );
//echo "<pre>";
//print_r( $allCat);
//die();
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


                                    <!-- Smart Wizard -->
                                   
                                         <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Category <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="productCat" onchange="CatAjax(this.value)"  class="form-control">
                                              							<option value="0"> Chosse Category </option>
											  
											  								<?php foreach( $allCatParent['parent'] as $CatParentKey => $CatParentValue ) 
											  								  {
																				  $CatNameIdArray = explode("/",$CatParentValue);
																		?>			
                                                                        	<option value="<?php echo  $CatNameIdArray['1']; ?>"><?php echo  $CatNameIdArray['0']; ?></option>
                                                                        		
                                                                        <?php
																		   }
																		?>		  		
                                             </select>
                                            </div>
                                        </div>
                                         <div class="form-group" id = "div123c" style="display:none">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product SubCategory <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" id = "div123">
                                           
                                            </div>
                                           
                                        </div>
                                        <div style="display:none" id="s123">
											<button class="btn btn-success xcxc" type="submit">Submit</button>
                                        </div>
                                        
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    

	<input type="hidden" name="v" value="shopvp"/>
	<input type="hidden" name="f" value="vptab"/>
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