$(document).ready(function(){

    $(".table-affectations").DataTable({
        autoWidth: true,
        ordering:  false,
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: nbreserv,
<<<<<<< HEAD
        columnDefs: [
            { "visible": false, "targets": 1 },
            { "visible": ((typuser==4 || typuser==5)?false:true), "targets": 8 },
		],
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		createdRow: function( row, data, dataIndex){
               if( data[1] ==  'JOUR'  ){
                    $(row).css({"background-color":"#dddd33"});
                }
		},
        dom: 'Bfrtip',
<<<<<<< HEAD
		buttons: [{extend:'copyHtml5',text:'Copier',titleAttr: 'Copier le contenu du tableau'},
				  {extend:'csv',text:'CSV',titleAttr: 'Télécharger le tableau au format CSV'},
				  {extend:'excel',text:'Excel',titleAttr: 'Télécharger le tableau au format Excel'},
				  {extend:'pdf',text:'PDF',titleAttr: 'Télécharger le tableau au format PDF'},
				  {extend:'print',text:'Imprimer',titleAttr: 'Imprimer le tableau'}],
=======
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
    });

	loadselect('INSPECTEUR DE POIDS','Get_inspecteurs_model','.form-triaffect select[name="inspecteur"]',0);
	loadselect('OPERATEUR','Get_users_model','.form-triaffect select[name="user"]',0);
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
	var inspecteur=$('.form-triaffect select[name="inspecteur"]').val();
	var user=$('.form-triaffect select[name="user"]').val();
	loadaffectations(factur,debut,fin,inspecteur,user);
}

function loadaffectations(factur,debut,fin,inspecteur,user){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_affectations_model.php',
        type: 'POST',
		data: 'factur='+factur+'&debut='+debut+'&fin='+fin+'&inspecteur='+inspecteur+'&user='+user,
		dataType: 'json',
        success : function(response){

            hideloader();

            $('.table-affectations').DataTable().clear().draw(false);

<<<<<<< HEAD
			$('#resultat').html(((debut!="" && fin!="")?"Pour la période du&nbsp;<b>"+debut+"</b>&nbsp;au&nbsp;<b>"+fin+"</b>, i":"I")+"l y a&nbsp;<b>"+((response[0]>0)?response[1]:"aucune")+"</b>&nbsp;réservation"+((response[0]>1)?"s":"")+" affectée"+((response[0]>1)?"s":"")+""+((response[2]!=0)?", facturée"+((response[0]>1)?"s":"")+" pour un montant total de&nbsp;<b>"+response[2]+" FCFA</b>.":"."));

            if(response[0] > 0){

                var j = 3,
=======
            if(response[0] > 0){

                var j = 1,
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                    non = '',
                    oui = '';

                for(var i = 0; i < response[0]; i++){

<<<<<<< HEAD
                    non = ((typuser==4 || typuser==5)?'':'<button class="btn btn-dark button-affectation" name="'+response[j]+'_5_'+response[j+8]+'" title="Annuler l\'affectation de l\'inspecteur" style="color: white;"><i class="mdi mdi-cancel"></i></button>'); //&nbsp;Demander
                    oui = ((typuser==4 || typuser==5)?'':'<button class="btn btn-warning button-affectation" name="'+response[j]+'_4_'+response[j+8]+'" title="Modifier l\'agent affecté" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'); //&nbsp;Demander

                   $('.table-affectations').DataTable().row.add([
                        '<label class="badge bg-'+((response[j+1]==0)?'danger':'success')+'" style="color:white;border-radius: 5px;height: 20px;padding-top: 3px">'+Facturation(response[j+1])+'</label> ',
						response[j+6]+' / '+response[j+4],
=======
                    non = ((typuser==4)?'':'<button class="btn btn-dark button-affectation" name="'+response[j]+'_5_'+response[j+8]+'" title="Annuler l\'affectation de l\'inspecteur" style="color: white;"><i class="mdi mdi-cancel"></i></button>'); //&nbsp;Demander
                    oui = ((typuser==4)?'':'<button class="btn btn-warning button-affectation" name="'+response[j]+'_4_'+response[j+8]+'" title="Modifier l\'agent affecté" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'); //&nbsp;Demander

                   $('.table-affectations').DataTable().row.add([
                        '<label class="badge badge-'+((response[j+1]==0)?'danger':'success')+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+Facturation(response[j+1])+'</label> ',
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                        response[j+2],//date reservation 
                        '<span class="text-'+((response[j+3]==1)?'success':'danger')+'">'+PlageHoraire(response[j+3])+'</span>',//plage horaire 
                        '<b>'+response[j+4]+'</b>',//pont
                        response[j+5],//inspecteur
                        '<b>'+response[j+6]+'</b>',//demandeur
<<<<<<< HEAD
                        '<span style="color:'+villecolor(response[j+7])+'">'+Ville(response[j+7])+'</span> ',
=======
                        '<span class="text-'+statuscolor(response[j+7])+'">'+Ville(response[j+7])+'</span> ',
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
 						'<span style="white-space:nowrap">'+oui+' '+non+'</span>',
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

