
///*
$('.form-quartier').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-quartier').serialize();

	$.ajax({

		url: './models/Process_quartier_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==1)
				mssg(lang,12,'Le quartier '+response[1]+" existe déjà !");
			else if(response[0]==0){
				$('#modal-quartier').modal('hide');
				loadselect('QUARTIER','Get_quartiers_model','.form-'+$('.form-quartier input[name="origine"]').val()+' select[name="quartier"]',response[1]);
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