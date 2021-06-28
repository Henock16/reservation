			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
					<form class="form-trireserv">
						<div class="form-group row col-sm-12" style="margin-bottom:5px;">
							<h4 class="card-title col-sm-3 ">Affectation des réservations</h4>
							<div class="input-group col-sm-2"  style="float:left">
								<select class="form-control text-center" name="statut" style="height:30px;padding-left:5px;padding-right:5px;">
									<option value="0" selected="selected">STATUT</option>
									<option value="1" class="text-center">En attente</option>
									<option value="2" style="text-align:center">Annulée</option>
									<option value="3" ><center>Affectée</center></option>
									<option value="4" style="font-weight:bold;">Avortée</option>
									<option value="5" style="align:center">Rejetée</option>
									<option value="6" style="font-weight:bold;">Expirée</option>
								</select>
							</div>
							<div class="input-group col-sm-2"  style="float:left">
								<input type="text" class="form-control datepicker text-center" name="date" value="" placeholder="DATE" style="height:30px;padding-left:10px;padding-right:10px;"/>
							</div>
							<div class="input-group col-sm-5"  style="float:left">
								<select class="form-control" name="pont" style="height:30px">
								</select>
							</div>
						</div>
					</form>
					<hr color="green" size="3" noshade />
                   <div class="table-responsive">
                    <table class="table table-hover table-reservations" width="100%">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Plage</th>
						              <th>Pont</th>
                          <th>Statut</th>
                          <th>Inspecteur</th>
                          <th>Non</th>
                          <th>Oui</th>
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
                        </tr>
                       </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>