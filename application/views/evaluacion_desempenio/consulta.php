	<div id="content" class="content">
		<div class="row">
			<div class="col-lg-12">
	            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
	                <div class="panel-heading">
					</div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-4">
	                            <label>Rif del Contratista a Consultar</label>
	                            <input class="form-control" type="text" name="rif_b" id="rif_b" onkeypress="may(this);" placeholder="J123456789">
	                        </div>
	                        <div class="col- mt-4">
	                            <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i class="fas fa-search"></i> </button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
			<div class="col-12">
				<h4 class="text-center" id="mensaje" style="display:none"> <b style="color:red">Nota:</b>Por favor espere mientras se genera la información Completa</h4>
			</div>

			<div class="col-3"></div>
			<div class="col-lg-6">
				<div class="panel panel-inverse" data-sortable-id="chart-js-1">
					<div class="panel-heading">
						<h4 class="panel-title">Calificaciones</h4>
					</div>
					<div class="panel-body">
						<div>
							<canvas id="miGrafico"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<br>
				<h3 class="text-center">Evaluaciones Registradas Anterior Sistema</h3>
				<table id="data1" class="table table-striped table-bordered">
					<thead style="background:#e4e7e8">
						<tr class="text-center">
							<th>Fecha Evaluación</th>
							<th>Ente Calificador</th>
							<th>Calificación</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="col-6">
				<br>
				<h3 class="text-center">Evaluaciones Registradas Nuevo Sistema</h3>
				<table id="data2" class="table table-striped table-bordered">
					<thead style="background:#e4e7e8">
						<tr class="text-center">
							<th>Fecha Evaluación</th>
							<th>Ente Calificador</th>
							<th>Calificación</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="<?=base_url()?>/js/graficos.js"></script>
	<script type="text/javascript">
	    function may(e){
	         e.value = e.value.toUpperCase();
	    }
	</script>
