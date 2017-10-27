<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_institute');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'admin/institute/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('code');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="code" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="name_institute" value="" data-start-view="2">
						</div>
					</div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('nit');?></label>

            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="nit" value="" data-start-view="2">
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
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

            <div class="col-sm-5">
              <input type="text" class="form-control datepicker" name="address" value="" data-start-view="2">
            </div>
          </div>


					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone1" value="" >
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
            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

            <div class="col-sm-5">
              <select name="gender_institute" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                              <option value="mixto"><?php echo get_phrase('mixto');?></option>
                          </select>
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
										<span class="fileinput-new">Seleccione Imagen</span>
										<span class="fileinput-exists">Cambiar</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Eliminar</a>
								</div>
							</div>
						</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_institute');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
