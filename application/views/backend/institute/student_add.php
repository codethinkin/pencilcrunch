<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('student_add');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('more_info');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
<?php echo form_open(base_url() . 'institute/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>

							<div class="col-sm-5">
							<select name="institute" class="form-control" data-validate="required" id="id"
							data-message-required="<?php echo get_phrase('value_required');?>"
								onchange="return get_sede_sections(this.value)">
														<option value=""><?php echo get_phrase('select');?></option>
														<?php
							$classes = $this->db->get_where('institute', array('id'=> $Idint))->result_array();
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
							<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_name');?></label>

							<div class="col-sm-5">
							<input type="text" class="form-control" name="lastName" data-validate="required" >
							</div>
							</div>



							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>

							<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
							</div>
							</div>

							<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('birth_place');?></label>

							<div class="col-sm-5">
							<input type="text" class="form-control" name="birthplace" data-validate="required" >
							</div>
							</div>

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('type_identify');?></label>

							<div class="col-sm-5">
							<select name="typeIdentify" class="form-control">
														<option value=""></option>
														<option value="rc">RC</option>
														<option value="ti">TI</option>
														<option value="cc">CC</option>
														<option value="te">TE</option>
												</select>
							</div>
							</div>

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('number_identify');?></label>

							<div class="col-sm-5">
							<input type="text" class="form-control" name="numberIdentify" value="" >
							</div>
							</div>

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('type_rh');?></label>

							<div class="col-sm-5">
							<select name="typeRh" class="form-control">
														<option value=""></option>
														<option value="a+">A+</option>
														<option value="a-">A-</option>
														<option value="b+">B+</option>
														<option value="b-">B-</option>
														<option value="ab">AB+</option>
														<option value="ab-">AB-</option>
														<option value="o+">O+</option>
														<option value="o-">O-</option>
												</select>
							</div>
							</div>

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

							<div class="col-sm-5">
							<select name="sex" class="form-control">
							              <option value=""><?php echo get_phrase('select');?></option>
							              <option value="m"><?php echo get_phrase('male');?></option>
							              <option value="f"><?php echo get_phrase('female');?></option>
														 <option value="o"><?php echo get_phrase('other');?></option>
							          </select>
							</div>
							</div>

							<div class="form-group">
							<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('residence_place');?></label>

							<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
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
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">

									<div class="form-group">
											<label class="col-sm-3 control-label"><?php echo get_phrase('school_restaurant');?></label>
											<div class="col-sm-5">
												<select name="school_restaurant" class="form-control">
																				<option value=""><?php echo get_phrase('select');?></option>
																				<option value="SI">SI</option>
																				<option value="NO">NO</option>
																		</select>
											</div>
									</div>
<hr>
									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('disability');?></label>

										<div class="col-sm-5">
											<input type="text" class="form-control" name="disability" value="" >
										</div>
									</div>

									<div class="form-group">
										<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>

										<div class="col-sm-5">
											<input type="text" class="form-control" name="religion" value="" >
										</div>
									</div>

									<div class="form-group">
											<label class="col-sm-3 control-label"><?php echo get_phrase('displaced');?></label>
											<div class="col-sm-5">
												<select name="displaced" class="form-control">
																				<option value=""><?php echo get_phrase('select');?></option>
																				<option value="SI">SI</option>
																				<option value="NO">NO</option>

																		</select>
											</div>
									</div>


				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('level')." ". "(SISBEN)";?></label>

					<div class="col-sm-5">
						<input type="text" class="form-control" name="level" value="" >
					</div>
				</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('carnet')." ". "(SISBEN)";?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="carnet"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('stracto');?></label>
                                <div class="col-sm-5">
																	<select name="estracto" class="form-control">
																									<option value=""><?php echo get_phrase('select');?></option>
																									<option value="1">1</option>
																									<option value="2">2</option>
																									<option value="3">3</option>
																									<option value="4">4</option>
																									<option value="5">5</option>
																									<option value="mas">Mas</option>
																							</select>
                                </div>
                            </div>

														<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('indigenous_community');?></label>
                                <div class="col-sm-5">
																	<select name="indigenous_community" class="form-control">
																									<option value=""><?php echo get_phrase('select');?></option>
																									<option value="SI">SI</option>
																									<option value="NO">NO</option>

																							</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('etnia');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="etnia"/>
                                </div>
                            </div>
														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('eps');?></label>
																<div class="col-sm-5">
																		<input type="text" class="form-control" name="eps"/>
																</div>
														</div>
														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('ips');?></label>
																<div class="col-sm-5">
																		<input type="text" class="form-control" name="ips"/>
																</div>
														</div>
														<div class="form-group">
																<label class="col-sm-3 control-label"><?php echo get_phrase('ars');?></label>
																<div class="col-sm-5">
																		<input type="text" class="form-control" name="ars"/>
																</div>
														</div>

														<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info"><?php echo get_phrase('add_student');?></button>
										</div>
									</div>


														<?php echo form_close();?>

                </div>
			</div>
			<!----CREATION FORM ENDS-->

		</div>
	</div>
</div>

<script type="text/javascript">

	function get_sede_sections(id) {

    	$.ajax({
            url: '<?php echo base_url();?>institute/get_sede_section/' + id ,
            success: function(response)
            {
                jQuery('#sede_selector_holder').html(response);
            }
        });

    }

</script>
