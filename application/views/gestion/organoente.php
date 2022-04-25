<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
    <div id="areaDeNotificacion"></div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center" id="tituloForm"><i class="ion-ios-list-outline"></i> Datos del Organo-Ente</h3>
            <form>
                <fieldset class="border border-success p-10 shadow-lg">
                    <legend class="font-weight-bold">Datos del Organo-Ente</legend>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="txtRif">RIF</label>
                            <input type="text" class="form-control" id="txtRif" placeholder="RIF" maxlength="10">
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="sltTipoOrganoEnte">Tipo de Organo-Ente</label>
                            <select id="sltTipoOrganoEnte" class="form-control">
                                <option >[Tipo Organo-Ente]</option>
                                <option value="0">Organo Padre</option>
                                <option value="1">Organo Adscrito</option>
                                <option value="2">Ente</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="sltOrganoEnteAds">Adcrito a</label>
                            <select id="sltOrganoEnteAds" class="form-control">
                                <option >Organo Ente Adscrito</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="txtDescripcion">Descripción</label>
                            <input type="text" class="form-control" id="txtDescripcion" placeholder="Descripción de Organo-Ente" maxlength="250">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6">
                            <label for="txtCodOnapre">Código ONAPRE</label>
                            <input type="text" class="form-control" id="txtCodOnapre" placeholder="Código ONAPRE" maxlength="100">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6">
                            <label for="txtSiglas">Siglas</label>
                            <input type="text" class="form-control" id="txtSiglas" placeholder="Siglas" maxlength="12">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border border-success p-10 shadow-lg">
                    <legend class="font-weight-bold">Datos de ubicación</legend>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="sltEstado">Estado</label>
                            <select id="sltEstado" class="form-control">
                                <option >[Estado]</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="sltMunicipio">Municipio</label>
                            <select id="sltMunicipio" class="form-control">
                                <option >[Municipio]</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="sltParroquia">Parroquia</label>
                            <select id="sltParroquia" class="form-control">
                                <option >[Parroquia]</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccion">
                    </div>
                </fieldset>
                <fieldset class="border border-success p-10 shadow-lg">
                    <legend class="font-weight-bold">Datos Legales</legend>
                    <div class="row">
                        <div class="form-group col-lg-9 col-md-9 col-sm-12">
                            <label for="txtGaceta">Gaceta</label>
                            <input type="text" class="form-control" id="txtGaceta" placeholder="Gaceta Oficial" maxlength="50">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-12">
                            <label for="txtFechaGaceta">Fecha Gaceta</label>
                            <input type="date" class="form-control" id="txtFechaGaceta">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border border-success p-10 shadow-lg">
                    <legend class="font-weight-bold">Datos de contacto</legend>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="txtPaginaWeb">Página Web</label>
                            <input type="text" class="form-control" id="txtPaginaWeb" placeholder="Página Web" maxlength="120">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="txtCorreo">Correo</label>
                            <input type="email" class="form-control" id="txtCorreo" placeholder="Correo" maxlength="100">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="txtTel1">Teléfono 1</label>
                            <input type="tel" class="form-control" id="txtTel1" placeholder="Teléfono 1" maxlength="20">
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="txtTel2">Teléfono 2</label>
                            <input type="tel" class="form-control" id="txtTel2" placeholder="Teléfono 2" maxlength="20">
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="txtMovil1">Móvil 1</label>
                            <input type="tel" class="form-control" id="txtMovil1" placeholder="Móvil 1" maxlength="20">
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="txtMovil2">Móvil 2</label>
                            <input type="tel" class="form-control" id="txtMovil2" placeholder="Móvil2" maxlength="20">
                        </div>
                    </div>
                </fieldset>
                <br/>
                <div class="footer ">
                    <button type="button" class="btn btn-primary btn-lg float-right" id="btnGuardar" ><i class="ion-compose"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>



<style>
    fieldset>legend{
        font-size: 12pt;
        margin-left: 8px;
    }
    
    fieldset{
        margin-bottom: 5px;
        margin-top: 5px;
    }
</style>