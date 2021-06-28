$(document).ready(function(){
 
	$('.datepicker-first-connect').datetimepicker({
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


 // Ajouter une ligne pour contact				
	$("#add_row").click(function(){
		if(document.getElementById('tab_logic').rows.length>0){
			var i = document.getElementById('tab_logic').rows.length - 1;
			$('#addr'+i).html("<td  style=\"padding-bottom:2px;padding-top:2px;padding-left:2px;padding-right:2px;\"><input name='contact"+i+"' id='contact"+i+"' type='text' placeholder='Contact' style=\"height:30px\" class='form-control' onkeypress=\"return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57\"  oninput=\"testnumtel(this)\" maxlength=\"14\"/></td>");
			$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
			jQuery(function($){
            	$("#contact"+i).mask("99 99 99 99 99",{placeholder:" "});
            });
		}
	});				
				
// Supprimer une ligne pour contact
	$("#delete_row").click(function(){
		var i = document.getElementById('tab_logic').rows.length - 1;
		if(i>1){
			$("#addr"+(i-1)).html('');
			$("#addr"+i).remove();
		}
	});

// Ajouter une ligne pour adresse mail
	$("#add_row1").click(function(){
		if(document.getElementById('tab_logic1').rows.length>0){
			var i = document.getElementById('tab_logic1').rows.length - 1;
			$('#addrm'+i).html("<td  style=\"padding-bottom:2px;padding-top:2px;padding-left:2px;padding-right:2px;\"><input name='mail"+i+"' id='mail"+i+"' type='text' placeholder='Adresse Mail' style=\"height:30px\" class='form-control input-md'  onkeypress=\"return ((event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 64 || event.charCode == 45 || event.charCode == 46))\"/></td>");
				$('#tab_logic1').append('<tr id="addrm'+(i+1)+'"></tr>');
				i++; 
			}
		});
				
// Supprimer une ligne pour adresse mail
	$("#delete_row1").click(function(){
		var i = document.getElementById('tab_logic1').rows.length - 1;			
		if(i>1){
			$("#addrm"+(i-1)).html('');
			$("#addrm"+i).remove();
		}
	});

});

			
// Poster les informations du formulaire si les mots de passe concordent

$("#form-FirstConnection").submit(function(event){
	
	event.preventDefault();
	
	function isContact(myVar){
		myVar=myVar.split(" ").join("");
		return (((myVar.length==10) && !isNaN(parseInt(myVar)))?true:false);
	}
	
	function isEmail(myVar){
        var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
        return regEmail.test(myVar);
	}
	
	var i = document.getElementById('tab_logic').rows.length - 1;
	var bool1 = true;
	var j ;
	
	for(j = 0; j < i; j++){	    
	    var num = document.getElementById('contact'+j).value ;
	    bool1 = bool1 && (isContact(num));
	}

	i = document.getElementById('tab_logic1').rows.length - 1;
	var bool2 = true;
	
	for(j = 0; j < i; j++){	    
	    var mail = document.getElementById('mail'+j).value ;
	    bool2 = bool2 && (isEmail(mail));
	}
	
	var mdp=document.forms["FirstConnection-form"].elements["mdp"];
	var confmdp=document.forms["FirstConnection-form"].elements["confmdp"];
	
	if(!bool1)
        mssg(lang,22,0);
    else if(!bool2)
        mssg(lang,22,1);
    else if(mdp.value != confmdp.value)
        mssg(lang,20,0);
    else if(mdp.value==$('.form-authentication input[name="user"]').val())
        mssg(lang,21,2);
    else if(mdp.value=="12345")
        mssg(lang,21,1);
    else if(mdp.value.length<5)
        mssg(lang,21,0);
	else{
    		var donnees = $(this).serialize();
    		var table = document.getElementById("tab_logic").rows.length - 1;
    		var table1 = document.getElementById("tab_logic1").rows.length - 1;
    		$.ajax({
    			url : 'models/offline/First_connect_base.php',
    			type : 'POST',
    			data : donnees+'&t1='+table+'&t2='+table1,
    			dataType : 'json',
    			success : function(data){
					if(data[0]==0){
						mssg(lang,23,0);
						$('#modal-FirstConnection').modal('hide');
					}else
						mssg(lang,25,data);
    			},
				error: function(jqXHR, status, error){
					mssg(lang,24,error);
			}
    		});
    	}
    	
 
});

