<?php
$allSet = $ketObj->runquery("SELECT", "kv.vname,kv.vmail,kv.vphone,ku.upassword", "ketechuser ku INNER JOIN ketechvendor kv ON ku.vid = kv.id", array(), "where kv.id = ".$_SESSION['vid']."");
/*echo "<pre>";
print_r( $allSet );
die();*/
if( isset( $allSet ) && is_array( $allSet ) && count( $allSet ) > 0 )
{
    $uname			=	$allSet[0]['vname'];
	$uemail			=	$allSet[0]['vmail'];
	$upassword      =   $allSet[0]['upassword'];
	$uphone			=	$allSet[0]['vphone'];	
}else
{
	$uname			=	"";
	$uemail			=	"";
	$upassword      =   "";
	$uphone			=	"";
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
                                                <input placeholder="Admin Phone" type="number" class="form-control col-md-7 col-xs-12" required="required" id="uphone" name="uphone" data-parsley-id="3686" value="<?php echo $uphone; ?>" min="0">
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
	<input type="hidden" name="task" value="savesetting" />
	<input type="hidden" name="c" value="shopset" />
	<input type="hidden" name="f" value="tmpl" />
</form>			