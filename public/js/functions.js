/* -------- function limpiar cadena -------- */
String.prototype.trim = function() { 
	return this.replace(/^\s+|\s+$/g, ""); 
}; 

function PushKey(event){
	//console.log("El evento " + event.type + " tiene código: " + event.which);
	var key = event.which;
	switch(key)
	{
		/*case 13: //enter
			$('#loan-new-form').submit();
		break;*/
		case 115://F4
			$('#loan-new-form').submit();
		break;
		case 113://F2
			$('#loan-add-form').submit();
		break;
	}
}