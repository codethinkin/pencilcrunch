<div style="margin-top:0">

<div class="row">
	<div class="col-md-12 col-sm-12 clearfix " style="text-align:center; background:#8cb5de">

		<h2 class="alto1"><?php
		$uno = $this->session->userdata('login_type');
		$idTeacher = $this->session->userdata('teacher_id');
		$idParent = $this->session->userdata('parent_id');
		$idStudent = $this->session->userdata('student_id');
		$idInstitute = $this->session->userdata('institute_id');
				switch ($uno) {
					case 'teacher':
					$this->db->select('i.name_institute, i.id');
					$this->db->from('teacher t');
					$this->db->join('institute i', 'i.id = t.institute');
					$this->db->where('t.teacher_id', $idTeacher);
					$institute = $this->db->get()->result();
					foreach ($institute  as $row)
					{
							echo $row->name_institute;
							 						}
						break;
						case 'admin':
						echo "<h2>Administrador del Sistema</h2>";
						break;

					case 'parent':
						$this->db->select('i.name_institute');
						$this->db->from('parent t');
						$this->db->join('institute i', 'i.id = t.institute');
						$this->db->where('t.parent_id', $idParent);
						$institute = $this->db->get()->result();
						foreach ($institute  as $row)
						{
								echo $row->name_institute;
							}
						break;

						case 'student':
						$this->db->select('i.name_institute, i.id');
						$this->db->from('student t');
						$this->db->join('institute i', 'i.id = t.institute');
						$this->db->where('t.student_id', $idStudent);
						$institute = $this->db->get()->result();
						foreach ($institute  as $row)
						{
								echo $row->name_institute;
							}
						break;

						case 'institute':
						$this->db->select('name_institute');
						$this->db->from('institute ');
						$this->db->where('id', $idInstitute);
						$institute = $this->db->get()->result();
						foreach ($institute  as $row)
						{
								echo $row->name_institute;
							}
						break;

					default:
						# code...
						break;
				}

																										?></h2>


  </div>
</div>
	<!-- Raw Links -->
<div class="row">


<div class="col-md-4 col-sm-4 clearfix" style="background:#303641">
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" style="color:#ffffff">
                        	<i class="entypo-user"></i> Hola, <?php echo $this->session->userdata('name');?>
                    </a>
				<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?><?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?><?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
				<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>parents/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>parents/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
			</li>
        </ul>

</ul>

</div>
<div class="col-md-4 col-sm-4 clearfix alto" style="background:#303641" >
<h4 style="font-weight:200; margin:0px; color:#ffffff" class="list-inline links-list pull-center"><?php echo $system_name;?></h4>
</div>

<div class="col-md-4 col-sm-4 clearfix alto" style="background:#303641">

		<ul class="list-inline links-list pull-right">

			<!-- Language Selector
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <i class="entypo-globe"></i> language
                    </a>

				<ul class="dropdown-menu <?php if ($text_align == 'left-to-right') echo 'pull-left'; else echo 'pull-right';?>">
					<?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $field)
                            {
                                if($field == 'phrase_id' || $field == 'phrase')continue;
                                ?>
                                    <li class="<?php if($this->session->userdata('current_language') == $field)echo 'active';?>">
                                        <a href="<?php echo base_url();?>multilanguage/select_language/<?php echo $field;?>">
                                            <img src="assets/images/flag/<?php echo $field;?>.png" style="width:16px; height:16px;" />
												 <span><?php echo $field;?></span>
                                        </a>
                                    </li>
                                <?php
                            }
                            ?>

				</ul>

			</li>
			-->
			<!--<li class="sep"></li>-->

			<li>
				<a href="<?php echo site_url('login/logout'); ?>" style="color:#ffffff">
					<?php echo get_phrase('logout'); ?> <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>

</div>
</div>
<hr style="margin-top:0px;" />
