<style>
 
    .form-style-2-heading{
        border-bottom: 2px solid #161616;
        width: 100%;
    }
</style>
<div class="container">
    <div class="col-sm-12" style="padding-right: 30px; ">
									
        <div class="row" style="background-color: #fff;">
                               
 									<div class="col-sm-12" style="height: 30px;padding-left:0px;padding-right:0px;">
										<marquee width="100%" onmouseout="start()" onmouseover="stop()" class="marquee" height="100%" scrolldelay="30" scrollamount="1" truespeed style="background:red; font-family: Source Sans pro, sans-serif;">
											<p>
											<img src="./images/urgent.gif" width="110px" height="30px" style="margin-bottom:4px"/>
											<font size="3px" color="white">
											<b><span id="bande-deroulante"></span></b>
											</font>
											<img src="./images/cci.jpg" width="110px" height="30px" style="margin-bottom:4px"/>
											</p>
										</marquee>
									</div>
                                    
                                
            <div class="col-sm-6 " style="">                         
              <form method="post" class="form-group" id="frm-super" style="margin-bottom: 5px;">
				<div class="modal-body" style="overflow-y:hidden;">
 
                           <input type="hidden" name="id"  value=""/>
                           
                           <div class="form-group form-row" id="superviseur" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-3" >Superviseur&nbsp;*</label>
                                <div class="input-group col-sm-8"  style="float:right">
                                    <select name="superviseur" class="form-control text-center col-sm-12" style="float:right"></select>
                                </div>  
                            </div>
                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-3" >Inspecteur&nbsp;*</label>
                                <div class="input-group col-sm-8"  style="float:right">
                                    <select id="ins" name="ins" class="form-control text-center col-sm-10" style="float:right" required></select>
                                </div>  
                            </div>


                            <div class="form-group form-row">
                                <label style="white-space:nowrap;background-color:white" class="col-sm-2" >Plage&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;color:white" class="col-sm-3 btn btn-success" for="jourm">
									<input class="form-check-input"  type="radio" id="jourm" name="plagem"  value="1" required>Jour</label>
                                    <label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;" class="col-sm-3 btn btn-danger" for="nuitm">
									<input class="form-check-input"  type="radio"  id="nuitm" name="plagem"  value="2" required>Nuit</label>
                                    <input type="text" id="datepicker" class="form-control datepicker text-center col-sm-6" style="height:30px;" name="date" placeholder="Date" required />
								</div>	

                             </div>
							 <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-3" >Nb heures&nbsp;*</label>
                                <div class="input-group col-sm-8" style="float:right">
                                    <input type="number" class="input-field form-control" id="nbh" name="nbh" value="" style="height:30px;" required/></label>
                                </div>  
                            </div> 
                            
				</div>
				<div class="form-style-2-heading"></div>

                            <div class="form-group text-center" style="margin: 20px;">
                                <input type="submit" class="btn btn-success button-validate" style="outline-style: none; border-radius:3px; height:30px;font-size:12px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);" value="Valider" name="Valider" />
                                <button type="button" class="btn btn-warning pull-center button-modifier">Modifier</button>
                                <button type="button" class="btn btn-danger pull-center button-annuler">Annuler</button>
                            </div>
              </form>
            </div> <!-- col-sm-6  -->                                                                         
                                        
            <div class="col-sm-6 container2" id="scroll" style="border: solid 0px #C2C2C2; padding-left:0px; padding-right:15px ; height: 100%;overflow: hidden;vertical-align: bottom; ">
                <form method="post" class="form-group" id="frm-apercu" style="margin-bottom: 5px;">
                        <div class="form-group form-row" style="margin-top:20px">
                                    <div id="semaineap" class="input-group col-sm-8"  style="float:right">
                                        <select name="sem" class="form-control text-center col-sm-6" style="float:right" required></select>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type="button" id="button-apercu" class="btn btn-secondary  pull-center button-apercu" style="color:#fff" title="Voir l'aperçu de la matrice"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>  
                        </div>
                </form>
                    <?php
                        include_once('Super_list_view.php'); 
                        include_once('Super_table_list_view.php');
                    ?>
                
               <!-- <form class="form-table"> -->
               
            </div> <!-- col-sm-6  -->
            <!-- </form> -->
        </div> <!-- row  -->
                                        
    </div> <!-- col-sm-12  -->
                
    
</div><!-- container -->
                                               

