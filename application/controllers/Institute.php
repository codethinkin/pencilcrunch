<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Institute extends CI_Controller{

	public function __construct(){
		parent::__construct();

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /***default function, redirects to login page if no institute logged in yet***/
    public function index() {
        redirect( site_url( 'institute/dashboard' ), 'refresh');
    }



    /***institute DASHBOARD***/
    function dashboard() {
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('institute_dashboard');
        $this->load->view('backend/index', $page_data);
    }


    /****MANAGE STUDENTS CLASSWISE*****/
	function student_add() {

		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}

	function student_bulk_add($param1 = '')
	{

		if ($param1 == 'import_excel')
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx');
			// Importing excel sheet for bulk student uploads

			include 'simplexlsx.class.php';

			$xlsx = new SimpleXLSX('uploads/student_import.xlsx');

			list($num_cols, $num_rows) = $xlsx->dimension();
			$f = 0;
			foreach( $xlsx->rows() as $r )
			{
				// Ignore the inital name row of excel file
				if ($f == 0)
				{
					$f++;
					continue;
				}
				for( $i=0; $i < $num_cols; $i++ )
				{
					if ($i == 0)	    $data['name']			=	$r[$i];
					else if ($i == 1)	$data['birthday']		=	$r[$i];
					else if ($i == 2)	$data['sex']		    =	$r[$i];
					else if ($i == 3)	$data['address']		=	$r[$i];
					else if ($i == 4)	$data['phone']			=	$r[$i];
					else if ($i == 5)	$data['email']			=	$r[$i];
					else if ($i == 6)	$data['password']		=	$r[$i];
					else if ($i == 7)	$data['roll']			=	$r[$i];
				}
				$data['class_id']	=	$this->input->post('class_id');

				$this->db->insert('student' , $data);
				//print_r($data);
			}
			redirect(base_url() . 'institute/student_information/' . $this->input->post('class_id'), 'refresh');
		}
		$page_data['page_name']  = 'student_bulk_add';
		$page_data['page_title'] = get_phrase('add_bulk_student');
		$this->load->view('backend/index', $page_data);
	}

	function student_information($class_id = '')
	{
		if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}

	function student_list()
	{
		if ($this->session->userdata('institute_login') != 1)
						redirect('login', 'refresh');

		$page_data['page_name']  	= 'student_list';
		$page_data['page_title'] 	= get_phrase('student_list');
		$this->load->view('backend/index', $page_data);
	}

	function student_marksheet($class_id = '')
	{
		if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

		$page_data['page_name']  = 'student_marksheet';
		$page_data['page_title'] 	= get_phrase('student_marksheet'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}

    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
					  $data['institute']       = $this->input->post('institute');
						$data['sede']       = $this->input->post('sede');
            $data['name']       = $this->input->post('name');
						$data['lastName']       = $this->input->post('lastName');
            $data['birthday']   = $this->input->post('birthday');
            $data['sex']        = $this->input->post('sex');
            $data['address']    = $this->input->post('address');
            $data['phone']      = $this->input->post('phone');
            $data['birth_place']      = $this->input->post('birthplace');
            $data['email']      = $this->input->post('email');
            $data['password']   = $this->input->post('password');
            $data['typeIdentify']   = $this->input->post('typeIdentify');
						$data['numberIdentify']   = $this->input->post('numberIdentify');
						$data['typeRh']   = $this->input->post('typeRh');
						$data['nivel']   = $this->input->post('level');
						$data['carnet']   = $this->input->post('carnet');
						$data['estrato']   = $this->input->post('estracto');
						$data['etnia']   = $this->input->post('etnia');
						$data['eps']   = $this->input->post('eps');
						$data['ips']   = $this->input->post('ips');
						$data['ars']   = $this->input->post('ars');
$data['disability']   = $this->input->post('disability');
$data['religion']   = $this->input->post('religion');
$data['school_restaurant']   = $this->input->post('school_restaurant');
$data['displaced']   = $this->input->post('displaced');
$data['indigenous_community']   = $this->input->post('indigenous_community');

            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
          //  $data['parent_id']  = $this->input->post('parent_id');
          //  $data['roll']       = $this->input->post('roll');
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
          $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'institute/student_add/', 'refresh');
        }
        if ($param2 == 'do_update') {
					$data['institute']       = $this->input->post('institute');
					$data['sede']       = $this->input->post('sede');
					$data['name']       = $this->input->post('name');
					$data['lastName']       = $this->input->post('lastName');
					$data['birthday']   = $this->input->post('birthday');
					$data['sex']        = $this->input->post('sex');
					$data['address']    = $this->input->post('address');
					$data['phone']      = $this->input->post('phone');
					$data['email']      = $this->input->post('email');
					$data['password']   = $this->input->post('password');
          $data['birth_place']      = $this->input->post('birthplace');
					$data['typeIdentify']   = $this->input->post('typeIdentify');
					$data['numberIdentify']   = $this->input->post('numberIdentify');
					$data['typeRh']   = $this->input->post('typeRh');
					$data['nivel']   = $this->input->post('level');
					$data['carnet']   = $this->input->post('carnet');
					$data['estrato']   = $this->input->post('estracto');
					$data['etnia']   = $this->input->post('etnia');
					$data['eps']   = $this->input->post('eps');
					$data['ips']   = $this->input->post('ips');
					$data['ars']   = $this->input->post('ars');
					$data['disability']   = $this->input->post('disability');
					$data['religion']   = $this->input->post('religion');
					$data['school_restaurant']   = $this->input->post('school_restaurant');
					$data['displaced']   = $this->input->post('displaced');
					$data['indigenous_community']   = $this->input->post('indigenous_community');

            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/student_information/' . $param1, 'refresh');
        }

        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/student_information/' . $param1, 'refresh');
        }
    }
     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
			$estado = "a";
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
					 $data['institute']        	= $this->input->post('institute');
					  $data['student']        	= $this->input->post('student');
						$data['tipeParent']       = $this->input->post('tipeParent');
            $data['name']        			= $this->input->post('name');
            $data['email']       			= $this->input->post('email');
            $data['password']    			= $this->input->post('password');
            $data['phone']       			= $this->input->post('phone');
            $data['level_of_schooling']       			= $this->input->post('level_of_schooling');
						$data['movil']            = $this->input->post('movil');
            $data['address']     			= $this->input->post('address');
            $data['profession']  			= $this->input->post('profession');
						$data['state']  			    = $estado;
            $this->db->insert('parent', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email_parent('parent', $data['email'],$data['name'], $data['password']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'institute/parent/', 'refresh');
        }
        if ($param1 == 'edit') {
						 $data['institute']        			= $this->input->post('institute');
					$data['student']        			= $this->input->post('student');
						$data['tipeParent']        			= $this->input->post('tipeParent');
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
						$data['password']    			= $this->input->post('password');
            $data['phone']                  = $this->input->post('phone');
						$data['movil']                  = $this->input->post('movil');
            $data['address']                = $this->input->post('address');
            $data['level_of_schooling']       			= $this->input->post('level_of_schooling');
            $data['profession']             = $this->input->post('profession');
						$data['state']  			    			= $this->input->post('state');
            $this->db->where('parent_id' , $param2);
            $this->db->update('parent' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/parent/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }


		/****MANAGE INSITUTES*****/
		function institute($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['name_institute']       	 						= $this->input->post('name_institute');
						$data['nit']         							= $this->input->post('nit');
						$data['code']        							= $this->input->post('code');
						$data['address']     							= $this->input->post('address');
						$data['phone1']       						= $this->input->post('phone1');
						$data['phone2']       						= $this->input->post('phone2');
						$data['email']       							= $this->input->post('email');
						$data['password']    							= $this->input->post('password');
						$data['url']    									= $this->input->post('url');
						$data['observation']    					= $this->input->post('observation');
						$data['type_institute']    		= $this->input->post('type_institute');
						$data['character']    					= $this->input->post('character');
						$data['zone_ee']    						= $this->input->post('zone_ee');
						$data['calendar_institute']    = $this->input->post('calendar_institute');
						$data['sector']    						= $this->input->post('sector');
						$data['gender_institute']    	= $this->input->post('gender_institute');


						$this->db->insert('institute', $data);
						$institute_id = $this->db->insert_id();
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/institute_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/institute/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['name_institute']       	 						= $this->input->post('name_institute');
					$data['nit']         							= $this->input->post('nit');
					$data['code']        							= $this->input->post('code');
					$data['address']     							= $this->input->post('address');
					$data['phone1']       						= $this->input->post('phone1');
					$data['phone2']       						= $this->input->post('phone2');
					$data['email']       							= $this->input->post('email');
					$data['password']    							= $this->input->post('password');
					$data['url']    									= $this->input->post('url');
					$data['observation']    					= $this->input->post('observation');
					$data['type_institute']    		= $this->input->post('type_institute');
					$data['character']    					= $this->input->post('character');
					$data['zone_ee']    						= $this->input->post('zone_ee');
					$data['calendar_institute']    = $this->input->post('calendar_institute');
					$data['sector']    						= $this->input->post('sector');
					$data['gender_institute']    	= $this->input->post('gender_institute');

						$this->db->where('id', $param2);
						$this->db->update('institute', $data);
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/institute_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/institute/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('institute', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('institute');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/institute/', 'refresh');
				}
				$page_data['institute']   = $this->db->get('institute')->result_array();
				$page_data['page_name']  = 'institute';
				$page_data['page_title'] = get_phrase('manage_institute');
				$this->load->view('backend/index', $page_data);
		}


		/****MANAGE goups*****/
		function manage_group($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['period']       	 						= $this->input->post('period');
						$data['teacher_id']         							= $this->input->post('teacher_id');
						$data['student']        							= $this->input->post('student');
						$data['courses']     							= $this->input->post('courses');
						$data['institute']       						= $this->input->post('institute');
						$data['name']       						= $this->input->post('name');
						$data['description']       							= $this->input->post('description');

						$this->db->insert('group_class', $data);
						$institute_id = $this->db->insert_id();
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/institute_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_group/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['period']       	 						= $this->input->post('period');
					$data['teacher_id']         							= $this->input->post('teacher_id');
					$data['student']        							= $this->input->post('student');
					$data['courses']     							= $this->input->post('courses');
					$data['institute']       						= $this->input->post('institute');
					$data['name']       						= $this->input->post('name');
					$data['description']       							= $this->input->post('description');

						$this->db->where('id', $param2);
						$this->db->update('group_class', $data);
						move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/institute_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/manage_group/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('institute', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('group_class');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/manage_group/', 'refresh');
				}
				$page_data['manage_group']   = $this->db->get('institute')->result_array();
				$page_data['page_name']  = 'manage_group';
				$page_data['page_title'] = get_phrase('manage_group');
				$this->load->view('backend/index', $page_data);
		}



				/****MANAGE SEDES*****/
				function sede($param1 = '', $param2 = '', $param3 = '')
				{
						if ($param1 == 'create') {
								$data['name_institute']       	 	= $this->input->post('name_institute');
								$data['institute']       	 				= $this->input->post('institute');
								$data['nit']         							= $this->input->post('nit');
								$data['code']        							= $this->input->post('code');
								$data['address']     							= $this->input->post('address');
								$data['phone1']       						= $this->input->post('phone1');
								$data['phone2']       						= $this->input->post('phone2');
								$data['email']       							= $this->input->post('email');
								$data['password']    							= $this->input->post('password');
								$data['url']    									= $this->input->post('url');
								$data['observation']    					= $this->input->post('observation');
								$data['type_institute']    		= $this->input->post('type_institute');
								$data['character']    					= $this->input->post('character');
								$data['zone_ee']    						= $this->input->post('zone_ee');
								$data['calendar_institute']    = $this->input->post('calendar_institute');
								$data['sector']    						= $this->input->post('sector');
								$data['gender_institute']    	= $this->input->post('gender_institute');


								$this->db->insert('sede', $data);
								$institute_id = $this->db->insert_id();
								move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
								$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
								//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
								redirect(base_url() . 'institute/sede/', 'refresh');
						}
						if ($param1 == 'do_update') {
							$data['name_institute']       	 	= $this->input->post('name_institute');
							$data['institute']       	 				= $this->input->post('institute');
							$data['nit']         							= $this->input->post('nit');
							$data['code']        							= $this->input->post('code');
							$data['address']     							= $this->input->post('address');
							$data['phone1']       						= $this->input->post('phone1');
							$data['phone2']       						= $this->input->post('phone2');
							$data['email']       							= $this->input->post('email');
							$data['password']    							= $this->input->post('password');
							$data['url']    									= $this->input->post('url');
							$data['observation']    					= $this->input->post('observation');
							$data['type_institute']    		= $this->input->post('type_institute');
							$data['character']    					= $this->input->post('character');
							$data['zone_ee']    						= $this->input->post('zone_ee');
							$data['calendar_institute']    = $this->input->post('calendar_institute');
							$data['sector']    						= $this->input->post('sector');
							$data['gender_institute']    	= $this->input->post('gender_institute');

								$this->db->where('id', $param2);
								$this->db->update('sede', $data);
								move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
								$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
								redirect(base_url() . 'institute/sede/', 'refresh');
						} else if ($param1 == 'edit') {
								$page_data['edit_data'] = $this->db->get_where('sede', array(
										'id' => $param2
								))->result_array();
						}
						if ($param1 == 'delete') {
								$this->db->where('id', $param2);
								$this->db->delete('sede');
								$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
								redirect(base_url() . 'institute/sede/', 'refresh');
						}
						$page_data['institute']   = $this->db->get('sede')->result_array();
						$page_data['page_name']  = 'sede';
						$page_data['page_title'] = get_phrase('manage_sede');
						$this->load->view('backend/index', $page_data);
				}



    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
					  $data['institute']        = $this->input->post('institute');
            $data['name']        = $this->input->post('name');
          //  $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
						$data['movi']       = $this->input->post('movil');
            $data['email']       = $this->input->post('email');
            $data['scale']       = $this->input->post('scale');
            $data['position']       = $this->input->post('position');
            $data['password']    = $this->input->post('password');
						$data['profession']    = $this->input->post('profession');
						$data['movi']    = $this->input->post('movi');
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email_teacher('teacher', $data['email'], $data['name'], $data['password']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'institute/teacher/', 'refresh');
        }
        if ($param1 == 'do_update') {
					 $data['institute']        = $this->input->post('institute');
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['scale']       = $this->input->post('scale');
            $data['position']       = $this->input->post('position');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
						$data['profession']  = $this->input->post('profession');
						$data['movi']        = $this->input->post('movi');
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/subject/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/subject/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/subject/'.$param3, 'refresh');
        }
		 $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($param1 == 'create') {
					  $data['institute']         = $this->input->post('institute');
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
						$data['schedule']   = $this->input->post('schedule');
            $this->db->insert('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
					  $data['institute']       = $this->input->post('institute');
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
							$data['schedule']   = $this->input->post('schedule');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }



		/****MANAGE sectionCurse*****/
		function sectionCurse($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['nameSection']       	 				= $this->input->post('nameSection');
						$data['institute']         = $this->input->post('institute');
						$data['comment']         = $this->input->post('comment');
						$this->db->insert('sectionCurse', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/sectionCurse/', 'refresh');
				}
				if ($param1 == 'do_update') {
							$data['nameSection']       	 				= $this->input->post('nameSection');
							$data['institute']         = $this->input->post('institute');
							$data['comment']         = $this->input->post('comment');
						$this->db->where('id', $param2);
						$this->db->update('sectionCurse', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/sectionCurse/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('sectionCurse', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('sectionCurse');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/sectionCurse/', 'refresh');
				}
				$page_data['sectionCurse']   = $this->db->get('sectionCurse')->result_array();
				$page_data['page_name']  = 'manage_section_curse';
				$page_data['page_title'] = get_phrase('manage_section_curse');
				$this->load->view('backend/index', $page_data);
		}


		/****MANAGE folio_settings*****/
		function folio_settings($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['folioNumber']       	 				= $this->input->post('folioNumber');
						$data['institute']         = $this->input->post('institute');

						$this->db->insert('folio', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/folio_settings/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['folioNumber']       	 				= $this->input->post('folioNumber');
					$data['institute']         = $this->input->post('institute');

						$this->db->where('id', $param2);
						$this->db->update('folio', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/folio_settings/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('folio', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('folio');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/folio_settings/', 'refresh');
				}
				$page_data['sectionCurse']   = $this->db->get('folio')->result_array();
				$page_data['page_name']  = 'folio_settings';
				$page_data['page_title'] = get_phrase('folio_settings');
				$this->load->view('backend/index', $page_data);
		}


		/****MANAGE folio_settings*****/
		function libro_settings($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['libroNumber']       	 				= $this->input->post('libroNumber');
						$data['institute']         = $this->input->post('institute');

						$this->db->insert('libro', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/libro_settings/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['libroNumber']       	 				= $this->input->post('libroNumber');
					$data['institute']         = $this->input->post('institute');

						$this->db->where('id', $param2);
						$this->db->update('libro', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/libro_settings/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('libro', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('libro');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/libro_settings/', 'refresh');
				}
				$page_data['libro_settings']   = $this->db->get('libro')->result_array();
				$page_data['page_name']  = 'libro_settings';
				$page_data['page_title'] = get_phrase('libro_settings');
				$this->load->view('backend/index', $page_data);
		}



				/****MANAGE PERIOD*****/
				function period($param1 = '', $param2 = '', $param3 = '')
				{
						$active = "Activo";
						if ($param1 == 'create') {
								$data['start_period']       = $this->input->post('start_period');
								$data['end_period']         = $this->input->post('end_period');
								$data['state']              = $active;
								$data['name']               = $this->input->post('name');
								$data['institute']               = $this->input->post('institute');

								$this->db->insert('period', $data);
								$institute_id = $this->db->insert_id();
								//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
								$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
								//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
								redirect(base_url() . 'institute/period/', 'refresh');
						}
						if ($param1 == 'do_update') {
							$data['start_period']       = $this->input->post('start_period');
							$data['end_period']         = $this->input->post('end_period');
							$data['state']              = $this->input->post('state');
							$data['name']               = $this->input->post('name');
								$data['institute']               = $this->input->post('institute');

								$this->db->where('id', $param2);
								$this->db->update('libro', $data);
								//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
								$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
								redirect(base_url() . 'institute/period/', 'refresh');
						} else if ($param1 == 'edit') {
								$page_data['edit_data'] = $this->db->get_where('period', array(
										'id' => $param2
								))->result_array();
						}
						if ($param1 == 'delete') {
								$this->db->where('id', $param2);
								$this->db->delete('period');
								$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
								redirect(base_url() . 'institute/period/', 'refresh');
						}
						$page_data['period']   = $this->db->get('period')->result_array();
						$page_data['page_name']  = 'period';
						$page_data['page_title'] = get_phrase('period');
						$this->load->view('backend/index', $page_data);
				}

		/****MANAGE folio_settings*****/
		function manage_score($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['period']       	 				= $this->input->post('period');
						$data['student']       	 				= $this->input->post('student_id');
						$data['courses']       	 				= $this->input->post('courses');
						$data['class']       	 				= $this->input->post('class');
						$data['nota1']       	 				= $this->input->post('nota1');

						$data['institute']         = $this->input->post('institute');

						$this->db->insert('score', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_score/', 'refresh');
				}
				if ($param1 == 'create') {
						$data['period']       	 				= $this->input->post('period');
						$data['student']       	 				= $this->input->post('student_id');
						$data['courses']       	 				= $this->input->post('courses');
						$data['class']       	 				= $this->input->post('class');
						$data['nota1']       	 				= $this->input->post('nota1');
						$data['nota2']       	 				= $this->input->post('nota2');

						$data['institute']         = $this->input->post('institute');

						$this->db->insert('score', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_score/', 'refresh');

				}

				if ($param1 == 'create') {
						$data['period']       	 				= $this->input->post('period');
						$data['student']       	 				= $this->input->post('student_id');
						$data['courses']       	 				= $this->input->post('courses');
						$data['class']       	 				= $this->input->post('class');
						$data['nota1']       	 				= $this->input->post('nota1');
						$data['nota2']       	 				= $this->input->post('nota2');
						$data['nota3']       	 				= $this->input->post('nota3');

						$data['institute']         = $this->input->post('institute');

						$this->db->insert('score', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_score/', 'refresh');

				}

				if ($param1 == 'create') {
						$data['period']       	 				= $this->input->post('period');
						$data['student']       	 				= $this->input->post('student_id');
						$data['courses']       	 				= $this->input->post('courses');
						$data['class']       	 				= $this->input->post('class');
						$data['nota1']       	 				= $this->input->post('nota1');
						$data['nota2']       	 				= $this->input->post('nota2');
						$data['nota3']       	 				= $this->input->post('nota3');
						$data['nota4']       	 				= $this->input->post('nota4');

						$data['institute']         = $this->input->post('institute');

						$this->db->insert('score', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_score/', 'refresh');

				}

				if ($param1 == 'create') {
						$data['period']       	 				= $this->input->post('period');
						$data['student']       	 				= $this->input->post('student_id');
						$data['courses']       	 				= $this->input->post('courses');
						$data['class']       	 				= $this->input->post('class');
						$data['nota1']       	 				= $this->input->post('nota1');
						$data['nota2']       	 				= $this->input->post('nota2');
						$data['nota3']       	 				= $this->input->post('nota3');
						$data['nota4']       	 				= $this->input->post('nota4');
						$data['nota_cualitativa']       	 				= $this->input->post('nota_cualitativa');

						$data['institute']         = $this->input->post('institute');

						$this->db->insert('score', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/manage_score/', 'refresh');

				}
				if ($param1 == 'do_update') {
					$data['period']       	 				= $this->input->post('period');
					$data['student']       	 				= $this->input->post('student');
					$data['courses']       	 				= $this->input->post('courses');
					$data['class']       	 				= $this->input->post('class');
					$data['nota1']       	 				= $this->input->post('nota1');
					$data['nota2']       	 				= $this->input->post('nota2');
					$data['nota3']       	 				= $this->input->post('nota3');
					$data['nota4']       	 				= $this->input->post('nota4');
					$data['nota_cualitativa']       	 				= $this->input->post('nota_cualitativa');
					$data['institute']         = $this->input->post('institute');

						$this->db->where('id', $param2);
						$this->db->update('score', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/manage_score/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('score', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('score');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/manage_score/', 'refresh');
				}
				$page_data['manage_score']   = $this->db->get('score')->result_array();
				$page_data['page_name']  = 'manage_score';
				$page_data['page_title'] = get_phrase('manage_score');
				$this->load->view('backend/index', $page_data);
		}

		/****MANAGE Jornadas_settings*****/
		function schedule_settings($param1 = '', $param2 = '', $param3 = '')
		{
				if ($param1 == 'create') {
						$data['name']       	 				= $this->input->post('name');
						$data['institute']         = $this->input->post('institute');

						$this->db->insert('schedule', $data);
						$institute_id = $this->db->insert_id();
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/schedule_settings/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['name']       	 				= $this->input->post('name');
					$data['institute']         = $this->input->post('institute');

						$this->db->where('id', $param2);
						$this->db->update('schedule', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/schedule_settings/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('schedule', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('schedule');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/schedule_settings/', 'refresh');
				}
				$page_data['schedule_settings']   = $this->db->get('schedule')->result_array();
				$page_data['page_name']  = 'schedule_settings';
				$page_data['page_title'] = get_phrase('schedule_settings');
				$this->load->view('backend/index', $page_data);
		}



		/****MANAGE COURSES*****/
		function courses($param1 = '', $param2 = '', $param3 = '')
		{

$active = "Activo";
				if ($param1 == 'create') {

						$c = $this->input->post('grade');
						$s= $this->input->post('sectioncurse');
						$cs = $c.$s;
						$data['numberStudent']       	 				= $this->input->post('numberStudent');
						$data['grade']       	 								= $this->input->post('grade');
						$data['sectionCurse']       	 				= $this->input->post('sectioncurse');
						$data['description']       	 				  = $cs;
						$data['institute']                    = $this->input->post('institute');
            $data['classroom']                    = $this->input->post('classroom');
            $data['state']                        = $active;

						$this->db->insert('courses', $data);
						$institute_id = $this->db->insert_id();



						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $institute_id . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						//$this->email_model->account_opening_email('institute', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
						redirect(base_url() . 'institute/courses/', 'refresh');
				}
				if ($param1 == 'do_update') {
					$data['numberStudent']       	 				= $this->input->post('numberStudent');
					$data['grade']       	 								= $this->input->post('grade');
					$data['sectionCurse']       	 				= $this->input->post('sectionCurse');
					$data['description']       	 				  = $this->input->post('description');
					$data['institute']         = $this->input->post('institute');
					$data['classroom']         = $this->input->post('classroom');
						$this->db->where('id', $param2);
						$this->db->update('courses', $data);
						//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sedes_image/' . $param2 . '.jpg');
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/courses/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('sectionCurse', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('sectionCurse');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/courses/', 'refresh');
				}
				$page_data['manage_curses']   = $this->db->get('courses')->result_array();
				$page_data['page_name']  = 'manage_curses';
				$page_data['page_title'] = get_phrase('manage_curses');
				$this->load->view('backend/index', $page_data);
		}



    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
						  $data['institute']       =   $this->input->post('institute');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
						$data['grade'] =   $this->input->post('grade');
            $this->db->insert('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
						$data['institute']       =   $this->input->post('institute');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
						$data['grade'] =   $this->input->post('grade');
            $this->db->where('section_id' , $param2);
            $this->db->update('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/section' , 'refresh');
        }
    }

    function get_sede_section($id)
    {
        $sections = $this->db->get_where('sede' , array(
            'institute' => $id
        ))->result_array();
        foreach ($sections as $row) {
					  echo '<option value="">' . "Principal". '</option>';
            echo '<option value="' . $row['id'] . '">' . $row['name_institute'] . '</option>';
        }
    }

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

		function get_class_teacher($institute)
		{
				$subjects = $this->db->get_where('teacher' , array(
						'institute' => $institute
				))->result_array();
				foreach ($subjects as $row) {
						echo '<option value="' . $row['teacher_id'] . '">' . $row['name'] . '</option>';
				}
		}

    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }

		/****MANAGE ENROLLMENT*****/
		function enrollment($param1 = '', $param2 = '' , $param3 = '')
		{
				if ($param1 == 'create') {
						$data['student']    = $this->input->post('student');
						$data['schedule']    = $this->input->post('schedule');
						$data['courses'] = $this->input->post('grade');
						$data['period'] = $this->input->post('period');
						$data['institute'] = $this->input->post('institute');
						$data['folio'] = $this->input->post('folio');
						$data['libro'] = $this->input->post('libro');
						$data['state'] = $this->input->post('state');

						$this->db->insert('enrollment', $data);
						$enrollment_id = $this->db->insert_id();


						$upcupo = $this->input->post('grade');
						$inst = $this->input->post('institute');
						$sql="update courses set studentRegister= studentRegister + 1 where id='".$upcupo."' And Institute = '".$inst."'";
						$query=$this->db->query($sql);
            $dispo= $this->db->get_where('courses', array('institute'=> $inst) )->result_array();
							foreach ($dispo as $row) {
							   $cupo = $row['studentRegister'];
								 $number = $row['numberStudent'];
								 if ($cupo >= $number ) {
									$sql="update courses set state = 'Inactivo' where institute = '".$inst."' and id = '".$upcupo ."' ";
			 						$query=$this->db->query($sql);
								 }
						}
$state = "r";
						$student = $this->input->post('student');
						$inst = $this->input->post('institute');
						$sql="update student set state = '".$state."' where student_id='".$student."' And institute = '".$inst."'";
						$query=$this->db->query($sql);


						$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
						redirect(base_url() . 'institute/enrollment/', 'refresh');
				}
				if ($param1 == 'edit' && $param2 == 'do_update') {
					$data['student']    = $this->input->post('student');
					$data['schedule']    = $this->input->post('schedule');
					$data['courses'] = $this->input->post('grade');
					$data['period'] = $this->input->post('period');
					$data['institute'] = $this->input->post('institute');
					$data['folio'] = $this->input->post('folio');
					$data['libro'] = $this->input->post('libro');
					$data['state'] = $this->input->post('state');

						$this->db->where('id', $param3);
						$this->db->update('enrollment', $data);
						$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
						redirect(base_url() . 'institute/enrollment/', 'refresh');
				} else if ($param1 == 'edit') {
						$page_data['edit_data'] = $this->db->get_where('enrollment', array(
								'id' => $param2
						))->result_array();
				}
				if ($param1 == 'delete') {
						$this->db->where('id', $param2);
						$this->db->delete('enrollment');
						$this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
						redirect(base_url() . 'institute/enrollment/', 'refresh');
				}
				$page_data['enrollment']      = $this->db->get('enrollment')->result_array();
				$page_data['page_name']  = 'manage_enrollment';
				$page_data['page_title'] = get_phrase('manage_enrollment');
				$this->load->view('backend/index', $page_data);
		}

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');

            // get all the students of the selected class
            $students = $this->db->get_where('student' , array(
                'class_id' => $class_id
            ))->result_array();
            // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                    $receiver_phone = $row['phone'];
                if ($receiver == 'parent' && $row['parent_id'] != '')
                    $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;


                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $marks = $this->db->get('mark')->result_array();
                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';

                }
                // send sms
                $this->sms_model->send_sms( $message , $receiver_phone );
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
            redirect(base_url() . 'institute/exam_marks_sms' , 'refresh');
        }

        $page_data['page_name']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'institute/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'institute/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $data['mark_obtained'] = $this->input->post('mark_obtained');
            $data['comment']       = $this->input->post('comment');

            $this->db->where('mark_id', $this->input->post('mark_id'));
            $this->db->update('mark', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }


    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
			 $Idint=  $this->session->userdata('institute_id');
			        if ($param1 == 'create') {
            $data['courses']        = $this->input->post('courses');
            $data['class'] = $this->input->post('class');
  					$data['institute']     = $this->input->post('institute');
						$data['teacher']     = $this->input->post('teacher');
						$data['period']     = $this->input->post('period');
						$data['student']     = $this->input->post('student');
            $this->db->insert('course_class', $data);

						$invoice_id = $this->db->insert_id();

						$data2['courses']        = $this->input->post('courses');
            $data2['class'] = $this->input->post('class');
  					$data2['institute']     = $this->input->post('institute');
						$data2['teacher']     = $this->input->post('teacher');
						$data2['period']     = $this->input->post('period');
						$data2['student']     = $this->input->post('student');

						$this->db->insert('score', $data2);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
					$data['courses']        = $this->input->post('courses');
					$data['class'] = $this->input->post('class');
					$data['institute']     = $this->input->post('institute');
$data['teacher']     = $this->input->post('teacher');
$data['period']     = $this->input->post('period');
$data['student']     = $this->input->post('student');

            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('course_class', array(
                'id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('course_class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/grade/', 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
					$data['institute']   = $this->input->post('institute');
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['day']        = $this->input->post('day');
						$data['classroom']        = $this->input->post('classroom');
            $this->db->insert('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/class_routine/', 'refresh');
        }
        if ($param1 == 'do_update') {
					 $data['institute']   = $this->input->post('institute');
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['day']        = $this->input->post('day');
						$data['classroom']        = $this->input->post('classroom');

            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/class_routine/', 'refresh');
        }
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }

	/****** DAILY ATTENDANCE *****************/
	function manage_attendance($date='',$month='',$year='',$class_id='')
	{
		if($this->session->userdata('institute_login')!=1)redirect('login' , 'refresh');

		if($_POST)
		{
			// Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $this->input->post('date'));

                $this->db->update('attendance' , array('status' => $attendance_status));
            }

			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'institute/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id , 'refresh');
		}
        $page_data['date']     =	$date;
        $page_data['month']    =	$month;
        $page_data['year']     =	$year;
        $page_data['class_id'] =	$class_id;

        $page_data['page_name']  =	'manage_attendance';
        $page_data['page_title'] =	get_phrase('manage_daily_attendance');
		$this->load->view('backend/index', $page_data);
	}
	function attendance_selector()
	{
		redirect(base_url() . 'institute/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year').'/'.
							$this->input->post('class_id') , 'refresh');
	}
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {

        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
						$data['institute']          = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            $data2['description']       =   $this->input->post('description');
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
						$data2['timestamp']         =   strtotime($this->input->post('date'));

            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/invoice', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
            $data['description']  =   $this->input->post('description');
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $this->db->insert('payment' , $data);

            $data2['amount_paid']   =   $this->input->post('amount');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(base_url() . 'institute/invoice', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/invoice', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**********ACCOUNTING********************/
    function income($param1 = '' , $param2 = '')
    {
       if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'income';
        $page_data['page_title'] = get_phrase('incomes');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $this->db->insert('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/expense', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/expense', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/expense', 'refresh');
        }

        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('expenses');
        $this->load->view('backend/index', $page_data);
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/expense_category');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/expense_category');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/expense_category');
        }

        $page_data['page_name']  = 'expense_category';
        $page_data['page_title'] = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

						$Idint=  $this->session->userdata('institute_id');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
						$data['isbn']      = $this->input->post('isbn');
						$data['institute']      = $Idint;
            $this->db->insert('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
							$data['isbn']      = $this->input->post('isbn');
							$data['institute']      = $Idint;

            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/book', 'refresh');
        }
				$Idint=  $this->session->userdata('institute_id');
        $page_data['books']      = $this->db->get_where('book', array('institute' => $Idint))->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }

		/**********INFORMES********************/
    function report($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

						$Idint=  $this->session->userdata('institute_id');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
						$data['driver']        = $this->input->post('driver');
            $data['route_fare']        = $this->input->post('route_fare');
						$data['institute']      = $Idint;
            $this->db->insert('report', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/report', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
							$data['driver']        = $this->input->post('driver');
						$data['institute']      = $Idint;

            $this->db->where('id', $param2);
            $this->db->update('report', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/report', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('report', array(
                'id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('report');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/report', 'refresh');
        }
        $page_data['report'] = $this->db->get_where('report', array('institute' => $Idint))->result_array();
        $page_data['page_name']  = 'report';
        $page_data['page_title'] = get_phrase('report');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

						$Idint=  $this->session->userdata('institute_id');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
						$data['driver']        = $this->input->post('driver');
            $data['route_fare']        = $this->input->post('route_fare');
						$data['institute']      = $Idint;
            $this->db->insert('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/transport', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
							$data['driver']        = $this->input->post('driver');
						$data['institute']      = $Idint;

            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/transport', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/transport', 'refresh');
        }
        $page_data['transports'] = $this->db->get_where('transport', array('institute' => $Idint))->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE CLASSROOM / HOSTELS / ROOMS ********************/
    function classroom($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect('login', 'refresh');

									$Idint=  $this->session->userdata('institute_id');
        if ($param1 == 'create') {
					  $data['institute']           = $this->input->post('institute');
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->insert('classroom', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/classroom', 'refresh');
        }
        if ($param1 == 'do_update') {
					$data['institute']           = $this->input->post('institute');
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');

            $this->db->where('classroom_id', $param2);
            $this->db->update('classroom', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/classroom', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('classroom', array(
                'classroom_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('classroom_id', $param2);
            $this->db->delete('classroom');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/classroom', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get_where('classroom', array('institute' => $Idint))->result_array();
        $page_data['page_name']   = 'classroom';
        $page_data['page_title']  = get_phrase('manage_classroom');
        $this->load->view('backend/index', $page_data);

    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {

			$Idint=  $this->session->userdata('institute_id');

        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
						$data['institute']      = $Idint;
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'institute/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'institute/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get_where('noticeboard', array('institute' => $Idint))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'institute/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'institute/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'do_update') {

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'institute/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected'));
            redirect(base_url() . 'institute/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'institute/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
			redirect(base_url() . 'login', 'refresh');

		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'institute/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'institute/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'institute/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'institute/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'institute/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'institute/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'institute/backup_restore/', 'refresh');
        }

        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('institute_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name_institute']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('id', $this->session->userdata('institute_id'));
            $this->db->update('institute', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/institute_image/' . $this->session->userdata('institute_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'institute/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('institute', array(
                'institute_id' => $this->session->userdata('institute_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('institute_id', $this->session->userdata('institute_id'));
                $this->db->update('institute', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'institute/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('institute', array(
            'id' => $this->session->userdata('institute_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

}
