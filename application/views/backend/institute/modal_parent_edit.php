<?php $Idint=  $this->session->userdata('institute_id'); ?>
<?php
	$edit_data = $this->db->get_where('parent' , array('parent_id' => $param2))->result_array();
	foreach ($edit_data as $row):
?>

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

                <?php echo form_open(base_url() . 'institute/parent/edit/' . $row['parent_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">

<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
		<div class="col-sm-5">
				<select name="student" class="form-control">
						<option value=""></option>
						<?php
						$institute= $this->db->get('student')->result_array();

						foreach($institute as $row2):
						?>
								<option value="<?php echo $row2['student_id'];?>"
										<?php if($row['student'] == $row2['student_id'])echo 'selected';?>>
												<?php echo $row2['name']." ".$row2['lastName'];?>
														</option>
						<?php
						endforeach;
						?>
				</select>
		</div>
</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
                            	value="<?php echo $row['name'];?>">
						</div>
					</div>

					<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo get_phrase('parentesc');?></label>
							<div class="col-sm-5">
									<select name="tipeParent" class="form-control" style="width:100%;">
										<option value=""><?php echo get_phrase('select');?></option>

										<option value="madre" <?php if($row['tipeParent'] == 'madre')echo 'selected';?>><?php echo get_phrase('mother');?></option>
										<option value="padre" <?php if($row['tipeParent'] == 'padre')echo 'selected';?>><?php echo get_phrase('father');?></option>
										<option value="abuelo" <?php if($row['tipeParent'] == 'abuelo')echo 'selected';?>><?php echo get_phrase('GranMother');?></option>
										<option value="abuela" <?php if($row['tipeParent'] == 'abuela')echo 'selected';?>><?php echo get_phrase('GranFather');?></option>
										<option value="otros" <?php if($row['tipeParent'] == 'otros')echo 'selected';?>><?php echo get_phrase('other');?></option>

									</select>
							</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email"
                            	value="<?php echo $row['email'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="password"
															value="<?php echo $row['password'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('movil');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="movil" value="<?php echo $row['movil'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="profession" value="<?php echo $row['profession'];?>">
						</div>
					</div>
					<div class="form-group">
							<label class="col-sm-3 control-label"><?php echo get_phrase('state');?></label>
							<div class="col-sm-5">
									<select name="state" class="form-control">
										<option value="Activo" <?php if($row['state'] == 'Activo')echo 'selected';?>><?php echo get_phrase('active');?></option>
										<option value="Inactivo" <?php if($row['state'] == 'Inactivo')echo 'selected';?>><?php echo get_phrase('inactive');?></option>
									</select>
							</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
