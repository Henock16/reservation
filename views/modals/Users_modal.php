<div class="row">
	<div class="modal fade" id="modal-user" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header" id="modal-user-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-user-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-user">
				<div class="modal-body" style="overflow-y:hidden;">
 
					<input type="hidden" name="action-id" />
					<input type="hidden" name="user-id" />
					<input type="hidden" name="numero" />

<<<<<<< HEAD
                    <div class="form-group row" id="bloque" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Bloqué</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="bloque0" class="col-sm-6 btn btn-success" style="color:white;height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="user-details" name="bloque" id="bloque0" value="0"/>
							Non</label>
							<label for="bloque1" class="col-sm-6 btn btn-danger" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="user-details" name="bloque" id="bloque1" value="1"/>
							Oui</label>
						</div>
                    </div>
                    <div class="form-group row" id="statut" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Statut</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="statut0" class="col-sm-6 btn btn-success" style="color:white;height:30px;padding-top:5px;text-align:left">
=======
                    <div class="form-group row" id="statut" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Statut</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="statut0" class="col-sm-6 btn btn-success" style="height:30px;padding-top:5px;text-align:left">
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
							<input type="radio" class="user-details" name="statut" id="statut0" value="0"/>
							Actif</label>
							<label for="statut1" class="col-sm-6 btn btn-danger" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="user-details" name="statut" id="statut1" value="1"/>
							Inactif</label>
						</div>
                    </div>
                    <div class="form-group row" id="connex" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Connexion</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="connex0" class="col-sm-4 btn btn-danger" style="height:30px;padding-top:5px;text-align:left;padding-left:5px;">
							<input type="radio" class="user-details" name="connex" id="connex0" value="0"/>
							Jamais</label>
							<label for="connex1" class="col-sm-3 btn btn-warning" style="height:30px;padding-top:5px;text-align:left;padding-left:5px;">
							<input type="radio" class="user-details" name="connex" id="connex1" value="1"/>
							Déjà</label>
							<label for="connex2" class="col-sm-5 btn btn-secondary" style="height:30px;padding-top:5px;text-align:left;padding-left:5px;">
							<input type="radio" class="user-details" name="connex" id="connex2" value="2"/>
							Réinitialisé</label>
						</div>
                    </div>
<<<<<<< HEAD
                    <div class="form-group row" id="type" style="margin-top:0px;margin-bottom:0px;">
=======
                    <div class="form-group row" id="type"style="margin-top:0px;margin-bottom:0px;">
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Type</label>
						<div class="input-group col-sm-8" style="float:right">
							<select class="form-control user-details" name="type" placeholder="" style="height:30px" required/>
								<option value="" id="type0">TYPE DE COMPTE</option>
								<option value="3" id="type3">Super administrateur</option>
								<option value="1" id="type1">Administrateur</option>
								<option value="2" id="type2">Opérateur</option>
								<option value="4" id="type4">Agent de la DRH</option>
<<<<<<< HEAD
								<option value="5" id="type5">Agent de la DFC</option>
								<option value="6" id="type6">Supervieur</option>
							</select>
						</div>
                    </div>
                    <div class="form-group row" id="struct" style="margin-top:0px;margin-bottom:0px;">
=======
								<option value="5" id="type5">Agent de la DAF</option>
							</select>
						</div>
                    </div>
                    <div class="form-group row" id="struct"style="margin-top:0px;margin-bottom:0px;">
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Structure</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control user-details" name="struct" placeholder="" style="height:30px" required></select>
						</div>
                    </div>
                    <div class="form-group row" id="login" style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Login</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-details" name="login" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="connect"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Dernière connexion</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="connect" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="actif"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Dernière activité</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="actif" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="categ" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Catégorie</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control user-info" name="categ" placeholder="" style="height:30px" required/>
								<option value="0" id="categ0"></option>
								<option value="1" id="categ1">Exportateur</option>
								<option value="2" id="categ2">Pont bascule</option>
								<option value="3" id="categ3">Usine standardisée</option>
								<option value="4" id="categ4">Transitaire</option>
							</select>
						</div>
                    </div>
                    <div class="form-group row" id="ville"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Ville</label>
						<div class="input-group col-sm-8"  style="float:right">
<<<<<<< HEAD
							<label for="ville1" class="col-sm-6 btn btn-warning" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="user-details" name="ville" id="ville1" value="1"/>
							Abidjan</label>
							<label for="ville2" class="col-sm-6 btn btn-primary" style="height:30px;padding-top:5px;text-align:left">
=======
							<label for="ville1" class="col-sm-6 btn btn-light" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="user-details" name="ville" id="ville1" value="1"/>
							Abidjan</label>
							<label for="ville2" class="col-sm-6 btn btn-light" style="height:30px;padding-top:5px;text-align:left">
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
							<input type="radio" class="user-details" name="ville" id="ville2" value="2"/>
							San Pédro</label>
						</div>
                    </div>
                         <div class="form-group row user-chmp" id="sigle"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Sigle</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="sigle" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="numcc"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Num CC</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="numcc" placeholder="" style="height:30px"/>
						</div>
                    </div>
					<div class="form-group row user-chmp" id="localisation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Localisation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="localisation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="nomresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Responsable</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="nomresp" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="foncresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Fonction</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="foncresp" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row user-chmp" id="contresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Contact</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control user-info" name="contresp" placeholder="" style="height:30px"/>
						</div>
                    </div> 
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-user" class="btn btn-success pull-center"></button>
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
