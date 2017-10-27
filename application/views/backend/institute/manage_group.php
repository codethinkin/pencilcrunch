
<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('score_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_group');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>

		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>

												<th><div><?php echo get_phrase('period');?></div></th>
                        <th><div><?php echo get_phrase('name');?></div></th>

                        <th><div><?php echo get_phrase('class');?></div></th>
                        <th><div><?php echo get_phrase('teacher');?></div></th>
                        <th><div><?php echo get_phrase('student');?></div></th>
                        <th><div><?php echo get_phrase('description');?></div></th>
            -

                      		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
											$count = 1;
											$this->db->select('g.id, g.name, g.description,
                      p.name As periodname, CONCAT((s.name)," ", (s.lastName)) As student,
                      g.institute, c.name As course, t.name As teacher, g.description');
											$this->db->from('group_class g');
                      $this->db->join('period p', 'p.id = g.period');
                      $this->db->join('student s', 's.student_id = g.student');
                      $this->db->join('class c', 'c.class_id = g.class');
                      $this->db->join('teacher t', 't.teacher_id = g.teacher_id');
											$this->db->where('g.institute', $Idint);
												$clas = $this->db->get()->result_array();
											foreach($clas as $row):
																								?>

                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['periodname'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['course'];?></td>
                            <td><?php echo $row['teacher'];?></td>
                            <td><?php echo $row['student'];?></td>
                            <td><?php echo $row['description'];?></td>


																					<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <?php echo get_phrase('acction'); ?> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_score/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>institute/manage_score/delete/<?php echo $row['id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'institute/manage_score/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
									<input type="hidden" name="institute" value="<?php echo $Idint; ?> ">
                        <div class="padded">



                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('period');?></label>
                              <div class="col-sm-5">
                                  <select name="period" class="form-control" style="width:100%;">
                          					<option value="">Seleccione</option>
                                    <?php
                          $grade= $this->db->get_where('period', array('institute'=> $Idint) )->result_array();
                          foreach($grade as $row):
                          ?>

                                      <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                      <?php
                          endforeach;
                          ?>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="name"/>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                              <div class="col-sm-5">
                                  <select name="student_id" class="form-control" style="width:100%;">
                                    <option value="">Seleccione</option>
                                    <?php
                          $grade= $this->db->get_where('student', array('institute'=> $Idint) )->result_array();
                          foreach($grade as $row):
                          ?>

                                      <option value="<?php echo $row['student_id'];?>"><?php echo $row['name']." ".$row['lastName'] ;?></option>
                                      <?php
                          endforeach;
                          ?>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('grade');?></label>
                              <div class="col-sm-5">
                                  <select name="courses" class="form-control" style="width:100%;">
                                    <option value="">Seleccione</option>
                                    <?php
                          $grade= $this->db->get_where('courses', array('institute'=> $Idint) )->result_array();
                          foreach($grade as $row):
                          ?>

                                      <option value="<?php echo $row['id'];?>"><?php echo $row['description'];?></option>
                                      <?php
                          endforeach;
                          ?>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                              <div class="col-sm-5">
                                  <select name="class" class="form-control" style="width:100%;">
                                    <option value="">Seleccione</option>
                                    <?php
                          $grade= $this->db->get_where('class', array('institute'=> $Idint) )->result_array();
                          foreach($grade as $row):
                          ?>

                                      <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                      <?php
                          endforeach;
                          ?>
                                  </select>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="description"/>
                              </div>
                          </div>





                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_group');?></button>
                              </div>
							</div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{


		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>
