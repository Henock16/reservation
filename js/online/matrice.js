/* must apply only after HTML has loaded */

$(document).ready(function() {

	loadmois('Get_mois_model','#form-matrice select[name="mois"]',((typuser==6)?1:0));
    

	if(typuser==6){	//superviseurs	
		$('#matrice-type').css('display','none');
		$('#matrice-superviseur').css('display','none');
		$('#form-matrice select[name="superviseur"]').prop('disabled',true);
        $('#superviseur').css('display','none');
        $('.superviseur').css('display','none');
        $('#form-search').css('display','none');
        loadselect('SEMAINE','Get_semainesapercçu_model','#frm-apercu select[name="sem"]',0);
	}else{		 //admin type =3
		$('#matrice-type').css('display','block');
		$('#matrice-semaine').css('display','none');
		$('#matrice-superviseur').css('display','none');
        $('#semaineap').css('display','none');
        $('#button-apercu').css('display','none');
		$('#form-matrice select[name="superviseur"]').prop('disabled',true);
		loadselect('SUPERVISEUR','Get_superviseurs_model','#form-matrice select[name="superviseur"]',0);
        $('#frm-super select[name="superviseur"]').prop('required',true);
        loadselect('SUPERVISEUR','Get_superviseurs_model','#frm-super select[name="superviseur"]',0);
        loadselect('SUPERVISEUR','Get_superviseurs_model','#form-search select[name="superviseur"]',0);
        loadmois('Get_mois_model','#form-search select[name="mois"]',1);

        
	}

});



$('#matrice').on('click', function(){

	$('#modal-matrice').modal('show');		


});//ONCLICK

////pour la matrice
$('#form-matrice select[name="type"]').on('change', function(){

	$('#matrice-semaine').css('display',($('#form-matrice select[name="type"]').val()==1)?'block':'none');
    $('#btn-excel').css('display',($('#form-matrice select[name="type"]').val()==1)?'none':'block');
	$('#matrice-superviseur').css('display',($('#form-matrice select[name="type"]').val()==1)?'block':'none');
	$('#form-matrice select[name="superviseur"]').prop('disabled',($('#form-matrice select[name="type"]').val()==1)?false:true);
	loadmois('Get_mois_model','#form-matrice select[name="mois"]',(($('#form-matrice select[name="type"]').val()==1)?1:0));
});//


function loadmois(model,list,typ){

	showloader() ;

	$.ajax({

		url: './models/'+model+'.php',
		type: 'POST',
		data: "&type="+typ,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]!=0)
				mssg(lang,15,response[0]);
			else{
				var j = 3;
				var options = "";
				for(var i = 0; i < response[1]; i++){
					options += "<option value=\""+response[j]+"\" "+((i==0)?"selected=\"selected\"":"")+">"+response[j+1]+"</option>";							
					j += response[2];
				}
				
				$(list).html(options);

				if((typuser==6)||($('#form-matrice select[name="type"]').val()==1))
				    loadsemaine('Get_semaines_model','#form-matrice select[name="semaine"]',$('#form-matrice select[name="mois"]').val());
                    else
                    loadsemaine('Get_semaines_model','#form-search select[name="semaine"]',$('#form-search select[name="mois"]').val());

			}
		},//SUCCESS
		error: function(jqXHR, status, error) {
			hideloader();
			mssg(lang,14,error);
		}//ERROR
	});//AJAX
}
$('#form-search select[name="mois"]').on('change', function(){

	if((typuser==3))
	loadsemaine('Get_semaines_model','#form-search select[name="semaine"]',$('#form-search select[name="mois"]').val());
});//

$('#form-matrice select[name="mois"]').on('change', function(){

	if((typuser==6)||($('#form-matrice select[name="type"]').val()==1))
	loadsemaine('Get_semaines_model','#form-matrice select[name="semaine"]',$('#form-matrice select[name="mois"]').val());
});//

