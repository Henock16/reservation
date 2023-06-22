$(document).ready(function () {
		
	affichemails();

});

function affichemails(){
 
$.ajax({
        url: "models/profil.php",
        type: "GET",
        data: "&action=mail",
		dataType:'json',
        success: function(data, textStatus, jqXHR) {
    		$("#head-tag").html(data[0]);
    		$("#body-tag").html(data[1]);

        },
        error: function(jqXHR, status, error) {
        	alert(" Erreur de connexion Internet: \n\n" + error);
        }
    });
}	


$('#trigger').click(function(){
	
 document.forms["form_ajout"].elements["mail"].value='';
 $('#mailModal').modal('show');
  
});


function isEmail(myVar){
    // La 1ère étape consiste à définir l'expression régulière d'une adresse email
     var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

     return regEmail.test(myVar);
}
        
$("#ajout_mail").on("click", function() {
		   
    var addr = document.forms["form_ajout"].elements["mail"].value ;
		    
    if((addr=="")||(isEmail(addr) == false))
		 alert("Veuillez saisir une adresse electronique valide !"); 
    else{
		mailModal
		 $("#mailModal").modal('hide');  
		 $("#ajout_form").submit();  
	}		 
});



$("#ajout_form").on("submit", function(e) {
            
		    e.preventDefault();
					    
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax({
					url: formURL,
					type: "GET",
					data: postData,
					success: function(data, textStatus, jqXHR) {
					    
					if(data.split(";")[0]=="ko")
					    alert("L'adresse electronique existe deja dans la liste !");
					else if(data.split(";")[0]=="ok")
						affichemails();
					else
 				        alert("Erreur détecté lors de l'ajout du mail: \n"+data);
 				},
				error: function(jqXHR, status, error) {
					alert("Erreur de connexion Internet: \n\n" + error);
				}
			});
});
			

function delmail(id){

          							$.ajax({
        							    url: "models/profil.php",
        							    type: "GET",
        							    data: "idmail="+id+"&action=desactiver",
        							    success: function(data, textStatus, jqXHR) {
        							    if(data=="ok")
										   affichemails();
										else
    								        alert("Erreur de désactivation du mail: \n"+data);
        							    },
        							    error: function(jqXHR, status, error) {
        								alert(" Erreur de connexion Internet: \n\n" + error);
        							    }
        							});
        							e.preventDefault();
}
