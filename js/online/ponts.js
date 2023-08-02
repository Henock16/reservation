$(document).ready(function(){

    $(".table-ponts").DataTable({
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


 loadponts();

});
//END FUNCTION


function loadponts(){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_ponts_model.php',
        type: 'POST',
		data: 'statut=1',
        success : function(response){

            hideloader();

            $('.table-ponts').DataTable().clear().draw(false);

            if(response[0] != 0)
				mssg(lang,18,response);
            else if(response[1] > 0){

                var j = 3,
                    actif = '',
                    modif = '';

                for(var i = 0; i < response[1]; i++){
   
					if(response[j+2]==0)
						actif = '<button class="btn btn-danger button-ponts" name="'+response[j]+'_3_'+response[j+2]+'" title="Désactiver" style="color: white;"><i class="mdi mdi-cancel"></i></button>'; 
					else
						actif = '<button class="btn btn-success button-ponts" name="'+response[j]+'_3_'+response[j+2]+'" title="Activer" style="color: white;"><i class="mdi mdi-check"></i></button>'; 
					
					if(response[j+2]==0)
						modif = '<button class="btn btn-warning button-ponts" name="'+response[j]+'_2_'+response[j+2]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>';
					else
						modif='';
 
                    $('.table-ponts').DataTable().row.add([
<<<<<<< HEAD
                        '<label class="badge bg-'+statuscolor((response[j+2]==0)?3:5)+'" style="color:white;border-radius: 5px;height: 20px;padding-top: 3px">'+Statut(response[j+2])+'</label>',
                        response[j+4],
                        '<span style="color:'+villecolor(response[j+5])+'">'+TypePont(response[j+5])+'</span> ',
                        response[j+3],
                        '<b>'+response[j+1]+'</b>',
                        response[j+6],
                        '<span style="color:'+villecolor(response[j+7])+'">'+Ville(response[j+7])+'</span> ',
=======
                        '<label class="badge badge-'+statuscolor((response[j+2]==0)?3:5)+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+Statut(response[j+2])+'</label>',
                        response[j+4],
                        '<span class="text-'+statuscolor(response[j+5])+'">'+TypePont(response[j+5])+'</span> ',
                        response[j+3],
                        '<b>'+response[j+1]+'</b>',
                        response[j+6],
                        '<span class="text-'+statuscolor(response[j+7])+'">'+Ville(response[j+7])+'</span> ',
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
 						'<span style="white-space:nowrap">'+actif+' '+modif+'</span>',
                        '<button class="btn btn-info button-ponts" name="'+response[j]+'_1_'+response[j+2]+'" title="Détails" style="color: white;"><i class="mdi mdi-magnify-plus"></i></button>' //&nbsp;details
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
$('.table-ponts').on('click','.button-ponts', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==1 || id[1]==2){

		showloader() ;

		$.ajax({

			url: './models/Get_pont_details_model.php',
			type: 'POST',
			data: 'id='+id[0]+'&action='+id[1]+'&statut='+id[2],
			dataType: 'json',
			success : function(response){

				hideloader();

				if(response[0]!=1)
					mssg(lang,8,response[0]);
				else if(id[1]==1 || id[1]==2)//DETAILS //MODIFICATION
					loadform(id[0],id[1],id[2],'pont','site de pesée',response);

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
	
	}else if(id[1]==3){
		
		Confirmation(id[0],id[1],id[2],'Process_pont_model',"table-ponts","Voulez-vous vraiment "+((id[2]==0)?"dés":"")+"activer ce site?");
	}

});//ONCLICK

$('#new-pont').on('click', function(){
	
	loadform(0,0,0,'pont','site de pesée','');
});


$('.form-pont select[name="struct"]').on('change', function(e){
	
	if($('.form-pont select[name="struct"]').val()==0)
		loadform(0,0,'pont','structure','structure','');

});

<<<<<<< HEAD
$('.form-pont select[name="quartier"]').on('change', function(e){
	
	if($('.form-pont select[name="quartier"]').val()==0)
		loadform(0,0,'pont','quartier','quartier','');

});
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643

///*
$('.form-pont').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-pont').serialize();

	$.ajax({

		url: './models/Process_pont_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==2)
				mssg(lang,12,"Le code "+response[1]+" existe déjà!");
			else if(response[0]==1)
				mssg(lang,12,"Le nom "+response[1]+" existe déjà!");
			else if(response[0]==0){
				$('#modal-pont').modal('hide');
				loadponts();
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