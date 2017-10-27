<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

	function account_opening_email($account_type = '' , $email = '', $name = '', $lastName = '', $password = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;

		$email_msg		=	"Hola, ".$name." ".$lastName."<br />";
		$email_msg    .= "En ".$system_name." Queremos felicitarte por tomar los primeros pasos en conseguir los conocimientos que te ayudaran a triunfar. <br />";
		$email_msg		.=	"Perfil de Usuario: ".$account_type."<br />";
		$email_msg		.=	"Estos son tus datos de ingreso: <br />";
		$email_msg		.=	"Nombre de Usuario : ".$email."<br />";
		$email_msg		.=	"Contraseña  : ".$password."<br /><br /><br />";
		$email_msg		.=	"Para comenzar a cursar en ".$system_name. ", ingresa aquí:  ".base_url()."<br />";

		$email_sub		=	"Apertura de Cuenta Por Correco Electrónico";
		$email_to		=	$email;

		$this->do_email($email_msg , $email_sub , $email_to);
	}

	function account_opening_email_teacher($account_type = '' , $email = '', $name = '', $password = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;

		$email_msg		=	"Hola, ".$name."<br />";
		$email_msg    .= "En ".$system_name.", queremos darte la bienvenida y felicitarte por hacer parte de nuestra institución . <br />";
		$email_msg    .= "a continuación te presentamos los datos de acceso al portal de educación virtual  ".$system_name."<br />";
		$email_msg		.=	"Perfil de Usuario: ".$account_type."<br />";
		$email_msg		.=	"Estos son tus datos de ingreso: <br />";
		$email_msg		.=	"Nombre de Usuario : ".$email."<br />";
		$email_msg		.=	"Contraseña  : ".$password."<br /><br /><br />";
		$email_msg		.=	"Pulsa en el siguiente link para entrar a la plataforma ".$system_name. ", ingresa aquí:  ".base_url()."<br />";

		$email_sub		=	"Apertura de Cuenta Por Correco Electrónico";
		$email_to		=	$email;

		$this->do_email($email_msg , $email_sub , $email_to);
	}

	function account_opening_email_parent($account_type = '' , $email = '', $name = '', $password = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;

		$email_msg		=	"Hola, ".$name."<br />";
		$email_msg    .= "En ".$system_name.", queremos darte la bienvenida y felicitarte por hacer parte de nuestra institución . <br />";
		$email_msg    .= "a continuación te presentamos los datos de acceso al portal de educación virtual  ".$system_name."<br /><br />";
		$email_msg		.=	"Perfil de Usuario: Acudiente <br />";
		$email_msg		.=	"Estos son tus datos de ingreso: <br /> ";
		$email_msg		.=	"Nombre de Usuario : ".$email."<br />";
		$email_msg		.=	"Contraseña  : ".$password."<br /><br /><br />";
		$email_msg		.=	"Pulsa en el siguiente link para entrar a la plataforma ".$system_name. ", ingresa aquí:  ".base_url()."<br />";

		$email_sub		=	"Apertura de Cuenta Por Correco Electrónico";
		$email_to		=	$email;

		$this->do_email($email_msg , $email_sub , $email_to);
	}

	function password_reset_email($new_password = '' , $account_type = '' , $email = '')
	{
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{

			$email_msg	=	"Su tipo de usuario es : ".$account_type."<br />";
			$email_msg	.=	"Su Contraseña es : ".$new_password."<br />";

			$email_sub	=	"Recuperar Clave";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{
			return false;
		}
	}

	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{

		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //change this
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'ralvarezloud@gmail.com'; //change this
		$config['smtp_pass'] = 'Elguru47198@'; //change this
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;

		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);

		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center></center>";
		$this->email->message($msg);

		$this->email->send();

		//echo $this->email->print_debugger();
	}
}
