<div class="row">
	<div class="modal fade" id="modal-inspecteur" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header" id="modal-inspecteur-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-inspecteur-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-inspecteur">
				<div class="modal-body" style="overflow-y:hidden;">
 
					<input type="hidden" name="action-id" />
					<input type="hidden" name="inspecteur-id" />

                    <div class="form-group row" id="statut" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Statut</label>
						<div class="input-group col-sm-8"  style="float:right">
<<<<<<< HEAD
							<label for="statut0" class="col-sm-6 btn btn-success" style="color:white;height:30px;padding-top:5px;text-align:left">
=======
							<label for="statut0" class="col-sm-6 btn btn-success" style="height:30px;padding-top:5px;text-align:left">
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
							<input type="radio" class="inspecteur-details" name="statut" id="statut0" value="0"/>
							Actif</label>
							<label for="statut1" class="col-sm-6 btn btn-danger" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="statut" id="statut1" value="1"/>
							Inactif</label>
						</div>
                    </div>
                    <div class="form-group row" id="matricule"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Matricule</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="number" class="form-control inspecteur-details" name="matricule" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row" id="nom"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Nom</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="nom" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row" id="prenoms"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Prénoms</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="prenoms" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row" id="naissance"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Date de naissance</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details datepicker text-center" name="naissance" placeholder="" style="height:30px"/>
						</div>
                    </div>
<<<<<<< HEAD
=======
                    <div class="form-group row" id="habitation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Lieu d'habitation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="habitation" placeholder="" style="height:30px"/>
						</div>
                    </div>
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                    <div class="form-group row" id="mail"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Adresse mail</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="email" class="form-control inspecteur-details" name="mail" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="telephone"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Téléphone perso</label>
						<div class="input-group col-sm-8"  style="float:right">
<<<<<<< HEAD
							<input type="number" class="form-control inspecteur-details" name="telephone" placeholder="" style="height:30px" maxlength="10" onkeypress="return ((event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 32 || event.charCode == 45 || event.charCode == 47))"

/>
=======
							<input type="number" class="form-control inspecteur-details" name="telephone" placeholder="" style="height:30px"/>
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
						</div>
                    </div>
                    <div class="form-group row" id="flotte"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Téléphone flotte</label>
						<div class="input-group col-sm-8"  style="float:right">
<<<<<<< HEAD
							<input type="number" class="form-control inspecteur-details" name="flotte" placeholder="" style="height:30px" maxlength="10" onkeypress="return ((event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 32 || event.charCode == 45 || event.charCode == 47))"

/>
=======
							<input type="number" class="form-control inspecteur-details" name="flotte" placeholder="" style="height:30px"/>
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
						</div>
                    </div>
                    <div class="form-group row" id="contrat"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Type de contrat</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="contrat1" class="col-sm-6 btn btn-white" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="contrat" id="contrat1" value="1"/>
							CDD</label>
							<label for="contrat2" class="col-sm-6 btn btn-white" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="contrat" id="contrat2" value="2"/>
							CDI</label>
						</div>
                    </div>
<<<<<<< HEAD
=======
                    <div class="form-group row" id="ville"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Ville</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="ville1" class="col-sm-6 btn btn-light" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="ville" id="ville1" value="1"/>
							Abidjan</label>
							<label for="ville2" class="col-sm-6 btn btn-light" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="ville" id="ville2" value="2"/>
							San Pédro</label>
						</div>
                    </div>
                    <div class="form-group row" id="site"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Site d'affectation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control inspecteur-details" name="site" placeholder="" style="height:30px"/></select>
						</div>
                    </div>
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                    <div class="form-group row" id="diplome"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Diplome</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="diplome" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="niveau"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Niveau d'étude</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="niveau" placeholder="" style="height:30px"/>
						</div>
                    </div>
<<<<<<< HEAD
                    <div class="form-group row" id="ville"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Ville</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="ville1" class="col-sm-6 btn btn-warning" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="ville" id="ville1" value="1"/>
							Abidjan</label>
							<label for="ville2" class="col-sm-6 btn btn-primary" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="inspecteur-details" name="ville" id="ville2" value="2"/>
							San Pédro</label>
						</div>
                    </div>
                    <div class="form-group row" id="quartier"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Quartier</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control inspecteur-details" name="quartier" placeholder="" style="height:30px"/></select>
						</div>
                    </div>
                    <div class="form-group row" id="habitation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Lieu d'habitation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="habitation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="gps"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Coordonnées GPS</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control inspecteur-details" name="gps" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="site"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Site d'affectation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control inspecteur-details" name="site" placeholder="" style="height:30px"/></select>
						</div>
                    </div>
=======
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
 
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-inspecteur" class="btn btn-success pull-center"></button>
					<button type="button" data-dismiss="modal" class="btn btn-info pull-center">Fermer</button>
				</div>
              </form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
