<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<style>
	#cke_1_contents
	{
		height:200px !important;
	}
	.select2{
		width:100% !important;
		}
</style>
<script>
function modifysell(){  if( document.getElementById("modsellp").checked == true )
		 { 
		 	document.getElementById("sellprice").value = <?php if( isset( $_REQUEST['sprice'] ) &&  $_REQUEST['sprice']!=""){echo $_REQUEST['sprice'];} ?>
		 
		 
		 }else{
		 		//$value = document.getElementById("sellprice").value;alert($value);
		 
		 } 
}
function modifybase(){ if( document.getElementById("modbasep").checked == true )
		 { 
		 	document.getElementById("baseprice").value = <?php  if( isset( $_REQUEST['mprice'] ) &&  $_REQUEST['mprice']!=""){echo $_REQUEST['mprice'];}?>
		 
		 
		 }else{
		 		//$value = document.getElementById("sellprice").value;alert($value);
		 
		 } 
}
</script>
<script>
var formSubmit="no";
function chkAlias()
{
	
	/*alert( baseprice );
	alert( sellprice );*/
  if( document.getElementById('123ss').value == "" )
  {
  		//alert( document.getElementById('pide').value );
	    pid	 =	document.getElementById('pide').value;
  }else{
  		//alert( document.getElementById('123ss').value );
	    pid	 =	document.getElementById('123ss').value;
  } 
	//alert("ffffsd");	
	//alert(document.getElementById('hidcid').value);
	//pid	 =	document.getElementById('123ss').value;
	vpid =  document.getElementById('hidcid').value;
	vid =  document.getElementById('hidchild').value;
	
	/*if(/^[a-zA-Z0-9-]*$/.test(palias) == false) {
		alert('Alias only can contain hyphen(-)!');
		return false;
	}*/
	$.ajax( {
			url: "index.php",
			type: 'POST',
			data: "aj=y&pid="+pid+"&vp=vendor&vpid="+vpid+"&vid="+vid,
			dataType: 'html',
			success: function( msg, textStatus, xhr )
			{
				//alert(msg);
				if( msg == "no" )
				{
					baseprice = Number(document.getElementById('baseprice').value);
					sellprice = Number(document.getElementById('sellprice').value);
					/*alert(baseprice);
					alert(sellprice);*/
					if( sellprice > baseprice ){
						alert( "SellPrice Cannot exceed than  BasePrice" );
						return false;
					
					}else{ 
							formSubmit	=	"yes";
							$("#addeditc").submit();
							return true;
						}	
				}else
				{
					alert( "Product already exists!" )
					//document.getElementById('palias').focus();
					return false;
				}
			}
		})
		//return false;
	
}
</script>
<script>
function CatAjax( str,parent="" )
{
	//alert("ddsss");
	if( parent == "p" )
	{
	  document.getElementById("div123").innerHTML="";
	  document.getElementById("123ss").innerHTML="";
	} 
	
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
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert("jjjj")
				     try
                        {
                            chkJson            =    JSON.parse( xmlhttp.responseText );
                        } catch( exception )
                        {
                            chkJson            =    null;
                        }
						console.log(xmlhttp.responseText);
                        if(chkJson['sel'] == "")
                        {
							//alert("RRRR");
							busscatid = chkJson['selid'];
							var input = document.createElement("input");

                            input.setAttribute("type", "hidden");

                            input.setAttribute("name", "buscatid");

                            input.setAttribute("value", busscatid);
							document.getElementById("addeditc").appendChild(input);
							
                            //append to form element that you want .

                        	
                        }else
                        {
							if( chkJson['product'] != "" )
							{
							 document.getElementById("123ss").innerHTML+=chkJson['sel'];
							 document.getElementById("div123cp").style.display ="block";
							 //location.reload();
							}
							else {
							
                        	document.getElementById("div123").innerHTML+=chkJson['sel'];
							document.getElementById("div123c").style.display ="block";
							
		                       
							}
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
$vidl = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid'] > 0 ){
			$avid = $_REQUEST['avid'];
		
		}else{
			$avid = "";
		}
		if( isset( $_REQUEST['productCat'] ) && ($_REQUEST['productCat'] > 0 || $_REQUEST['productCat']="ap" )){
			$productCat = $_REQUEST['productCat'];
			
		
		}else{
			$productCat = "";
		}
		if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct'] != "" ){
			$searchbyproduct = $_REQUEST['searchbyproduct'];
			
		
		}else{
			$searchbyproduct = "";
		}if( isset( $_REQUEST['searchp'] ) && $_REQUEST['searchp'] != "" ){
			$searchp = $_REQUEST['searchp'];
			
		
		}else{
			$searchp = "";
		}if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] != "" ){
			$buscatidS = $_REQUEST['buscatid'];
		}else{
			$buscatidS = $_REQUEST['buscatid'];
		}
	
		$allSet = $ketObj->runquery( "DELETE", "", "ketechvp_".$_REQUEST['vid']."", array(), "WHERE id=".$_REQUEST['del'] );
		header("Location: index.php?v=shopvpl&f=tmpl&vid=".$_REQUEST['vid']."&avid=".$avid."$productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid = ".$buscatidS."");
		
	}
	
