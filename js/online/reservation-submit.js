/* must apply only after HTML has loaded */

  $(document).ready(function() {

	loadselect('PONT BASCULE / SITE D\'EMPOTAGE','Get_oper_ponts_model','#site',0);
	loadreservations(1);

  });



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

$('#frm-reserv').on('submit', function(e){
		
	e.preventDefault();

    var postdata = $(this).serialize();

	$('.button-reservation').prop('disabled',true)
	$('.reserv').prop('disabled',true)

	$.ajax({

		url: './models/Post_reserv_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			$('.button-reservation').prop('disabled',false);
			
			if(response[0]==0){
				$('#frm-confirm input[name="action"]').val('confirmer');
				$('#frm-confirm input[name="site"]').val(response[6]);
				$('#frm-confirm input[name="plage"]').val(response[7]);
				$('#frm-confirm input[name="date_reserv"]').val(response[8]);
				$('#frm-confirm input[name="fullname"]').val(response[9]);
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
			
			$('.button-reservation').prop('disabled',false)
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
 
 
 