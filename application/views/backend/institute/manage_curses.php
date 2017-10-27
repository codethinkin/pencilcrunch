<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('courses_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_courses');?>
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
                    		<th><div><?php echo get_phrase('grade');?></div></th>
												<th><div><?php echo get_phrase('description');?></div></th>
                        <th><div><?php echo get_phrase('numberStudent');?></div></th>
												<th><div><?php echo get_phrase('classroom');?></div></th>

                    <th><div><?php echo get_phrase('studen_register');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
											<?php
												$courses	=	$this->db->get_where('courses', array('institute'=> $Idint) )->result_array();
											  $count = 1;foreach($courses as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['grade'];?></td>
								<td><?php echo $row['description'];?></td>
										<td><?php echo $row['numberStudent'];?></td>
																			     <td><?php echo $this->crud_model->get_classroom_name_by_id('classroom',$row['classroom']);?></td>
                  <td><?php echo $row['studentRegister'];?></td>


			 					<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <?php echo get_phrase('action');?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_courses/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/courses/delete/<?php echo $row['id'];?>');">
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
                	<?php echo form_open(base_url() . 'institute/courses/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('grade');?></label>
    <div class="col-sm-5">
          <input type="text" class="form-control" name="grade"/>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
    <div class="col-sm-5">
  <input type="text" class="form-control" name="sectioncurse"/>
    </div>
</div>

<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_student');?></label>
                                <div class="col-sm-5 controls">
                                    <input type="text" class="form-control" name="numberStudent"/>
                                </div>
                            </div>

														<div class="form-group">
														    <label class="col-sm-3 control-label"><?php echo get_phrase('classroom');?></label>
														    <div class="col-sm-5">
														        <select name="classroom" class="form-control" style="width:100%;">
																			<option value="">Seleccione</option>
														          <?php
														$grade= $this->db->get_where('classroom', array('institute'=> $Idint) )->result_array();
														foreach($grade as $row):
														?>

														            <option value="<?php echo $row['classroom_id'];?>"><?php echo $row['number_of_room'];?></option>
														            <?php
														endforeach;
														?>
														        </select>
														    </div>
														</div>


                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_courses');?></button>
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