function loadsemaine(model,list,mois){

	showloader() ;

	$.ajax({

		url: './models/'+model+'.php',
		type: 'POST',
		data: (mois==null)?"&mois="+$('#form-matrice select[name="mois"]').val():"&mois="+mois,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]!=0)
				mssg(lang,15,response[0]);
			else{
				var j = 3;
				var options = "";
				for(var i = 0; i < response[1]; i++){
					options += "<option value=\""+response[j]+"\" "+((i==response[1]-1)?"selected=\"selected\"":"")+">"+response[j+1]+"</option>";							
					j += response[2];
				}
				
				$(list).html(options);
			}
		},//SUCCESS
		error: function(jqXHR, status, error) {
			hideloader();
			mssg(lang,14,error);
		}//ERROR
	});//AJAX
}


$('#form-matrice').on('submit', function(e){

	e.preventDefault();
	
	type=$('#form-matrice select[name="type"]').val();
	mois=$('#form-matrice select[name="mois"]').val();
	semaine=$('#form-matrice select[name="semaine"]').val();
	superviseur=(((typuser==6)||($('#form-matrice select[name="type"]').val()==2))?'':$('#form-matrice select[name="superviseur"]').val());
	
	window.open('models/load_matrice.php?typeuser='+typuser+'&type='+type+'&mois='+mois+'&semaine='+semaine+'&superviseur='+superviseur+'');
 

});//
$('#btn-excel').on('click', function(e){
    e.preventDefault();
	
	type=$('#form-matrice select[name="type"]').val();
	mois=$('#form-matrice select[name="mois"]').val();
	semaine=$('#form-matrice select[name="semaine"]').val();
	superviseur=(((typuser==6)||($('#form-matrice select[name="type"]').val()==2))?'':$('#form-matrice select[name="superviseur"]').val());
	
	window.open('models/load_csv.php?typeuser='+typuser+'&type='+type+'&mois='+mois+'&semaine='+semaine+'&superviseur='+superviseur+'');
});

$('#form-search ').on('submit', function(e){

	e.preventDefault();
	
	mois=$('#form-search select[name="mois"]').val();
	semaine=$('#form-search select[name="semaine"]').val();
	superviseur=$('#form-search select[name="superviseur"]').val();
    var btnM=$('.button-modifier').hide();
    var btnA=$('.button-annuler').hide();
    showloader() ;

    $.ajax({
        url: 'models/Post_sup_model.php',
        type: 'post',
        data: '&action=afficher&typeuser='+typuser+'&sup='+superviseur+'&semaine='+semaine,
        dataType: 'json',
        success : function(response){
            hideloader();
            btnA;
            btnM;
            
            $('.table-super').DataTable().clear().draw(false);
            if(response[0]==0){
                var j = 2;
                  for(var i = 0; i < response[1]; i++){
                     $('.table-super').DataTable().row.add([
                        response[j+1],//IDENTIFIANT
                        response[j+2],//DATE
                        response[j+3],//ID_SUPERVISEUR
                        response[j+4],//SUPERVISEUR
                        response[j+5],//ID_INSP
                        response[j+6],//INSPECTEUR
                        (response[j+7]==1)?'JOUR':'NUIT',//PLAGE HORAIRE
                        response[j+8],//NBH
                        response[j+9],//DATE SERVER
                       '<button class="btn btn-warning button-modif" name="'+response[j]+'_1_'+response[j+1]+'_'+response[j+2]+'_'+response[j+3]+'_'+response[j+4]+'_'+response[j+5]+'_'+response[j+6]+'_'+response[j+7]+'_'+response[j+8]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'
                        +' '+
                        '<button class="btn btn-danger button-sup" name="'+response[j]+'_2_'+response[j+1]+'" title="Suprimer" style="color: white;"><i class="mdi mdi-delete"></i></button>'   
                    ]).columns.adjust().draw(false);
                    
                    j += response[2];
                }
            }
        },
        error: function(jqXHR, status, error) {
            
            alert("Erreur detectee lors du chargement des données : "+error);
        }//ERROR

});//
})

////////////////////////////2///////////////////////////////////////

/* must apply only after HTML has loaded */

