$(document).ready(function(){

    $(".table-inspect-affect").DataTable({
        paging:    false,
        info:      false,
        searching: false,
        autoWidth: true,
        ordering:  false,
        order: [[ 0, 'desc' ]],
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: nbaffect,
        columnDefs: [
             { "visible": false, "targets": 0 }
        ]
	});

});
//END FUNCTION


function loadformaffect(table,id,response){
	
	$('#modal-affectation-title').html((id[1]==2)?'<i class="mdi mdi-lead-pencil"></i>&nbsp; Affectation d\'un inspecteur':'<i class="mdi mdi-lead-pencil"></i>&nbsp; Modification de l\'Affectation');
	$('#modal-affectation-header').css("background-color",(id[1]==2)?'lightgreen':'orange');

	$('.form-affectation input[name="action-id"]').val(id[1]);
	$('.form-affectation input[name="reservation-id"]').val(id[0]);
	$('.form-affectation input[name="table"]').val(table);

	if(id[1]==4) 
		loadinspectaffect(response[1]);
	else{
		$('#submit-affectation').prop('disabled',true);
		$('#inspectors_affectations').css('display','none');
	}
							
	var j = 2;
	var list = "<option value=\"\" selected=\"selected\">&lt;SELECTIONNER L'INSPECTEUR A AFFECTER&gt;</option>";
	for(var i = 0; i < response[0]; i++){
		list += "<option value=\""+response[j]+"\" "+((response[j]==response[1])?"selected=\"selected\"":"")+">"+response[j+1]+" | "+((response[j+2]=="")?"pas d'":response[j+2]+" ")+"heure"+((response[j+2]>1)?"s":"")+" d'affectation cette semaine</option>";							
		j += 3;
	}
	$('.form-affectation select[name="inspecteur-id"]').html(list);

	$('#submit-affectation').text((id[1]==2)?"Affecter":"Reaffecter");

	$('#modal-affectation').modal('show');		
}


///*
$('.form-affectation select[name="inspecteur-id"]').on('change', function(e){

	e.preventDefault();
	
	$('#inspectors_affectations').css('display','none');
	if($(this).val()!="") loadinspectaffect($(this).val());
	$('#submit-affectation').prop('disabled',($(this).val()!="")?false:true);
});

//


function loadinspectaffect(id){
	
	showloader() ;

	$.ajax({

		url: './models/Get_inspector_affectations_model.php',
		type: 'POST',
		data: 'id='+id,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]!=0)
				mssg(lang,13,response[0]);
			else{ 
				if(response[1] == 0){
					$('#inspectors_affectations').css('display','none');
				}else{
					$('#nbaffect').html(((nbaffect>1)?'SES '+nbaffect:'SA')+' DERNIERE'+((nbaffect>1)?'S':'')+' AFFECTATION'+((nbaffect>1)?'S':''));
					$('#inspectors_affectations').css('display','block');
					$('.table-inspect-affect').DataTable().clear().draw(false);
					var j = 2;
					for(var i = 0; i < response[1]; i++){

						$('.table-inspect-affect').DataTable().row.add([
							((response[j+1]==1)?"ROTATION":"RESERVATION"),
							response[j+2],//date reservation (FR)
							PlageHoraire(response[j+3]),//plage horaire (1/2)
							'<b>'+response[j+4]+'</b>',//pont
							'<button  name="'+response[j]+'_5_'+response[j+5]+'" class="btn btn-danger button-inspect-affect" title="Annuler l\'affectatation" style="color: white;height:20px;width:15px;padding-top:2px;padding-left:3px;"><i class="mdi mdi-delete"></i></button>' 
						]).columns.adjust().draw(false);
						j += 6;
					}//END FOR
				}//ENF IF RESPONSE[1]>0
			}//ENF IF RESPONSE[0]!=0
		},//SUCCESS
		error: function(jqXHR, status, error) {
			hideloader();
			mssg(lang,12,error);
		}//ERROR
	});//AJAX
}
//*/


$('.table-inspect-affect').on('click','.button-inspect-affect', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==5){
		
	Confirmation(id[0],id[1],id[2],'Cancel_reject_model',"table-inspect-affect","Voulez-vous vraiment annuler cette affectation?");		
	}
});//ONCLICK

///*
$('.form-affectation').on('submit', function(e){

	e.preventDefault();
});
//*/


//CLICK SUR LE BOUTON DES AFFECTATIONS
///*
$('#submit-affectation').on('click', function(e){

	showloader() ;

    var postdata = $('.form-affectation').serialize();

	$.ajax({

		url: './models/Set_affectation_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==2)
				mssg(lang,12,"Impossible d'affecter '"+response[1]+"' !\n\n"+"Il a été affecté sur '"+response[2]+"' pour l"+((response[5]==1)?'a journée':((response[5]==2)?'a nuit':((response[5]==3)?"'après-midi":'')))+" du "+response[3]+".");
			else if(response[0]==1)
				mssg(lang,12,"Impossible d'affecter '"+response[1]+"' !\n\n"+"Il est déja affecté sur \'"+response[2]+"\'.");
			else if(response[0]==0){
				
				$('#modal-affectation').modal('hide');
				
				if($('.form-affectation input[name="table"]').val()=='table-reservations')
					trigereservations();
				else
					trigeraffectations();
			}else
				mssg(lang,11,response[0]); 
		},//SUCCESS
		error: function(jqXHR, status, error) {
			hideloader();
			mssg(lang,10,error);
		}//ERROR
	});//AJAX
});
//*/
