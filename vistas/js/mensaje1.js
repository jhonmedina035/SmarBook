alertaBienvenido()
function alertaBienvenido(){
Swal.fire({
  allowOutsideClick:false,
  title: 'Bienvenido',
  icon: 'success',
  text: '¡Ahora puedes crear y disfrutar de los cursos que tenemos para ti!',})
  .then(()=>{
      window.location=("../vistas/home.php");

  });
}