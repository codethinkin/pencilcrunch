<?php
$edit_data		=	$this->db->get_where('classroom' , array('classroom_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>

<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_classroom');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'institute/classroom/do_update/'.$row['classroom_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('number_of_room');?></label>
										<div class="col-sm-5">
												<input type="text" class="form-control" name="number_of_room" value="<?php echo $row['number_of_room'];?>"/>
										</div>
								</div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>


										<!--
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control">
                                <option value=""></option>
                                <?php
                                $teachers = $this->db->get('teacher')->result_array();
                                foreach($teachers as $row2):
                                ?>
                                    <option value="<?php echo $row2['teacher_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

									-->
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_classroom');?></button>
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