if( isset( $_REQUEST['id'] ) && $_REQUEST['id'] > 0 )
{
	$id	=	$_REQUEST['id'];
	$allSet =  $ketObj->runquery( "SELECT", "*", "ketechvp_".$_REQUEST['vid']."", array(), "where id = ".$_REQUEST['id'].""  );
	$allSetP =  $ketObj->runquery( "SELECT", "pname", "ketechprod", array(), "where id = ".$allSet['0']['pid'].""  );
}
/*echo "<pre>";
print_r( $allSetP );
die();*/
$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), "where cstatus=1"  );
//echo "<pre>";
//print_r( $allCat);
//die();

 // $CatNameIdArray = explode("/",$allCatParent['parent']['0']);
  
//echo "<pre>";
//print_r(  $CatNameIdArray  );
//die();

$b_catEdit = "";
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$baseprice	=	    $allSet[0]['baseprice'];	
	$sellprice	=	    $allSet[0]['sellprice'];
	$pide       =       $allSet['0']['pid'];
	$sub_cat_text =     $allSet['0']['sub_cat_text'];
	$b_cat        =     $allSet['0']['b_cat'];
	$parent_cat =       $allSet['0']['p_cat'];
	$stock = 	        $allSet[0]['stock'];
	$f_product =        $allSet[0]['f_product'];
	$mpq_fp = 			$allSet[0]['mpq_fp'];
	$mblpq = 			$allSet[0]['max_buy_limit'];
	$status	   =	    $allSet[0]['status'];	
	
}else
{
	$baseprice	=	   "";	
	$sellprice	=	   "";
	$id = 0;
	$pide       =       "";
	$parent_cat =       "";
	$sub_cat_text =     "";
	$b_cat        =    "";	
	$status	   =	    "";	
	$f_product =        "";
	$mpq_fp = 			"";
	$stock = "";
	$mblpq = "";
}

if( isset( $allCat ) && is_array( $allCat ) && count( $allCat ) > 0 ){
	foreach( $allCat as $allCatKey => $allCatValue)
	{
		if( $allCatValue['cparent'] == 0 )
		{
			$allCatParent['parent'][] = $allCatValue['cname']."/".$allCatValue['id'];
		
			
		}
		
		if( isset( $b_cat ) && $b_cat > 0 &&  $b_cat == $allCatValue['id']){
			
			$b_catEdit = $allCatValue['cname'];
			
		}
	}
}



 if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" ){ $subvp =  $_REQUEST['vid']; }
 $vpjoin = "select pid,pname from ketechvp_".$subvp." INNER JOIN ketechprod ON ketechvp_".$subvp.".pid = ketechprod.id where ketechprod.pstatus = 1 ";
 /*echo  $vpjoin;
 die();*/
 $vpresult = mysql_query( $vpjoin );
 while( $rowvpj = mysql_fetch_array(  $vpresult ))
 {
 	$vpl[$rowvpj['pid']] = $rowvpj['pname']; 
 
 }
 /*echo "<pre>";
 print_r( $vpl );
 die();*/
