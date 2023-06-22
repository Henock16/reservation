<div class="row">
	<div class="modal fade" id="modal-pont" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header" id="modal-pont-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-pont-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-pont">
				<div class="modal-body" style="overflow-y:hidden;">
 
					<input type="hidden" name="action-id" />
					<input type="hidden" name="pont-id" />

                    <div class="form-group row" id="statut" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Statut</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="statut0" class="col-sm-6 btn btn-success" style="color:white;height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="statut" id="statut0" value="0"/>
							Actif</label>
							<label for="statut1" class="col-sm-6 btn btn-danger" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="statut" id="statut1" value="1"/>
							Inactif</label>
						</div>
                    </div>
                    <div class="form-group row" id="niveau"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Niveau</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="number" class="form-control pont-details" name="niveau" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="type"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Type</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="type1" class="col-sm-6 btn btn-white" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="type" id="type1" value="1"/>
							Pont</label>
							<label for="type2" class="col-sm-6 btn btn-white" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="type" id="type2" value="2"/>
							Usine</label>
						</div>
                    </div>
                    <div class="form-group row" id="code"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Code</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="code" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row" id="nom"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Nom</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="nom" placeholder="" style="height:30px" required/>
						</div>
                    </div>
                    <div class="form-group row" id="struct"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Structure</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control pont-details" name="struct" placeholder="" style="height:30px" required/></select>
						</div>
                    </div>
                    <div class="form-group row" id="ville"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Ville</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="ville1" class="col-sm-6 btn btn-warning" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="ville" id="ville1" value="1"/>
							Abidjan</label>
							<label for="ville2" class="col-sm-6 btn btn-primary" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="pont-details" name="ville" id="ville2" value="2"/>
							San Pédro</label>
						</div>
                    </div>
                    <div class="form-group row" id="quartier"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Quartier</label>
						<div class="input-group col-sm-8"  style="float:right">
							<select class="form-control pont-details" name="quartier" placeholder="" style="height:30px"/></select>
						</div>
                    </div>
                    <div class="form-group row" id="localisation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Localisation</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="localisation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="gps"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Coordonnées GPS</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="gps" placeholder="" style="height:30px"/>
						</div>
                    </div>
                     <div class="form-group row" id="nomresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Responsable</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="nomresp" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="foncresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Fonction</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="foncresp" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="contresp"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Contact</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control pont-details" name="contresp" placeholder="" style="height:30px"/>
						</div>
                    </div>

				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-pont" class="btn btn-success pull-center"></button>
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
