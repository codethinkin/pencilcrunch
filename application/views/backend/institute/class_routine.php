<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('class_routine_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_class_routine');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>


		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane active" id="list">
				<div class="panel-group joined" id="accordion-test-2">
                	<?php
					$toggle = true;
					$classes = $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
					foreach($classes as $row):
						?>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                		<h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse<?php echo $row['class_id'];?>">
                                        <i class="entypo-rss"></i> Class <?php echo $row['name'];?>
                                    </a>
                                    </h4>
                                </div>

                                <div id="collapse<?php echo $row['class_id'];?>" class="panel-collapse collapse <?php if($toggle){echo 'in';$toggle=false;}?>">
                                    <div class="panel-body">
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                                            <tbody>
                                                <?php
                                                for($d=1;$d<=7;$d++):

																									if($d==1)$day='Domingo';
																									else if($d==2)$day='Lunes';
																									else if($d==3)$day='Martes';
																									else if($d==4)$day='Miercoles';
																									else if($d==5)$day='Jueves';
																									else if($d==6)$day='Viernes';
																									else if($d==7)$day='Sabado';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
																											$this->db->select('c.class_routine_id, c.time_start, c.time_end, r.number_of_room, c.subject_id');
														$this->db->from('class_routine c');
														$this->db->join('classroom r', 'r.classroom_id = c.classroom');
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $row['class_id']);
														$routines	 = $this->db->get()->result_array();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            	<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
																<?php echo '('.$row2['number_of_room'].'|'.$row2['time_start'].'-'.$row2['time_end'].')';?>
                                                            	<span class="caret"></span>
                                                            </button>
															<ul class="dropdown-menu">
																<li>
                                                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');">
                                                                    <i class="entypo-pencil"></i>
                                                                        <?php echo get_phrase('edit');?>
                                                                    			</a>
                                                         </li>

                                                         <li>
                                                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/class_routine/delete/<?php echo $row2['class_routine_id'];?>');">
                                                                <i class="entypo-trash"></i>
                                                                    <?php echo get_phrase('delete');?>
                                                                </a>
                                                    		</li>
															</ul>
														</div>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
						<?php
					endforeach;
					?>
  				</div>
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'institute/class_routine/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">
													  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control" style="width:100%;"
                                        onchange="return get_class_subject(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                    	<?php
										$classes = $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>

														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
																<div class="col-sm-5">
																		<select name="subject_id" class="form-control" style="width:100%;"
																				>
																				<option value="">Selecciones Profesor</option>
																		 <?php
									 $classes = $this->db->get_where('teacher', array('institute'=> $Idint) )->result_array();
									 foreach($classes as $row):
									 ?>
																			 <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
																				<?php
									 endforeach;
									 ?>
																		</select>
																</div>
														</div>

														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('classroom');?></label>
																<div class="col-sm-5">
																		<select name="classroom" class="form-control" style="width:100%;"
																				>
																				<option value="">Selecciones Aula</option>
																		 <?php
									 $classes = $this->db->get_where('classroom', array('institute'=> $Idint) )->result_array();
									 foreach($classes as $row):
									 ?>
																			 <option value="<?php echo $row['classroom_id'];?>"><?php echo $row['number_of_room'];?></option>
																				<?php
									 endforeach;
									 ?>
																		</select>
																</div>
														</div>


                          <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('day');?></label>
                                <div class="col-sm-5">
                                    <select name="day" class="form-control" style="width:100%;">
                                        <option value="domingo">Domingo</option>
                                        <option value="lunes">Lunes</option>
                                        <option value="martes">Martes</option>
                                        <option value="miercoels">Miercoles</option>
                                        <option value="jueves">Jueves</option>
                                        <option value="viernes">Viernes</option>
                                        <option value="sabado">Sabado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('starting_time');?></label>
                                <div class="col-sm-5">
                                    <select name="time_start" class="form-control" style="width:100%;">
										<?php for($i = 0; $i <= 12 ; $i++):?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php endfor;?>
                                    </select>
                                    <select name="starting_ampm" class="form-control" style="width:100%">
                                    	<option value="1">am</option>
                                    	<option value="2">pm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('ending_time');?></label>
                                <div class="col-sm-5">
                                    <select name="time_end" class="form-control" style="width:100%;">
										<?php for($i = 0; $i <= 12 ; $i++):?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php endfor;?>
                                    </select>
                                    <select name="ending_ampm" class="form-control" style="width:100%">
                                    	<option value="1">am</option>
                                    	<option value="2">pm</option>
                                    </select>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class_routine');?></button>
                              </div>
							</div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS-->

		</div>
	</div>
</div>

<script type="text/javascript">
    function get_class_subject(institute) {
        $.ajax({
            url: '<?php echo base_url();?>institute/get_class_teacher/' + institute ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
</script>
