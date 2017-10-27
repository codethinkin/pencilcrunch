<?php $idTeacher=  $this->session->userdata('teacher_id'); ?>

<?php
$this->db->select('i.name_institute, i.id');
$this->db->from('teacher t');
$this->db->join('institute i', 'i.id = t.institute');
$this->db->where('t.teacher_id', $idTeacher);
$institute = $this->db->get()->result();
foreach ($institute  as $row)
{
		$inst =  $row->id;

}

 ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('class_routine_list');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>


		<div class="tab-content">


            <!----TABLE LISTING STARTS-->
            <div class="tab-pane active" id="list">
				<div class="panel-group joined" id="accordion-test-2">
                	<?php
					$toggle = true;
					$classes = $this->db->get_where('class', array('institute'=> $inst, 'teacher_id'=> $idTeacher) )->result_array();

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
                                                else if($d==7)$day='Sábado';
                                                ?>
																								<tr class="gradeA">
																										<td width="100"><?php echo strtoupper($day);?></td>
																										<td>
																											<?php
																											$this->db->select('c.class_routine_id, c.time_start, c.time_end, r.number_of_room, c.subject_id, c.teacher');
														$this->db->from('class_routine c');
														$this->db->join('classroom r', 'r.classroom_id = c.classroom');
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $row['class_id']);
														$this->db->where('c.subject_id' , $idTeacher);
														$routines	 = $this->db->get()->result_array();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																															<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
																<?php echo '('.$row2['number_of_room'].'|'.$row2['time_start'].'-'.$row2['time_end'].')';?>
																															<span class="caret"></span>
																														</button>
															<!--<ul class="dropdown-menu">
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

														-->
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
            <!----TABLE LISTING ENDS-->




		</div>
	</div>
</div>