?>

<form class="form-horizontal form-label-left" data-parsley-validate="" name="addeditc" id="addeditc" method="post" action="index.php" enctype="multipart/form-data">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left"  >
                            <h3>Choose Product</h3>
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
                                              <select name="productCat" class="select2_single form-control" tabindex="-1" onchange="CatAjax(this.value,'p')" >
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
                                            <div class="col-md-6 col-sm-6 col-xs-12" id = "div123"></div>
                                           
                                        </div>
                                        
                                         <div class="form-group" id = "div123cp" style="display:none;">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Choose Product<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="width:400px;">
                                             <select  class="select2_single form-control" tabindex="-1" name="product" id = "123ss">
                                             </select>
                                            </div>
                                           
                                        </div>
                                         <?php  if( isset( $allSetP ) && count( $allSetP  ) >0 ){  ?>
										              <input type="hidden" name="pide"  id = "pide" value="<?php echo $pide; ?>"/>
                                         
										  <div class="form-group" id = "div123p123">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product
                                            </label>
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="width:400px;">
                                            
                                             <?php echo "".$allSetP['0']['pname']."(".$b_catEdit.")";?>
                                             
                                            </div>
										 </div>
                                         
										 <?php } ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Base Price<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $baseprice; ?>" data-parsley-id="3686" name="baseprice" id="baseprice" class="form-control col-md-7 col-xs-12" placeholder="Base price" min="0"><?php if( isset( $_REQUEST['mprice']) && $_REQUEST['mprice']!= "") { echo "Modify Base Price: ".$_REQUEST['mprice'];?>
												<input type="checkbox" name="modbasep" id = "modbasep" onclick="modifybase()" />
												
												<?php } ?>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sell Price<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $sellprice; ?>" data-parsley-id="3686" name="sellprice" id="sellprice"  class="form-control col-md-7 col-xs-12" placeholder="Sell price" min="0"><?php if( isset( $_REQUEST['sprice']) && $_REQUEST['sprice']!= "") { echo "Modify Sell Price: ".$_REQUEST['sprice']; ?>
												<input type="checkbox" name="modsellp" id = "modsellp" onclick="modifysell()" />
												
												
												<?php
												 } ?>
                                            </div>
                                        </div>
										 <input type="hidden" name="pide"  id = "pide" value="<?php echo $pide; ?>"/>
										<input type="hidden" name="parent_cat"  id = "parent_cat" value="<?php echo $parent_cat; ?>"/><input type="hidden" name="sub_cat_text"  id = "sub_cat_text" value="<?php echo $sub_cat_text; ?>"/>
										<input type="hidden" name="b_cat"  id = "b_cat" value="<?php echo $b_cat; ?>"/>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Maximum Buy Limit of Product Qty <span></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $mblpq; ?>" data-parsley-id="3686" name="mblpq" id="mblpq"  class="form-control col-md-7 col-xs-12" placeholder="Maximum Buy Limit of Product Qty" min="0">
                                            </div>
                                        </div>
										
										 <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stock<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $stock; ?>" data-parsley-id="3686" name="stock" id="stock"  class="form-control col-md-7 col-xs-12" placeholder="Stock" min="0">
                                            </div>
                                        </div>
										
											
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Free Product<span></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="select2_single form-control" tabindex="-1" name="f_product" >
													<option value="0" <?php if( isset( $f_product ) && $f_product == 0 ) { echo "selected = \"selected\"";}?>>No Free Product</option>
													<?php
														if( isset( $vpl ) && is_array( $vpl ) && count( $vpl ) > 0 )
														{
															foreach( $vpl as $vplK => $vpltV )
															{
													?>
																<option value="<?php echo $vplK; ?>" <?php if( isset( $f_product ) && $f_product == $vplK ) { echo "selected = \"selected\"";} ?>><?php echo $vpltV; ?></option>
													<?php			
															}
														}
													?>
												</select>
                                            </div>
                                        </div>
									
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Minimum Purchase Qty for Free Product<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $mpq_fp; ?>" data-parsley-id="3686" name="mpq_fp" id="mpq_fp"  class="form-control col-md-7 col-xs-12" placeholder="Minimum Purchase Qty for Free Product" min="0">
                                            </div>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="status"   class="form-control">
                                              							<option value="1" <?php if( isset( $status ) &&  $status == 1 ){ echo "selected = \"selected\""; } ?>> Publish </option>
											  							<option value="0"<?php if( isset( $status ) &&  $status == 0 ){ echo "selected = \"selected\""; } ?>> UnPublish </option>
											  							
                                             </select>
                                            </div>
                                        </div>
                                          
                                        <div  id="s123">
											<button class="btn btn-success xcxc" type="submit">Submit</button>
                                        </div>
                                        
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
			<?php	
			if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid'] > 0 ){
		?>	
			<input type="hidden" name="avid" value="<?php echo $_REQUEST['avid'];?>"/>
		<?php	
			}
		?>
		<?php	
		if( isset( $_REQUEST['productCat'] ) && ($_REQUEST['productCat'] > 0 || $_REQUEST['productCat']="ap" )){
		?>
			
			<input type="hidden" name="productCat" value="<?php echo $_REQUEST['productCat'];?>"/>
		<?php	
		}
		?>
		<?php
		if( isset( $_REQUEST['searchbyproduct'] ) && $_REQUEST['searchbyproduct'] != "" ){
		?>
			
			<input type="hidden" name="searchbyproduct" value="<?php echo $_REQUEST['searchbyproduct'];?>" />
		<?php
		}if( isset( $_REQUEST['searchp'] ) && $_REQUEST['searchp'] != "" ){
		
		?>
			<input type="hidden" name="searchp" value="<?php echo $_REQUEST['searchp'];?>" />
		<?php	
			
		
		}if( isset( $_REQUEST['buscatid'] ) && $_REQUEST['buscatid'] != "" ){
		?>	
			
			<input type="hidden" name="buscatidS" value="<?php echo $_REQUEST['buscatid'];?>" />
		<?php	
		}
		if( isset( $_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] != "" ){
		?>	
			
			<input type="hidden" name="admin_approval" value="<?php echo $_REQUEST['admin_approval'];?>" />
		<?php	
		}
		?>
    
	<input type="hidden" name="vid" value="<?php if( isset( $_GET['vid'] ) && $_GET['vid'] != "") {echo $_GET['vid'];}else{ echo $allSet['0']['vid']; } ?>"/>
	<?php if( isset( $_REQUEST['admin_approval'] ) && $_REQUEST['admin_approval'] == 'y') { ?>
	<input type="hidden" name="admin_approval" value="y"/>
	<?php } ?>
	<input type="hidden" name="v" value="shopvpl"/>
    <input type="hidden" name="c" value="shopvp"/>
	<input type="hidden" name="f" value="tmpl"/>
    <input type="hidden" name="task" value="addeditvendorProduct" />
	<input type="hidden" name="hidchild" id="hidchild" value="<?php if( isset( $_REQUEST['vid'] ) && $_REQUEST['vid']!="" ){ echo $_REQUEST['vid'];  }?>" />
	<input type="hidden" name="hidcid" id="hidcid" value="<?php echo $id; ?>" />
    
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>
<script>
	$(document).ready(function () {
	
		$(".select2_single").select2({ 
		
			placeholder: "Select a Product",
			allowClear: true
			
			//alert("helloR");
		});
		$(".select2_group").select2({});
		$(".select2_multiple").select2({
	
			maximumSelectionLength: 4,
			placeholder: "With Max Selection limit 4",
			allowClear: true
			
			//alert("helloS");
		});
		
		$( ".select2-search__field" ).keypress(function() {
 alert('asasas');
});
	});
	//alert("helloR");
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