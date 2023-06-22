			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
					<form class="form-triaffect">
						<div class="form-group row col-sm-12" style="margin-bottom:5px;">
							<h4 class="card-title col-sm-3 ">Extraction des affectations</h4>
							<select class="form-control col-sm-1 text-center" name="facturation" style="height:30px;float:left;padding-left:5px;padding-right:5px;">
								<option value="">FACTURE</option>
								<option value="0">OUI</option>
								<option value="1">NON</option>
							</select>
							
							<input type="text" class="form-control col-sm-1 datepicker text-center" name="debut" value="" placeholder="DEBUT" style="float:left;height:30px;padding-left:5px;padding-right:5px;margin-left:5px;"/>
							
							<input type="text" class="form-control col-sm-1 datepicker text-center" name="fin" value="" placeholder="FIN" style="float:left;height:30px;padding-left:5px;padding-right:5px;margin-left:5px;"/>

							<select class="form-control col-sm-2" name="inspecteur" style="float:left;height:30px;padding-right:5px;padding-top:5px;margin-left:5px;">
							</select>
							
							<select class="form-control col-sm-2" name="user" style="float:left;height:30px;padding-right:5px;padding-top:5px;margin-left:5px;">
							</select>
							
							<button type="submit" id="submit-affectations" class="btn btn-success" style="float:left;height:30px;padding-left:5px;padding-right:5px;padding-top:5px;margin-left:5px;width:40px;color:white"><i class="mdi mdi-magnify-plus"></i></button>
						</div>
					</form>
					<hr color="green" size="3" noshade />
						<div id="resultat" class="form-group row col-sm-12" style="margin-bottom:5px;">
						
						</div>
					<hr color="green" size="3" noshade />
                    <div class="table-responsive">
                    <table class="table table-hover table-affectations" width="100%">
                      <thead>
                        <tr>
                          <th>Facturé</th>
                          <th>Demandeur / Pont</th>
                          <th>Date</th>
                          <th>Plage</th>
						  <th>Pont</th>
                          <th>Inspecteur</th>
                          <th>Demandeur</th>
                          <th>Ville</th>
                          <th>Action</th>
                          <th>Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
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