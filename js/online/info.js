 $(document).ready(function() {

	setTimeout(function(){

					var x=1;
		            $.ajax({
						url: './models/Annonce_model.php',
						type: 'POST',
						data: '&x='+x,
						dataType: 'json',
						success : function(data){
							
							if(data[0] == 0){

								if(data[1]!=''){
								
									$('#alert-annonce-title').html(data[1]);
									$('#alert-annonce-title').css("color","red");
									$('#annonce-image').prop('src','images/caution.png');
									$('#alert-annonce').html(data[2].replace("\n","<br>"),"");
									$("#modal-annonce").modal("show");
								}

								$('#bande-deroulante').html(data[2].replace("\n","<br>"),"");
							}
						}
					});

	}, 0*1000);

	if(accord>=0)
		$("#modal_avis").modal("show");
  });

$("#modal-annonce").on("hidden.bs.modal",function(e){

//	$("#logout").click();
});

$("#modal_avis").on("hidden.bs.modal",function(e){

	$("#accord_oui").prop("checked",false);
	$("#accord_non").prop("checked",false);

	$("#button_fermer").prop("disabled",false);
	$("#button_accord").prop("disabled",true);

//	$("#modal_accord").modal("show");
});


$('#accord_oui').on('change', function(e){
	    if($('#accord_oui').is(":checked")){
		$("#accord_non").prop("checked",false);

		$("#button_fermer").prop("disabled",true);
		$("#button_accord").prop("disabled",false);
	    }else{
		$("#button_fermer").prop("disabled",false);
		$("#button_accord").prop("disabled",true);
	    }
});

$('#accord_non').on('change', function(e){
	    if($('#accord_non').is(":checked")){
		$("#accord_oui").prop("checked",false);
		$("#button_accord").prop("disabled",true);

		$("#button_fermer").prop("disabled",false);
	    }else{
		$("#button_fermer").prop("disabled",true);
	    }
});


$("#button_fermer").on("click", function(){

	$("#modal_accord").modal("hide");
	$("#modal_info").modal("show");
});

$("#modal_info").on("hidden.bs.modal",function(e){

	$("#logout").click();
});


$("#button_accord").on("click", function(){

	$("#modal_accord").modal("hide");
	
	$.ajax({
				url: './models/Accord_model.php',
				type: 'post',
				data: '&accord=1',
				dataType: 'text',
				success : function(){
				},
				error: function(jqXHR, status, error) {
					alert("Erreur de connexion Internet: \n\n" + error);
				}
	});
});

