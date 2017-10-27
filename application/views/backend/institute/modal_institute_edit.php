<?php
$edit_data		=	$this->db->get_where('institute' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_institute');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/institute/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('institute' , $row['id']);?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Seleccionar Imagen</span>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

											

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('code');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="code" value="<?php echo $row['code'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name_institute" value="<?php echo $row['name_institute'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('nit');?></label>

                              <div class="col-sm-5">
                                <input type="text" class="form-control datepicker" name="nit" value="<?php echo $row['nit'];?>" >
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone1" value="<?php echo $row['phone1'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="password" value="<?php echo $row['password'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                                <div class="col-sm-5">
                                    <select name="sex" class="form-control">
                                    	<option value="male" <?php if($row['gender_institute'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                    	<option value="female" <?php if($row['gender_institute'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                      <option value="female" <?php if($row['gender_institute'] == 'mixto')echo 'selected';?>><?php echo get_phrase('mixto');?></option>
                                    </select>
                                </div>
                            </div>





                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_institute');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
