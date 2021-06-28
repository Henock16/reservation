				
<div class="col-sm-6"  style="padding-right: 14px;margin-right:-14px; width:100%" >
					
    <div class="panel panel-info" style="margin-bottom: 0px;margin-right: 14px; width:100%;">
                        
            <div style="height:40px;background-color: lightblue; padding-top:7px;text-align:center;border-color: #bce8f1;color: #31708f;"> 
                <h3 id="structure"></h3>
            </div>
               
            <div class="panel-body" style="background-color:white;">
                   
                    <table class="table table-sm " style="table-layout:fixed;">																	
                                 <tbody>
                                    <tr>
                                        <td width="20%" >Type</td>
                                         <td id="tab_type" width="80%"></td>
                                    </tr>
                                    <tr>
                                      <td >Sigle</td>
                                         <td id="tab_sigle"></td>
                                    </tr>
                                                          <tr>
                                                            <td>N° CC</td>
                                                            <td  id="tab_nocc"></td>
                                                          </tr>
                                                          
                                                          <tr>
                                                            <td>Ville</td>
                                                            <td id="tab_ville"></td>
                                                          </tr>
                                                   
                                                            <tr>
                                                            <td >Localisation</td>
                                                            <td  id="tab_adrgeo"></>
                                                          </tr>
                                                            <tr>
                                                            <td >Responsable</td>
                                                            <td id="tab_nomresp"></td>
                                                          </tr>
                                                          <tr>
                                                            <td >Fonction</td>
                                                            <td id="tab_fctresp"></td>
                                                          </tr>
                                                        <tr>
                                                            <td>Contact(s)</td>
                                                            <td id="tab_contact"></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                     </div>
                                     
                                    <div class="panel-footer" style="width:100%;background-color:lightgray">
                                        <a class="btn btn-light" id="openinfo" style="background-color:white;margin:2px">Modifier</a>
                                    </div>
                    </div>
</div>
                            
                           <style>
                        
                               .btn-success
                               {   
                                    margin-right: 125px;
                               }
                               .btn-primary
                               {
                                   margin-left: 131px;
                               }
                            .btn-danger{
                                 margin-right: 131px;
                            }
                           </style>
                            
<!-- Modal -->
<div  id="infoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        
            <div class="modal-header" style="padding-bottom: 0px; display: block; text-align:center;">
                <p style=" font-size: 12px;"><i style="color: red;">Veuillez s\'il vous pla&icirc;t modifier votre profil</i>
                    <button type="button" style="padding-top:0%;" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </p>  
                
            </div>
            
            <div class="modal-body">

                <form class="form-group" role="form" method="get" action="models/profil.php" name="form_modif" id="form_modif">

                    <input type="hidden" name="iduser" value="<?php echo $_SESSION['ID_UTIL'];?>"/>
                    <input type="hidden" name="action" value="modifier"/>

                    <div class="form-group row" style="border-bottom: 1px solid #cccccc;">
                        <div class="col-sm-12" align="center" >
                            <p style="font-weight: bold; color: #337ab7; font-size: 16px">STRUCTURE</p>
                        </div>
                    </div>
                    <div  class="form-group row">
                       
                            <label class="col-sm-3 col-form-label-sm" for="categorie" >Cat&eacute;gorie</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" name="categorie" id="categorie" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                                </select>
                            </div>
                       
                            <label  class="col-sm-3 col-form-label-sm" for="sigle">Sigle</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" name="sigle" id="sigle" placeholder="Sigle" value="" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                            </div>
                       
                            <label  class="col-sm-3 col-form-label-sm" for="ville">Ville</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" name="ville" id="ville" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                                </select>
                            </div>
                            <label  class="col-sm-3 col-form-label-sm" for="adgeo">Adresse Geographique</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" name="adgeo" id="adgeo" placeholder="Adresse Geographique" value="" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                            </div>
                            <label  class="col-sm-3 col-form-label-sm" for="ncoco">N&deg; Compte Contribuable</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" name="ncoco" id="ncoco2" placeholder="N° Compte Contribuable" value="" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                            </div>
                    </div>
                    <div class="form-group row" style="border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc;">

                        <div class="col-sm-12" align="center" style="padding-top: 15px;">
                            <p style="font-weight: bold; color: #337ab7; font-size: 16px">RESPONSABLE</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label-sm" for="nom">Nom Complet</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="nom" id="nom" placeholder="Nom Complet" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                        </div>
                        <label  class="col-sm-3 col-form-label-sm" for="fonction">Fonction</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" name="fonction" id="function" placeholder="Fonction" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required>
                        </div>
                        <label  class="col-sm-3 col-form-label-sm" >Contact(s)<br/><span style="color:red">*** 02 minimum</span></label>
                        <div class="col-sm-9">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <table class="table table-bordered table-hover" id="numeros">
                                        <tr id="num0">
                                            <td>
                                                <input type="text" name="contact0" id="contact0" placeholder="Contact" class="form-control form-control-sm" oninput="setCustomValidity(\'\')" oninvalid="this.setCustomValidity(\'Champ obligatoire\')" required />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a id="add_row" class="btn btn-success pull-left"  style="padding-top: 5px;border-radius:3px; height:15px;width:90px;font-size:12px;text-align:center; -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">+ ajouter</a>
                            <a id="delete_row" class="pull-right btn btn-warning" style="border-radius:3px; height:15px;width:100px;font-size:12px;text-align:center; -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);padding-top: 5px;">- supprimer</a>
                        </div>
                    </div>
                </form>
                <div class="modal-footer" style="margin-top: 0px;">
                    <div class="row clearfix">
                        <button type="button" class="btn btn-danger" id="revenir" data-dismiss="modal" aria-hidden="true"  style="padding-top: 5px;border-radius:3px; height:30px;width:100px;font-size:12px;text-align:center;  -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">annuler</button>
                        <button type="submit" class="btn btn-primary" id="bouton_modifier" style="padding-top: 5px;border-radius:3px; height:30px;width:100px;font-size:12px;display:block; text-align:center;  -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">modifier</button>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>									
                            
                    

                    	

<!-- <script type="text/javascript">
    // jQuery(function($){
    //     });    
</script> -->