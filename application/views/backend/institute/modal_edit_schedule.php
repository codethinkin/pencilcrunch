<?php
$edit_data		=	$this->db->get_where('schedule' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>

<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_schedule');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'institute/schedule_settings/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">
								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
										<div class="col-sm-5">
												<input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
										</div>
								</div>

            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_schedule');?></button>
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
