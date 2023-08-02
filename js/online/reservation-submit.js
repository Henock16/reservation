/* must apply only after HTML has loaded */

  $(document).ready(function() {

<<<<<<< HEAD
	loadselect('PONT BASCULE / SITE D\'EMPOTAGE','Get_oper_ponts_model','#site',0);
	loadreservations(1);

  });



=======
  	loadponts();
	loadreservations(1);

//   $('#datepicker').datepicker({
//     dateFormat: 'dd/mm/yy',
//     startDate: '-3d'
//   	});

  });

function loadponts(){

	$.ajax({
		url: './models/Get_ponts.php',
		type: 'post',
		data: '&deco=1',
		dataType: 'text',
		success : function(response){
			$('#site').html(response);
		}
	});
}
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
function loadreservations(page){
	
	$.ajax({
		url: 'models/Post_reserv_model.php',
		type: 'post',
		data: "&action=afficher&page="+page,
		dataType: 'json',
		success : function(response){

			if(response[0]==0){
				$('#table-content').css('display','none');
				$('#message-content').css('display','block');
				$('#message-content').removeClass().addClass(response[1]);
				$('#message-title').html(response[2]);
				$('#message-text').html(response[3]);
				$('#confirm_button').css('display','none');
			}else{
				$('#table-content').html(response[1]);
				$('#table-content').css('display','block');
				$('#message-content').css('display','none');
			}
		},
		error: function(jqXHR, status, error) {
			
 			alert("Erreur detectee lors du chargement des reservations : "+error);
 		}//ERROR
 	});	
 }

<<<<<<< HEAD
=======
// $("#modal_avis").on("hidden.bs.modal",function(e){

// 	$("#accord_oui").prop("checked",false);
// 	$("#accord_non").prop("checked",false);

// 	$("#button_fermer").prop("disabled",false);
// 	$("#button_accord").prop("disabled",true);

// 	$("#modal_accord").modal("show");
// })


// $('#accord_oui').on('change', function(e){
// 	    if($('#accord_oui').is(":checked")){
// 		$("#accord_non").prop("checked",false);

// 		$("#button_fermer").prop("disabled",true);
// 		$("#button_accord").prop("disabled",false);
// 	    }else{
// 		$("#button_fermer").prop("disabled",false);
// 		$("#button_accord").prop("disabled",true);
// 	    }
// 	});

	// $('#accord_non').on('change', function(e){
	//     if($('#accord_non').is(":checked")){
	// 	$("#accord_oui").prop("checked",false);
	// 	$("#button_accord").prop("disabled",true);

	// 	$("#button_fermer").prop("disabled",false);
	//     }else{
	// 	$("#button_fermer").prop("disabled",true);
	//     }
	// });

    // $("#button_valider").on("click", function() {

	// //5$("#button_accord").prop("disabled",true);
	// //$("#modal_accord").modal("show");

    // });

//     $("#button_fermer").on("click", function() {
// //	$("#deconnexion").submit();
// 	//$("#modal_accord").modal("hide");
// 	$("#modal_info").modal("show");
//     });

    //  $("#modal_info").on("hidden.bs.modal",function(e){
	// $("#deconnexion").submit();
    // });


    $("#button_accord").on("click", function() {
	//$("#modal_accord").modal("hide");
	    $.ajax({
				url: 'models/accord.php',
				type: 'post',
				data: '&accord=1',
				dataType: 'text',
				success : function(){
				},
				error: function(jqXHR, status, error) {
//					alert("Erreur de connexion Internet: \n\n" + error);
				}
			});
    });

