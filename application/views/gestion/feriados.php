<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
    <div id="areaDeNotificacion"></div>
    <ul class="nav nav-tabs" id="tabFeriados" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="frds-nacionales-tab" data-toggle="tab" href="#frds-nacionales" role="tab" aria-controls="frds-nacionales" aria-selected="true">
                <i class="ion-calendar"></i> Feriados Nacionales
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="frds-estadales-tab" data-toggle="tab" href="#frds-estadales" role="tab" aria-controls="frds-estales" aria-selected="false">Feriados Estadales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="frds-municipales-tab" data-toggle="tab" href="#frds-municipales" role="tab" aria-controls="frds-municipales" aria-selected="false">Feriados Municipales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="frds-espacificos-tab" data-toggle="tab" href="#frds-especificos" role="tab" aria-controls="frds-especificos" aria-selected="false">Feriados No Aniversarios</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="frds-nacionales" role="tabpanel" aria-labelledby="frds-nacionales-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmFeriadoNacionalModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                    <button type="button" class="btn btn-secondary" id="btnListarFeriadosNacionales" ><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon2"><i class="ion-search"></i></div>
                    </div>
                    <input type="text" class="form-control" placeholder="Descripción del Feriado" id="txtFeriadoNacionalBuscar"/>
                </div>
            </div>
            <div id="list-frds-nacionales">Lista de Feriados Nacionales</div>
        </div>
        <div class="tab-pane fade" id="frds-estadales" role="tabpanel" aria-labelledby="frds-estadales-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmFeriadoEstadalModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="btn-group" role="group">
                    <select id="sltEstadoFrdEstadal" class="form-control">
                        <option>Estado</option>
                    </select>
                    <button type="button" class="btn btn-secondary" id="btnListarFeriadosEstadales"><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon2"><i class="ion-search"></i></div>
                    </div>
                    <input type="text" class="form-control" placeholder="Descripción del Feriado" id="txtFeriadoEstadalBuscar"/>
                </div>
            </div>
            <div id="list-frds-estadales">Lista de Feriados Estadales</div>
        </div>
        <div class="tab-pane fade" id="frds-municipales" role="tabpanel" aria-labelledby="frds-municipales-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmFeriadoMunicipalModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="btn-group" role="group">
                    <select id="sltEstadoFrdMunicipal" class="form-control">
                        <option>Estado</option>
                    </select>
                    <select id="sltMunicipioFrdMunicipal" class="form-control">
                        <option>Municipio</option>
                    </select>
                    <button type="button" class="btn btn-secondary" id="btnListarFeriadosMunicipales"><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon2"><i class="ion-search"></i></div>
                    </div>
                    <input type="text" class="form-control" placeholder="Descripción del Feriado" id="txtFeriadoMunicipalBuscar"/>
                </div>
            </div>
            <div id="list-frds-municipales">Lista de Feriados Municipales</div>
        </div>
        <div class="tab-pane fade" id="frds-especificos" role="tabpanel" aria-labelledby="frds-especificos-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmFeriadoEspecificoModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="btn-group" role="group">
                    <select id="sltAnioFeridadoEspecifico" class="form-control">
                        <option >Todos</option>
                        <option >...</option>
                    </select>
                    <button type="button" class="btn btn-secondary" id="btnListarFeriadosEspecificos"><i class="ion-ios-list"></i> Mostrar</button>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon2"><i class="ion-search"></i></div>
                    </div>
                    <input type="text" class="form-control" placeholder="Descripción del Feriado" id="txtFeriadoEspecificoBuscar"/>
                </div>
            </div>
            <div id="list-frds-especificos">Lista de Feriados Especificos</div>
        </div>
    </div>
    <script>
        $('#txtFeriadoMunicipalBuscar').change(function(){
            if ($("#txtFeriadoMunicipalBuscar").val().length){
                FeriadoMunicipal.buscar($('#txtFeriadoMunicipalBuscar').val());
            }
        });
        $('#txtFeriadoEstadalBuscar').change(function(){
            if ($("#txtFeriadoEstadalBuscar").val().length){
                FeriadoEstadal.buscar($('#txtFeriadoEstadalBuscar').val());
            }
        });
        $('#txtFeriadoNacionalBuscar').change(function(){
            if ($("#txtFeriadoNacionalBuscar").val().length){
                FeriadoNacional.buscar($('#txtFeriadoNacionalBuscar').val());
            }
        });
        $('#txtFeriadoEspecificoBuscar').change(function(){
            if ($("#txtFeriadoEspecificoBuscar").val().length){
                FeriadoEspecifico.buscar($('#txtFeriadoEspecificoBuscar').val());
            }
        });
        $('#btnListarFeriadosNacionales').click(function(){
            $('#txtFeriadoNacionalBuscar').val('');
            FeriadoNacional.listar();
        });
        $('#btnListarFeriadosEspecificos').click(function(){
            $('#txtFeriadoEspecificoBuscar').val('');
            FeriadoEspecifico.listar();
        });
        $('#btnListarFeriadosEstadales').click(function(){
            $('#txtFeriadoEstadalBuscar').val('');
            FeriadoEstadal.listar();
        });
        $('#btnListarFeriadosMunicipales').click(function(){
            $('#txtFeriadoMunicipalBuscar').val('');
            FeriadoMunicipal.listar();
        });
        $("#btnFrmFeriadoNacionalModal").click(function(){
            FeriadoNacional.form();
        });
        $("#btnFrmFeriadoEspecificoModal").click(function(){
            FeriadoEspecifico.form();
        });
        $("#btnFrmFeriadoEstadalModal").click(function(){
            FeriadoEstadal.form();
        });
        $("#btnFrmFeriadoMunicipalModal").click(function(){
            FeriadoMunicipal.form();
        });
        $("#sltEstadoFrdMunicipal").change(function(){
            FeriadoMunicipal.cargarSltMunicipio();
        });
        
        $(function () {
            $('#tabFeriados li:first-child a').tab('show');
        });
    </script>
</div>

