
///*
$('.form-structure').on('submit', function(e){

	e.preventDefault();

	showloader() ;

    var postdata = $('.form-structure').serialize();

	$.ajax({

		url: './models/Process_structure_model.php',
		type: 'POST',
		data: postdata,
		dataType: 'json',
		success : function(response){

			hideloader();

			if(response[0]==1)
				mssg(lang,12,'La structure '+response[1]+" existe déjà !");
			else if(response[0]==0){
				$('#modal-structure').modal('hide');
				loadselect('STRUCTURE','Get_structures_model','.form-'+$('.form-structure input[name="origine"]').val()+' select[name="struct"]',response[1]);
				if($('.form-structure input[name="origine"]').val()=='user')
						setlogin(response[2]);
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