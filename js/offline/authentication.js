

$('.form-authentication').on('submit', function(e) {


    e.preventDefault();
    var data = $(this).serialize();

    $.ajax({

        url: './models/offline/Authentication_model.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success : function(data){

            //UTILISATEUR OU MOT DE PASSE ERRONE
            if(data[0] == 0){
                mssg(lang,2,0);
            }
            //COMPTE DESACTIVE
            else if(data[0] == 1){
                mssg(lang,3,0);
            }
            //COMPTE EN COURS D'UTILISATION
            else if(data[0] == 2){
                mssg(lang,4,session);
            }
            //PREMIERE CONNEXION
            else if(data[0] == 3){
                $('.form-authentication input[name="pass"]').val("");
                $('#form-FirstConnection')[0].reset();
                $('#title-FirstConnection').html('<i class="mdi mdi-head text-info"></i>&nbsp;<b>Bienvenue '+data[10]+'</b>');
				
                $('#categorie').val(data[1]);
                $('#sigle').val(data[2]);
                $('#ville').val(data[3]);
                $('#adgeo').val(data[4]);
                $('#ncoco').val(data[5]);
                $('#nom').val(data[6]);
                $('#fonction').val(data[7]);

                if(data[8]!=null){
                    var tel=data[8].split(",");
                    for(var i = 0; i < tel.length; i++){
                        if(i>0)
                            $("#add_row").click();
                        $('#contact'+i).val(tel[i].slice(0,2)+' '+tel[i].slice(2,4)+' '+tel[i].slice(4,6)+' '+tel[i].slice(6,8)+' '+tel[i].slice(8,10));
                    }
                }
                if(data[9]!=null){
                    var mail=data[9].split(",");
                    for(var i = 0; i < mail.length; i++){
                        if(i>0)
                            $("#add_row1").click();
                        $('#mail'+i).val(mail[i]);
                    }
                }
                $('#mdp').val('');
                $('#confmdp').val('');
                $('#modal-FirstConnection').modal('show');
            }
            //MOT DE PASSE REINITIALISE
            else if(data[0] == 4){
                $('.form-authentication input[name="pass"]').val("");
                $('#form-NewPassword')[0].reset();
                $('#modal-NewPassword').modal('show');
            }
            else if(data[0] == 5){
                window.location.replace('index.php'+((data[1]!='')?'?p='+data[1]:''));
            }
            else
            	mssg(lang,5,data);
        },
        error: function(jqXHR, status, error) {
            mssg(lang,6,error);
        }

    });

});


