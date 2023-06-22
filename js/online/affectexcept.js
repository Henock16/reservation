/* must apply only after HTML has loaded */

$('#affectexcept').on('click', function(){
			
	loadselect('PONT BASCULE / SITE D\'EMPOTAGE','Get_ponts_model','#frm-affect-except select[name="site"]',0);
	loadselect('INSPECTEUR','Get_inspecteurs_model','#frm-affect-except select[name="inspecteur"]',0);

	$('#modal-affect-except').modal('show');
});//ONCLICK

$('#frm-affect-except').on('submit', function(e){
		
	e.preventDefault();

    var postdata = $(this).serialize();

	$('.button-affect-except').prop('disabled',true);

	$.ajax({

		url: './models/Affect_except_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			$('.button-affect-except').prop('disabled',false);
						
			if(response[0]==3)
				mssg(lang,12,"Impossible d'affecter '"+response[1]+"' car "+nuits+" nuit"+((nuits>1)?"s":"")+" "+((nuits>1)?"d'affilé":"")+" d'affectation entraine"+((nuits>1)?"nt":"")+" un repos le jour suivant.");
			else if(response[0]==2)
				mssg(lang,12,"Impossible d'affecter '"+response[1]+"' !\n\n"+"Il a été affecté sur '"+response[2]+"' pour l"+((response[5]==1)?'a journée':((response[5]==2)?'a nuit':((response[5]==3)?"'après-midi":'')))+" du "+response[3]+".");
			else if(response[0]==1)
				mssg(lang,12,"Impossible d'affecter '"+response[1]+"' !\n\n"+"Il est déja affecté sur \'"+response[2]+"\' à la même date et plage horaire.");
			else if(response[0]==0){
				
				$('#modal-affect-except').modal('hide');
				$('#frm-affect-except')[0].reset();
				
			}else if(response[0]==-1){
				mssg(lang,12,"Impossible d'effectuer l'affectation car un autre agent est deja affecté sur ce pont à la même date et plage horaire.");
			}else
				mssg(lang,11,response[0]); 
			
		},//SUCCESS
		error: function(jqXHR, status, error) {
			
			$('.button-affect-except').prop('disabled',false)

			alert("Erreur detectee lors de l'affectation exceptionnelle : "+error);
		}//ERROR
		
	});//AJAX
	
});
