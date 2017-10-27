
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
					<?php echo get_phrase('add_score');?>
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
                      <th><div><?php echo get_phrase('student');?></div></th>
                        <th><div><?php echo get_phrase('grade');?></div></th>
                        <th><div><?php echo get_phrase('class');?></div></th>

												<th>1</th>
												<th>2</th>
												<th>3</th>
												<th>4</th>
<th><div>Def</div></th>
<th><div>1</div></th>
<th><div>2</div></th>
<th><div>3</div></th>
<th><div>4</div></th>
<th><div>Def</div></th>
<th><div>1</div></th>
<th><div>2</div></th>
<th><div>3</div></th>
<th><div>4</div></th>
<th><div>Def</div></th>
<th><div>1</div></th>
<th><div>2</div></th>
<th><div>3</div></th>
<th><div>4</div></th>
<th><div>Def</div></th>

												<th><div>NC</div></th>
                        <th><div>ND</div></th>

                      		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
											$count = 1;
											$this->db->select('s.id, s.nota1, s.nota2, s.nota3,
                      s.nota4,s.nota21, s.nota22, s.nota23,
                      s.nota24,s.nota31, s.nota32, s.nota33,
                      s.nota34,s.nota41, s.nota42, s.nota43,
                      s.nota44, s.notaprome,s.nota2prome,s.nota3prome, s.nota44prome, s.nota_cualitativa,
										  SUM((s.nota1+s.nota2+s.nota3+s.nota4)/4)As notaprome,
                      SUM((s.nota21+s.nota22+s.nota23+s.nota24)/4)As nota2prome,
                      SUM((s.nota31+s.nota32+s.nota33+s.nota34)/4)As nota3prome,
                      SUM((s.nota41+s.nota42+s.nota43+s.nota44)/4)As nota44prome,

                      p.name As periodname, CONCAT((t.name)," ", (t.lastName)) As student,
                      s.institute, c.description, m.name As asigna');
											$this->db->from('score s');
                      $this->db->join('period p', 'p.id = s.period');
                      $this->db->join('student t', 't.student_id = s.student');
                      $this->db->join('courses c', 'c.id = s.courses');
                      $this->db->join('class m', 'm.class_id = s.class');
											$this->db->where('s.institute', $Idint);
											$this->db->group_by('student');
											$clas = $this->db->get()->result_array();
											foreach($clas as $row):
$uno =   $row['notaprome'];
$dos =   $row['nota2prome'];
$tres =   $row['nota3prome'];
$cuatro =   $row['nota44prome'];
$prome = ($uno+$dos+$tres+$cuatro)/4;
																								?>

                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['periodname'];?></td>
                            <td><?php echo $row['student'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['asigna'];?></td>
														<td><?php echo $row['nota1'];?></td>
                            <td><?php echo $row['nota2'];?></td>
                            <td><?php echo $row['nota3'];?></td>
                            <td><?php echo $row['nota4'];?></td>
														<td><?php echo $row['notaprome'];?></td>
														<td><?php echo $row['nota21'];?></td>
														<td><?php echo $row['nota22'];?></td>
														<td><?php echo $row['nota23'];?></td>
														<td><?php echo $row['nota24'];?></td>
														<td><?php echo $row['nota2prome'];?></td>
														<td><?php echo $row['nota31'];?></td>
														<td><?php echo $row['nota32'];?></td>
														<td><?php echo $row['nota33'];?></td>
														<td><?php echo $row['nota34'];?></td>
														<td><?php echo $row['nota3prome'];?></td>
														<td><?php echo $row['nota41'];?></td>
														<td><?php echo $row['nota42'];?></td>
														<td><?php echo $row['nota43'];?></td>
														<td><?php echo $row['nota44'];?></td>
														<td><?php echo $row['nota44prome'];?></td>
														<td><?php echo round($row['nota_cualitativa'],1);?></td>
                            <td><?php echo $prome;?></td>

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
															<label class="col-sm-3 control-label"><?php echo get_phrase('nota1');?></label>
															<div class="col-sm-5">
																	<input type="text" class="form-control" name="nota1"/>
															</div>
													</div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('nota2');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="nota2"/>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('nota3');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="nota3"/>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('nota4');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="nota4"/>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo get_phrase('nota_cualitativa');?></label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="nota_cualitativa"/>
                              </div>
                          </div>



                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_score');?></button>
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
