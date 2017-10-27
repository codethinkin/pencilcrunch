<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }


function sendmail()
{
  echo "Enviar Pagina de Prueba";
    $this->load->library('email'); // load email library
    $this->email->from('ralvarezloud@gmail.com', 'appvirtualschool');
    $this->email->to('sistemas@cargar.com.co');
    $this->email->cc('robinson.alvarez@enfoco.com.co');
    $this->email->subject('Prueba Correo');
    $this->email->message('Esto es un mensaje de prueba');
    //$this->email->attach('/path/to/file1.png'); // attach file
    //$this->email->attach('/path/to/file2.pdf');
    if ($this->email->send())
        echo "Mail Sent!";
    else
        echo "There is error in sending mail!";
}


}
