$(document).ready(function(){


    $(".table-reservations").DataTable({
        autoWidth: true,
        ordering:  false,
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: nbreserv,
		createdRow: function( row, data, dataIndex){
               if( data[1] ==  'JOUR'  ){
                    $(row).css({"background-color":"#dddd33"});
                }
		},
        dom: 'Bfrtip',
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    });


 loadreservations(0,'','');

 loadselect('PONT DE RESERVATION','Get_ponts_model','.form-trireserv select[name="pont"]',0);
 
});
//END FUNCTION

///*
$('.form-trireserv select[name="statut"]').on('change', function(e){
	
	trigereservations();
});	
//*/

///*
$('.form-trireserv select[name="pont"]').on('change', function(e){
	
	trigereservations();
});	
//*/

///*
$('.form-trireserv input[name="date"]').on('change', function(e){
	
	trigereservations();
});	
//*/

function trigereservations(){
	
	loadreservations($('.form-trireserv select[name="statut"]').val(),$('.form-trireserv select[name="pont"]').val(),$('.form-trireserv input[name="date"]').val());
}

function loadreservations(statut,pont,date){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_reservations_model.php',
        type: 'POST',
		data: 'statut='+statut+'&pont='+pont+'&date='+date,
        success : function(response){

            hideloader();

            $('.table-reservations').DataTable().clear().draw(false);

            if(response[0] > 0){

                var j = 1,
                    non = '',
                    oui = '';

                for(var i = 0; i < response[0]; i++){

                    non = '';
                    oui = '';

                    if(response[j+4] == 1){			//1=en attente
						if(response[j+6] == 0)
							non = '<button class="btn btn-danger button-reservation" name="'+response[j]+'_3_'+response[j+6]+'" title="Rejeter la réservation" style="color: white;"><i class="mdi mdi-delete"></i></button>'; //&nbsp;Demander
                        oui = '<button class="btn btn-success button-reservation" name="'+response[j]+'_2_'+response[j+6]+'" title="Affecter un inspecteur à la réservation" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'; //&nbsp;Demander
                    }else if(response[j+4] == 2){	//2=annulee
						non = '';
						oui = '';
                    }else if(response[j+4] == 3){	//3=affectee
                        non = '<button class="btn btn-dark button-reservation" name="'+response[j]+'_5_'+response[j+6]+'" title="Annuler l\'affectation de l\'inspecteur à la réservation" style="color: white;"><i class="mdi mdi-cancel"></i></button>'; //&nbsp;Demander
                        oui = '<button class="btn btn-warning button-reservation" name="'+response[j]+'_4_'+response[j+6]+'" title="Modifier l\'agent affecté à la réservation" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'; //&nbsp;Demander
                    }else if(response[j+4] == 4){	//4=avortee
						non = '';
						oui = '';
					}else if(response[j+4] == 5){	//5=rejetee
						non = '';
						oui = '';
                    }

                    $('.table-reservations').DataTable().row.add([
                        response[j+1],//date reservation 
                        '<span class="text-'+((response[j+2]==1)?'success':'danger')+'">'+PlageHoraire(response[j+2])+'</span>',//plage horaire 
                        '<b>'+response[j+3]+'</b>',//pont
                        '<label class="badge badge-'+statuscolor(response[j+4])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+statusname(lang,response[j+4])+'</label> ',
                        response[j+5],//inspecteur
 						non,
						oui,
                        '<button class="btn btn-info button-reservation" name="'+response[j]+'_1" title="Voir le détails de la réservation" style="color: white;"><i class="mdi mdi-magnify-plus"></i></button>' //&nbsp;details
                    ]).columns.adjust().draw(false);
                    j += 7;
                }//END FOR
            }//ENF IF
        },//END SUCCES
        error: function(jqXHR, status, error) {
            hideloader();
            mssg(lang,7,error);
        }
    });//END AJAX

}//FIN ONTAB CLICK


//CLICK SUR UN BOUTON DU TABLEAU reservations
$('.table-reservations').on('click','.button-reservation', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==1 || id[1]==2 || id[1]==4){

		showloader() ;

		$.ajax({

			url: ((id[1]==1)?'./models/Get_reservation_details_model.php':'./models/Get_inspector_list_model.php'),
			type: 'POST',
			data: 'id='+id[0]+'&action='+id[1]+'&expire='+id[2],
			dataType: 'json',
			success : function(response){

				hideloader();

				if(response[0]<=0)
					mssg(lang,8,response[0]);
				else{

					//DETAILS 
					if(id[1]==1){

						loadform(id[0],id[1],id[2],'reservation','reservation',response);

					//AFFECTATION
					}else if(id[1]==2 || id[1]==4){

						loadformaffect('table-reservations',id,response);
						
					}
				}//FIN SI LE STATUT N'A PAS CHANGE

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
							
	}else if(id[1]==3 || id[1]==5){
		
		Confirmation(id[0],id[1],id[2],'Cancel_reject_model',"table-reservations","Voulez-vous vraiment "+((id[1]==5)?"annuler cette affectation":"rejeter cette réservation")+"?");
	}

});//ONCLICK

