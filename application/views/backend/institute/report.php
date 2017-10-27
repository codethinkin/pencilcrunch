<?php $Idint=  $this->session->userdata('institute_id'); ?>
<div class="row">
	<div class="col-md-8">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            INFORMES Y ESTADISTICAS
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
<div class="row">
<div class="col-md-6">
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/desplaza1.png') ?> " alt="Card image cap" width="80" height="60">
    <div class="card-body">
      <h4 class="card-title" >DESPLAZAMIENTO</h4>
      <p class="card-text">Cantidad de Alumnos y/o Acudientesvictima del desplazamiento forzado</p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>
<hr>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/sisben.jpg') ?> " alt="Card image cap" width="80" height="60">
    <div class="card-body">
      <h4 class="card-title">NIVEL SISBEN</h4>
      <p class="card-text">Cantidad de Alumnos según el nivel del SISBEN</p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>
<hr>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/edades.png') ?> " alt="Card image cap" width="80" height="60">
    <div class="card-body">
      <h4 class="card-title">EDADES</h4>
      <p class="card-text">Cantidad de Alumnos según su edad</p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>


</div>

<div class="col-md-6">
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/desplaza.jpg') ?> " alt="Card image cap" width="80" height="80">
    <div class="card-body">
      <h4 class="card-title">RESTAURANTES ESCOLAR</h4>
      <p class="card-text">Informe de participación de Alumnos en el restaurante </p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>
<hr>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/genero.png') ?> " alt="Card image cap" width="80" height="60">
    <div class="card-body">
      <h4 class="card-title">GENEROS</h4>
      <p class="card-text">Cantidad de Alumnos según su genero</p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>
<hr>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo base_url('assets/images/estadisticas/grados.jpg') ?> " alt="Card image cap" width="80" height="60">
    <div class="card-body">
      <h4 class="card-title">GRADOS</h4>
      <p class="card-text">Cantidad de Alumnos según grado en curso</p>
      <a href="#" class="btn btn-primary">Ver Informe</a>
    </div>
  </div>


</div>

</div>






                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">

                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->where('institute', $Idint)->count_all_results('student');?>"
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total Estudiantes Activos</p>
                </div>

            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->where('institute', $Idint)->count_all_results('teacher');?>"
                    		data-postfix="" data-duration="800" data-delay="0">0</div>

                    <h3><?php echo get_phrase('teacher');?></h3>
                   <p>Total Profesores</p>
                </div>

            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-aqua" >
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->where('institute', $Idint)->count_all_results('parent');?>"
                    		data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h4><?php echo get_phrase('parent');?></h4>
                   <p>Total Acudientes</p>
                </div>

            </div>

						<div class="col-md-12">

								<div class="tile-stats tile-blue">
										<div class="icon"><i class="entypo-chart-bar"></i></div>
										<div class="num" data-start="0" data-end="<?php echo $this->db->where('institute', $Idint)->count_all_results('sede');?>"
												data-postfix="" data-duration="500" data-delay="0">0</div>

										<h3><?php echo get_phrase('institute');?></h3>
									 <p>Total Sedes Educativas</p>
								</div>

						</div>



</div>