>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
$('#frm-reserv').on('submit', function(e){
		
	e.preventDefault();

    var postdata = $(this).serialize();

<<<<<<< HEAD
	$('.button-reservation').prop('disabled',true)
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
	$('.reserv').prop('disabled',true)

	$.ajax({

		url: './models/Post_reserv_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){
<<<<<<< HEAD

			$('.button-reservation').prop('disabled',false);
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			
			if(response[0]==0){
				$('#frm-confirm input[name="action"]').val('confirmer');
				$('#frm-confirm input[name="site"]').val(response[6]);
				$('#frm-confirm input[name="plage"]').val(response[7]);
				$('#frm-confirm input[name="date_reserv"]').val(response[8]);
<<<<<<< HEAD
				$('#frm-confirm input[name="fullname"]').val(response[9]);
=======
				$('#frm-confirm input[name="fullname"]').val(response[8]);
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
				$('#frm-confirm input[name="fonction"]').val(response[10]);
				$('#frm-confirm input[name="tel"]').val(response[11]);
								
			}else{
				$('#frm-confirm input[name="action"]').val('');
				$('.reserv').prop('disabled',false)
			}
			
			$('#table-content').css('display','none');
			$('#message-content').css('display','block');
			$('#message-content').removeClass().addClass(response[1]);
			$('#message-title').html(response[2]);
			$('#message-text').html(response[3]);
			$('#confirm_button').css('display','block');
			$('#confirm_button').removeClass().addClass(response[4]);
			$('#confirm_button').val(response[5]);

		},//SUCCESS
		error: function(jqXHR, status, error) {
			
<<<<<<< HEAD
			$('.button-reservation').prop('disabled',false)
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
			$('.reserv').prop('disabled',false)

			alert("Erreur detectee lors de la reservation : "+error);
		}//ERROR
		
	});//AJAX
	
});


$('#close_alert').on('click', function(e){

		$('#message-content').css('display','none');
		$('.reserv').prop('disabled',false)

		loadreservations(1);
	
});


$('#frm-confirm').on('submit', function(e){

	e.preventDefault();

	if($('#frm-confirm input[name="action"]').val()!='confirmer'){
		
		$('.reserv').prop('disabled',false)
		loadreservations(1);

	}else{

		var postdata = $(this).serialize();

		$.ajax({

			url: './models/Post_reserv_model.php',
			type: 'POST',
			data: postdata,
			dataType: 'json',
			success : function(response){
				
				if(response[0]==0){
					$('#frm-confirm input[name="action"]').val('');
					$('#frm-confirm input[name="site"]').val('');
					$('#frm-confirm input[name="plage"]').val('');
					$('#frm-confirm input[name="date_reserv"]').val('');
					$('#frm-confirm input[name="fullname"]').val('');
					$('#frm-confirm input[name="fonction"]').val('');
					$('#frm-confirm input[name="tel"]').val('');
					
					$('#table-content').css('display','none');
					$('#message-content').css('display','block');
					$('#message-content').removeClass().addClass(response[1]);
					$('#message-title').html(response[2]);
					$('#message-text').html(response[3]);
					$('#confirm_button').css('display','block');
					$('#confirm_button').removeClass().addClass(response[4]);
					$('#confirm_button').val(response[5]);
					
					//$('#frm-reserv')[0].reset();
				}else{
					alert("Erreur detectee lors de la confirmation de la reservation : "+response);					
					loadreservations(1);
				}
				
				$('.reserv').prop('disabled',false)

			},//SUCCESS
			error: function(jqXHR, status, error) {
				
				$('.reserv').prop('disabled',false)

				alert("Erreur detectee lors de la confirmation de la reservation : "+error);
			}//ERROR
			
		});//AJAX
		
	}
	
});

function delreservations(id,page){
	
	$.ajax({
		url: 'models/Post_reserv_model.php',
		type: 'post',
		data: "&action=annuler&id="+id+"&page="+page,
		dataType: 'json',
		success : function(response){

			if(response[0]==0){
				loadreservations(page);
			}else{
				alert("Erreur detectee lors de la suppression de la reservation : "+response);
			}
		},
		error: function(jqXHR, status, error) {
			
			alert("Erreur detectee lors de la suppression de la reservation : "+error);
		}//ERROR
	});
	
	
 }
<<<<<<< HEAD
 
 
 
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
