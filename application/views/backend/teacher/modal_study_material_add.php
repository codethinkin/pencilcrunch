

<?php $idTeacher=  $this->session->userdata('teacher_id'); ?>

<?php
$this->db->select('i.name_institute, i.id');
$this->db->from('teacher t');
$this->db->join('institute i', 'i.id = t.institute');
$this->db->where('t.teacher_id', $idTeacher);
$institute = $this->db->get()->result();
foreach ($institute  as $row)
{
		$inst =  $row->id;

}

 ?>

 <?php $class_info = $this->db->get_where('class', array('teacher_id'=> $idTeacher) )->result_array();?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_study_material'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'teacher/study_material/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<input type="hidden" name="institute_id" value="<?php echo $inst; ?>">
<input type="hidden" name="teacher_id" value="<?php echo $idTeacher; ?>">
<input type="hidden" name="timestamp" value="<?php echo $idTeacher; ?>">


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="title" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-9">
                            <textarea name="description" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php foreach ($class_info as $row) { ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">
                          <input type="file" name="file_name" value="" placeholder="Archivo" data-label="<i class='glyphicon glyphicon-file'></i> Browse">



                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('file_type'); ?></label>

                        <div class="col-sm-5">
                            <select name="file_type" class="form-control">
                                <option value=""><?php echo get_phrase('select_file_type'); ?></option>
                                <option value="image"><?php echo get_phrase('image'); ?></option>
                                <option value="doc"><?php echo get_phrase('doc'); ?></option>
                                <option value="pdf"><?php echo get_phrase('pdf'); ?></option>
                                <option value="excel"><?php echo get_phrase('excel'); ?></option>
                                <option value="other"><?php echo get_phrase('other'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
