<div class="row">
	<div class="modal fade" id="modal-affectation" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header" id="modal-affectation-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-affectation-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-affectation">
				<div class="modal-body" style="overflow-y:hidden;">

                   <div class="col-12" id="affectation-details">
<<<<<<< HEAD
                        <b>
                            Veuillez sélectionner l'inspecteur à affecter sur <h5 class="lead" style="font-weight: bold;" id="nom-pont"></h5> 
                        </b>
                        <br/>
						
                            <input type="hidden"  name="statut" value="">
=======
                        <h3 class="lead" style="font-weight: bold;">
                            <b> Veuillez sélectionner l'inspecteur à affecter:</b> 
                        </h3>
                        <br/>
						
>>>>>>> 686f7821902170a957ef7e43867a07ae1e40e643
                            <input type="hidden"  name="action-id" value="">
                            <input type="hidden"  name="reservation-id" value="">
                            <input type="hidden"  name="table" value="">

                            <div class="form-group row">
                                 <div class="col-sm-12">
                                    <select class="form-control" name="inspecteur-id" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="inspectors_affectations">
                               <div class="col-sm-12">
									<table class="table table-hover table-inspect-affect" width="100%">
									  <thead>
										<tr>
											<th style="text-align: center" colspan=5 id="nbaffect"></th>
										</tr>
										<tr>
											<th style="text-align: center">TYPE</th>
											<th style="text-align: center">DATE</th>
											<th style="text-align: center">PLAGE</th>
											<th style="text-align: center">SITE</th>
											<th style="text-align: center"></th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										  <td></td>
										</tr>
									   </tbody>
									</table>
                                </div>
                            </div>
                    </div>


				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal"class="btn btn-danger pull-center ">Fermer</button>
					<button type="submit" id="submit-affectation"class="btn btn-success pull-right"></button>
				</div>
              </form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
