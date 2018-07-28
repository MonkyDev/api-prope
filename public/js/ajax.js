/*------------------------------------------------ Del seguimiento ------------------------------------------------*/


$(".form_observaciones").submit(function(event){
	event.preventDefault();
	id = $(this).attr('id');
	var Datas  = $('.form_observaciones#'+id).serialize();
  var Route = $("#routing").val();
  console.log(Route);

  if (Route!='' && Datas!='')
  {
  	$.ajax({
			url: Route,
			type: 'POST',
			data: Datas,
			dataType: 'JSON',
			success: function(response){
				if(response.code == 300){
		    	alertify.error(response.status+' :'+response.message);

				}else if(response.code == 200) {
					alertify.success( response.message );
					location.reload();
				}
				else{
					console.log(response);
					alertify.error(response.message);
				}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
		  if (jqXHR.status === 0)
		    alert('Not connect: Verify Network.');

		  else if (jqXHR.status == 404)
		    alert('Requested page not found [404]');

		  else if (jqXHR.status == 500)
		    alert('Internal Server Error [500].');

		 else if (textStatus === 'parsererror')
			 alert('Requested JSON parse failed.');

		  else if (textStatus === 'timeout')
		    alert('Time out error.');

		  else if (textStatus === 'abort')
		    alert('Ajax request aborted.');

		  else
		    alert('Uncaught Error: ' + jqXHR.responseText);

		});
  }/* ///\ FIN DE LA VALIDACION /\\\ */
  else
		alert('Error de complementos.');

}); /* ///\ FIN DEL EVENTO DEL BOTON GUARDAR /\\\*/





$("button.seguimiento").on('click', function(event){
	event.preventDefault();

	name_elemt = $(this).attr('id');
  var Route = $(this).children().attr('href');
	$("#modal-"+name_elemt).modal('toggle');
  if ( Route!='' )
  {
  	$.ajax({
			url: Route,
			dataType: 'JSON',
			success: function(response){
				//console.log(response);

				if(response.code == 300){
		    	alertify.error(response.status+' :'+response.message);

				}else if(response.code == 200) {
					if ( response.message != "" )
						$("table." + name_elemt + ">tbody").html(response.message);
					else{
						$("table." + name_elemt + ">tbody").html('No hay observaciones...');
					}
				}
				else{
					console.log(response);
					alertify.error(response.message);
				}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
		  if (jqXHR.status === 0)
		    alert('Not connect: Verify Network.');

		  else if (jqXHR.status == 404)
		    alert('Requested page not found [404]');

		  else if (jqXHR.status == 500)
		    alert('Internal Server Error [500].');

		 else if (textStatus === 'parsererror')
			 alert('Requested JSON parse failed.');

		  else if (textStatus === 'timeout')
		    alert('Time out error.');

		  else if (textStatus === 'abort')
		    alert('Ajax request aborted.');

		  else
		    alert('Uncaught Error: ' + jqXHR.responseText);

		});
  }/* ///\ FIN DE LA VALIDACION /\\\ */
  else
		alert('Error de complementos.');
});











/*$(document).click(function(event){
	target = $( event.target ); // event.target.nodeName
	//console.log( target );
	if ( target.is("i") ) {
		parent = target.parent().data('target');
		if ( parent==="#modal-two" ) {
			console.log( 1 );
		}
		//console.log(  );
	} else if( target.is("a") ){
		if ( $(this).data('target')==="#modal-two" ) {
			console.log( 1 );
		}

	} else console.log(0);

});	*/


//$("section").each(function(){ all_sec = $(this).attr('class'); });
	//$("section").find('.'+name_elemt).removeClass('hide');

	/*$("section .show").each(function(){
		all_sec = $(this).attr('class');
		if (all_sec != name_elemt)
			$("."+all_sec).addClass('hide');
		else
			$("."+name_elemt).removeClass('hide');
	});*/


/*
$('#myModal').modal('toggle');
$('#myModal').modal('show');
$('#myModal').modal('hide');
*/