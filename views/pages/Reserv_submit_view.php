            
                <div class="form-style-2" style="margin:auto; width: 100%; max-width: 1000px;padding-top:20px">
        
                    <form method="post" class="form-group" id="frm-reserv" style="margin-bottom: 5px;">

                            <input type="hidden" name="action"  value="reserver"/>

                            <div class="form-style-2-heading">RESERVER UN AGENT</div>

                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-2" >Site&nbsp;*</label>
								<div class="input-group col-sm-10"  style="float:right">
									<select id="site" name="site" class="form-control text-center col-sm-12" style="float:right" required></select>
								</div>	
                            </div>

                            <div class="form-group form-row">
                                <label style="white-space: nowrap;;background-color:white" class="col-sm-2" >Plage&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;" class="col-sm-3 btn btn-success" for="jour">
									<input class="form-check-input"  type="radio" id="jour" name="radio"  value="1" required>Jour</label>
                                    <label style="text-align:left;height:30px;padding-left:30px;padding-top:5px;" class="col-sm-3 btn btn-danger" for="nuit">
									<input class="form-check-input reserv"  type="radio"  id="nuit" name="radio"  value="2" required>Nuit</label>
                                    <input type="text" id="datepicker" class="form-control datepicker text-center col-sm-6" style="height:30px;" name="date_reserv" placeholder="Date" required />
								</div>	
                             </div>

                            <div class="form-style-2-heading">INFORMATIONS SOUMETTEUR</div>

                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-2" >Nom&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<input type="text" class="input-field form-control" id="fullname" name="fullname" value="" style="height:30px;" required/></label>
								</div>	
                            </div>

                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-2" >Fonction&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<input type="text" class="input-field form-control" id="fonction" name="fonction" value="" style="height:30px;" required/></label>
								</div>	
                            </div>

                            <div class="form-group form-row" style="margin-top:20px">
                                <label style="white-space: nowrap;" class="col-sm-2" >Telephone&nbsp;*</label>
								<div class="input-group col-sm-10" style="float:right">
									<input type="text" class="input-field form-control" id="tel" name="tel" value="" style="height:30px;" required/></label>
								</div>	
                            </div>


                            <div class="form-style-2-heading"></div>

                            <div class="form-group text-center" style="margin: 20px;">
                                <input type="submit" class="btn btn-info button-reservation" style="outline-style: none; border-radius:3px; height:30px;font-size:12px;text-align:center; box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5); -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);" value="Réserver" name="Valider" id="button_valider" />
                            </div>

                    </form>
                                                    
                </div>
