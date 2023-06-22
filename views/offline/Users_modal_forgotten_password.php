			<!-- Modal -->
			<div class="modal fade" id="modal-ForgottenPassword" role="dialog"  data-keyboard="false"  data-backdrop="static">
			
				<div class="modal-dialog" style="width:300px;">
    
					<!-- Modal content-->
					<div class="modal-content">
					
						<div class="modal-header">
							<h4 class="modal-title lead" style="font-weight: bold;" ><i class="mdi mdi-lock-open-check text-warning"></i>&nbsp;Mot de passe oublié</h4>
						</div>
						
						<div class="modal-body">
		
							<form class="form" role="form" method="post" action="#" name="ForgottenPassword-form" id="form-ForgottenPassword">

								<input type="hidden" id="matr" name="matr" value=""/>
								<input type="hidden" id="test" name="test" value=""/>
								<input type="hidden" id="champ" name="champ" value=""/>
								<input type="hidden" id="result" name="result" value=""/>
				
								<label id="request" class="col-sm-12 col-form-label"></label>

								<div id="answer" class="col-sm-12"></div>

								<div class="col-sm-12 naissance">
									<input type="text" class="form-control datepicker-naissance naissance" name="datenaissance" placeholder="JJ/MM/AAAA" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
								</div>
								
								<div class="col-sm-12 embauche">
									<input type="text" class="form-control datepicker-embauche embauche" name="dateembauche" placeholder="JJ/MM/AAAA" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Champ obligatoire')" required />
								</div>
								
								<div class="form-group row"></div>
											
								<div class="form-group row col-sm-12" style="align:center;margin-left:0px;">
									<table width="100%">
										<tr>
											<td style="margin-bottom:0px;margin-top:0px;" width="33%">
												<button type="button" class="btn btn-danger next" data-dismiss="modal" style="border-radius:3px; height:30px;font-size:15px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">Fermer</button>
											</td>
											<td align="center" style="margin-bottom:0px;margin-top:0px;" width="33%">
												<button type="button" class="btn btn-info end" data-dismiss="modal" style="border-radius:3px; height:30px;font-size:15px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">OK</button>
											</td>
											<td align="right" style="margin-bottom:0px;margin-top:0px;" width="33%">
												<button type="submit" class="btn btn-success next" style="border-radius:3px; height:30px;font-size:15px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);">Suivant</button>
											</td>
										</tr>
									</table>
								</div>
								
							</form>
		
						</div>
					</div>
      
				</div>
			</div>

