
$(document).ready(function(){
 
	$('.datepicker-naissance').datetimepicker({
		language: 'fr',
		weekStart: 1,
		format: 'dd/mm/yyyy',
		autoclose: true,
		todayBtn:  false,
		todayHighlight: true,
		startView: 2,
		forceParse: true,
		minView: 2,
	});

	$('.datepicker-embauche').datetimepicker({
		language: 'fr',
		weekStart: 1,
		daysOfWeekDisabled: [6,0],
		format: 'dd/mm/yyyy',
		autoclose: true,
		todayBtn:  false,
		todayHighlight: true,
		startView: 2,
		forceParse: true,
		minView: 2,
	});

});


$("#forgotten-password").on('click', function(e) {

	get_ForgottenPassword_question('&matr=&test=0&champ=&result=');	
	
	$('#answer').css('display','block');
	$('.naissance').css('display','none');			
	$('.naissance').prop('disabled',true)
	$('.embauche').css('display','none');
	$('.embauche').prop('disabled',true)
	$('.next').css('display','block');			
	$('.end').css('display','none');			
	$("#modal-ForgottenPassword").modal("show");

});

$("#form-ForgottenPassword").on('submit', function(e){

	e.preventDefault();

	get_ForgottenPassword_question($(this).serialize());	
	
});

function get_ForgottenPassword_question(postData){

  showloader() ;

  $.ajax({

      url: './models/offline/Get_ForgottenPassword_question_model.php',
      type: 'POST',
      data: postData,
      dataType: 'json',
      success: function(response){
		  hideloader();
          if(response[0] > 0){

			$('#test').val(response[0]);
			$('#matr').val(response[1]);
			$('#champ').val(response[2]);
			$('#result').val(response[3]);
			$('#request').html(response[4]);

			if(response[5]=='datenaissance'){
				$('#answer').css('display','none');
				$('#answer').html('');
				$('.naissance').css('display','block');
				$('.naissance').prop('disabled',false)
				$('form-ForgottenPassword input[name="datenaissance"]').val('');
			}else if(response[5]=='dateembauche'){
				$('#answer').css('display','none');
				$('#answer').html('');
				$('.embauche').css('display','block');
				$('.embauche').prop('disabled',false)
				$('#form-ForgottenPassword input[name="dateembauche"]').val('');
			}else{
				$('#answer').css('display','block');
				$('#answer').html(response[5]);
				$('.naissance').css('display','none');
				$('.naissance').prop('disabled',true)
				$('.embauche').css('display','none');
				$('.embauche').prop('disabled',true)
			}
						
          }else if(response[0] == 0){
			mssg(lang,4,response[1]);          
          }else if(response[0] == -1){
			$('#request').html(response[4]);
			$('#answer').html(response[5]);			
			$('.next').css('display','none');			
			$('.end').css('display','block');			
          }else
			mssg(lang,3,0);
      },
     error: function(jqXHR, status, error){
			hideloader();
			mssg(lang,2,0);
     }
  });
}