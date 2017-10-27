<?php $idTeacher=  $this->session->userdata('teacher_id'); ?>

<?php
$this->db->select('i.name_institute, i.id, t.teacher_id');
$this->db->from('teacher t');
$this->db->join('institute i', 'i.id = t.institute');
$this->db->where('t.teacher_id', $idTeacher);
$institute = $this->db->get()->result();
foreach ($institute  as $row)
{
		$inst =  $row->id;
    $tea = $row->teacher_id;

}

 ?>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
													<th><div><?php echo get_phrase('period');?></div></th>
													<th><div><?php echo get_phrase('curses');?></div></th>
													<th><div><?php echo get_phrase('class');?></div></th>
                          <th><div><?php echo get_phrase('name');?></div></th>
                          <th><div><?php echo get_phrase('email');?></div></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idInstitute = $inst;
		                    $idTeacher = $this->session->userdata('teacher_id');
                        $this->db->select('c.id, s.name As student, s.email, c.teacher, p.name As period,  r.description As courses,  l.name As class ');
                        $this->db->from('course_class c');
                        $this->db->join('student s', 's.student_id = c.student');
                        $this->db->join('period  p', 'p.id = c.period');
                        $this->db->join('class  l', 'l.class_id = c.class');
												$this->db->join('courses  r', 'r.id = c.courses');
                        $this->db->where_in('c.teacher', $tea);
                        $teachers = $this->db->get()->result_array();





                              //  $teachers	=	$this->db->get('teacher' )->result_array();
                                foreach($teachers  as $row):?>
                        <tr>
  													<td><?php echo $row['period'];?></td>
														<td><?php echo $row['courses'];?></td>
														<td><?php echo $row['class'];?></td>
                            <td><?php echo $row['student'];?></td>
                            <td><?php echo $row['email'];?></td>


                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



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
