	<!-- Modal -->
			<div class="modal fade" id="modal-FirstConnection" role="dialog" data-backdrop="static" data-keyboard="false">
			
				<div class="modal-dialog">
    
					<!-- Modal content-->
					<div class="modal-content">
					
						<div class="modal-header" style="background-color:lightgreen;height:50px">
							<h2 class="modal-title"  id="title-FirstConnection" style="font-weight: bold;color:white"></h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-weight: bold;color:white">&times;</span></button>
						</div>
						
						<div class="modal-body">
							<p align="center" style="color: red;font-size:12px"><i>Pour votre premi&egrave;re connexion &agrave; l'application, veuillez s'il vous pla&icirc;t corriger ou renseigner soigneusement vos informations personnelles.</i></p>  
							<p align="center" style="color: blue;font-size:12px">Celles-ci sont importantes car elles vous permettront de récupérer votre mot de passe en cas de perte ou d'oubli de celui-ci.</p>  
		
							<form class="form" role="form" method="post" action="#" name="FirstConnection-form"  id="form-FirstConnection">
						
								<div class="col-sm-12" align="left" style="background-color:lightgray">
									<p style="font-weight: bold; color: #337ab7; font-size: 16px">STRUCTURE</p>							
								</div>
	
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="categorie" style="height:30px">Catégorie</label>
									<div class="col-sm-7">
										<select class="form-control" name="categorie" id="categorie" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required>
											<option selected value="">Sélectionner une catégorie</option>
											<option value="1" >EXPORTATEUR</option>
											<option value="2" >PONT BASCULE</option>
											<option value="3" >USINE</option>
											<option value="4" >TRANSITAIRE</option>
										</select>
									</div>
								</div>
			
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="sigle" style="height:30px">Sigle</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="sigle" id="sigle" placeholder="Sigle" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
			
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="ville" style="height:30px">Ville</label>
									<div class="col-sm-7">
										<select class="form-control" name="ville" id="ville" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required>
											<option selected value="">Sélectionner une Ville</option>
											<option value="1" >ABIDJAN</option>
											<option value="2" >SAN PEDRO</option>
										</select>
									</div>
								</div>
		
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="adgeo" style="height:30px">Adresse Geographique</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="adgeo" id="adgeo" placeholder="Adresse Geographique" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
			
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="ncoco" style="height:30px">N&deg; Compte Contribuable</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="ncoco" id="ncoco" placeholder="N° Compte Contribuable" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
			
								<div class="col-sm-12" align="left" style="background-color:lightgray">
									<p style="font-weight: bold; color: #337ab7; font-size: 16px">RESPONSABLE</p>							
								</div>

								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="nom" style="height:30px">Nom Complet</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom Complet" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
						
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="fonction" style="height:30px">Fonction</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="fonction" id="fonction" placeholder="Fonction" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>

								<div class="form-group row" style="margin-bottom:10px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" style="height:30px">Numéro(s) de téléphone<br/></label>
									<div class="col-sm-7" >
										<div class="row clearfix" >
											<div class="col-md-12 column" >
												<table class="table table-bordered table-hover" id="tab_logic">
													<tr id='addr0'>
														<td style="padding-bottom:2px;padding-top:2px;padding-left:2px;padding-right:2px;">
															<input type="text" name='contact0' id='contact0' placeholder='Contact' style="height:30px" class="form-control" oninvalid="this.setCustomValidity('Champ obligatoire')" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" oninput="testnumtel(this)" maxlength="14" required />
														</td>
													</tr>
													<tr id='addr1'></tr>
												</table>
											</div>
										</div>
									
										<table border="0" width="100%">
											<tr>
												<td>
										<a id='delete_row' class="btn btn-danger" style="align:left;border-radius:3px; height:20px;font-size:12px;text-align:center;color:white;font-weight: bold;box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);margin-top:-3px;padding-top:3px;padding-left:5px;padding-right:5px;" title="Supprimer un contact">-</a>
												</td><td align="right">
										<a id="add_row" class="btn btn-success" style="align:right;border-radius:3px; height:20px;font-size:12px;text-align:center;color:white;font-weight: bold;box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);margin-top:-3px;padding-top:3px;padding-left:5px;padding-right:5px;" title="Ajouter un contact">+</a>
												</td>
											</tr>
										</table>
			
									</div>
								</div>
			
								<div class="form-group row" style="margin-bottom:10px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" style="height:30px">Adresse(s) électronique(s)<br/></label>
									<div class="col-sm-7">
										<div class="row clearfix">
											<div class="col-md-12 column" >
												<table class="table table-bordered table-hover" id="tab_logic1">
													<tr id='addrm0'>
														<td style="padding-bottom:2px;padding-top:2px;padding-left:2px;padding-right:2px;">
															<input type="text" name='mail0' id='mail0' placeholder='Adresse mail' style="height:30px" class="form-control" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required onkeypress="return ((event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 64 || event.charCode == 45 || event.charCode == 46))"/>
														</td>
													</tr>
													<tr id='addrm1'></tr>
												</table>
											</div>
										</div>
										
										<table border="0" width="100%">
											<tr>
												<td>
										<a id='delete_row1' class="btn btn-danger" style="align:left;border-radius:3px; height:20px;font-size:12px;text-align:center;color:white;font-weight: bold;box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);margin-top:-3px;padding-top:3px;padding-left:5px;padding-right:5px;" title="Supprimer un mail">-</a>
												</td><td align="right">
										<a id="add_row1" class="btn btn-success" style="align:right;border-radius:3px; height:20px;font-size:12px;text-align:center;color:white;font-weight: bold;box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);margin-top:-3px;padding-top:3px;padding-left:5px;padding-right:5px;" title="Ajouter un mail">+</a>
												</td>
											</tr>
										</table>
			
									</div>
								</div>
								
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="mdp-first-connect" style="height:30px">Nouveau mot de passe</label>
									<div class="col-sm-7">
										<input type="password" class="form-control" name="mdp" id="mdp-first-connect" placeholder="Nouveau mot de passe" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
								
								<div class="form-group row" style="margin-bottom:0px;margin-top:0px;">
									<label  class="col-sm-5 col-form-label" for="confmdp-first-connect" style="height:30px">Confirmer le mot de passe</label>
									<div class="col-sm-7">
										<input type="password" class="form-control" name="confmdp" id="confmdp-first-connect" placeholder="Confirmer mot de passe" style="height:30px" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
									</div>
								</div>
			
								<div class="form-group" style="margin-bottom:0px;margin-top:10px;">
									<table width="100%">
										<tr>
											<td style="margin-bottom:0px;margin-top:0px;">
												<button type="button" class="btn btn-danger" style="border-radius:3px; height:30px;font-size:15px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);" data-dismiss="modal" >Fermer</button>
											</td>
											<td align="right" style="margin-bottom:0px;margin-top:0px;">
												<button type="submit" class="btn btn-success" style="border-radius:3px; height:30px;font-size:15px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">Valider</button>
											</td>
										</tr>
									</table>
								</div>
								
							</form>
		
						</div>
					</div>
      
				</div>
			</div>

