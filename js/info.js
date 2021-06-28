/* must apply only after HTML has loaded */

$(document).ready(function () {
		
//	$("#ncoco2").mask("9999999a",{placeholder:" "});

	afficheuser();

});
	
function afficheuser(){
 
 $.ajax({
        url: './models/profil.php',
        type: 'GET',
        data: '&action=info',
        success: function(data, textStatus, jqXHR) {
        if(data.split(";").length==10)
    		{
			$("#lastconnect").html(data.split(";")[0]);
			$("#structure").html(data.split(";")[1]);
			$("#tab_type").html(data.split(";")[2]);
			$("#tab_sigle").html(data.split(";")[3]);
			$("#tab_nocc").html(data.split(";")[4]);
			$("#tab_ville").html(data.split(";")[5]);
			$("#tab_adrgeo").html(data.split(";")[6]);
			$("#tab_nomresp").html(data.split(";")[7]);
			$("#tab_fctresp").html(data.split(";")[8]);
			$("#tab_contact").html(data.split(";")[9].replace(","," / "));
			}
		else
    		alert("Erreur lors du chargement des informations: "+data);
        },
        error: function(jqXHR, status, error) {
        	alert(" Erreur de connexion Internet: \n\n" + error);
        }
    });
}	


$("#openinfo").on("click", function(e) {

    $.ajax({
        url: './models/profil.php',
        type: "GET",
        data: "&action=charger",
        success: function(data, textStatus, jqXHR) {
        if(data.split(";").length==8)
    		{
			$("#categorie").html(data.split(";")[0]);
			$("#sigle").val(data.split(";")[1]);
			$("#ville").html(data.split(";")[2]);
			$("#adgeo").val(data.split(";")[3]);
			$("#ncoco2").val(data.split(";")[4]);
			$("#nom").val(data.split(";")[5]);
			$("#function").val(data.split(";")[6]);
			
			$("#numeros").html("");
			
			for(var i=0;i<data.split(";")[7].split(",").length;i++)
			    {
    			$('#numeros').append('<tr id="num'+i+'"></tr>');
    			$('#num'+i).html("<td><input name='contact"+i+"' id='contact"+i+"' type='text' placeholder='Contact' value='"+data.split(";")[7].split(",")[i]+"' class='form-control input-md'/></td>");
			    }
    	}
		else
    		alert("Erreur lors du chargement des données: "+data);
        },
        error: function(jqXHR, status, error) {
        	alert(" Erreur de connexion Internet: \n\n" + error);
        }
    });
        e.preventDefault();

		$("#infoModal").modal("show");
});
	
	
	
		$("#add_row").click(function(){
		    var i=document.getElementById("numeros").rows.length;
			$('#numeros').append('<tr id="num'+i+'"></tr>');
			$('#num'+i).html("<td><input name='contact"+i+"' id='contact"+i+"' type='text' placeholder='Contact' class='form-control input-md'/></td>");
			
			jQuery(function($){
    			$("#contact"+i).mask("99 99 99 99",{placeholder:" "});
    		});
		});
				
		$("#delete_row").click(function(){
		    var i=document.getElementById("numeros").rows.length;
		    if(i>1)
				$("#num"+(i-1)).remove();
		});


		$("#bouton_modifier").on("click", function() {
		    
            if(document.forms["form_modif"].elements["sigle"].value==="")
    			alert("Saisissez un sigle !");
    	    else
            if(document.forms["form_modif"].elements["adgeo"].value==="")
    			alert("Saisissez une adresse géographique!");
    	    else
            if(document.forms["form_modif"].elements["ncoco"].value==="")
    			alert("Saisissez un N° de compte contribuable!");
    	    else
            if(document.forms["form_modif"].elements["nom"].value==="")
    			alert("Saisissez un nom de responsable!");
    	    else
            if(document.forms["form_modif"].elements["fonction"].value==="")
    			alert("Saisissez la fonction du responsable!");
    	    else
            if(document.getElementById("numeros").rows.length===1)
    			alert("Saisissez au moins deux numéros de téléphone!");
    	    else
                {
            	    var i=0;
            	    var j=0;
            	    while(i<document.getElementById("numeros").rows.length)
            	        {
             	            if(document.getElementById("contact"+i).value !== "")
            	                j++;
             	            i++;
            	        }
                     
                    if(j<2)
        			alert("Saisissez au moins deux numéros de téléphone!");
            	    else{						
						$('#infoModal').modal('hide');
            			$("#form_modif").submit();
					}
                }
    			
		});

		$("#form_modif").on("submit", function(e) {
			var donnees = $(this).serializeArray();
			var formURL = $(this).attr("action");
			$.ajax({
				url: formURL,
				type: "GET",
				data: donnees,
				success: function(data, textStatus, jqXHR) {
                if(data.split(";")[0]=="ok")
                    {
					afficheuser();

                    }
				else
    			    alert("Erreur de modification du profil: "+data);
				},
				error: function(jqXHR, status, error) {
					alert("Erreur de connexion Internet: \n\n" + error);
				}
			});
			e.preventDefault();
		});

