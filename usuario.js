
const vm = new Vue({
	el:"#app",
	data:{
		loading:false,
		students:[],
		errorMessage:'',
		successMessage:'',
		mostrarF:false,
		activeStudent:{},
		successMessage:'',
		errorMessage:''
	},
	mounted(){
		this.getAllStudents();
		document.getElementById("formulario").style.display="none";
	},
	computed:{

	},
	methods:{
		getAllStudents:function(){
			axios.post('usuario.ajax.php?operacion=listar')
				.then(res=>{
					this.students = res.data.students;
					// console.log(res.data.students);
					// console.log(res.data.students);
				});
		},
		createStudent(e){
			let form = new FormData(e.target);
			this.loading=true;
			axios({
			  method: 'post',
			  url: 'usuario.ajax.php?operacion=insertaryactualizar',
			  data: form
			})
			.then(res=>{
					setTimeout(()=>{
						this.loading=false;
					},200)

					this.getAllStudents()
					this.setMessages(res);
					this.mostrarForm();
				});
			
		},
	
		eliminarStudent:function(e){
			this.loading=true;
      		axios.post("usuario.ajax.php?operacion=eliminar",new FormData(e.target))
      			.then(res=>{
					// console.log(res.data);
					// document.getElementById("modalDelete").style.height=0;
					$("#modalDelete").modal('hide');//ocultamos el modal
				    // $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
				    // $('.modal-backdrop').remove();//eliminamos el backdrop del modal
					this.getAllStudents();
					this.activeStudent = {};
					this.setMessages(res);
					setTimeout(()=>{
						this.loading=false;
					},200)
      			})
		},
		getStudent:function(student){
			this.mostrarForm();
			this.activeStudent = student;

		},
		getStudentDelete:function(student){
			// this.mostrarForm();
			this.activeStudent = student;

		},
		mostrarForm:function(){
			this.mostrarF=!this.mostrarF;
			if(this.mostrarF){
				document.getElementById("listado").style.display="none";
				document.getElementById("formulario").style.display="block";

			}else{
				
				document.getElementById("listado").style.display="block";
				document.getElementById("formulario").style.display="none";
				this.activeStudent = {};
			}
		},
		setMessages(res){
				if(res.data.error){
					this.errorMessage = res.data.message;
				}else{
					this.successMessage = res.data.message;
					this.getAllStudents();
				}

				setTimeout(() => {
					this.errorMessage=false;
					this.successMessage=false;
				},2000);
			},

	}

}) 
