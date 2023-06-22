<div class="row">
	<div class="modal fade" id="modal-reservation" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header" id="modal-reservation-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-reservation-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-reservation">
				<div class="modal-body" style="overflow-y:hidden;">

 					<input type="hidden" name="action-id" />
					<input type="hidden" name="reservation-id" />

                    <div class="form-group row" id="pont" style="margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Pont</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="pont" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="structure"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Structure</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="structure" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="demandeur"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Demandeur</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="demandeur" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="compte"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Compte</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="compte" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="creation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Création</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="creation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="reservation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Réservation</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="reservation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="plage"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Plage</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="plage" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="etat"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Etat</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="etat" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="inspecteur"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Affecté</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="inspecteur" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="date_affectation"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Le</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="date_affectation" placeholder="" style="height:30px"/>
						</div>
                    </div>
                    <div class="form-group row" id="affecte_par"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-3" style="padding-top:0px;height:30px;">Par</label>
						<div class="input-group col-sm-9"  style="float:right">
							<input type="text" class="form-control reservation-details" name="affecte_par" placeholder="" style="height:30px"/>
						</div>
                    </div>
 
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-reservation" class="btn btn-success pull-center"></button>
					<button type="button" data-dismiss="modal"class="btn btn-info pull-center">Fermer</button>
				</div>
              </form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
