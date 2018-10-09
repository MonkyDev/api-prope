$(document).ready(function(){

/* -------- valida un nombre completo y lo particiona function -------- */
	$("#registerUser #nombre").on('blur',function(){
		var	people = $(this).val();
	 	nombre = people.trim();  /* limpiamos cadena a separar*/
	 	okNombre = nombre.replace(/\s+/gi,' '); /*validamos con una expresion*/
		if (okNombre != "") {
			arregloNombre = okNombre.split(' '); /*Array del nombre con las palabras separadas en cada posición.*/
			fullName = []; /*Array que contendrá el nombre final.*/
			palabrasReservadas =['da', 'de', 'del', 'la', 'las', 'los', 'san', 'santa']; /*Palabras de apellidos y nombres compuestos, aquí podemos agregar más palabras en caso de ser necesario.*/
			auxPalabra = ""; /*Variable auxiliar para concatenar los apellidos compuestos.*/
			arregloNombre.forEach(function(name){ /*Iteramos el array del nombre.*/
			 nameAux = name.toLowerCase(); /*convertimos en minúscula la palabra que se esta iterando para poder hacer la búsqueda de esta palabra en nuestro arreglo de "palabrasReservadas".*/
			 if(palabrasReservadas.indexOf(nameAux)!=-1) /*Cuando la palabra existe dentro de nuestro array, la funcion "indexOf" nos arrojara un numero diferente de -1.*/
			 {
			 auxPalabra += name+' ' ; /*Concatenamos y guardamos en nuestra variable auxiliar la palabra detectada.*/
			 }
			 else { /*En caso de que la palabra no existe en nuestro array de palabras reservadas, hacemos un push a la variable "fullName" que contendrá el nombre final*/
			 fullName.push(auxPalabra+name);
			 auxPalabra = ""; /*Limpiamos la variable auxiliar*/
			 }
			 });
			 /*Al final de la iteración vamos a tener un array en el cual la posicion 0 y 1 contienen los apellidos Paterno y Materno respectivamente.*/
			 /*las siguientes posiciones despues de eso contendra el nombre*/
			console.log("Apellido paterno: "+fullName[0]); /*Apellido Paterno*/
			$("#registerUser #paterno").val(fullName[0]);
			console.log("Apellido materno: "+fullName[1]); /*Apellido Materno*/
			$("#registerUser #materno").val(fullName[1]);
			delete fullName[0]; /*Eliminamos la posición del apellido paterno*/
			delete fullName[1]; /*Eliminamos la posición del apellido materno*/
			nombreCompleto = ""; /*Variable que contiene el puro nombre*/
			fullName.forEach(function(nombre){ /*Iteramos en caso de que la persona tenga un nombre compuesto, ejemplo: Juan Manuel */
			 if(nombre!="")
			 {
			 nombreCompleto += nombre+ " "; /*Concatenamos el nombre*/
			 }
			});
			console.log("Nombre completo: "+nombreCompleto);  /*Nombre completo sin apellidos*/
			$("#registerUser #nombres").val(nombreCompleto);

			/*alteramos el formulario*/
			$("#registerUser .alert-info").removeClass('hidden');
			$("#registerUser .fullname").removeClass('hidden');
			$("#registerUser .name").addClass('hidden');
		}
	});


	$("#registerUser #name").on('focus',function(){
		clave = $("#clave").val();
		$(this).val('516T' + clave);
	});


	//$(document).keyup(PushKey);

	$("a#btn-add-obsv").on('click', function(event){
		event.preventDefault();
		id_prestamo	= $(this).attr('href');
		$("#modal-add-obsv"+id_prestamo).modal('toggle');
		$("#routing").val('http://192.168.2.70:8001/observation/'+id_prestamo);
	return false;
	});

	$("a#end-seg").on('click', function(event){
		event.preventDefault();
		id_prestamo	= $(this).attr('href');
		
		alertify.confirm('Seguimiento al prestamo',
											 '¿Desea finalizar el prestamo del documento?, no se volvera a mostrar en esta pantalla.',
							function(){
								var Route = 'http://192.168.2.70:8001/tracing/' + id_prestamo;
								location.href = Route;
							},
              function(){ alertify.error('No se ejecutaron procesos...')
            	});
	return false;
	});
});