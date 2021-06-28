$(document).ready(function(){

    $(".table-feries").DataTable({
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


 loadferies();

});
//END FUNCTION


function loadferies(){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_feries_model.php',
        type: 'POST',
		data: 'statut=1',
        success : function(response){

            hideloader();

            $('.table-feries').DataTable().clear().draw(false);

            if(response[0] != 0)
				mssg(lang,18,response);
            else if(response[1] > 0){

                var j = 2,
                    modif = '',
                    suppr = '';

                for(var i = 0; i < response[1]; i++){
   					
					modif = '<button class="btn btn-warning button-feries" name="'+response[j]+'_2_'+response[j+4]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>';
 					suppr = '<button class="btn btn-danger button-feries" name="'+response[j]+'_3_'+response[j+4]+'" title="Supprimer" style="color: white;"><i class="mdi mdi-cancel"></i></button>';
 
                    $('.table-feries').DataTable().row.add([
                        '<center><label class="badge badge-'+statuscolor(response[j+1])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+JourFerie(response[j+1])+'</label></center>',
                        '<b>'+response[j+2]+'</b>',
                        response[j+3],
 						'<span style="white-space:nowrap">'+modif+' '+suppr+'</span>'
                    ]).columns.adjust().draw(false);
                    j += 5;
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
$('.table-feries').on('click','.button-feries', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==2){

		showloader() ;

		$.ajax({

			url: './models/Get_ferie_details_model.php',
			type: 'POST',
			data: 'id='+id[0]+'&action='+id[1]+'&statut='+id[2],
			dataType: 'json',
			success : function(response){

				hideloader();

				if(response[0]!=1)
					mssg(lang,8,response[0]);
				else if(id[1]==2)//DETAILS //MODIFICATION
					loadform(id[0],id[1],id[2],'ferie','jour férié',response);

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
	
	}else if(id[1]==3){
		
		Confirmation(id[0],id[1],id[2],'Process_ferie_model',"table-feries","Voulez-vous vraiment supprimer ce jour férié?");
	}

});//ONCLICK

$('#new-ferie').on('click', function(){
	
	loadform(0,0,0,'ferie','jour férié','');
});

$('.form-ferie input[name="type"]').on('change', function(e){

	var type=['','Le lendemain de la nuit du destin','La fête de fin du Ramadan','La fête de la Tabaski','Le lendemain de la naissance du Prophète Mahomet'];
	var nom='';
	for(var i=0;i<=type.length;i++)
	   nom=($('#type'+i).prop('checked')?type[i]:nom);

	$('.form-ferie input[name="nom"]').prop('readonly',($('#type0').prop('checked')?false:true));
	$('.form-ferie input[name="nom"]').val(nom);
	
//$("#regime3").is(":checked")
});

///*
$('.form-ferie').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-ferie').serialize();

	$.ajax({

		url: './models/Process_ferie_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==2)
				mssg(lang,12,"Le même jour férié existe déjà pour la même année le "+response[1]+"!");
			else if(response[0]==1)
				mssg(lang,12,response[1]+" existe déjà à la même date!");
			else if(response[0]==0){
				$('#modal-ferie').modal('hide');
				loadferies();
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