
<div class="col-sm-6" id="scroll" style="border: solid 0px #C2C2C2; padding-left:14px;">
															
                                                            <table id="mails" class="table table-sm " style="margin-bottom: 0px; font-size: 12px;margin-left:0px">
                                                                <thead id="head-tag">
                                                                </thead>
                                                                <tbody id="body-tag">		 
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr ><td colspan=2  bgcolor="lightgray" ><a class="btn" id="trigger" style="background-color:white" >Ajouter</a></td></tr>
                                                                </tfoot>
                                                                
                                                           </table>
</div>
                                                       
                                                       <!-- Modal -->
                                                       <div id="mailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                                           <div class="modal-dialog">
                                                               <div class="modal-content">
                                                                     <div class="modal-header">
                                                                      
                                                                       <h4 id="myModalLabel" style="margin-top: 5px;margin-bottom: 5px;">Ajouter une adresse électronique</h4>
                                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                     </div>
                                                                     <div class="modal-body">
                                                                       <form name="form_ajout" id="ajout_form" class="form-inline"  method="GET" action="models/profil.php" style="display:block">
                                                                         <div class="input-group">
                                                                           <span class="input-group-addon" id="basic-addon1">@</span>
                                                                           <input type="text" name="mail" class="form-control form-control-sm" placeholder="Entrer la nouvelle adresse électronique ici" aria-describedby="basic-addon1">
                                                                         </div>
                                                                           <input type="hidden" name="action" value="ajouter"/>
                                                                       </form>
                                                                     </div>
                                                                     <div class="modal-footer" style="margin: 0px;">
                                                                       <button type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true"  style="border-radius:3px; height:30px;width:100px;font-size:12px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">Annuler</button>
                                                                       <button type="button" class="btn btn-primary" data-dismiss="modal" id="ajout_mail"  style="border-radius:3px; height:30px;width:100px;font-size:12px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">Ajouter</button>
                                                                     </div>
                                                               </div>		
                                                           </div>		
                                                       </div>		
                                                       <!-- Modal -->
                                                       