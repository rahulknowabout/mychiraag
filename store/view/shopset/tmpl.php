<?php
$allSet = $ketObj->runquery( "SELECT", "*", "ketechset", array(), ""  );
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
	$cat_thmub_w	=	$allSet[0]['cat_thmub_w'];	
	$cat_thmub_h	=	$allSet[0]['cat_thmub_h'];	
	$cat_full_w		=	$allSet[0]['cat_full_w'];	
	$cat_full_h		=	$allSet[0]['cat_full_h'];	
	$cat_prod_w		=	$allSet[0]['cat_prod_w'];	
	$cat_prod_h		=	$allSet[0]['cat_prod_h'];	
	$prod_full_w	=	$allSet[0]['prod_full_w'];	
	$prod_full_h	=	$allSet[0]['prod_full_h'];
	$uname			=	$allSet[0]['uname'];
	$uemail			=	$allSet[0]['uemail'];
	$upassword      =   $allSet[0]['upassword'];
	$emailcc		=	$allSet[0]['emailcc'];
	$uphone			=	$allSet[0]['uphone'];
	$burl           =   $allSet[0]['burl'];
}else
{
	$cat_thmub_w	=	"";	
	$cat_thmub_h	=	"";	
	$cat_full_w		=	"";	
	$cat_full_h		=	"";	
	$cat_prod_w		=	"";	
	$cat_prod_h		=	"";	
	$prod_full_w	=	"";	
	$prod_full_h	=	"";	
	$uname			=	"";
	$uemail			=	"";
	$upassword      =   "";
	$emailcc		=	"";
	$uphone			=	"";
	$burl = "";
	
}
?>
<form class="form-horizontal form-label-left" data-parsley-validate="" name="allsetting" method="post" action="index.php">
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>All Settings</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <div data-example-id="togglable-tabs" role="tabpanel" class="">
                                        <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
                                            <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" id="home-tab" href="#tab_content1">Basic</a>
                                            </li>
                                            <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" id="profile-tab" role="tab" href="#tab_content2">Category & Product</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div aria-labelledby="home-tab" id="tab_content1" class="tab-pane fade" role="tabpanel">
                                                <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Admin Name" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uname" name="uname" data-parsley-id="3686" value="<?php echo $uname; ?>">
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Admin Phone" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uphone" name="uphone" data-parsley-id="3686" value="<?php echo $uphone; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Admin Password" type="text" class="form-control col-md-7 col-xs-12" required="required" id="upassword" name="upassword" data-parsley-id="3686" value="<?php echo $upassword; ?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Admin Email" type="text" class="form-control col-md-7 col-xs-12" required="required" id="uemail" name="uemail" data-parsley-id="3686" value="<?php echo $uemail; ?>">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">CC<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <textarea rows="4" cols="50" name = "emailcc"><?php echo $emailcc;	?></textarea>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Base URL<span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Base URL" type="text" class="form-control col-md-7 col-xs-12"  id="burl" name="burl" data-parsley-id="3686" value="<?php echo $burl; ?>">
                                            </div>
                                        </div>
										<div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-success" type="submit">Submit</button>
                                            </div>
                                        </div>
								</div>		
                                            <div aria-labelledby="profile-tab" id="tab_content2" class="tab-pane fade active in" role="tabpanel">
                                                <div class="x_content">
                                    <br>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Thumb (px) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Width" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_thmub_w" name="cat_thmub_w" data-parsley-id="3686" style="width:50%" value="<?php echo $cat_thmub_w; ?>"><input placeholder="Height" style="width:50%" value="<?php echo $cat_thmub_h; ?>" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_thmub_h" name="cat_thmub_h" data-parsley-id="3686">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category Full (px) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Width" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_full_w" name="cat_full_w" data-parsley-id="3686" style="width:50%" value="<?php echo $cat_full_w; ?>"><input placeholder="Height" style="width:50%" value="<?php echo $cat_full_h; ?>" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_full_h" name="cat_full_h" data-parsley-id="3686">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Thumb (px) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Width" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_prod_w" name="cat_prod_w" data-parsley-id="3686" style="width:50%" value="<?php echo $cat_prod_w; ?>"><input placeholder="Height" style="width:50%" value="<?php echo $cat_prod_h; ?>" type="text" class="form-control col-md-7 col-xs-12" required="required" id="cat_prod_h" name="cat_prod_h" data-parsley-id="3686">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Full (px) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input placeholder="Width" type="text" class="form-control col-md-7 col-xs-12" required="required" id="prod_full_w" name="prod_full_w" data-parsley-id="3686" style="width:50%" value="<?php echo $prod_full_w; ?>"><input placeholder="Height" style="width:50%" value="<?php echo $prod_full_h; ?>" type="text" class="form-control col-md-7 col-xs-12" required="required" id="prod_full_h" name="prod_full_h" data-parsley-id="3686">
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
                    </div>
                </div>
            </div>
	<input type="hidden" name="task" value="savesetting" />
	<input type="hidden" name="c" value="shopset" />
	<input type="hidden" name="f" value="tmpl" />
</form>			