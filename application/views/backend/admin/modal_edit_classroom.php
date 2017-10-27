<?php
$edit_data		=	$this->db->get_where('classroom' , array('classroom_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'admin/classroom/do_update/'.$row['classroom_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">

              <div class="form-group">
                  <label class="col-sm-3 control-label"><?php echo get_phrase('institute');?></label>
                  <div class="col-sm-5">
                      <select name="institute" class="form-control" >
                          <option value=""></option>
                          <?php
                          $institute= $this->db->get('institute')->result_array();
                          foreach($institute as $row2):
                          ?>
                              <option value="<?php echo $row2['id'];?>"
                                  <?php if($row['institute'] == $row2['id'])echo 'selected';?>>
                                      <?php echo $row2['name_institute'];?>
                                          </option>
                          <?php
                          endforeach;
                          ?>
                      </select>
                  </div>
              </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>
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
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_dormitory');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
