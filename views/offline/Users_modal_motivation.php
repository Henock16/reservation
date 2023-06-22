<div class="row">
	<div class="modal fade" id="modal-motivation" style="z-index: 1401;" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 3px;">
				<div class="modal-header" id="modal-motivation-header">
          			<h4 class="modal-title lead" style="font-weight: bold;color:white" id="modal-motivation-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
              <form class="form-motivation">
				<div class="modal-body" style="max-height: 500px; overflow-y:auto;">
                    <div class="row" style="vertical-align: center">
                        <input type="hidden"  name="action" value="">
                        
						<div class="col-md-12" style="margin-bottom: 0px">
                            <p id="motivation-message" class="lead " style="margin-bottom: 20px;font-size: medium;vertical-align: center">

                            </p>
                        </div>
                        <div class="col-md-12" >
                            <textarea class="form-control border-danger" name="motif" rows="9" maxlength="500" required></textarea>
                        </div>
                    </div>
                </div>
				<div class="modal-footer"  style=" ">
					<button type="button" data-dismiss="modal"class="btn btn-danger pull-center ">Fermer</button>
					<button type="submit" id="submit"class="btn btn-success pull-right">Envoyer</button>
				</div>
			  </form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
