$(document).ready(function(){

    $(".table-affectations").DataTable({
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

	loadselect('PONT BASCULE / SITE D\'EMPOTAGE','Get_ponts_model','.form-triaffect select[name="pont"]',0);
});
//END FUNCTION


///*
$('.form-triaffect').on('submit', function(e){
	
	e.preventDefault();

	trigeraffectations();
});	
//*/


function trigeraffectations(){
	
	var factur=$('.form-triaffect select[name="facturation"]').val();
	var debut=$('.form-triaffect input[name="debut"]').val();
	var fin=$('.form-triaffect input[name="fin"]').val();
	var pont=$('.form-triaffect select[name="pont"]').val();
	loadaffectations(factur,debut,fin,pont);
}

function loadaffectations(factur,debut,fin,pont){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_facturation_model.php',
        type: 'POST',
		data: 'factur='+factur+'&debut='+debut+'&fin='+fin+'&pont='+pont,
		dataType: 'json',
        success : function(response){

            hideloader();

            $('.table-affectations').DataTable().clear().draw(false);

            if(response[0] > 0){

                var j = 1,
                    non = '',
                    oui = '';

                for(var i = 0; i < response[0]; i++){


                   $('.table-affectations').DataTable().row.add([
                        response[j+2],//date reservation 
                        '<span class="text-'+((response[j+3]==1)?'success':'danger')+'">'+PlageHoraire(response[j+3])+'</span>',//plage horaire 
                        '<b>'+response[j+4]+'</b>',//pont
                        response[j+5],//inspecteur
                        '<button class="btn btn-info button-affectation" name="'+response[j]+'_1" title="Voir le détails de l\'affectation" style="color: white;"><i class="mdi mdi-magnify-plus"></i></button>' //&nbsp;details
                    ]).columns.adjust().draw(false);
                    j += 9;
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
$('.table-affectations').on('click','.button-affectation', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==1 || id[1]==4){

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
					}else if(id[1]==4){

						loadformaffect('table-affectations',id,response);
						
					}
				}//FIN SI LE STATUT N'A PAS CHANGE

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
	
	}else if(id[1]==5){
		
		Confirmation(id[0],id[1],id[2],'Cancel_reject_model',"table-affectations","Voulez-vous vraiment annuler cette affectation ?");
	}

});//ONCLICK

