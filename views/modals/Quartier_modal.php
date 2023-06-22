<div class="row">
	<div class="modal fade" id="modal-quartier" style="z-index: 1401;padding-left:0px;margin-left:0px;" data-backdrop="static">
		<div class="modal-dialog lg" role="document" style="border-radius: 3px;width:700px;">
			<div class="modal-content">
				<div class="modal-header" id="modal-quartier-header">
					<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-quartier-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-quartier">
				<div class="modal-body" style="overflow-y:hidden;">
 
					<input type="hidden" name="action-id"/>
					<input type="hidden" name="quartier-id"/>
					<input type="hidden" name="origine"/>

					<div class="form-group row" id="nom"style="margin-top:0px;margin-bottom:0px;">
						<label class="col-sm-4" style="padding-top:0px;height:30px;">Nom</label>
						<div class="input-group col-sm-8"  style="float:right">
							<input type="text" class="form-control quartier-details" name="nom" placeholder="" style="height:30px" required/>
						</div>
                    </div> 
				</div>
				<div class="modal-footer">
					<button type="submit" id="submit-quartier" class="btn btn-success pull-center"></button>
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
