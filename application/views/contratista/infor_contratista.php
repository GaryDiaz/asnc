<div class="sidebar-bg"></div>
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
                            <input class="form-control" type="text" name="rif_b" id="rif_b"  placeholder="J123456789" onkeyup="mayusculas(this);">

                        </div>
                        <div class="col- mt-4">
                            <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Información del Contratista </b></h4>
                </div>
                <div class="panel-body" id="no_existe">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <h4 class="mt-2"><label>Por Favor revise el Rif ingresado! y vuelva a intentar.</label></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body" id="existe">
                    <form action="<?= base_url() ?>index.php/Contratista/planillaresumen" class="form-horizontal" data-parsley-validate="true" name="demo-form" id="form-Registrar" method="POST">
                        <div class="row">
                            <div class="form-group col-12">
                                <input class="form-control" type="hidden" name="idedocontratistas" id="idedocontratistas">
                                <textarea class="form-control" name="descedocont" id="descedocont" rows="4" readonly></textarea>
                            </div>
                            <div class="form-group col-12 text-center">
                                <h4 class="panel-title"> <b> Información de la Empresa </b> </h4>
                            </div>
                            <div class="form-group col-3">
                                <label>Número RIF</label>
                                <input class="form-control" type="text" name="rif_cont" id="rif_cont" value="" readonly>
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
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>
<script src="<?=base_url()?>/js/contratista/contratista.js"></script>
