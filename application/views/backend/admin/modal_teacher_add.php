<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_teacher');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'admin/teacher/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

								<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>

								<div class="col-sm-5">
								<select name="institute" class="form-control" data-validate="required" id="id"
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_sede_sections(this.value)">
															<option value=""><?php echo get_phrase('select');?></option>
															<?php
								$classes = $this->db->get('institute')->result_array();
								foreach($classes as $row):
									?>
																<option value="<?php echo $row['id'];?>">
											<?php echo $row['name_institute'];?>
																						</option>
																<?php
								endforeach;
								?>
													</select>
								</div>
								</div>


								<div class="form-group">
								<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('sede');?></label>
												<div class="col-sm-5">
														<select name="sede" class="form-control" id="sede_selector_holder">
																<option value=""><?php echo get_phrase('select');?></option>

													</select>
											</div>
								</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="profession" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>




					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-5">
							<select name="sex" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div>

					<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('department');?></label>

					<div class="col-sm-5">
					<select name="department" class="form-control" data-validate="required" id="id"
					data-message-required="<?php echo get_phrase('value_required');?>"
						onchange="return get_towns_sections(this.value)">
												<option value=""><?php echo get_phrase('select');?></option>
												<?php
					$classes = $this->db->get('department')->result_array();
					foreach($classes as $row):
						?>
													<option value="<?php echo $row['id'];?>">
								<?php echo $row['name'];?>
																			</option>
													<?php
					endforeach;
					?>
										</select>
					</div>
					</div>


					<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('towns');?></label>
									<div class="col-sm-5">
											<select name="towns" class="form-control" id="towns_selector_holder">
													<option value=""><?php echo get_phrase('select');?></option>

										</select>
								</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
