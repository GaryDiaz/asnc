<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
    	<div class="col-lg-12">
            <form action="<?=base_url()?>index.php/Programacion/editar_programacion_proy_o" method="POST" class="form-horizontal">
    			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-body">
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
                                            <input type="hidden" id="id_programacion" name="id_programacion" value="<?=$id_programacion?>/<?=$id_p_acc_centralizada?>">
                                            <input type="hidden" name="fecha_est" id="fecha_est" value="<?=$anio?>">
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                             <?php foreach($inf_1_acc as $inf_1_acc):?><?php endforeach;?>
                             <div class="col-6 mt-3 form-group">
                                 <label>Acción Centralizada<b style="color:red">*</b></label><br>
                                 <select style="width: 100%;"  name="id_accion_centralizada" id="id_accion_centralizada" class="default-select2 form-control">
                                     <option value="<?=$inf_1_acc['id_accion_centralizada']?>"><?=$inf_1_acc['desc_accion_centralizada']?></option>
                                     <?php foreach ($acc_cent as $data): ?>
                                     <option value="<?=$data['id_accion_centralizada']?>"><?=$data['desc_accion_centralizada']?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
							 <div class="form-group mt-3 col-3">
                                <label>Objeto de Contratación</label>
                                <select id="id_obj_comercial" name="id_obj_comercial" class="default-select2 form-control">
                                    <option value="<?=$inf_1_acc['id_obj_comercial']?>"><?=$inf_1_acc['desc_objeto_contrata']?></option>
                                    <?php foreach ($act_com as $data): ?>
                                        <option value="<?=$data['id_objeto_contrata']?>"><?=$data['desc_objeto_contrata']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Información Items Fuente Financiamiento (IFF)</h4>
                            </div>
                            <div class="form-group col-12">
                                <label>Partida Presupuestaria</label>
                                    <input type="hidden" name="par_presupuestaria_ff" id="par_presupuestaria_ff">
                                    <select id="par_presupuestaria" name="par_presupuestaria" class="default-select2 form-control">
                                        <option value="0">Seleccione</option>
                                        <?php foreach ($part_pres as $data): ?>
                                            <option value="<?=$data['id_partida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?>/<?=$data['codigopartida_presupuestaria']?>"><?=$data['codigopartida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?></option>
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="form-group col-6">
                                <label>Estado</label>
                                <select id="id_estado" name="id_estado" class="default-select2 form-control" multiple="multiple">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($estados as $data): ?>
                                        <option value="<?=$data['descedo']?>"><?=$data['descedo']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Fuente de Financiamiento</label>
                                <select id="fuente_financiamiento" name="fuente_financiamiento" class="default-select2 form-control">
                                    <option value="0" selected="selected">Seleccione</option>
                                    <!-- <option selected="selected" value="0">Seleccione</option> -->
                                    <?php foreach ($fuente as $data): ?>
                                        <option value="<?=$data['id_fuente_financiamiento']?>/<?=$data['desc_fuente_financiamiento']?>"><?=$data['desc_fuente_financiamiento']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Porcentaje<b style="color:red">*</b></label>
                                    <input id="porcentaje" type="text" class="form-control" onblur="porc();">
                            </div>
                            <div class="col-12">
                                <h5 class="text-center"><b style="color:red;">NOTA:</b> Debe llenar todos lo items para llenar la tabla.</h5>
                            </div>
                            <div class="col-5"></div>
                            <div class="col-7 mt-4">
                                <button type="button" onclick="agregar_ff(this);" class="btn btn-lg btn-default"  id="btn_agregar" name="btn_agregar">
                                    Agregar
                                </button>
                            </div>

                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="col-11" style="margin-left: 40px;">
                                <div class="table-responsive mt-3">
                                    <h5 class="text-center">Nota: si desea editar una fila, debe <b>Descartar</b> y volver <b>Agregar</b>.</h5>
                                    <table id="target_ff" class="table table-bordered table-hover">
                                        <thead style="background:#e4e7e8;">
                                            <tr class="text-center">
                                                <th>Código Part. Presupuestaria</th>
                                                <th>Partida Presupuestaria</th>
                                                <th>Estado</th>
                                                <th>Fuente de Financiamiento</th>
                                                <th>%</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="inf_ff">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <h4 style="color:red;">Información Items Productos (IP)</h4>
                            </div>

							<div class="form-group col-4">
                                <label>Tipo de Obra <b style="color:red">*</b></label><br>
                                <select  id="id_tip_obra_e" name="id_tip_obra_e" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($tip_obra as $data): ?>
                                        <option value="<?=$data['id_tip_obra']?>/<?=$data['descripcion_tip_obr']?>"><?=$data['descripcion_tip_obr']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Alcance de la Obra <b style="color:red">*</b></label><br>
                                <select  id="id_alcance_obra_e" name="id_alcance_obra_e" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($alcance_obra as $data): ?>
                                        <option value="<?=$data['id_alcance_obra']?>/<?=$data['descripcion_alcance_obra']?>"><?=$data['descripcion_alcance_obra']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Objeto de la Obra <b style="color:red">*</b></label><br>
                                <select  id="id_obj_obra_e" name="id_obj_obra_e" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($obj_obra as $data): ?>
                                        <option value="<?=$data['id_obj_obra']?>/<?=$data['descripcion_obj_obra']?>"><?=$data['descripcion_obj_obra']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label>Rango de Fecha</label>
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" id="fecha_desde" name="fecha_desde" onchange="verif_d();" onblur="habilitar_trim();" name="start" placeholder="Desde" />
                                        <span class="input-group-addon">-</span>
                                        <input type="text" class="form-control"  id="fecha_hasta" name="fecha_hasta" onchange="verif_h();" onblur="habilitar_trim();" name="end" placeholder="Hasta" />
                                    </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Especificación <b style="color:red">*</b></label>
                                <input id="especificacion" type="text" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label>Unidad de Medida <b style="color:red">*</b></label><br>
                                <select  id="id_unidad_medida" name="id_unidad_medida" class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($unid as $data): ?>
                                        <option value="<?=$data['id_unidad_medida']?>/<?=$data['desc_unidad_medida']?>"><?=$data['desc_unidad_medida']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="card card-outline-danger">
                                <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b></h5>
                                <div class="row mt-2">
                                    <div class="form-group col-2">
                                        <label>I<b style="color:red">*</b></label>
                                        <input id="i" name="i" type="text" onblur="calculo();" value="0" class="form-control" onkeypress="return valideKey(event);" disabled>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>II<b style="color:red">*</b></label>
                                        <input id="ii" name="ii" type="text" onblur="calculo();" value="0" class="form-control"  onkeypress="return valideKey(event);" disabled>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>III<b style="color:red">*</b></label>
                                        <input id="iii" name="iii" type="text" onblur="calculo();" value="0" class="form-control"  onkeypress="return valideKey(event);" disabled>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>IV<b style="color:red">*</b></label>
                                        <input id="iv" name="iv" type="text" onblur="calculo();" value="0" class="form-control"  onkeypress="return valideKey(event);" disabled>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Cantd. Total Distribuir <b style="color:red">*</b></label>
                                        <input id="cant_total_distribuir" value="100" onblur="calculo();" name="cant_total_distribuir" type="number" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label>Precio Total <b style="color:red">*</b></label>
                                <input id="precio_total_e" name="precio_total_e" type="text" onclick="cant_total();" onblur="calculo();" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                                <select name="id_alicuota_iva" id="id_alicuota_iva" onchange="calculo();" class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($iva as $data): ?>
                                        <option value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>"><?=$data['desc_porcentaj']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                <input id="iva_estimado" name="iva_estimado" type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto total Estimado<b style="color:red">*</b></label>
                                <input id="monto_estimado" name="monto_estimado"  type="text" class="form-control" disabled>
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
                                <input id="estimado_iV" name="estimado_iV" type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label>Estimado Total Trimestres</label>
                                <input id="estimado_total_t" name="estimado_total_t" type="text" class="form-control" disabled>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 text-center">
                                <button type="button" onclick="agregar_ccnu(this);" class="btn btn-lg btn-default">
                                    Agregar
                                </button>
                            </div>

                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="table-responsive mt-4">
                                <h5 class="text-center">Nota: si desea editar una fila, debe <b>Descartar</b> y volver <b>Agregar</b>.</h5>
                                <table id="target_req" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Partida Pres.</th>
                                            <th>Tp. Obra</th>
											<th>Alc. Obra</th>
											<th>Obj. Obra</th>
                                            <th>Fecha Desde</th>
                                            <th>Fecha Hasta</th>
                                            <th>Esp.</th>
                                            <th>Unid. Medida</th>
                                            <th>I</th>
                                            <th>II</th>
                                            <th>III</th>
                                            <th>IV</th>
                                            <th>Precio Total</th>
                                            <th>IVA Estimado</th>
                                            <th>Monto Iva Est.</th>
                                            <th>Monto Total Est.</th>
                                            <th>Editar</th>
                                            <th>Descartar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--////////////////////////////SEGUNDA PARTE DE LA CARGA -->
                        <div class="col-12 text-center mt-3">
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-grey" href="javascript:history.back()"> Volver</a>
                            <button class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" type="submit" id="btn_guardar" name="button" >Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal para editar Proyecto / Obra</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="fecha_esti" id="fecha_esti" value="<?=$anio?>">
                    <input type="hidden" class="form-control" name="id_items" id="id_items">
                    <div class="form-group col-4">
                        <label>Cod. Partida Presupuestaria</label>
                        <input type="hidden" name="id_part_pres" id="id_part_pres">
                        <input id="cod_partida_pre" class="form-control" name="cod_partida_pre" class="form-control" disabled>
                    </div>
                    <div class="form-group col-8">
                        <label>Partida Presupuestaria</label>
                        <input id="partida_pre" class="form-control" name="partida_pre" class="form-control" disabled>
                    </div>
                    <div class="form-group col-12">
                        <label> Cambiar Partida Presupuestaria <i title="Si requiere cambiar la Partida Presupuestaria, debe seleccionarlo en el siguiente campo" class="fas fa-question-circle"></i></label>
                        <select class="form-control" name="selc_part_pres" id="selc_part_pres">
                            <option value="0">Seleccione</option>
                        </select>
                    </div>

					<div class="form-group col-4">
                        <label>Tipo de Obra </label>
                        <input type="hidden" id="id_tipo_obra_m" class="form-control" name="id_tipo_obra_m" class="form-control" disabled>
						<input id="tipo_obra_m" class="form-control" name="id_tipo_obra_m" class="form-control" disabled>
                    </div>
					<div class="form-group col-4">
                        <label>Alcance de la Obra </label>
                        <input type="hidden" id="id_alcance_obra_m" class="form-control" name="id_alcance_obra_m" class="form-control" disabled>
						<input id="alcance_obra_m" class="form-control" name="alcance_obra_m" class="form-control" disabled>
                    </div>
					<div class="form-group col-4">
                        <label>Objeto de la Obra </label>
                        <input type="hidden" id="id_obj_obra_m" class="form-control" name="id_obj_obra_m" class="form-control" disabled>
						<input id="obj_obra_m" class="form-control" name="obj_obra_m" class="form-control" disabled>
                    </div>

					<div class="form-group col-4">
						<label>Tipo de Obra <b style="color:red">*</b></label><br>
						<select  id="selec_tip_obra" name="selec_tip_obra" class="form-control">
							<option value="">SELECCIONE</option>
						</select>
					</div>
					<div class="form-group col-4">
						<label>Alcance de la Obra <b style="color:red">*</b></label><br>
						<select  id="selec_alcance_obra" name="selec_alcance_obra" class="form-control">
							<option value="">SELECCIONE</option>
						</select>
					</div>
					<div class="form-group col-4">
						<label>Objeto de la Obra <b style="color:red">*</b></label><br>
						<select  id="selec_obj_obra" name="selec_obj_obra" class="form-control">
							<option value="">SELECCIONE</option>
						</select>
					</div>

                    <div class="form-group col-3">
                        <label>Fecha desde</label>
                        <input type="date" class="form-control" name="fecha_desde_e" id="fecha_desde_e" onchange="verif_d_mod();" onblur="habilitar_trim_mod();">
                    </div>
                    <div class="form-group col-3">
                        <label>Fecha hasta</label>
                        <input type="date" class="form-control" name="fecha_hasta_e" id="fecha_hasta_e" onchange="verif_h_mod();" onblur="habilitar_trim_mod();">
                    </div>

					<div class="form-group col-3">
                        <label>Unidad de Medida</label>
                        <input type="text" class="form-control" name="unid_med" id="unid_med" disabled>
                        <input type="hidden" name="id_unid_med" id="id_unid_med">
                    </div>
                    <div class="form-group col-3">
                        <label> Cambiar Unid. Medida <i title="Si requiere cambiar la Unidad de Medida, debe seleccionarla en este campo" class="fas fa-question-circle"></i></label>
                        <select class="form-control" name="camb_unid_medi" id="camb_unid_medi">
                          <option value="0">Seleccione</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label>Especificación</label>
                        <input type="text" class="form-control" name="esp" id="esp">
                    </div>
                    
                    <div class="col-6"></div>
                    <div class="card card-outline-danger">
                        <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b></h5>
                        <div class="row mt-2">
                            <div class="form-group col-2">
                                <label>I Trimestre</label>
                                <input type="text" class="form-control" onkeypress="return valideKey(event);" onblur="calculo_mod();" name="primero" id="primero">
                            </div>
                            <div class="form-group col-2">
                                <label>II Trimestre</label>
                                <input type="text" class="form-control" onkeypress="return valideKey(event);" onblur="calculo_mod();" name="segundo" id="segundo">
                            </div>
                            <div class="form-group col-2">
                                <label>III Trimestre</label>
                                <input type="text" class="form-control" onkeypress="return valideKey(event);" onblur="calculo_mod();" name="tercero" id="tercero">
                            </div>
                            <div class="form-group col-2">
                                <label>IV Trimestre</label>
                                <input type="text" class="form-control" onkeypress="return valideKey(event);" onblur="calculo_mod();" name="cuarto" id="cuarto">
                            </div>
                            <div class="form-group col-4">
                                <label>Cantd. Total Distribuir <b style="color:red">*</b></label>
                                <input id="cant_total_dist_m" onblur="calculo_mod();" name="cant_total_dist_m" type="number" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-3">
                        <label>Precio Total</label>
                        <input type="text" class="form-control" onblur="calculo_mod();" name="prec_t" id="prec_t">
                    </div>
                    <div class="form-group col-3">
                        <label>Alicuota IVA estimado.</label>
                        <div class="row">
                            <div class="col-5">
                                <input type="text" class="form-control" onblur="calculo_mod();" name="ali_iva_e" id="ali_iva_e" disabled>
                            </div>
                            <div class="col-7">
                                <select title="Para cambiar la Alicuota de IVA debe seleccionarlo en este campo." class="form-control" name="sel_id_alic_iva" id="sel_id_alic_iva"  onchange="calculo_mod();">
                                    <option value="s">Selec</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label>IVA Estimado</label>
                        <input type="text" class="form-control" name="monto_iva_e" id="monto_iva_e" disabled>
                    </div>
                    <div class="form-group col-3">
                        <label>Monto Total Estimado</label>
                        <input type="text" class="form-control" name="monto_tot_est" id="monto_tot_est" disabled>
                    </div>
                    <div class="col-12">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                    </div>
                    <div class="form-group col-2">
                        <label>Est. I Trimestre</b></label>
                        <input id="estimado_primer" name="estimado_i" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-2">
                        <label>Est. II Trimestre</label>
                        <input id="estimado_segundo" name="estimado_ii" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-2">
                        <label>Est. III Trimestre</label>
                        <input id="estimado_tercer" name="estimado_iii" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-2">
                        <label>Est. IV Trimestre</label>
                        <input id="estimado_cuarto" name="estimado_iV" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-4">
                        <label>Est. Total Trimestres</label>
                        <input id="estimado_total_t_mod" name="estimado_total_t" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="guardar_tabla();" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>-

<script src="<?=base_url()?>/js/obra/llenar_editar_acc.js"></script>
<script src="<?=base_url()?>/js/obra/calculos_edit.js"></script>

<script src="<?=base_url()?>/js/dependientes.js"></script>

<script src="<?=base_url()?>/js/obra/agregar_proyecto_edit.js"></script>
<script src="<?=base_url()?>/js/obra/agregar_proyecto_ff.js"></script>
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
