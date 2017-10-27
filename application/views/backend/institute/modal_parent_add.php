<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_parent');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'institute/parent/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">

<div class="form-group">
<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>

<div class="col-sm-5">
<select name="student" class="form-control" data-validate="required">
							<option value=""><?php echo get_phrase('select');?></option>
							<?php
							$classes= $this->db->get_where('student', array('institute'=> $Idint) )->result_array();
							foreach($classes as $row):?>

								<option value="<?php echo $row['student_id'];?>">
			<?php echo $row['name']." ".$row['lastName'];?>
														</option>
								<?php
endforeach;
?>
					</select>
</div>
</div>

								<div class="form-group">
										<label class="col-sm-3 control-label"><?php echo get_phrase('parentesc');?></label>
										<div class="col-sm-5">
												<select name="tipeParent" class="form-control" style="width:100%;">
													<option value=""><?php echo get_phrase('select');?></option>
													<option value="madre"><?php echo get_phrase('mother');?></option>
													<option value="padre" ><?php echo get_phrase('father');?></option>
													<option value="abuelo"><?php echo get_phrase('GranMother');?></option>
													<option value="abuela"><?php echo get_phrase('GranFather');?></option>
													<option value="otros" ><?php echo get_phrase('other');?></option>
												</select>
										</div>
								</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
						</div>
					</div>



					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('movil');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="movil" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="">
						</div>
					</div>

					<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo get_phrase('level_of_schooling');?></label>
							<div class="col-sm-5">
									<select name="level_of_schooling" class="form-control" style="width:100%;">
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="madre"><?php echo get_phrase('none');?></option>
										<option value="padre" ><?php echo get_phrase('primary');?></option>
										<option value="abuelo"><?php echo get_phrase('high_school');?></option>
										<option value="abuela"><?php echo get_phrase('professional');?></option>
										<option value="otros" ><?php echo get_phrase('other');?></option>
									</select>
							</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="profession" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email"
															value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="">
						</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_parent');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
