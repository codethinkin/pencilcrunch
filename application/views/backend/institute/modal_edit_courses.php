
<?php
$edit_data		=	$this->db->get_where('courses' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_courses');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'institute/courses/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">


<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('grade');?></label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="grade" value="<?php echo $row['grade'];?>"/>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="sectioncurse" value="<?php echo $row['sectionCurse'];?>"/>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('number_student');?></label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="number_student" value="<?php echo $row['numberStudent'];?>"/>
    </div>
</div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('classroom');?></label>
                    <div class="col-sm-5 controls">
                        <select name="period" class="form-control">
                            <?php


                            $classes= $this->db->get_where('classroom', array('institute'=> $Idint) )->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['classroom_id'];?>"
                                    <?php if($row['classroom'] == $row2['classroom_id'])echo 'selected';?>>
                                        <?php echo $row2['number_of_room'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
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
