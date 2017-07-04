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
var formSubmit="no";
function chkAlias()
{
	//alert("ffffsd");
	baseprice = document.getElementById('modifybaseprice').value;
	sellprice = document.getElementById('modifysellprice').value;
		
  if( document.getElementById('123ss').value == "" )
  {
  		//alert( document.getElementById('pide').value );
	    pid	 =	document.getElementById('pide').value;
  }else{
  		//alert( document.getElementById('123ss').value );
	    pid	 =	document.getElementById('123ss').value;
  } 
	
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
				//alert("gggffgfg");
				console.log(msg);
				//alert(msg);
				
				if( msg == "no" )
				{
					if( sellprice > baseprice ){
						alert( "ModifySellPrice Cannot exceed than  ModifyBasePrice" );
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
function CatAjax( str,parent = "" )
{
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
$b_catEdit="";
$vidl = 0;
if( isset( $_REQUEST['del'] ) && $_REQUEST['del'] > 0 )
	{
		$allSet = $ketObj->runquery( "DELETE", "", "ketechvp_".$_REQUEST['vid']."", array(), "WHERE id=".$_REQUEST['del'] );
		
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
			$buscatidS = "";
		}if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] != "" ){
			$orderstatus = $_REQUEST['orderstatus'];
		}else{
			$orderstatus = "";
		}
		
		header("Location: index.php?v=shopvpl&f=tmpl&vid=".$_REQUEST['vid']."&avid=".$avid."$productCat=".$productCat."&searchbyproduct=".$searchbyproduct."&searchp=".$searchp."&buscatid = ".$buscatidS."&orderstatus=".$orderstatus."");
		
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
$allCat = $ketObj->runquery( "SELECT", "id,cname,calias,cparent", "ketechcat", array(), "where cstatus = 1"  );
//echo "<pre>";
//print_r( $allCat);
//die();

 // $CatNameIdArray = explode("/",$allCatParent['parent']['0']);
  
//echo "<pre>";
//print_r(  $CatNameIdArray  );
//die();


if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$baseprice	=	    $allSet[0]['baseprice'];	
	$sellprice	=	    $allSet[0]['sellprice'];
	$stock      = 	    $allSet[0]['stock'];
	$pide       =       $allSet['0']['pid'];
	$sub_cat_text =     $allSet['0']['sub_cat_text'];
	$b_cat        =     $allSet['0']['b_cat'];
	$parent_cat =       $allSet['0']['p_cat'];
	$modifybaseprice       =       $allSet['0']['modify_baseprice'];
	$modifysellprice       =       $allSet['0']['modify_sellprice'];
	$status	    =	    $allSet[0]['status'];
	$art_no = $allSet[0]['ART_NO'];
	$sup_no = $allSet[0]['SUPPL_NO'];
	$sup_name = $allSet[0]['SUPPL_NAME'];
	$suppl_art_no = $allSet[0]['SUPPL_ART_NO'];
	$buyer_uid=$allSet[0]['BUYER_UID'];
	$cont_buy_unit=$allSet[0]['CONT_BUY_UNIT'];
	$art_grp_no=$allSet[0]['ART_GRP_NO'];
	$art_grp_descr=$allSet[0]['ART_GRP_DESCR'];
	$art_grp_sub_no =$allSet[0]['ART_GRP_SUB_NO'];
	$art_grp_sub_descr=$allSet[0]['ART_GRP_SUB_DESCR'];
	$dept_no=$allSet[0]['DEPT_NO'];
	$dept_descr=$allSet[0]['DEPT_DESCR'];
	$sell_pr=$allSet[0]['SELL_PR'];
	$sell_vat=$allSet[0]['SELL_VAT'];
	$spat=$allSet[0]['SPAT'];
	$vat_my=$allSet[0]['MRP_PRICE'];
	$buy_vat_no=$allSet[0]['VAT_MY'];
	$buy_vat_perc=$allSet[0]['BUY_VAT_NO'];
	$mrp_price=$allSet[0]['BUY_VAT_PERC'];
	$offer_no=$allSet[0]['Offer_No'];
	$dms=$allSet[0]['DMS'];
	$on_order=$allSet[0]['ON_ORDER'];
	$last_delday=$allSet[0]['LAST_DELDAY'];
	$last_saleday=$allSet[0]['LAST_SALEDAY'];
	$mfg_date=$allSet[0]['MFG_Date'];
	$exp_date=$allSet[0]['Exp_Date'];
	$art_status=$allSet[0]['ART_STATUS'];
	$store=$allSet[0]['STORE'];
	
}else
{
	$baseprice	=	   "";
	$id = 0;	
	$sellprice	=	   "";
	$stock         = "";
	$pide          = "";
	$parent_cat = "";
	$sub_cat_text =    "";
	$b_cat        =    "";
	$modifybaseprice       =      "";
	$modifysellprice       =       "";		
	$status	   =	    "";	
	$art_no = "";
	$sup_no = "";
	$sup_name = "";
	$suppl_art_no="";
	$buyer_uid="";
	$cont_buy_unit="";
	$art_grp_no="";
	$art_grp_descr="";
	$art_grp_sub_no="";
	$art_grp_sub_descr="";
	$dept_no="";
	$dept_descr="";
	$sell_pr="";
	$sell_vat="";
	$spat="";
	$vat_my="";
	$buy_vat_no="";
	$buy_vat_perc="";
	$mrp_price="";
	$offer_no="";
	$dms="";
	$on_order="";
	$last_delday=""; 
	$last_saleday="";
	$mfg_date="";
	$exp_date="";
	$art_status="";
	$store="";
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
		<div data-example-id="togglable-tabs" role="tabpanel" class="">
                                        <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab" >
                                            <li class="active" role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" id="home-tab" href="#tab_content1" >Basic</a>
                                            </li>
                                            <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" id="profile-tab" role="tab" href="#tab_content2">Extra</a>
                                            </li>
                                        </ul>
										
										<!---->
                                        <div class="tab-content" id="myTabContent">
                                            <div aria-labelledby="home-tab" id="tab_content1" class="tab-pane fade active in" role="tabpanel">
                                               <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Category <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <select name="productCat" class="form-control" onchange="CatAjax(this.value,'p')" >
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
													  <input type="hidden" name="parent_cat"  id = "parent_cat" value="<?php echo $parent_cat; ?>"/><input type="hidden" name="sub_cat_text"  id = "sub_cat_text" value="<?php echo $sub_cat_text; ?>"/>
													  <input type="hidden" name="b_cat"  id = "b_cat" value="<?php echo $b_cat; ?>"/>
                                         
										  <div class="form-group" id = "div123p123">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product
                                            </label>
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="width:400px;">
                                            
                                            <?php  echo "".$allSetP['0']['pname']."(".$b_catEdit.")"; ?>
                                             
                                            </div>
										 </div>
                                         
										 <?php } ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Base Price<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $baseprice; ?>" data-parsley-id="3686" name="baseprice" id="baseprice" class="form-control col-md-7 col-xs-12" placeholder="Base price" disabled="disabled" min="0">
												<input type="hidden" name="baseprice" id="baseprice" value="0" />
                                            </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sell Price<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $sellprice; ?>" data-parsley-id="3686" name="sellprice" id="sellprice"  class="form-control col-md-7 col-xs-12" placeholder="Sell price" disabled="disabled" min="0">
												<input type="hidden" name="sellprice" id="sellprice" value="0" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modify Base Price<span></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $modifybaseprice; ?>" data-parsley-id="3686" name="modifybaseprice" id="modifybaseprice"  class="form-control col-md-7 col-xs-12" placeholder="Modify Base Price" min="0">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modify Sell Price<span></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" value="<?php echo $modifysellprice; ?>" data-parsley-id="3686" name="modifysellprice" id="modifysellprice"  class="form-control col-md-7 col-xs-12" placeholder="Modify Sell Price" min="0">
												
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
											<!---->
											
                                            <div aria-labelledby="profile-tab" id="tab_content2" class="tab-pane fade" role="tabpanel">
                                                <div class="x_content">
                                    <br>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_no; ?>" data-parsley-id="3686" name="art_no" id="art_no"  class="form-control col-md-7 col-xs-12" placeholder="ART_NO">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SUPPL_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $sup_no; ?>" data-parsley-id="3686" name="sup_no" id="sup_no"  class="form-control col-md-7 col-xs-12" placeholder="SUPPL_NO">
											
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SUPPL_NAME<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $sup_name; ?>" data-parsley-id="3686" name="sup_name" id="sup_name"  class="form-control col-md-7 col-xs-12" placeholder="SUPPL_NAME">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SUPPL_ART_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $suppl_art_no; ?>" data-parsley-id="3686" name="suppl_art_no" id="suppl_art_no"  class="form-control col-md-7 col-xs-12" placeholder="SUPPL_ART_NO">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">BUYER_UID<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $buyer_uid; ?>" data-parsley-id="3686" name="buyer_uid" id="buyer_uid"  class="form-control col-md-7 col-xs-12" placeholder="BUYER_UID">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CONT_BUY_UNIT<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $cont_buy_unit; ?>" data-parsley-id="3686" name="count_buy_unit" id="count_buy_unit"  class="form-control col-md-7 col-xs-12" placeholder="CONT_BUY_UNIT">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_GRP_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_grp_no; ?>" data-parsley-id="3686" name="art_grp_no" id="art_grp_no"  class="form-control col-md-7 col-xs-12" placeholder="ART_GRP_NO">
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_GRP_DESCR<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_grp_descr; ?>" data-parsley-id="3686" name="art_grp_descr" id="art_grp_descr"  class="form-control col-md-7 col-xs-12" placeholder="ART_GRP_DESCR" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_GRP_SUB_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_grp_sub_no; ?>" data-parsley-id="3686" name="art_grp_sub_no" id="art_grp_sub_no"  class="form-control col-md-7 col-xs-12" placeholder="ART_GRP_SUB_NO" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_GRP_SUB_DESCR<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_grp_sub_descr; ?>" data-parsley-id="3686" name="art_grp_sub_descr" id="art_grp_sub_descr"  class="form-control col-md-7 col-xs-12" placeholder="ART_GRP_SUB_DESCR" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DEPT_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $dept_no; ?>" data-parsley-id="3686" name="dept_no" id="dept_no"  class="form-control col-md-7 col-xs-12" placeholder="DEPT_NO" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DEPT_DESCR<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $dept_descr; ?>" data-parsley-id="3686" name="dept_descr" id="dept_descr"  class="form-control col-md-7 col-xs-12" placeholder="DEPT_DESCR" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SELL_PR<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $sell_pr; ?>" data-parsley-id="3686" name="sell_pr" id="sell_pr"  class="form-control col-md-7 col-xs-12" placeholder="SELL_PR" >
												
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SELL_VAT<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $sell_vat; ?>" data-parsley-id="3686" name="sell_vat" id="sell_vat"  class="form-control col-md-7 col-xs-12" placeholder="SELL_VAT">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SPAT<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $spat; ?>" data-parsley-id="3686" name="spat" id="spat"  class="form-control col-md-7 col-xs-12" placeholder="SPAT">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MRP_PRICE<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $mrp_price; ?>" data-parsley-id="3686" name="mrp_price" id="mrp_price"  class="form-control col-md-7 col-xs-12" placeholder="MRP_PRICE">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">VAT<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $vat_my; ?>" data-parsley-id="3686" name="vat_my" id="vat_my"  class="form-control col-md-7 col-xs-12" placeholder="VAT">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">BUY_VAT_NO<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $buy_vat_no; ?>" data-parsley-id="3686" name="buy_vat_no" id="buy_vat_no"  class="form-control col-md-7 col-xs-12" placeholder="BUY_VAT_NO">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">BUY_VAT_PERC<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $buy_vat_perc; ?>" data-parsley-id="3686" name="buy_vat_perc" id="buy_vat_perc"  class="form-control col-md-7 col-xs-12" placeholder="BUY_VAT_PERC">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Offer_No<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $offer_no; ?>" data-parsley-id="3686" name="offer_no" id="offer_no"  class="form-control col-md-7 col-xs-12" placeholder="Offer_No">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DMS<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $dms; ?>" data-parsley-id="3686" name="dms" id="dms"  class="form-control col-md-7 col-xs-12" placeholder="DMS">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ON_ORDER<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $on_order; ?>" data-parsley-id="3686" name="on_order" id="on_order"  class="form-control col-md-7 col-xs-12" placeholder="ON_ORDER">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LAST_DELDAY<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $last_delday; ?>" data-parsley-id="3686" name="last_delday" id="last_delday"  class="form-control col-md-7 col-xs-12" placeholder="LAST_DELDAY">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">LAST_SALEDAY<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $last_saleday; ?>" data-parsley-id="3686" name="last_saleday" id="last_saleday"  class="form-control col-md-7 col-xs-12" placeholder="LAST_SALEDAY">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MFG_Date<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $mfg_date; ?>" data-parsley-id="3686" name="mfg_date" id="mfg_date"  class="form-control col-md-7 col-xs-12" placeholder="MFG_Date">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Exp_Date<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $exp_date; ?>" data-parsley-id="3686" name="exp_date" id="exp_date"  class="form-control col-md-7 col-xs-12" placeholder="Exp_Date">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ART_STATUS<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $art_status; ?>" data-parsley-id="3686" name="art_status" id="art_status"  class="form-control col-md-7 col-xs-12" placeholder="ART_STATUS">
												
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">STORE<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $store; ?>" data-parsley-id="3686" name="store" id="store"  class="form-control col-md-7 col-xs-12" placeholder="STORE">
												
                                            </div>
                                        </div>
										  <div>
											<button class="btn btn-success xcxc" type="submit">Submit</button>
                                        </div>
                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Smart Wizard -->
                                   
                                         
                                        
                                        
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
		if( isset( $_REQUEST['orderstatus'] ) && $_REQUEST['orderstatus'] != "" ){
		?>	
			
			<input type="hidden" name="orderstatusS" value="<?php echo $_REQUEST['orderstatus'];?>" />
		<?php	
		}
		?>
    
	<input type="hidden" name="vid" value="<?php if( isset( $_GET['vid'] ) && $_GET['vid'] != "") {echo $_GET['vid'];}else{ echo $allSet['0']['vid']; } ?>"/>
	<input type="hidden" name="v" value="shopvpl"/>
    <input type="hidden" name="c" value="shopvp"/>
	<input type="hidden" name="f" value="tmpl"/>
    <input type="hidden" name="task" value="addeditvendorProduct" />
	<input type="hidden" name="hidchild" id="hidchild" value="<?php echo $_SESSION['vid']; ?>" />
	<input type="hidden" name="hidcid" id="hidcid" value="<?php echo $id; ?>" />
    
</form>
<link href="css/select/select2.min.css" rel="stylesheet">
<script src="js/select/select2.full.js"></script>
<script>
	$(document).ready(function () {
		$(".select2_single").select2({
			placeholder: "Select a product",
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