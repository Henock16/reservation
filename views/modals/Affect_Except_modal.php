<div class="row">
	<div class="modal fade" id="modal-affect-except" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content">
				<div class="modal-header" id="modal-affect-except-header" Style="background-color:lightgreen">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-affect-except-title">Affectation exceptionnelle d'un inspecteur</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form method="post" class="form-group" id="frm-affect-except" style="margin-bottom: 5px;">
				<div class="modal-body" style="overflow-y:hidden;">
 
                           <input type="hidden" name="action"  value="reserver"/>

                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-2" >Site&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<select name="site" class="form-control text-center col-sm-12" style="float:right" required></select>
								</div>	
                            </div>

                            <div class="form-group form-row">
                                <label style="white-space:nowrap;background-color:white" class="col-sm-2" >Plage&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;color:white" class="col-sm-3 btn btn-success" for="jour">
									<input class="form-check-input"  type="radio" id="jour" name="plage"  value="1" required>Jour</label>
                                    <label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;" class="col-sm-3 btn btn-danger" for="nuit">
									<input class="form-check-input reserv"  type="radio"  id="nuit" name="plage"  value="2" required>Nuit</label>
                                    <input type="text" id="datepicker" class="form-control datepicker text-center col-sm-6" style="height:30px;" name="date_reserv" placeholder="Date" required />
								</div>	
                             </div>
							 
                            <div class="form-group form-row">
                                <label style="white-space: nowrap;" class="col-sm-2" >Inspecteur&nbsp;*</label>
                                <div class="col-sm-10" style="float:right">
                                    <select name="inspecteur" class="form-control text-center col-sm-12" style="float:right" required></select>
                                </div>
                            </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success pull-center button-affect-except">Valider</button>
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

