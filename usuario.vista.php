<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD VUE.JS</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/normalize.css"> -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/font-awesome.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

</head>
<body>
	<main class="container" id="app">
		<section class="row">
			<div class="col-md-3 col-xs-12">
				<img src="https://vuejs.org/images/logo.png" alt="vue.js" class="responsive-img" height="300px">
			</div>
			<div class="col-md-6 col-xs-12" align="center" style="margin-top: 100px;">
				<h1>CRUD</h1>
				<h4>(PHP + MYSQL + BOOTSTRAP)</h4>
			</div>
			<div class="col-md-3 col-xs-12" style="margin-top: 100px;">
				<img src="https://ed.team/themes/custom/escueladigital/img/EDteam-logo.svg" alt="EDteam" class="responsive-img">
				
			</div>
		</section>
		<section>
			<div class="col-xs-12" align="center">
				<h1>Vue.js desde cero </h1>
			</div>
		<hr>
		</section>
		 <!-- <section name="fade"> -->
	      
	    <!-- </section> -->
	    <div class="loader" v-show="loading">
			<img src="cargando.gif" class="responsive-img"  width="1400px">
	    </div>
		<section id="listado">
			<div class="row">
				<div class="col-xs-10">
					<h2>Lista de estudiantes</h2>
				</div>
				<div class="col-xs-2">
					<button class="img-circle btn btn-success" width="30px;" v-on:click="mostrarForm">
						<i class="fa fa-plus-circle"></i>
					</button> 

				</div>
			</div>
			<p class="alert alert-success"  v-if="successMessage">
		        {{ successMessage }}
		        <i class="fa fa-check"></i>
		    </p>
		    <p class="alert alert-warning" v-if="errorMessage">
		        {{ errorMessage }}
		        <i class="fa fa-check"></i>
		    </p>
		<!-- </section> -->
		
		<!-- <section> -->
			<table class="table-responsive table table-striped table-bordered table-condensed table-hove">
				<thead>
					<tr>
					  <th>ID</th>
		              <th>Name</th>
		              <th>Email</th>
		              <th>Web</th>
		              <th class="">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="student in students">
						<td v-text="student.idstudent"></td>
						<td v-text="student.name"></td>
						<td v-text="student.email"></td>
						<td v-text="student.web"></td>
						<td>
							<button class="btn btn-success" v-on:click="getStudent(student)">Actualizar</button>
							<button class="btn btn-warning" data-toggle="modal" data-target="#modalDelete" v-on:click="getStudentDelete(student)">Eliminar</button>
						</td>
					</tr>
					
				</tbody>
			</table>
		</section>
		<section id="formulario">
			<div class="row">
				<div class="col-xs-12">
					<h3 align=""><b>Registrar Estudiante</b></h3>
				</div>
				<!-- <div class="col-xs-2">
					<button type="button" class="close" data-dismiss="modal" >
				      <span aria-hidden="true" >&times;</span>
					</button>
				</div> -->
			</div>
			<div class="loader" v-show="loading">
				<img src="cargando.gif" class="responsive-img"  width="1400px">
		    </div>
			<form class="" id="" v-on:submit.prevent="createStudent">
					<div class="form-group">
						<input type="hidden" name="idstudent" id="idstudent" v-model="activeStudent.idstudent">
          				<label for="name">Nombres</label>
						<input type="text" name="name" id="name" v-model="activeStudent.name" required class="form-control">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" v-model="activeStudent.email" required class="form-control">
						<label for="web">Web</label>
						<input type="text" name="web" id="web" required v-model="activeStudent.web" class="form-control">
					</div>
					<div class="col-xs-12 pull-right">
						<button type="submit" class="btn btn-primary" >Guardar</button>
						<button type="button" class="btn btn-danger" v-on:click="mostrarForm">Cancelar</button>
					</div>
				</form>
		</section>
		<div class="modal fade" id="modalDelete" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row">
							<div class="col-xs-10">
								<h3 align=""><b>Eliminar Estudiante</b></h3>
							</div>
							<div class="col-xs-2">
								<button type="button" class="close" data-dismiss="modal" >
							      <span aria-hidden="true" >&times;</span>
								</button>
							</div>
							
						</div>
						
					</div>
					<div class="modal-body">
						<form class="" id="" v-on:submit.prevent="eliminarStudent">
							<div class="form-group">
		          				<p>Esta seguro de eliminar al estudiante:  <span>{{ activeStudent.name }}</span></p>
								<input type="hidden" name="idstudent" id="idstudent" v-model="activeStudent.idstudent">
							</div>
							<div class="col-xs-12 pull-right">
								<button type="submit"  class="btn btn-primary " id="cerrarModal">Borrar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</form>
						<hr>
					</div>
						

				</div>
			</div>
		</div>
	</main>

<hr>
<br>
<script type="text/javascript" src="js/vue.min.js"></script>
<script type="text/javascript" src="js/axios.min.js"></script>
<!-- <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script type="text/javascript" src="usuario.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>