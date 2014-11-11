$(document).ready(function(){
	/*expandir todos los bloques con la clase clsActivo y agregar la clase clsArriba a los
	titulos de cada uno de esos bloques*/
	$('.clsActivo').stop(true,true).slideToggle().parent().find('.clsSeccion').addClass('clsArriba');
	/*buscamos el ultimo li, del ultimo ul y le agregamos la clase clsUltimo para redondear el
	borde inferior*/
	$('.clsContenedor').last('ul').find('li:last-child').addClass('clsUltimo');
	/*agregamos la clase clsAbajo a todos los elementos del acordeon, que inicialmente
	se muestren cerrados (sin la clase clsActivo)*/
	$(".clsContenedor .clsSeccion ").not('[class$="clsArriba"]').addClass('clsAbajo');
			
	/*evento que se dispara al hacer clic en cualquiera de los contenedores del acordeon*/
	//$('#clsContenedor0').click(function(){
	$('.clsContenedor_hijo').click(function(){
		id_name=$(this).attr('id');
		complemento =  id_name.split("_");
		//alert("#"+complemento[0]+"_padre"+complemento[1]);
		/*mostramos u ocultamos la lista (ul) utilizando slideToggle*/
		$("#"+complemento[0]+"_padre"+complemento[1]).find('ul').stop(true,true).slideToggle('fast',function(){
		//$("#clsContenedor_padre0").find('ul').stop(true,true).slideToggle('fast',function(){
			//verificar la clase que tiene el titulo del contenedor
			if($(this).parent().find('.clsSeccion').hasClass('clsAbajo')){
				//eliminamos la clase clsAbajo y agregamos la clase clsArriba (para los iconos)
				$(this).parent().find('.clsSeccion').removeClass('clsAbajo ').addClass('clsArriba');
				$(this).parent().find('.class_aux').removeClass('disabled ').addClass('enable');
			}else{
				//eliminamos la clase clsArriba y agregamos la clase clsAbajo (para los iconos)
				$(this).parent().find('.clsSeccion').removeClass('clsArriba').addClass('clsAbajo ');
				$(this).parent().find('.class_aux').removeClass('enable ').addClass('disabled');
			}
		});
	});
});