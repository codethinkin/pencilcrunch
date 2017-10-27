<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('grade_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_grade');?>
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
												<th><div><?php echo get_phrase('period');?></div></th>
                    		<th><div><?php echo get_phrase('curse_name');?></div></th>
												<th><div><?php echo get_phrase('class_names');?></div></th>
												<th><div><?php echo get_phrase('teacher');?></div></th>
												<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
											<?php
											$grades	=	$this->db->get_where('course_class', array('institute'=> $Idint) )->result_array();
											  $count = 1;foreach($grades as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
														<td><?php echo $this->crud_model->get_towns_name_by_id('period',$row['period']);?></td>
														<td><?php echo $this->crud_model->get_grade_name_by_id('courses',$row['courses']);?></td>
														<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class']);?></td>

														<td><?php echo $this->crud_model->get_teachers_name_by_id('teacher',$row['teacher']);?></td>
														<td><?php echo $this->crud_model->get_students_name_by_id('student',$row['student']);?></td>
			 					<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <?php echo get_phrase('action');?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_grade/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/grade/delete/<?php echo $row['id'];?>');">
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
                	<?php echo form_open(base_url() . 'institute/grade/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">


<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('period');?></label>
		<div class="col-sm-5">
				<select name="period" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
					<?php
$grade= $this->db->get_where('period', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

						<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
						<?php
endforeach;
?>
				</select>
		</div>
</div>

<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
		<div class="col-sm-5">
				<select name="class" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
					<?php
$grade= $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

						<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
						<?php
endforeach;
?>
				</select>
		</div>
</div>
<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('curse');?></label>
		<div class="col-sm-5">
				<select name="courses" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
					<?php
$grade= $this->db->get_where('courses', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

						<option value="<?php echo $row['id'];?>"><?php echo $row['description'];?></option>
						<?php
endforeach;
?>
				</select>
		</div>
</div>



<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
		<div class="col-sm-5">
				<select name="teacher" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
					<?php
$grade= $this->db->get_where('teacher', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

						<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
						<?php
endforeach;
?>
				</select>
		</div>
</div>


<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
		<div class="col-sm-5">
				<select name="student" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
					<?php
$grade= $this->db->get_where('student', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

						<option value="<?php echo $row['student_id'];?>"><?php echo $row['name']." ".$row['lastName'];?></option>
						<?php
endforeach;
?>
				</select>
		</div>
</div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_grade');?></button>
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