$(document).ready(function(){
if(typuser==3){
    $(".table-super").DataTable({
        autoWidth: true,
        ordering:  false,
        searching:false,
        order: [[6,'desc'],[5,'desc']],
        info:false,
        paging:false,
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: 2,
		columnDefs: [
                { "visible": false, "targets": 0 },
               { "visible": false, "targets": 2 },
            //    { "visible": false, "targets": 3 },
               { "visible": false, "targets": 4 },
               { "visible": false, "targets": 7 },
               { "visible": false, "targets": 8 }
        ]
    });
}else
{
    $(".table-super").DataTable({
        autoWidth: true,
        ordering:  false,
        searching:false,
        order: [[6,'desc'],[5,'desc']],
        info:false,
        paging:false,
        language: {'url': 'vendors/datatables/French.json'},
        pageLength: 2,
		columnDefs: [
             { "visible": false, "targets": 0 },
             { "visible": false, "targets": 3 },
             { "visible": false, "targets": 4 },
               { "visible": false, "targets": 2 },
               { "visible": false, "targets": 7 },
               { "visible": false, "targets": 8 }
        ]
    });
}
loadselect('INSPECTEUR','Get_inspecteurs_model','#frm-super select[name="ins"]',0);
affiche(1);
});
///choix de la plage horaire avce chargeur auto des nombres d'heures de travailles
 $('#frm-super input[name="plagem"]').on("change",function(){
        ///on utilise cette option que si on veut afficher le text du radio
        // var selectext= $('.frm-super input[name="radio"]:checked').text();
        // $('#nbh').val(selectext);
        ///on utilise cette option que si on veut afficher la valeur du radio (son id ou une autres valeur de la bd
        var selValue = $('#frm-super input[name="plagem"]:checked').val()==1?'8':'11';
        $("#nbh").val(selValue);

    }).change();
//traitement formulaire du superviseur
 function affiche(page){
    var btnM=$('.button-modifier').hide();
    var btnA=$('.button-annuler').hide();
    showloader() ;
    $.ajax({
        url: 'models/Post_sup_model.php',
        type: 'post',
        data: '&action=afficher&page='+page+'&typeuser='+typuser,
        dataType: 'json',
        success : function(response){
            hideloader();
            btnA;
            btnM;
            
            $('.table-super').DataTable().clear().draw(false);
            if(response[0]==0){
                var j = 2;
                  for(var i = 0; i < response[1]; i++){
                     $('.table-super').DataTable().row.add([
                        response[j+1],//IDENTIFIANT
                        response[j+2],//DATE
                        response[j+3],//ID_SUPERVISEUR
                        response[j+4],//SUPERVISEUR
                        response[j+5],//ID_INSP
                        response[j+6],//INSPECTEUR
                        (response[j+7]==1)?'JOUR':'NUIT',//PLAGE HORAIRE
                        response[j+8],//NBH
                        response[j+9],//DATE SERVER
                       '<button class="btn btn-warning button-modif" name="'+response[j]+'_1_'+response[j+1]+'_'+response[j+2]+'_'+response[j+3]+'_'+response[j+4]+'_'+response[j+5]+'_'+response[j+6]+'_'+response[j+7]+'_'+response[j+8]+'" title="Modifier" style="color: white;"><i class="mdi mdi-lead-pencil"></i></button>'
                        +' '+
                        '<button class="btn btn-danger button-sup" name="'+response[j]+'_2_'+response[j+1]+'" title="Suprimer" style="color: white;"><i class="mdi mdi-delete"></i></button>'   
                    ]).columns.adjust().draw(false);
                    
                    j += response[2];
                }
            }
        },
        error: function(jqXHR, status, error) {
            
            alert("Erreur detectee lors du chargement des données : "+error);
        }//ERROR
    }); 
 }
$('#close_alert').on('click', function(e){

        $('#message-content').css('display','none');
        var show=$('#table-mat').show();
             location. reload(true);
    
});
///Désactiver le bouton valider après avoir cliqué dessus pendant 15 secondes 
$('#frm-confirm').on(function desactiverBouton() {
    var bouton = document.getElementById("confirm_button");
    bouton.setAttribute("disabled", "true");
    setTimeout(function() {
      bouton.removeAttribute("disabled");
    }, 15000);
  });

