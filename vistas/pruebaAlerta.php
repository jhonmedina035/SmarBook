<?php 
require('alerta.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <script>

const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
				  confirmButton: 'btn btn-success',
				  cancelButton: 'btn btn-danger',
                  allowOutsideClick:false
				},
				buttonsStyling: false
			  })
           

			  swalWithBootstrapButtons.fire({
               
                allowOutsideClick:false,
				title: 'Terminos y condiciones',
				text: `No se permite lo siguiente: Contenido que denigre a una persona física o a un grupo de personas físicas, o que fomente el odio o la discriminación hacia ellos debido a su origen étnico o raza, religión, discapacidad, edad, nacionalidad, orientación sexual, género, identidad de género o alguna otra característica que esté asociada con la marginación o la discriminación. Tampoco es permitido:  contenido que promocione temas de índole sexual relacionados con menores de edad, actividades no consentidas o cualquier otra cuestión ilegal de naturaleza sexual, independientemente de que sea simulado o real, contenido como: sexo, violencia, lenguaje vulgar o representaciones desagradables de niños, contenido que promociona crueldad o violencia injustificada hacia los animales... Al aceptar nuestras politicas te comprometes a no montar contenido inapropiado mencionado anteriormente, recuerda que esta red social es netamente Educativa y si montas contenido que valla encontra de nuestras normas serás penalizado`,
				showCancelButton: true,
				confirmButtonText: 'si, acepto',
				cancelButtonText: 'No, no acepto',
				reverseButtons: true,
               
			  }).then((result) => {
                 
				if (result.isConfirmed) {
				  swalWithBootstrapButtons.fire(
                    
					'Puede montar el curso',
					'haz acetado los terminos y condiciones',
					'success' )
                    .then(()=>{
					window.location=('subir_curso.php');
				  });
				} else if (
				  /* Read more about handling dismissals below */
				  result.dismiss === Swal.DismissReason.cancel
				) {
				  swalWithBootstrapButtons.fire(
					'No podrás montar cursos',
					'',
					'warning')
                  .then(()=>{
					window.location=('home_2.php');
				  });
				}
			  })

            


    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>
</html>


</script>


<?php




?>