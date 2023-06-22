$(document).ready(function(){

    $(".table-inspecteurs").DataTable({
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
		buttons: [{extend:'copyHtml5',text:'Copier',titleAttr: 'Copier le contenu du tableau'},
				  {extend:'csv',text:'CSV',titleAttr: 'Télécharger le tableau au format CSV'},
				  {extend:'excel',text:'Excel',titleAttr: 'Télécharger le tableau au format Excel'},
				  {extend:'pdf',text:'PDF',titleAttr: 'Télécharger le tableau au format PDF'},
				  {extend:'print',text:'Imprimer',titleAttr: 'Imprimer le tableau'}],
    });


 loadinspecteurs();

});
//END FUNCTION


function loadinspecteurs(){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_inspecteurs_model.php',
        type: 'POST',
		data: 'statut=1',
        success : function(response){

            hideloader();

            $('.table-inspecteurs').DataTable().clear().draw(false);

            if(response[0] != 0)
				mssg(lang,18,response);
            else if(response[1] > 0){

                var j = 3,
                    actif = '',
                    modif = '';

                for(var i = 0; i < response[1]; i++){
   
					if(response[j+2]==0)
						actif = '<button class="btn btn-danger button-inspecteurs" name="'+response[j]+'_3_'+response[j+2]+'" title="Désactiver" style="color: white;"><i class="mdi mdi-cancel"></i></button>'; 
					else
						actif = '<button class="btn btn-success button-inspecteurs" name="'+response[j]+'_3_'+response[j+2]+'" title="Activer" style="color: white;"><i class="mdi mdi-check"></i></button>'; 
					
					if(response[j+2]==0)
						modif = '<button class="btn btn-warning button-inspecteurs" name="'+response[j]+'_2_'+response[j+2]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>';
					else
						modif='';
 
                    $('.table-inspecteurs').DataTable().row.add([
                        '<center><label class="badge bg-'+statuscolor((response[j+2]==0)?3:5)+'" style="color:white;border-radius: 5px;height:20px;padding-top:3px;">'+Statut(response[j+2])+'</label></center>',
                        response[j+3],
                        '<b>'+response[j+1]+'</b>',
                       '<span style="color:'+villecolor(response[j+4])+'">'+Ville(response[j+4])+'</span> ',
                        response[j+5],
 						'<span style="white-space:nowrap">'+actif+' '+modif+'</span>',
                        '<button class="btn btn-info button-inspecteurs" name="'+response[j]+'_1_'+response[j+2]+'" title="Détails" style="color: white;"><i class="mdi mdi-magnify-plus"></i></button>' //&nbsp;details
                    ]).columns.adjust().draw(false);
                    j += response[2];
                }//END FOR
            }//ENF IF
        },//END SUCCES
        error: function(jqXHR, status, error) {
            hideloader();
            mssg(lang,19,error);
        }
    });//END AJAX

}//FIN ONTAB CLICK


//CLICK SUR UN BOUTON DU TABLEAU 
$('.table-inspecteurs').on('click','.button-inspecteurs', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==1 || id[1]==2){

		showloader() ;

		$.ajax({

			url: './models/Get_inspector_details_model.php',
			type: 'POST',
			data: 'id='+id[0]+'&action='+id[1]+'&statut='+id[2],
			dataType: 'json',
			success : function(response){

				hideloader();

				if(response[0]!=1)
					mssg(lang,8,response[0]);
				else if(id[1]==1 || id[1]==2)//DETAILS //MODIFICATION
					loadform(id[0],id[1],id[2],'inspecteur','inspecteur de poids',response);

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
	
	}else if(id[1]==3){
		
		Confirmation(id[0],id[1],id[2],'Process_inspecteur_model',"table-inspecteurs","Voulez-vous vraiment "+((id[2]==0)?"dés":"")+"activer cet inspecteur?");
	}

});//ONCLICK

$('#new-inspecteur').on('click', function(){
	
	loadform(0,0,0,'inspecteur','inspecteur de poids','');
});

$('.form-inspecteur select[name="quartier"]').on('change', function(e){
	
	if($('.form-inspecteur select[name="quartier"]').val()==0)
		loadform(0,0,'inspecteur','quartier','quartier','');

});

///*
$('.form-inspecteur').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-inspecteur').serialize();

	$.ajax({

		url: './models/Process_inspecteur_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==2)
				mssg(lang,12,"Le matricule "+response[1]+" existe déjà!");
			else if(response[0]==1)
				mssg(lang,12,"La ville du site d'affectation est différente de la ville de l'inspecteur !");
			else if(response[0]==0){
				$('#modal-inspecteur').modal('hide');
				loadinspecteurs();
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