    function mostrarAlerta(icono,titulo,texto){
    console.log("hola vida linda");
	swal.fire({
		allowOutsideClick:false,
		icon: icono,
		title: titulo,
		text: texto,})
		.then(()=>{
			window.location=("../vistas/registro.php");
		});
    }