////submit formulaire

$('#frm-super').on('submit', function(e){
	
	e.preventDefault();
	var ins=$('#frm-super select[name="ins"]').val();
    var superviseur=$('#frm-super select[name="superviseur"]').val();
	var plagem=$('#frm-super input[name="plagem"]:checked').val();
	var date=$('#frm-super input[name="date"]').val();
	var nbh=$('#frm-super input[name="nbh"]').val();
    var hide=$('#table-mat').hide();
    var btnM=$('.button-modifier').hide();
    var btnA=$('.button-annuler').hide();
	showloader() ;
  
	$.ajax({

			url: './models/Post_sup_model.php',
			type: 'POST',
			data: '&action=inserer&ins='+ins+'&plagem='+plagem+'&date='+date+'&nbh='+nbh+'&typeuser='+typuser+'&superviseur='+superviseur,
			dataType: 'json',
			success : function(response){

				hideloader();
               hide;
               btnM;
               btnA;
				if(response[0]==0){
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    
                    $('#confirm_button').val(response[5]);
                    if(typuser==3)
                    {
                        $('#frm-confirm input[name="action"]').val('confirmer');
                    
                        $('#frm-confirm input[name="super"]').val(response[6]);
                        $('#frm-confirm input[name="ins"]').val(response[7]);
                        $('#frm-confirm input[name="plagem"]').val(response[8]);
                        $('#frm-confirm input[name="date"]').val(response[9]);
                        $('#frm-confirm input[name="nbh"]').val(response[10]);
                        $('#frm-confirm input[name="typecompte"]').val(typuser);
                    }else{
                    $('#frm-confirm input[name="action"]').val('confirmer');
                    
                    $('#frm-confirm input[name="ins"]').val(response[6]);
                    $('#frm-confirm input[name="plagem"]').val(response[7]);
                    $('#frm-confirm input[name="date"]').val(response[8]);
                    $('#frm-confirm input[name="nbh"]').val(response[9]);
                    $('#frm-confirm input[name="typecompte"]').val(typuser);
                }
				}else if(response[0]==1){
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                }
                else if(response[0]==3){
                    
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                }
                else
					
                $('#frm-confirm input[name="action"]').val('');
			},//SUCCESS
			error: function(jqXHR, status, error) {
				hideloader();
				 mssg(lang,9,error);

			}//ERROR
		});//AJAX
});	

//confirme


$('#frm-confirm').on('submit', function(e){

    e.preventDefault();

    if($('#frm-confirm input[name="action"]').val()!='confirmer'){
        
         $('#message-content').css('display','none');
        var show=$('#table-mat').show();
        showloader();
       location. reload(true);
    }else{

        var postdata = $(this).serialize();

        $.ajax({

            url: './models/Post_sup_model.php',
            type: 'POST',
            data: postdata,
            dataType: 'json',
            success : function(response){
                
                if(response[0]==0){
                    $('#frm-confirm input[name="id"]').val('');
                   $('#frm-confirm input[name="action"]').val('');
                   $('#frm-confirm input[name="super"]').val('');
                    $('#frm-confirm input[name="ins"]').val('');
                    $('#frm-confirm input[name="plagem"]').val('');
                    $('#frm-confirm input[name="date"]').val('');
                    $('#frm-confirm input[name="nbh"]').val('');
                    
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                    
                } else if(response[0]==1){
                    $('#frm-confirm input[name="id"]').val('');
                   $('#frm-confirm input[name="action"]').val('');
                   $('#frm-confirm input[name="super"]').val('');
                    $('#frm-confirm input[name="ins"]').val('');
                    $('#frm-confirm input[name="plagem"]').val('');
                    $('#frm-confirm input[name="date"]').val('');
                    $('#frm-confirm input[name="nbh"]').val('');
                    
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                }
                else if(response[0]==2){
                    $('#frm-confirm input[name="id"]').val('');
                    $('#frm-confirm input[name="action"]').val('');
                    $('#frm-confirm input[name="super"]').val('');
                    $('#frm-confirm input[name="ins"]').val('');
                    $('#frm-confirm input[name="plagem"]').val('');
                    $('#frm-confirm input[name="date"]').val('');
                    $('#frm-confirm input[name="nbh"]').val('');
                    
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);   
                }
                else{
                    alert("Erreur detectee lors de la confirmation ! ");                 
                    affiche(1);
                }

            },//SUCCESS
            error: function(jqXHR, status, error) {
                

                alert("Erreur detectee lors de la confirmation ");
            }//ERROR
            
        });//AJAX
        
    }
    
});

