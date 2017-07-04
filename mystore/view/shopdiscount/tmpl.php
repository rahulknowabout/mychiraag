<?php
function paginate( $path,$hold ) {
	if( ( $hold%10 ) == 0 ){
		$total = $hold/10;
	}
    else {
    	$total = ($hold/10)+1;
     }
	 $returnp =   '<ul class = "pagination">';
	 if( isset( $_REQUEST['avid'] ) && $_REQUEST['avid']>1 ) {
	 	$pre = $_REQUEST['avid']-1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$pre.'">Previous</a></li>';
	}
     for( $i = 1; $i <= $total; $i++ ) {
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$i.'">'.$i.'</a></li>';
	 }
	if( isset( $_REQUEST['avid'] ) &&  $_REQUEST['avid']<=($total-1) ) {
		$nex = $_REQUEST['avid']+1;
		$returnp = $returnp.'<li><a href = "'.$path.'&avid='.$nex.'">Next</a></li>';
	}
	$returnp = $returnp.'</ul>';
	return $returnp;
}

$where = " where vid = ".$_SESSION['vid']."";
if( isset( $_REQUEST['discount_on'] )  && $_REQUEST['discount_on']!="" ){
	$where .= " AND discount_on = '".$_REQUEST['discount_on']."'";
}

if( isset( $_REQUEST['s_date'] )  && $_REQUEST['s_date']!=""){
	$where .= " AND s_date = '".$_REQUEST['s_date']."' ";
}

if( isset($_REQUEST['e_date'] )  && $_REQUEST['e_date']!="" ){
	$where .= " AND e_date = '".$_REQUEST['e_date']."'";
}
$Count = $ketObj->runquery( "SELECT", "count(*)", "ketechdiscount", array(), $where  );
$hold = $Count['0']['count(*)']; 
$counter = 1;
	if(isset($_GET['avid']) && $_GET['avid']!="") {
			$vid1 = ($_GET['avid']-1)*10;
			$counter= $vid1+1;
			$vid1 = ($_GET['avid']-1)*10;
			$allManuf = $ketObj->runquery( "SELECT", "*", "ketechdiscount", array(),$where." limit ".$vid1.",10");
			
		}
		else
		{
		
			$allManuf = $ketObj->runquery( "SELECT", "*", "ketechdiscount", array(),$where." limit 0,10");
		}	

/*$allManuf = $ketObj->runquery( "SELECT", "*", "ketechdiscount", array(), $where  );*/
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Discount Rule List
                </h3>
                        </div>

                        <div class="title_right">
						<form name="searchorder" id = "searchorder" action="index.php" method="post">
                            <!--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>-->
								
								 <div class="input-group">
								<select name="discount_on" id = "discount_on" class="form-control" >
                                              							<option value="">Search By Discount Type</option>
											  							<option value="cat"<?php if( isset($_REQUEST['discount_on']) && $_REQUEST['discount_on'] == "cat") { echo "selected=selected";} ?>>Category</option>
																		<option value="amt"<?php if( isset($_REQUEST['discount_on']) && $_REQUEST['discount_on']== "amt") { echo "selected=selected";} ?>>Amount</option>
																		<option value="coupencode"<?php if( isset($_REQUEST['discount_on']) && $_REQUEST['discount_on'] == "coupencode") { echo "selected=selected";} ?>>Coupencode</option>
											  							 		
                                             </select>
											 <input type="hidden" class="form-control" placeholder="Search for..." name = "v" value="shopdiscount">
									<!--<input type="hidden" class="form-control" placeholder="Search for..." name = "vid" value="<?php echo $_REQUEST['vid']; ?>">-->
							<span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
						</div>
						
					
							
							
								    
                      					
                                                            <input type="text" id="single_cal2" style="line-height:30px;"  placeholder="Start Date  M/D/Y" name="s_date" value="<?php if( isset($_REQUEST['s_date']) && $_REQUEST['s_date']!="" ){ echo $_REQUEST['s_date'];} ?>"/>
                                                          
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                       
							
                                 
								   
                      					
                                                
                                                            <input type="text" id="single_cal1" style="line-height:30px;"  placeholder="End Date  M/D/Y"  name="e_date" value="<?php if( isset($_REQUEST['e_date']) && $_REQUEST['e_date']!="" ){ echo $_REQUEST['e_date'];}?>"/>
                                                            
                                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                        
                                         
						
                            <button class="btn btn-default" type="submit">Go!</button>
                      
						
						</form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Results </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="index.php?v=shopdiscount&f=add">Add New</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Discount On</th>
                                                <th>Start Date</th>
												 <th>End Date</th>
                                                <th>discount(%)</th>
												<!--<th>vid</th>-->
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												//$counter = 1;
												if( isset( $allManuf ) && is_array( $allManuf ) && count( $allManuf ) > 0 )
												{
													foreach( $allManuf as $allManufK => $allManufV )
													{
											?>
														<tr>
															<th scope="row"><?php echo $counter; ?></th>
															<td><?php echo $allManufV['discount_on']; ?></td>
															<td><?php echo $allManufV['s_date']; ?></td>
															<td><?php echo $allManufV['e_date']; ?></td>
															<td><?php echo $allManufV['discount']; ?></td>
															<!--<td><?php echo $allManufV['vid']; ?></td>-->
                                                            <td><a href = "index.php?v=shopdiscount&f=add&sid=<?php echo $allManufV['id'];?>" class="btn btn-info">Edit</a></td>
                                                            <td><a href = "index.php?v=shopdiscount&f=add&del=<?php echo $allManufV['id'];?>" class="btn btn-danger">Delete</a></td>
														</tr>
											<?php			
														$counter++;
													}
												}
												$path = 'index.php?v=shopdiscount&vid='.$_SESSION['vid'].'';
															
													if( isset( $_REQUEST['discount_on'] ) && $_REQUEST['discount_on'] != "" ){
													
													$path .= '&discount_on='.$_REQUEST['discount_on'].'';
															}
															
																		
													if( isset( $_REQUEST['s_date'] ) && $_REQUEST['s_date'] != "" ){
													
													$path .= '&s_date='.$_REQUEST['s_date'].'&e_date='.$_REQUEST['e_date'].'';
															}
															
													if( isset( $_REQUEST['e_date'] ) && $_REQUEST['e_date'] != "" ){
													
													$path .= '&e_date='.$_REQUEST['e_date'].'';
															}		
													echo '<tr><td align = "center" colspan = "15">'; 
													echo paginate($path,$hold);
													echo '</td></tr>';
											?>
											
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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