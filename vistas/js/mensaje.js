
    mostrarAlerta();
    function mostrarAlerta(){
    console.log("hola vida linda");
	swal.fire({
		allowOutsideClick:false,
		icon: 'error',
		title: 'Error',
		text: 'ya existe un usuario registrado con ese correo, prueba con uno nuevo',})
		.then(()=>{
			window.location=("../vistas/registro.php");
		});
    }



