<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open(base_url() . 'admin/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

    <div class="form-group">
    <label ><?php echo get_phrase('institute');?></label>
<br><br>

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

    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever" >

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('student'); ?>" id="student_selector_holder">
                <option value=""><?php echo get_phrase('select');?></option>
            </optgroup>
            <optgroup label="<?php echo get_phrase('teacher'); ?>" id="teacher_selector_holder">
                <option value=""><?php echo get_phrase('select');?></option>
            </optgroup>
            <optgroup label="<?php echo get_phrase('parent'); ?>" id="parent_selector_holder">
              <option value=""><?php echo get_phrase('select');?></option>
            </optgroup>
        </select>
    </div>


    <div class="compose-message-editor">
        <textarea row="2" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css"
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>"
            id="sample_wysiwyg"></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

</div>
