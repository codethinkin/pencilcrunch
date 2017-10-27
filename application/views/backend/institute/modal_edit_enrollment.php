<?php
$edit_data		=	$this->db->get_where('enrollment' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_enrollment');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'institute/enrollment/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
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
                        <select name="student" class="form-control">
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
                        <select name="grade" class="form-control">
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
										<label class="col-sm-3 control-label"><?php echo get_phrase('folio');?></label>
										<div class="col-sm-5 controls">
												<select name="folio" class="form-control">
														<?php


														$classes= $this->db->get_where('folio', array('institute'=> $Idint) )->result_array();
														foreach($classes as $row2):
														?>
																<option value="<?php echo $row2['id'];?>"
																		<?php if($row['id'] == $row2['id'])echo 'selected';?>>
																				<?php echo $row2['folioNumber'];?>
																						</option>
														<?php
														endforeach;
														?>
												</select>
										</div>
								</div>

								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('libro');?></label>
										<div class="col-sm-5 controls">
												<select name="libro" class="form-control">
														<?php


														$classes= $this->db->get_where('libro', array('institute'=> $Idint) )->result_array();
														foreach($classes as $row2):
														?>
																<option value="<?php echo $row2['id'];?>"
																		<?php if($row['id'] == $row2['id'])echo 'selected';?>>
																				<?php echo $row2['libroNumber'];?>
																						</option>
														<?php
														endforeach;
														?>
												</select>
										</div>
								</div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('schedule');?></label>
                    <div class="col-sm-5 controls">
                        <select name="schedule" class="form-control">
                            <option value=""></option>
                            <?php
                        $teachers = $this->db->get_where('schedule', array('institute'=> $Idint) )->result_array();

                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['id'];?>"
                                    <?php if($row['schedule'] == $row2['id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('state');?></label>
                    <div class="col-sm-5 controls">
                        <select name="state" class="form-control">
                            <option value="Activo">Activo</option>
                            <option value="Pendiente">Pendiente</option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_enrollment');?></button>
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
