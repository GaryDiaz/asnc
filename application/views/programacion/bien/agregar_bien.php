<div class="sidebar-bg"></div>
<div id="content" class="content">
	<div class="col-lg-12">
    	<div class="row">
      		<div class="panel panel-inverse">
        		<div class="panel-body">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-4">
							<button onclick="location.href='<?php echo base_url()?>index.php/Programacion/agregar_servicio?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg btn-default"  name="button">
								Agregar Información de Servicio
							</button>
						</div>
						<div class="col-4">
							<button onclick="location.href='<?php echo base_url()?>index.php/Programacion/agregar_obra?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg btn-default"  name="button">
								Agregar Información de Obra
							</button>
						</div>
					</div>
					<div class="col-12">
					  <br>
						<h3 class="text-center">Información de Bienes</h3>
					</div>
          			<form id="reg_bien" method="POST" class="form-horizontal">
            			<div class="row">
						
		                  	<div class="col-1"></div>
		                  	<div class="col-10 mt-4">
		                      	<div class="card card-outline-danger text-center bg-white">
		                          	<div class="card-block">
		                              	<blockquote class="card-blockquote" style="margin-bottom: -19px;">
		                                  	<p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
		                                  	<p class="f-s-16">RIF.: <?=$rif?> <br>
		                                  	Código ONAPRE: <?=$codigo_onapre?> <br>
		                                  	Año: <b><?=$anio?></b></p>
		                                  	<input type="hidden" id="id_programacion" name="id_programacion" value="<?=$id_programacion?>">
		                                  	<input type="hidden" name="fecha_est" id="fecha_est" value="<?=$anio?>">
		                              	</blockquote>
		                          	</div>
		                      	</div>
		                  	</div>
                  	<div class="col-3 mt-3" >
                      	<label>Acción a Cargar</label>
                      	<select id="acc_cargar" name="acc_cargar" class="select2 form-control">
                          	<option value="0">Seleccione</option>
                          	<option value="1">Proyecto</option>
                          	<option value="2">Acción Centralizada</option>
                      	</select>
                  	</div>
                  <div class="col-6 mt-3 form-group" id="acc_s" style="display:none;">
                      <label>Acción Centralizada<b style="color:red">*</b></label><br>
                      <select style="width: 100%;"  name="id_accion_centralizada" id="id_accion_centralizada" class="default-select2 form-control">
                          <option value="0">SELECCIONE</option>
                          <?php foreach ($acc_cent as $data): ?>
                          <option value="<?=$data['id_accion_centralizada']?>"><?=$data['desc_accion_centralizada']?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="col-6 mt-3 form-group" id="proyecto_s" style="display:none;">
                      <label>Nombre del Proyecto <b style="color:red">*</b></label>
                      <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control">
                  </div>
                  <div class="form-group mt-3 col-3">
                      <label>Objeto de Contratación</label>
                      <input type="text" class="form-control" id="id_obj_comercial" name="id_obj_comercial" value="Bienes" readonly>
                  </div>
                  <div class="col-12">
                      <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                  </div>
                  <div class="col-12 text-center">
                      <h4 style="color:red;">Información Items Fuente Financiamiento (IFF)</h4>
                  </div>
                  <div class="form-group col-12">
                      <label>Partida Presupuestaria</label><br>
                          <!-- <input type="hidden" name="par_presupuestaria" id="par_presupuestaria"> -->
                          <select style="width: 100%;" id="par_presupuestaria" required name="par_presupuestaria" class="default-select2 form-control">
                              <option value="0">Seleccione</option>
                              <?php foreach ($part_pres as $data): ?>
                                  <option value="<?=$data['id_partida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?>/<?=$data['codigopartida_presupuestaria']?>"><?=$data['codigopartida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?></option>
                              <?php endforeach; ?>
                          </select>
                  </div>
                  <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                  <div class="form-group col-3">
                      <label>Estado</label><br>
                      <select style="width: 100%;" id="id_estado" name="id_estado" class="default-select2 form-control" multiple="multiple">
                          <option value="0">Seleccione</option>
                          <?php foreach ($estados as $data): ?>
                              <option value="<?=$data['descedo']?>"><?=$data['descedo']?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group col-3">
                      <label>Fuente de Financiamiento</label>
                      <select style="width: 100%;" id="fuente_financiamiento" name="fuente_financiamiento" class="form-control">
                          <option value="0">Seleccione</option>
                          <?php foreach ($fuente as $data): ?>
                              <option value="<?=$data['id_fuente_financiamiento']?>/<?=$data['desc_fuente_financiamiento']?>"><?=$data['desc_fuente_financiamiento']?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
									<div id="desc_ff" class="form-group col-3" style="display:none">
                      <label>Descripcion<b style="color:red">*</b></label>
                      <input id="descripcion_ff" name="descripcion_ff" type="text" class="form-control">
                  </div>
                  <div class="form-group col-3">
                      <label>Porcentaje<b style="color:red">*</b></label>
                      <input id="porcentaje" name="porcentaje" onblur="porc();" type="text" class="form-control">
                  </div>

                  <div class="col-12">
                      <h5 class="text-center"><b style="color:red;">NOTA:</b> Debe llenar todos lo items para llenar la tabla. <br>
											 												<b>Recuerde que la suma del procentaje de cada fuente de Financiamiento debe dar un total de 100</b></h5>
                  </div>
                  <div class="col-5"></div>
                  <div class="col-7 mt-4">
                      <button type="button" onclick="agregar_ff(this);" class="btn btn-lg btn-default" id="prueba2">
                          Agregar <b>IFF</b>
                      </button>
                  </div>
                  <div class="table-responsive mt-3">
                      <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al menos un registro agregado, para proceder con la solicitud.</h5>
                      <table id="target_acc_ff" class="table table-bordered table-hover">
                          <thead style="background:#e4e7e8;">
                              <tr class="text-center">
                                  <th>Codigo Part. Presupuestaria</th>
                                  <th>Partida Presupuestaria</th>
                                  <th>Estado</th>
                                  <th>Fuente de Financiamiento</th>
																	<th></th>
                                  <th>%</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                      </table>
                  </div>
									<div class="col-12">
										<hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
									</div>
									<div class="col-12 mt-2 text-center">
										<h4 style="color:red;">Información Items Productos (IP)</h4>
									</div>

									<div class="form-group col-12">
										<label>CCNU <i style="color: red;" title="Para llenar el campo de CCNU debe ingresar una palabra clave, esto le ayudara con la busqueda" class="fas fa-question-circle"></i></label>
										<div class="row">
											<div class="col-4">
												<input title="Debe ingresar una palabra para realizar la busqueda" type="text" class="form-control" onKeyUp="this.value=this.value.toUpperCase();" name="ccnu_b" id="ccnu_b" onblur="buscar_ccnu();">
											</div>
											<div class="col-8">
												<select  name="id_ccnu" id="id_ccnu" title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones." class="form-control">
													<option value="0">Seleccione</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group col-6">
										<label>Especificación <b style="color:red">*</b></label>
										<input id="especificacion" type="text" class="form-control">
									</div>
									<div class="form-group col-6">
										<label>Unidad de Medida <b style="color:red">*</b></label><br>
										<select  style="width: 100%;" id="id_unidad_medida" class="form-control">
											<option value="">SELECCIONE</option>
											<?php foreach ($unid as $data): ?>
												<option value="<?=$data['id_unidad_medida']?>/<?=$data['desc_unidad_medida']?>"><?=$data['desc_unidad_medida']?></option>
											<?php endforeach; ?>
										</select>
									</div>

								<div class="card card-outline-danger">
									<h5 class="mt-3 text-center"><b>Distribución de la cantidad de la Ejecución Trimestral</b></h5>
									<div class="row mt-2">
										<div class="form-group col-2">
											<label>Cantidad<b style="color:red">*</b></label>
											<input id="cantidad" name="cantidad" onblur="calcular_bienes();" class="form-control" onkeypress="return valideKey(event);">
										</div>
										<div class="form-group col-2">
											<label>I<b style="color:red">*</b></label>
											<input id="I" name="I" onblur="calcular_bienes();"  value="0" class="form-control"  onkeypress="return valideKey(event);">
										</div>
										<div class="form-group col-2">
											<label>II<b style="color:red">*</b></label>
											<input id="II" name="II" onblur="calcular_bienes();" value="0" class="form-control" onkeypress="return valideKey(event);">
										</div>
										<div class="form-group col-2">
											<label>III<b style="color:red">*</b></label>
											<input id="III" name="III" onblur="calcular_bienes();" value="0" class="form-control"  onkeypress="return valideKey(event);">
										</div>
										<div class="form-group col-2">
											<label>IV<b style="color:red">*</b></label>
											<input id="IV" name="IV" onblur="calcular_bienes();" value="0" class="form-control" onkeypress="return valideKey(event);">
										</div>
										<div class="form-group col-2">
											<label>Cantd. restante a Distribuir <b style="color:red">*</b></label>
											<input id="cant_total_distribuir" onkeyup="verif();" name="cant_total_distribuir_acc" class="form-control"  disabled>
										</div>
									</div>
								</div>
								<div class="form-group col-2">
									<label>Costo Unitario <b style="color:red">*</b></label>
									<input style="width: 115%;" id="costo_unitario" name="costo_unitario"  onblur="calcular_bienes();" class="form-control" onkeypress="return valideKey(event);">
								</div>
								<div class="form-group col-3">
									<label>Precio Total Estimado<b style="color:red">*</b></label>
									<input id="precio_total" name="precio_total" type="text" class="form-control" disabled>
								</div>

								<div class="form-group col-2">
									<label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
									<select style="width: 100%;" name="id_alicuota_iva" id="id_alicuota_iva" onchange="calcular_bienes();" class="form-control">
										<option value="">SELECCIONE</option>
										<?php foreach ($iva as $data): ?>
											<option value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>"><?=$data['desc_porcentaj']?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group col-2">
									<label>Monto IVA Estimado<b style="color:red">*</b></label>
									<input id="iva_estimado" name="iva_estimado" type="text" class="form-control" disabled>
								</div>
								<div class="form-group col-3">
									<label>Monto total Estimado<b style="color:red">*</b></label>
									<input id="monto_estimado" name="monto_estimado" type="text" class="form-control" disabled>
								</div>
								<div class="col-12">
									<hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
								</div>
								<div class="form-group col-2">
									<label>Estimado I Trimestre</b></label>
									<input id="estimado_i" name="estimado_i" type="text" class="form-control" disabled>
								</div>
								<div class="form-group col-2">
									<label>Estimado II Trimestre</label>
									<input id="estimado_ii" name="estimado_ii" type="text" class="form-control" disabled>
								</div>
								<div class="form-group col-2">
									<label>Estimado III Trimestre</label>
									<input id="estimado_iii" name="estimado_iii" type="text" class="form-control" disabled>
								</div>
								<div class="form-group col-2">
									<label>Estimado IV Trimestre</label>
									<input id="estimado_IV" name="estimado_IV" type="text" class="form-control" disabled>
								</div>
								<div class="form-group col-4">
									<label>Estimado Total Trimestres + Iva Estimado</label>
									<input id="estimado_total_t" name="estimado_total_t" type="text" class="form-control" disabled>
								</div>
								<div class="col-12">
									<hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
								</div>
								<h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al menos un registro agregado, para proceder con la solicitud.</h5>

								<div class="col-12 text-center">
									<button type="button" onclick="agregar_ccnu_acc(this);" class="btn btn-lg btn-default">
										Agregar
									</button>
								</div>

								<div class="table-responsive mt-4">
									<h5 class="text-center">Lista de Requerimiento</h5>
									<h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al menos un requerimiento agregado, para proceder con la solicitud.</h5>
									<table id="target_req_acc" class="table table-bordered table-hover">
										<thead style="background:#e4e7e8;">
											<tr class="text-center">
												<th>Partida Pres.</th>
												<th>CCNU</th>
												<th>Esp.</th>
												<th>Unid. Medida</th>
												<th>Cantidad</th>
												<th>I</th>
												<th>II</th>
												<th>III</th>
												<th>IV</th>
												<th>Total a Distrib.</th>
												<th>Costo Unit.</th>
												<th>Precio Total</th>
												<th>IVA Estimado</th>
												<th>Monto Iva Est.</th>
												<th>Monto Total Est.</th>
												<th>Acciones</th>
											</tr>
										</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="row text-center mt-3">
							<div class="col-6">
								<button class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-success" type="button" onclick="guardar_bien();" id="btn_guar_2" name="button" disabled>Guardar</button>
							</div>
							<div class="col-6">
								<a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" href="javascript:history.back()"> Volver</a>
							</div>
						</div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url()?>/js/programacion.js"></script>
<script src="<?=base_url()?>/js/bien/calculos_bienes.js"></script>
<script src="<?=base_url()?>/js/bien/agregar_ff.js"></script>
<script src="<?=base_url()?>/js/bien/agregar_ip.js"></script>
<script src="<?=base_url()?>/js/bien/calculos_bienes.js"></script>
<script src="<?=base_url()?>/js/bien/registro.js"></script>
<script type="text/javascript">
function valideKey(evt){
   var code = (evt.which) ? evt.which : evt.keyCode;
    if(code==8) { // backspace.
        return true;
    }else if(code>=48 && code<=57) { // is a number.
        return true;
    }else{ // other keys.
        return false;
    }
}
</script>
