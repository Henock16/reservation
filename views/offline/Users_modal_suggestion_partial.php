<!--DETAILS DE LA SUGGESTION-->
<div class="row">
	<div class="modal fade" id="modal-suggestion" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content" >
				<div class="modal-header">
          <h4 class="modal-title lead" style="font-weight: bold;" id="modal-suggestion-title"><i class="mdi mdi-head-alert-outline text-success"></i>&nbsp;Suggestion</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body" style="overflow-y:hidden;">

                   <div class="col-12" id="suggestion-details">
                        <h3 class="lead" style="font-weight: bold;" id="numero-suggestion">
                            <b> Suggestion N&ordm;:</b> <span id="suggestion-number"></span>
                        </h3>
                        <br/>
                        <form class="form-suggestion">
							<div class="form-group row" id="anonymat">
                                <label class="col-sm-2">Anonymat</label>
                                <div class="col-sm-10">			
 									<label class="col-sm-11 col-form-label" for="anonyme"><input class="col-sm-1" type="checkbox" id="anonyme" name="anonyme" value="1">Rester anonyme</label>
                                </div>
                            </div>
                            <input type="hidden"  name="suggestion-type-id" value="">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Cible *</label>
                                <div class="col-sm-10">
                                    <select class="form-control suggestion-field" name="type" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Titre *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control suggestion-field" name="title" placeholder="Donner un titre à la suggestion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Texte *</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control suggestion-field" name="message" rows="5" maxlength="255" placeholder="Expliquer la suggestion en détail" ></textarea>
                                </div>
                            </div>
                        </form>
                    </div>


				</div>


				<div class="modal-footer">
					<button type="button" data-dismiss="modal"class="btn btn-danger pull-center ">Fermer</button>
					<button type="button" id="submit-suggestion"class="btn btn-success pull-right">Soumettre</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
