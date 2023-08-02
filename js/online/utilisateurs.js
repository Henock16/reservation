$(document).ready(function(){

    $(".table-users").DataTable({
        autoWidth: true,
        ordering:  false,
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: nbreserv,
<<<<<<< HEAD
        columnDefs: [
            { "visible": false, "targets": 0 },
        ],
		createdRow: function( row, data, dataIndex){
               if( data[0] ==  1  ){
                    $(row).css({"background-color":"#dd3333"});
                }
		},
        dom: 'Bfrtip',
		buttons: [{extend:'copyHtml5',text:'Copier',titleAttr: 'Copier le contenu du tableau'},
				  {extend:'csv',text:'CSV',titleAttr: 'Télécharger le tableau au format CSV'},
				  {extend:'excel',text:'Excel',titleAttr: 'Télécharger le tableau au format Excel'},
				  {extend:'pdf',text:'PDF',titleAttr: 'Télécharger le tableau au format PDF'},
				  {extend:'print',text:'Imprimer',titleAttr: 'Imprimer le tableau'}],
=======
		createdRow: function( row, data, dataIndex){
               if( data[1] ==  'JOUR'  ){
                    $(row).css({"background-color":"#dddd33"});
                }
		},
        dom: 'Bfrtip',
		buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
    });


 loadusers();

});
//END FUNCTION


