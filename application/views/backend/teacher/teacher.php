
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                              <th><div><?php echo get_phrase('profession');?></div></th>
                            <th><div><?php echo get_phrase('sede');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idInstitute = 5;
		                    $idTeacher = $this->session->userdata('teacher_id');
                      /*  $this->db->select('t.teacher_id, t.name, t.email, t.phone, s.name_institute As sede, t.institute, i.id ');
                        $this->db->from('teacher t');
                        $this->db->join('sede s', 's.id = t.sede');
                        $this->db->join('institute i', 'i.id = t.institute');
                        $this->db->where_in('t.institute', 5);
                        $teachers = $this->db->get()->result_array();
*/

$this->db->select('i.id');
$this->db->from('teacher t');
$this->db->join('institute i', 'i.id = t.institute');
$this->db->where('t.teacher_id', $idTeacher);
$sub_query = $this->db->get_compiled_select();



$this->db->select('t.teacher_id, t.name, t.email, t.phone, s.name_institute As sede, t.profession');
$this->db->from('teacher t');
$this->db->join('sede s', 's.id = t.sede', 'left');
$this->db->join('institute i', 'i.id = t.institute', 'left');
$this->db->where("t.institute = ($sub_query)");
$query = $this->db->get()->result_array();



                              //  $teachers	=	$this->db->get('teacher' )->result_array();
                                foreach($query as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['profession'];?></td>

                            <td><?php echo $row['sede'];?></td>

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
