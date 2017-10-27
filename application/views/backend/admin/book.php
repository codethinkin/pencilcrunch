<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('book_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_book');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>


		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
												<th><div><?php echo get_phrase('institute');?></div></th>
                    		<th><div><?php echo get_phrase('book_name');?></div></th>
                    		<th><div><?php echo get_phrase('author');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('price');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($books as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
														    <td><?php echo $this->crud_model->get_institute_name_by_id('institute',$row['institute']);?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['author'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['price'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td><span class="label label-<?php if($row['status']=='available')echo 'success';else echo 'secondary';?>"><?php echo $row['status'];?></span></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_book/<?php echo $row['book_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/book/delete/<?php echo $row['book_id'];?>');">
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
                	<?php echo form_open(base_url() . 'admin/book/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>


									                								<div class="form-group">
									                								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>

									                								<div class="col-sm-5">
									                								<select name="institute" class="form-control" data-validate="required" id="id"
									                								data-message-required="<?php echo get_phrase('value_required');?>"
									                									onchange="return get_sede_sections(this.value)">
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
									                														<select name="sede" class="form-control" id="sede_selector_holder">
									                																<option value=""><?php echo get_phrase('select');?></option>

									                													</select>
									                											</div>
									                								</div>



													  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>

														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('isbn');?></label>
																<div class="col-sm-5">
																		<input type="text" class="form-control" name="isbn"/>
																</div>
														</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="author"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="price"/>
                                </div>
                            </div>
														<div class="form-group">
				          					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
				          									<div class="col-sm-5">
				          											<select name="class_id" class="form-control" id="class_selector_holder">
				          													<option value=""><?php echo get_phrase('select');?></option>

				          										</select>
				          								</div>
				          					</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                <div class="col-sm-5">
                                    <select name="status" class="form-control" style="width:100%;">
                                    	<option value="available"><?php echo get_phrase('available');?></option>
                                    	<option value="unavailable"><?php echo get_phrase('unavailable');?></option>
                                    </select>
                                </div>
                            </div>
                        		<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_book');?></button>
                              </div>
								</div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS--->

		</div>
	</div>
</div>


<script type="text/javascript">
jQuery(document).ready(function($)
{


    });

    function get_sede_sections(id) {

      $.ajax({
            url: '<?php echo base_url();?>admin/get_sede_section/' + id ,
            success: function(response)
            {
                jQuery('#sede_selector_holder').html(response);
            }
        });

        $.ajax({
              url: '<?php echo base_url();?>admin/get_teacher_section/' + id ,
              success: function(response)
              {
                  jQuery('#teacher_selector_holder').html(response);
              }
          });

          $.ajax({
                url: '<?php echo base_url();?>admin/get_class_section/' + id ,
                success: function(response)
                {
                    jQuery('#class_selector_holder').html(response);
                }
            });

      }


</script>
