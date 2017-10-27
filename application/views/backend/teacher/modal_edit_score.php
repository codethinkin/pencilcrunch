
<?php $idTeacher=  $this->session->userdata('teacher_id'); ?>

<?php
$this->db->select('i.name_institute, i.id, t.teacher_id');
$this->db->from('teacher t');
$this->db->join('institute i', 'i.id = t.institute');
$this->db->where('t.teacher_id', $idTeacher);
$institute = $this->db->get()->result();
foreach ($institute  as $row)
{
		$Idint =  $row->id;
    $tea = $row->teacher_id;

}

 ?>

 <?php
 $edit_data		=	$this->db->get_where('score' , array('id' => $param2) )->result_array();
 foreach ( $edit_data as $row):
 ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_score');?>
            	</div>
            </div>

			<div class="panel-body">
                <?php echo form_open(base_url() . 'institute/manage_score/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('period');?></label>
                    <div class="col-sm-5 controls">
                        <select name="period" class="form-control">
                            <?php

                            $classes= $this->db->get_where('period', array('institute'=> $Idint) )->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['id'];?>"
                                    <?php if($row['id'] == $row2['id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                    <div class="col-sm-5 controls">
                        <select  name="student" class="form-control">
                            <?php
                              $classe= $this->db->get_where('student', array('institute'=> $Idint) )->result_array();

                            foreach($classe as $row3):
                            ?>
                                <option value="<?php echo $row3['student_id'];?>"
                                    <?php if($row['student'] == $row3['student_id'])echo 'selected';?>>
                                        <?php echo $row3['name']." ".$row3['lastName'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('grade');?></label>
                    <div class="col-sm-5 controls">
                        <select  name="courses" class="form-control">
                            <option value=""></option>
                            <?php
                        $teachers = $this->db->get_where('courses', array('institute'=> $Idint) )->result_array();

                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['id'];?>"
                                    <?php if($row['courses'] == $row2['id'])echo 'selected';?>>
                                        <?php echo $row2['description'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
										<div class="col-sm-5 controls">
												<select  name="class" class="form-control">
														<?php
														$classes= $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
														foreach($classes as $row2):
														?>
																<option value="<?php echo $row2['class_id'];?>"
																		<?php if($row['class'] == $row2['class_id'])echo 'selected';?>>
																				<?php echo $row2['name'];?>
																						</option>
														<?php
														endforeach;
														?>
												</select>
										</div>
								</div>

								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('nota1');?></label>
										<div class="col-sm-5 controls">
                		<input type="text" class="form-control" name="nota1" value="<?php echo $row['nota1'];?>"/>
										</div>
								</div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('nota2');?></label>
                    <div class="col-sm-5 controls">
                      <input type="text" class="form-control" name="nota2" value="<?php echo $row['nota2'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('nota3');?></label>
                    <div class="col-sm-5 controls">
                      <input type="text" class="form-control" name="nota3" value="<?php echo $row['nota3'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('nota4');?></label>
                    <div class="col-sm-5 controls">
                      <input type="text" class="form-control" name="nota4" value="<?php echo $row['nota4'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('nota_cualitativa');?></label>
                    <div class="col-sm-5 controls">
                      <input type="text" class="form-control" name="nota_cualitativa" value="<?php echo $row['nota_cualitativa'];?>"/>
                    </div>
                </div>


                          <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_score');?></button>
                    </div>
                 </div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
