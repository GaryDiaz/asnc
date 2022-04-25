<link href="<?=base_url()?>application/views/publicaciones/wizard.css" rel="stylesheet" />
<div class="sidebar-bg"></div>
<div id="content" class="content">
	<h2>Registro de Llamado Concurso</h2>
	<div class="row">
		<section class="signup-step-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Nuevo Llamado</i></a>
                                </li>
								<li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2 </span> <i>Configuración Llamado</i></a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"  aria-expanded="false"><span class="round-tab">3</span> <i>Períodos Aclaratoria / Respuesta	</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"  aria-expanded="false"><span class="round-tab">4</span> <i>Entrega de Sobres</i></a>
                                </li>
                            </ul>
                        </div>

                        <form role="form" action="index.html" class="login-box">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h4 class="text-center">Nuevo Llamado</h4>
                                    <div class="row">
										<div class="form-group col-6">
											<label>Número de Proceso <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" onkeypress="may(this);" type="text" name="num_proceso" id="num_proceso" placeholder="Descripcion de Número de Proceso">
										</div>
										<div class="form-group col-6">
											<label>Nivel de Ente <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_ente" id="id_ente">
												<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Modalidad <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_modalidad" id="id_modalidad" onclick=llenar();>
											<option value="0">SELECCIONE</option>
												<?php foreach ($modalidades as $data): ?>
													<option value="<?=$data['id_modalidad']?>"><?=$data['decr_modalidad']?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Mecanismo <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_mecanismo" id="id_mecanismo">
												<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Objeto de Contratación <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_obj_cont" id="id_obj_cont" onclick=llenarca();>
											<option value="0">SELECCIONE</option>
													<?php foreach ($obj_contrat as $data): ?>
														<option value="<?=$data['id_objeto_contrata']?>"><?=$data['desc_objeto_contrata']?></option>
													<?php endforeach; ?>
												</select>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Actividad <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_actividad" id="id_actividad">
												<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-3">
											<label>Denominación del Proceso <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="denominacion_proc" name="denominacion_proc" rows="3"></textarea>
										</div>
										<div class="form-group col-3">
											<label>Objeto de la Contratación <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="obj_contratacion" name="obj_contratacion" rows="3"></textarea>
										</div>
										<div class="form-group col-6">
											<label>Página web del Contratante <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" onkeypress="may(this);" type="text" name="pag_contratante" id="pag_contratante" placeholder="Dirección url">
										</div>
										<div class="form-group col-12">
											<div id="accordion" class="card-accordion">
												<div class="card">
													<div class="card-header bg-black text-white pointer-cursor" data-toggle="collapse" data-target="#collapseOne">
														Información Costo del Pliego
													</div>
													<div id="collapseOne" class="collapse show" data-parent="#accordion">
														<div class="card-body">
															<div class="form-group row">
																<div class="col-md-12">
																	<div class="checkbox checkbox-css checkbox-inline">
																		<input type="checkbox" value="1" id="inlineCssCheckbox2" onclick="verificar();"/>
																		<label for="inlineCssCheckbox2">¿Si lo tiene?</label>
																	</div>
																</div>
															</div>
															<div class="row" id="datos1" style="display:none">
																<div class="form-group col-3">
																	<label>Monto del Pliego <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="0.00">
																</div>
																<div class="form-group col-3">
																	<label>Metodo de Pago <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<select class="form-control" name="metodo_pago" id="metodo_pago">
																		<option value="">Tranferencia</option>
																		<option value="">Punto de Venta</option>
																	</select>
																</div>
																<div class="form-group col-6">
																	<label>Objervación del Pago <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<textarea class="form-control" id="obs_pago" name="obs_pago" rows="1"></textarea>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="card-header bg-black text-white pointer-cursor collapsed" data-toggle="collapse" data-target="#collapseTwo">
														Publicación de Prensa
													</div>
													<div id="collapseTwo" class="collapse" data-parent="#accordion">
														<div class="card-body">
															<div class="form-group row">
																<div class="col-md-12">
																	<div class="checkbox checkbox-css checkbox-inline">
																		<input type="checkbox" value="1" id="inlineCssCheckbox3" onclick="verificar2();"/>
																		<label for="inlineCssCheckbox3">¿Publicacióbn en Prensa?</label>
																	</div>
																</div>
															</div>
															<div class="row" id="datos2" style="display:none">
																<div class="form-group col-4">
																	<label>Solicitante <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
																</div>
																<div class="form-group col-4">
																	<label>Aprobación <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="Número de Aprobación">
																</div>
																<div class="form-group col-4">
																	<label>Aprobador <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
																</div>
																<div class="form-group col-3">
																	<label>Fecha de Aprobación <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
																</div>
																<div class="form-group col-3">
																	<label>Fecha de Publicación <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
																</div>
																<div class="form-group col-4">
																	<label>Periodico <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="Nombre">
																</div>
																<div class="form-group col-4">
																	<label>Página de Publicación <b title="Campo Obligatorio" style="color:red">*</b></label>
																	<input class="form-control" type="text" name="pag_contratante" id="pag_contratante" placeholder="Dirección URL">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn next-step">Siguiente</button></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h4 class="text-center">Configuración Llamado</h4>
                                    <div class="row">
										<div class="form-group col-4">
											<label>Fecha inicial del Pliego <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<div class="form-group col-4">
											<label>Fecha de Inicio <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<div class="form-group col-4">
											<label>Fecha Fin Disponible <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>

										<div class="form-group col-4">
											<label>Estado <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_estado" id="id_estado" onclick="llenar_municipio();">
													<option value="0">SELECCIONE</option>
														<?php foreach ($estados as $data): ?>
															<option value="<?=$data['id']?>"><?=$data['descedo']?></option>
														<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group col-4">
											<label>Municipio <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_municipio" id="id_municipio" onclick="llenar_parroquia();">
													<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-4">
											<label>Parroquia <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_parroquia" id="id_parroquia">
													<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-12">
											<label>Dirección <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="obj_contratacion" name="obj_contratacion" rows="3"></textarea>
										</div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Regresar</button></li>
                                        <li><button type="button" class="default-btn next-step">Continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h4 class="text-center">PERIODOS</h4>
                                    <div class="row">
										<label>Periodo de Aclaratorias</label>
										<div class="form-group col-12">
											<label>Fecha inicial del Pliego <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<div class="form-group col-12">
											<label>Fecha de Inicio <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<label class="mt-3">Periodo de Aclaratorias</label>
										<div class="form-group col-12">
											<label>Fecha Top de Aclaratorias <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<div class="form-group col-12 mt-3">
											<label>Observacion <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="obj_contratacion" name="obj_contratacion" rows="3"></textarea>
										</div>
										<div class="form-group col-12">
											<input type="hidden">
										</div>

                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Regresar</button></li>
                                        <li><button type="button" class="default-btn next-step">Continue</button></li>
                                    </ul>
                                </div>
								<div class="tab-pane" role="tabpanel" id="step4">
                                    <h4 class="text-center">Entrega de Sobres</h4>
                                    <div class="row">
										<div class="form-group col-4">
											<label>Fecha de entrega <b title="Campo Obligatorio" style="color:red">*</b></label>
											<input class="form-control" type="date" name="pag_contratante" id="pag_contratante" placeholder="Nombre y Apellido">
										</div>
										<div class="form-group col-6">
											<label>Estado <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_estado_n" id="id_estado_n" onclick="llenar_municipio_n();">
													<option value="0">SELECCIONE</option>
														<?php foreach ($estados as $data): ?>
															<option value="<?=$data['id']?>"><?=$data['descedo']?></option>
														<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group col-6">
											<label>Municipio <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_municipio_n" id="id_municipio_n" onclick="llenar_parroquia_n();">
												<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-6">
											<label>Parroquia <b title="Campo Obligatorio" style="color:red">*</b></label>
											<select class="form-control" name="id_parroquia_n" id="id_parroquia_n">
												<option value="0">SELECCIONE</option>
											</select>
										</div>
										<div class="form-group col-12">
											<label>Dirección <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="obj_contratacion" name="obj_contratacion" rows="3"></textarea>
										</div>
										<div class="form-group col-12">
											<label>Observacion <b title="Campo Obligatorio" style="color:red">*</b></label>
											<textarea class="form-control" id="obj_contratacion" name="obj_contratacion" rows="3"></textarea>
										</div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Anterior</button></li>
                                        <li><button type="button" class="default-btn next-step">Guardar</button></li>
                                    </ul>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
	</div>
</div>
<script src="<?=base_url()?>/js/publicaciones/registro_llamado.js"></script>
<script src="<?=base_url()?>/js/publicaciones/wizard.js"></script>
