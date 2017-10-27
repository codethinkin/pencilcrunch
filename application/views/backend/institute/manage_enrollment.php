<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('enrollment_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_enrollment');?>
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
												<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('period');?></div></th>
                        <th><div><?php echo get_phrase('courses');?></div></th>
                        <th><div><?php echo get_phrase('schedule');?></div></th>
												<th><div><?php echo get_phrase('folio');?></div></th>
												<th><div><?php echo get_phrase('libro');?></div></th>
											  <th><div><?php echo get_phrase('state');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
											<?php
											  $enrollment	=	$this->db->get_where('enrollment', array('institute'=> $Idint) )->result_array();
											  $count = 1;foreach($enrollment as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>

                            <td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student']);?></td>
														<td><?php echo $this->crud_model->get_towns_name_by_id('period',$row['period']);?></td>
							              <td><?php echo $this->crud_model->get_grade_name_by_id('courses',$row['courses']);?></td>
  													<td><?php echo $this->crud_model->get_grade_schedule_by_id('schedule',$row['schedule']);?></td>
														<td><?php echo $this->crud_model->get_folio_name_by_id('folio',$row['folio']);?></td>
									<td><?php echo $this->crud_model->get_libro_name_by_id('libro',$row['libro']);?></td>
              <td><?php echo $row['state'];?></td>

			 					<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <?php echo get_phrase('action');?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_enrollment/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/enrollment/delete/<?php echo $row['id'];?>');">
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
                	<?php echo form_open(base_url() . 'institute/enrollment/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
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
    <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
    <div class="col-sm-5">
        <select name="student" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
          <?php
$grade= $this->db->get_where('student', array('institute'=> $Idint, 'state'=>'a') )->result_array();
foreach($grade as $row):
?>

            <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?><?php echo " ". $row['lastName'];?></option>
            <?php
endforeach;
?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('grade');?></label>
    <div class="col-sm-5">
        <select name="grade" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
          <?php
$grade= $this->db->get_where('courses', array('institute'=> $Idint, 'state'=>'Activo') )->result_array();
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
    <label class="col-sm-3 control-label"><?php echo get_phrase('folio');?></label>
    <div class="col-sm-5">
        <select name="folio" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
          <?php
$grade= $this->db->get_where('folio', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

            <option value="<?php echo $row['id'];?>"><?php echo $row['folioNumber'];?></option>
            <?php
endforeach;
?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('libro');?></label>
    <div class="col-sm-5">
        <select name="libro" class="form-control" style="width:100%;">
					<option value="">Seleccione</option>
          <?php
$grade= $this->db->get_where('libro', array('institute'=> $Idint) )->result_array();
foreach($grade as $row):
?>

            <option value="<?php echo $row['id'];?>"><?php echo $row['libroNumber'];?></option>
            <?php
endforeach;
?>
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('schedule');?></label>
    <div class="col-sm-5">
        <select name="schedule" class="form-control" style="width:100%;">
          <?php
$nameSection= $this->db->get_where('schedule', array('institute'=> $Idint) )->result_array();
foreach($nameSection as $row):
?>
            <option value="">Seleccione</option>
            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?php
endforeach;
?>
        </select>
    </div>
</div>

<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('state');?></label>
                                <div class="col-sm-5 controls">
                                    <select name="state" class="form-control" style="width:100%;">
                                      <option value="Activo">Activo</option>
                                      <option value="Pendiente">Pendiente</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_enrollment');?></button>
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
