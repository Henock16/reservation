
$("#new-suggestion").on('click', function(e) {
	
    $('.form-suggestion')[0].reset();
		
	$(".suggestion-field").prop("disabled",false);
	$("#anonymat").css("display","none");
	$("#numero-suggestion").css("display","none");
    get_request_reason(e,-1,0,8);
	$("#submit-suggestion").css("display","block");
	
	$("#modal-suggestion").modal("show");

});


$("#submit-suggestion").on('click', function() {

    if($('.form-suggestion select[name="type"]').val()==null)
        mssg(lang,12,4);
	else if($('#suggestion-details input[name="title"]').val()=="")
        mssg(lang,27,1);
    else if($('#suggestion-details textarea[name="message"]').val()=="")
        mssg(lang,27,2);
	else
		$(".form-suggestion").submit();

});

$(".form-suggestion").on('submit', function(e) {
	
	e.preventDefault();

	showloader();

    var postdata = $(this).serialize();

	$.ajax({
		   
        url: './models/offline/Users_add_suggestions_model.php',
        type: 'POST',
		data: postdata,
        dataType: 'json',
        success : function(response){

            hideloader();

			if(response[0] == 0){

				$("#modal-suggestion").modal("hide");
				
				mssg(lang,15,0);

				loadsuggestions();

            }//ENF IF

        },//END SUCCES
        error: function(jqXHR, status, error) {
            hideloader();
            mssg(lang,70,error);
        }
    });//END AJAX

});