//Matrice fin	

///*
$('.table-super').on('click','.button-sup',function(){
	showloader();
	 var tr = $(this).closest('tr');
     var id = $(this).prop('name').split("_");
     var hide=$('#table-mat').hide();
   
     $.ajax({
		   
        url: './models/Post_sup_model.php',
        type: 'POST',
        data: '&idligne='+id[2]+'&action=suprimer',
        dataType: 'json',
        success : function(response){
           
            hideloader();

            
            if(response[0]==0){
                    $('#frm-confirm input[name="action"]').val('confirmer');
                    $('#frm-confirm input[name="id"]').val(id[2]);
                    hide;
            	    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                   
 				}
 				else
 					alert(response);
           },
           error: function(jqXHR, status, error) {
				hideloader();
				 mssg(lang,9,error);

			}//ERROR
       });

});
$('.table-super').on('click','.button-modif',function(){
	
    
    var tr = $(this).closest('tr');
    var id = $(this).prop('name').split("_");
    var hide=$('#table-mat').hide();
    var btn=$('.button-validate').hide();
    var btnM=$('.button-modifier').show();
    var btnA=$('.button-annuler').show();
    
     $.ajax({

            url: './models/Post_sup_model.php',
            type: 'POST',
            data: (typuser==3)?'&id_l='+id[2]+'&action=Affmodifier'+'&super='+id[4]+'&ins='+id[6]+'&plagem='+id[8]+'&date='+id[3]+'&nbh='+id[9]+'&typecompte='+typuser:'&id_l='+id[2]+'&action=Affmodifier'+'&super='+id[4]+'&ins='+id[6]+'&plagem='+id[8]+'&date='+id[3]+'&nbh='+id[9]+'&typecompte='+typuser,
            dataType: 'json',
            success : function(response){
                
                hideloader();
                btn;
                btnM;
                btnA;
                if(typuser==3)
                {
                    $('#frm-super input[name="id"]').val(id[2]);
                    // $('#frm-super select[name="super"]').prop('selectedIndex', response[1]);
                    $('#frm-super select[name="superviseur"]').val(response[1]);
                    $('#frm-super select[name="ins"]').val(response[2]);
                    (response[3]==1)?$('#frm-super input[name="plagem"][value="1"]').prop('checked', true):$('#frm-super input[name="plagem"][value="2"]').prop('checked', true);
                    $('#frm-super input[name="date"]').val(response[4]);
                    $('#frm-super input[name="nbh"]').val(response[5]);
                    $('#frm-confirm input[name="id"]').val(id[2]);
                    $('#frm-confirm input[name="super"]').val(response[1]);
                    $('#frm-confirm input[name="ins"]').val(response[2]);
                    $('#frm-confirm input[name="plagem"]').val(response[3]);
                    $('#frm-confirm input[name="date"]').val(response[4]);
                    $('#frm-confirm input[name="nbh"]').val(response[5]);
                    
                }else
                {
                    
                    $('#frm-super input[name="id"]').val(id[2]);
                    $('#frm-super select[name="ins"]').val(response[1]);
                    (response[2]==1)?$('#frm-super input[name="plagem"][value="1"]').prop('checked', true):$('#frm-super input[name="plagem"][value="2"]').prop('checked', true);
                    $('#frm-super input[name="date"]').val(response[3]);
                    $('#frm-super input[name="nbh"]').val(response[4]);
                    $('#frm-confirm input[name="id"]').val(id[2]);
                    $('#frm-confirm input[name="ins"]').val(response[1]);
                    $('#frm-confirm input[name="plagem"]').val(response[2]);
                    $('#frm-confirm input[name="date"]').val(response[3]);
                    $('#frm-confirm input[name="nbh"]').val(response[4]);
                   
                }
                    

                
            },//SUCCESS
            error: function(jqXHR, status, error) {
                hideloader();
                 mssg(lang,9,error);

            }//ERROR
        });//AJAX 
    

});
$('.button-modifier').on('click',function(){
   var hide=$('#table-mat').hide();
    var btn=$('.button-validate').hide();
    var btnM=$('.button-modifier').show();
    var btnA=$('.button-annuler').show();
    var btnannul=$('#annul_button').hide();
    var id = $('#frm-super input[name="id"]').val();
    var sup=  $('#frm-super select[name="superviseur"]').val();
    var ins=$('#frm-super select[name="ins"]').val();
    var plagem=$('#frm-super input[name="plagem"]:checked').val();
    var date=$('#frm-super input[name="date"]').val();
    var nbh=$('#frm-super input[name="nbh"]').val();
    
     $.ajax({

            url: './models/Post_sup_model.php',
            type: 'POST',
            data: '&action=modifier&id_l='+id+'&super='+sup+'&ins='+ins+'&plagem='+plagem+'&date='+date+'&nbh='+nbh+'&typecompte='+typuser,
            dataType: 'json',
            success : function(response){

                hideloader();
                btn;
                btnM;
                btnA;
                if(response[0]==2){
                    
                    hide;
                     $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    btnannul;
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                }else if(response[0]==1){
                    hide;
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                    btnannul;
                    $('#frm-confirm input[name="action"]').val('confirmer');
                    $('#frm-confirm input[name="id"]').val(id);
                    if(typuser==3)
                    {
                        $('#frm-confirm input[name="super"]').val(response[6]);
                        $('#frm-confirm input[name="ins"]').val(response[7]);
                        $('#frm-confirm input[name="plagem"]').val(response[8]);
                        $('#frm-confirm input[name="date"]').val(response[9]);
                        $('#frm-confirm input[name="nbh"]').val(response[10]);
                        $('#frm-confirm input[name="typecompte"]').val(response[11])


                    }else{
                    $('#frm-confirm input[name="ins"]').val(response[6]);
                    $('#frm-confirm input[name="plagem"]').val(response[7]);
                    $('#frm-confirm input[name="date"]').val(response[8]);
                    $('#frm-confirm input[name="nbh"]').val(response[9]);
                }
                }else if(response[0]==3){
                    hide;
                    $('#table-content').css('display','none');
                    $('#message-content').css('display','block');
                    $('#message-content').removeClass().addClass(response[1]);
                    $('#message-title').html(response[2]);
                    $('#message-text').html(response[3]);
                    btnannul;
                    $('#confirm_button').css('display','block');
                    $('#confirm_button').removeClass().addClass(response[4]);
                    $('#confirm_button').val(response[5]);
                }
                
            },//SUCCESS
            error: function(jqXHR, status, error) {
                hideloader();
                 mssg(lang,9,error);

            }//ERROR
        });//AJAX 
    

});
$('.button-annuler').on('click', function(e){

   e.preventDefault();
   showloader();
   location. reload(true);

});
/////////aperçu de la matrice ////
$('#button-apercu').on('click', function(e){

    e.preventDefault();
    const date = new Date(); // crée un objet Date représentant la date et l'heure actuelles
    const yearMonth = date.toISOString().slice(0, 7); // extrait les 7 premiers caractères de la chaîne ISO
	
	type=2;
	mois=yearMonth ;
	semaine=$('#frm-apercu select[name="sem"]').val();
	superviseur='';
	
	window.open('models/load_matrice.php?typeuser='+typuser+'&type='+type+'&mois='+mois+'&semaine='+semaine+'&superviseur='+superviseur+'');
 });


