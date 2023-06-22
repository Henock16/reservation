<div class="row">
	<div class="modal fade" id="modal-matrice" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content">
				<div class="modal-header" id="modal-affect-except-header" Style="background-color:lightgreen">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-affect-except-title">Matrice des heures d'affectation des inspecteurs</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form method="post" class="form-group" id="form-matrice" style="margin-bottom: 5px;">
				<div class="modal-body" style="overflow-y:hidden;">
 
                            <div id="matrice-type" class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-3" >Type de matrice *</label>
								<div class="input-group col-sm-9" style="float:right">
									<select name="type" class="form-control text-center col-sm-12" style="float:right">
										<option value="1" >HEBDOMADAIRE</option>
										<option value="2" selected>MENSUELLE</option>
									</select>
								</div>	
                            </div>
							 
                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-3" >Mois *</label>
								<div class="input-group col-sm-9" style="float:right">
									<select name="mois" class="form-control text-center col-sm-12" style="float:right" required></select>
								</div>	
                            </div>
							 
                            <div id="matrice-semaine" class="form-group form-row">
                                <label style="white-space: nowrap;" class="col-sm-3" >Semaine *</label>
                                <div class="col-sm-9" style="float:right">
                                    <select name="semaine" class="form-control text-center col-sm-12" style="float:right" ></select>
                                </div>
                            </div>

                            <div id="matrice-superviseur" class="form-group form-row">
                                <label style="white-space: nowrap;" class="col-sm-3" >Superviseur *</label>
                                <div class="col-sm-9" style="float:right">
                                    <select name="superviseur" class="form-control text-center col-sm-12" style="float:right" required></select>
                                </div>
                            </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success pull-center ">Télécharger</button>
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

