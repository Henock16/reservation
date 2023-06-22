<div class="row">
	<div class="modal fade" id="modal-ferie" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content">
				<div class="modal-header" id="modal-ferie-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-ferie-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-ferie">
				<div class="modal-body" style="overflow-y:hidden;">
 
					<input type="hidden" name="action-id" />
					<input type="hidden" name="ferie-id" />

                    <div class="form-group row" id="type" style="margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Type</label>
						<div class="input-group col-sm-8"  style="float:right">
							<label for="type1" class="col-sm-12 btn btn-warning" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="ferie-details" name="type" id="type1" value="1"/>
							Nuit du destin</label>
							<label for="type2" class="col-sm-12 btn btn-secondary" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="ferie-details" name="type" id="type2" value="2"/>
							Ramadan</label>
							<label for="type3" class="col-sm-12 btn btn-success" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="ferie-details" name="type" id="type3" value="3"/>
							Tabaski</label>
							<label for="type4" class="col-sm-12 btn btn-dark" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="ferie-details" name="type" id="type4" value="4"/>
							Mahouloud</label>
							<label for="type0" class="col-sm-12 btn btn-danger" style="height:30px;padding-top:5px;text-align:left">
							<input type="radio" class="ferie-details" name="type" id="type0" value="0"/>
							Exceptionnel</label>
						</div>
                    </div>
					<div class="form-group row" id="nom"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Nom</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control ferie-details" name="nom" placeholder="" style="height:30px" required/>
						</div>
                    </div> 
					<div class="form-group row" id="date"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Date</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control ferie-details datepicker text-center" name="date" placeholder="" style="height:30px" required/>
						</div>
                    </div> 
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-ferie" class="btn btn-success pull-center"></button>
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
