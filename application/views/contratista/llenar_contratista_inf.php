<div class="sidebar-bg"></div>
<div id="content" class="content">
		<div class="panel-body" id="existe">
		<form action="<?= base_url() ?>index.php/Contratista/planillaresumen" class="form-horizontal" data-parsley-validate="true" name="demo-form" id="form-Registrar" method="POST">
				<div class="row">
					<div class="col-6 mb-3">
							<a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" href="javascript:history.back()"> Volver</a>
					</div>
					<div class="form-group col-12">
						<input class="form-control" type="hidden" name="idedocontratistas" id="idedocontratistas">
						<textarea class="form-control" name="descedocont" id="descedocont" rows="4" readonly></textarea>
					</div>
					<div class="form-group col-12 text-center">
						<h4 class="panel-title"> <b> Información de la Empresa </b> </h4>
					</div>
					<div class="form-group col-3">
						<label>Número RIF</label>
						<input class="form-control" type="text" name="rif_cont" id="rif_cont" value="<?=$rif_consultado?>" readonly>
						<input class="form-control" type="hidden" name="proceso_id" id="proceso_id" readonly>
					</div>

					<div class="form-group col-6">
						<label>Nombre o Razón Social</label>
						<input type="text" name="nombre" id="nombre" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Tipo de Persona</label>
						<input type="text" name="tipopersona" id="tipopersona" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Denominación Comercial</label>
						<input type="text" name="descdencom" id="descdencom" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Objeto Principal de la Empresa</label>
						<input type="text" name="descobjcont" id="descobjcont" class="form-control" readonly>
					</div>
					<br>
					<div class="form-group col-3" >
						<label>Dirección Fiscal</label>
							<textarea class="form-control" name="dirfiscal" id="dirfiscal" rows="3" readonly></textarea>
					</div>
					<div class="form-group col-3">
						<label>Teléfonos</label>
						<input type="text" name="tele11" id="tele11" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Persona de Contacto</label>
						<input type="text" name="percontacto" id="percontacto" class="form-control" readonly>
					</div>
					<div class="form-group col-12 text-center">
						<h4 class="panel-title"><b>Información en el RNC</b> </h4>
					</div>
					<div class="form-group col-4">
						<label>Siuación Actual en el RNC</label>
						<textarea class="form-control" id="situacionact" rows="6" readonly></textarea>
					</div>
					<div class="form-group col-4">
						<label>Número de Certificado RNC</label>
						<input type="text" name="numcertrnc2" id="numcertrnc2" class="form-control" readonly>
					</div>
					<div class="form-group col-4">
						<label>Número de Control del Certificado RNC</label>
						<input type="text" name="nro_correlativo" id="nro_correlativo" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Inscrición en el RNC</label>
						<input type="text" name="fecinscrnc_at2" id="fecinscrnc_at2" class="form-control" readonly>
					</div>
					<div class="form-group col-3">
						<label>Vencimiento en el RNC</label>
						<input type="text" name="fecvencrnc_at2" id="fecvencrnc_at2" class="form-control" readonly>
					</div>

				</div>
				<div class="form-group col 12 text-center">
				<input type="button" class="btn btn-default mt-1 mb-1" name="imprimir" value="Imprimir Información de Contratistas" onclick="window.print();">
				</div>
				<div class="form-group col 12 text-center">
					<button class="btn btn-default mt-1 mb-1"  type="submit" class="send"> Ver Planilla Resumen</button>
					<input class="btn btn-default" type="submit" value="Ver Comprobante RNC" formaction="<?= base_url() ?>index.php/Contratista/ver_comprobante"/></div>
				</div>
			</form>
		</div>
</div>

<script type="text/javascript">
	function mayusculas(e) {
		e.value = e.value.toUpperCase();
	}
</script>
<script src="<?=base_url()?>/js/contratista/reportes.js"></script>
