<?php
$edit_data		=	$this->db->get_where('course_class' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_grade');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'institute/grade/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
							<div class="form-group">
									<label class="col-sm-3 control-label"><?php echo get_phrase('courses');?></label>
									<div class="col-sm-5 controls">
											<select name="courses" class="form-control">
													<?php
													$classes= $this->db->get_where('courses', array('institute'=> $Idint) )->result_array();
													foreach($classes as $row2):
													?>
															<option value="<?php echo $row2['id'];?>"
																	<?php if($row['id'] == $row2['id'])echo 'selected';?>>
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
											<select name="class" class="form-control">
													<?php


													$classes= $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
													foreach($classes as $row2):
													?>
															<option value="<?php echo $row2['class_id'];?>"
																	<?php if($row['id'] == $row2['class_id'])echo 'selected';?>>
																			<?php echo $row2['name'];?>
																					</option>
													<?php
													endforeach;
													?>
											</select>
									</div>
							</div>
                  <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_grade');?></button>
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
