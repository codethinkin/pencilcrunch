<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('secction_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_secction');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->


            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('grade_name');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
											<?php
															$grades	=	$this->db->get_where('sectionCurse', array('institute'=> $Idint) )->result_array();
											  $count = 1;foreach($grades as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['nameSection'];?></td>
			 					<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <?php echo get_phrase('action');?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_sectionCurse/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/sectionCurse/delete/<?php echo $row['id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'institute/sectionCurse/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">
													  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="nameSection"/>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="comment"/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_secction');?></button>
                              </div>
								</div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS-->

		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{


		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>