function loadusers(){
	
	showloader() ;

	$.ajax({
		   
        url: './models/Get_users_model.php',
        type: 'POST',
		data: 'statut=1',
        success : function(response){

            hideloader();

            $('.table-users').DataTable().clear().draw(false);

            if(response[0] != 0)
				mssg(lang,18,response);
            else if(response[1] > 0){

                var j = 3,
<<<<<<< HEAD
                    block = '',
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                    reini = '',
                    renou = '',
                    actif = '',
                    modif = '';

                for(var i = 0; i < response[1]; i++){
   
<<<<<<< HEAD
					if(response[j+8]==0)
						block='<button class="btn btn-dark button-users" name="'+response[j]+'_6_'+response[j+8]+'" title="Bloquer" style="color: white;"><i class="mdi mdi-cancel"></i></button>'; 
					else
						block='<button class="btn btn-dark button-users" name="'+response[j]+'_6_'+response[j+8]+'" title="Débloquer" style="color: white;"><i class="mdi mdi-check"></i></button>'; 

=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
 					renou=((response[j+2]==0 && response[j+3]!=0)?'<button class="btn btn-primary button-users" name="'+response[j]+'_5_'+response[j+2]+'" title="Renouveler la connexion" style="color: white;"><i class="mdi mdi-history"></i></button>':'');

 					reini=((response[j+2]==0 && response[j+3]==1)?'<button class="btn btn-secondary button-users" name="'+response[j]+'_4_'+response[j+2]+'" title="Réinitialiser le mot de passe" style="color: white;"><i class="mdi mdi-key"></i></button>':'');

					if(response[j+2]==0)
						actif='<button class="btn btn-danger button-users" name="'+response[j]+'_3_'+response[j+2]+'" title="Désactiver" style="color: white;"><i class="mdi mdi-cancel"></i></button>'; 
					else
						actif='<button class="btn btn-success button-users" name="'+response[j]+'_3_'+response[j+2]+'" title="Activer" style="color: white;"><i class="mdi mdi-check"></i></button>'; 
					
					modif=((response[j+2]==0)?'<button class="btn btn-warning button-users" name="'+response[j]+'_2_'+response[j+2]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>':'');
 
                    $('.table-users').DataTable().row.add([
<<<<<<< HEAD
						response[j+8],
                        '<label class="badge bg-'+statuscolor((response[j+2]==0)?3:5)+'" style="color:white;border-radius: 5px;height: 20px;padding-top: 3px">'+Statut(response[j+2])+'</label>',
                        '<label class="badge badge-'+statuscolor(response[j+3])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+Connexion(response[j+3])+'</label>',
                        '<label class="badge badge-'+statuscolor(response[j+4])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+TypeUser(response[j+4])+'</label>',
                        '<b>'+response[j+5]+'</b>',
                        response[j+1],
                        '<label class="badge badge-'+statuscolor(response[j+6])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+TypeOperateur(response[j+6])+'</label>',
                        '<span style="color:'+villecolor(response[j+7])+'">'+Ville(response[j+7])+'</span>',
 						'<span style="white-space:nowrap">'+block+' '+actif+' '+modif+' '+renou+' '+reini+'</span>',
=======
                        '<label class="badge badge-'+statuscolor((response[j+2]==0)?3:5)+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+Statut(response[j+2])+'</label>',
                        '<label class="badge badge-'+statuscolor(response[j+3])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+Connexion(response[j+3])+'</label>',
                        '<label class="badge badge-'+statuscolor(response[j+4])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+TypeUser(response[j+4])+'</label>',
                        '<b>'+response[j+1]+'</b>',
                        response[j+5],
                        '<label class="badge badge-'+statuscolor(response[j+6])+'" style="border-radius: 5px;height: 20px;padding-top: 3px">'+TypeOperateur(response[j+6])+'</label>',
                        '<span class="text-'+statuscolor(response[j+7])+'">'+Ville(response[j+7])+'</span>',
 						'<span style="white-space:nowrap">'+actif+' '+modif+' '+renou+' '+reini+'</span>',
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                        '<button class="btn btn-info button-users" name="'+response[j]+'_1_'+response[j+2]+'" title="Détails" style="color: white;"><i class="mdi mdi-magnify-plus"></i></button>' //&nbsp;details
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
$('.table-users').on('click','.button-users', function(){
	
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");

    if(id[1]==1 || id[1]==2){

		showloader() ;

		$.ajax({

			url: './models/Get_user_details_model.php',
			type: 'POST',
			data: 'id='+id[0]+'&action='+id[1]+'&statut='+id[2],
			dataType: 'json',
			success : function(response){

				hideloader();

				if(response[0]!=1)
					mssg(lang,8,response[0]);
				else if(id[1]==1 || id[1]==2)//DETAILS //MODIFICATION

					loadform(id[0],id[1],id[2],'user','compte d\'utilisateur',response);

			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				mssg(lang,9,error);
			}//ERROR
		});//AJAX
	
<<<<<<< HEAD
	}else if(id[1]==3 || id[1]==4 || id[1]==5 || id[1]==6){
		
		Confirmation(id[0],id[1],id[2],'Process_user_model',"table-users","Voulez-vous vraiment "+((id[1]==5)?"renouveler la connexion à":((id[1]==4)?"réinitialiser le mot de passe de":((id[1]==5)?((id[2]==0)?"dés":"")+"activer":((id[2]==0)?"":"dé")+"bloquer")))+" ce compte d\'utilisateur?");
=======
	}else if(id[1]==3 || id[1]==4 || id[1]==5){
		
		Confirmation(id[0],id[1],id[2],'Process_user_model',"table-users","Voulez-vous vraiment "+((id[1]==5)?"renouveler la connexion à":((id[1]==4)?"réinitialiser le mot de passe de":((id[2]==0)?"dés":"")+"activer"))+" ce compte d\'utilisateur?");
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
	}

});//ONCLICK

$('#new-user').on('click', function(){
		
	loadform(0,0,0,'user','compte d\'utilisateur','');
});

$('.form-user select[name="type"]').on('change', function(e){

	var none=($('.form-user select[name="type"]').val()=='');
	var oper=($('.form-user select[name="type"]').val()==2);
	$('.form-user select[name="struct"]').prop('disabled',oper?false:true);
	$('.form-user select[name="struct"]').val((oper || none)?'':5);
	$('.form-user input[name="login"]').prop('readonly',(oper || none)?true:false);
	$('.form-user input[name="login"]').val(oper?'':'');
});


$('.form-user select[name="struct"]').on('change', function(e){
	
	if($('.form-user select[name="struct"]').val()==0)
		loadform(0,0,'user','structure','structure','');
<<<<<<< HEAD
	else if($('.form-user input[name="action-id"]').val()==0)
=======
	else
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
		setlogin($('.form-user select[name="struct"] option:selected').html());
});

function setlogin(login){
			
	login=login.replace("'","").replace(" ","").replace("/","").replace("(","").replace(")","");
	login=login.slice(0,8).toLowerCase();
		
	login+=$('.form-user input[name="numero"]').val();
	$('.form-user input[name="login"]').val(login);

}

///*
$('.form-user').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-user').serialize();

	$.ajax({

		url: './models/Process_user_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==1)
				mssg(lang,12,"L'utilisateur "+response[1]+" existe deja !");
			else if(response[0]==0){
				$('#modal-user').modal('hide');
				loadusers();
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