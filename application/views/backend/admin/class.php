<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('class_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_class');?>
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
                    		<th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
												<th><div><?php echo get_phrase('institute');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($classes as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td><?php echo $this->crud_model->get_institute_name_by_id('institute',$row['institute']);?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_class/<?php echo $row['class_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/classes/delete/<?php echo $row['class_id'];?>');">
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
                	<?php echo form_open(base_url() . 'admin/classes/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">

													<div class="form-group">
													<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>

													<div class="col-sm-5">
													<select name="institute" class="form-control" data-validate="required" id="id"
													data-message-required="<?php echo get_phrase('value_required');?>"
														onchange="return get_towns_sections(this.value)">
																				<option value=""><?php echo get_phrase('select');?></option>
																				<?php
													$classes = $this->db->get('institute')->result_array();
													foreach($classes as $row):
														?>
																					<option value="<?php echo $row['id'];?>">
																<?php echo $row['name_institute'];?>
																											</option>
																					<?php
													endforeach;
													?>
																		</select>
													</div>
													</div>


													<div class="form-group">
													<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('sede');?></label>
																	<div class="col-sm-5">
																			<select name="sede" class="form-control" id="class_selector_holder">
																					<option value=""><?php echo get_phrase('select');?></option>

																		</select>
																</div>
													</div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name_numeric');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name_numeric"/>
                                </div>
                            </div>
														<div class="form-group">

														<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
																		<div class="col-sm-5">
																				<select name="teacher_id" class="form-control" id="teacher_selector_holder">
																						<option value=""><?php echo get_phrase('select');?></option>

																			</select>
																	</div>
														</div>
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class');?></button>
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

	function get_towns_sections(id) {

			$.ajax({
						url: '<?php echo base_url();?>admin/get_sede_section/' + id ,
						success: function(response)
						{
								jQuery('#class_selector_holder').html(response);
						}
				});

				$.ajax({
							url: '<?php echo base_url();?>admin/get_teacher_section/' + id ,
							success: function(response)
							{
									jQuery('#teacher_selector_holder').html(response);
							}
					});

		};



</script>
