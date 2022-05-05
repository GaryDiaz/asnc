<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
    <div id="areaDeNotificacion"></div>
    <ul class="nav nav-tabs" id="tabGestionActividades" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="lapsos-tab" data-toggle="tab" href="#lapsos" role="tab" aria-controls="lapsos" aria-selected="true"><i class="ion-ios-calendar-outline"></i> Lapsos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="modalidades-tab" data-toggle="tab" href="#modalidades" role="tab" aria-controls="modalidades" aria-selected="false"><i class="ion-ios-location"></i> Modalidades</a>

        <li class="nav-item">
            <a class="nav-link" id="mecanismos-tab" data-toggle="tab" href="#mecanismos" role="tab" aria-controls="mecanismos" aria-selected="false"><i class="ion-gear-b"></i> Mecanismos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="objetoscont-tab" data-toggle="tab" href="#objetoscont" role="tab" aria-controls="objetoscont" aria-selected="false"><i class="ion-ios-list"></i> Objetos de Contratación</a>
        </li>
    </ul>
    <div class="tab-content border border-primary">
        <div class="tab-pane active" id="lapsos" role="tabpanel" aria-labelledby="lapsos-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmLapsoModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-secondary" id="btnListarLapsos"><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>
            </div>
            <div id="list-lapsos">Lista de Lapsos</div>
        </div>
        <div class="tab-pane fade" id="modalidades" role="tabpanel" aria-labelledby="modalidades-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmModalidadModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-secondary" id="btnListarModalidades"><i class="ion-ios-list"></i> Mostrar Todas</button>
                </div>
            </div>
            <div id="list-modalidades">Lista de Modalidades</div>
        </div>
        <div class="tab-pane fade" id="mecanismos" role="tabpanel" aria-labelledby="mecanismos-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmMecanismoModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-secondary" id="btnListarMecanismos"><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>

            </div>
            <div id="list-mecanismos">Lista de Mecanismos</div>
        </div>
        <div class="tab-pane fade" id="objetoscont" role="tabpanel" aria-labelledby="objetoscont-tab">
            <div class="btn-toolbar justify-content-between" role="toolbar">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" id="btnFrmObjetoContModal" data-toggle="modal" data-target="#sncModalDlg"><i class="ion-plus"></i> Añadir</button>
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-secondary" id="btnListarObjetosCont"><i class="ion-ios-list"></i> Mostrar Todos</button>
                </div>
            </div>
            <div id="list-objetos-cont">Lista de Objetos de Contratación</div>
        </div>
    </div>
    <script>
        $('#btnListarLapsos').click(function() {
            Lapso.listar();
        });
        $('#btnListarModalidades').click(function() {
            Modalidad.listar();
        });
        $('#btnListarMecanismos').click(function() {
            Mecanismo.listar();
        });
        $('#btnListarObjetosCont').click(function() {
            ObjetoContratacion.listar();
        });

        $("#btnFrmLapsoModal").click(function() {
            Lapso.form();
        });
        $("#btnFrmModalidadModal").click(function() {
            Modalidad.form();
        });
        $("#btnFrmMecanismoModal").click(function() {
            Mecanismo.form();
        });
        $("#btnFrmObjetoContModal").click(function() {
            ObjetoContratacion.form();
        });

        $(function() {
            $('#tabGestionActividades li:first-child a').tab('show');
        });
    </script>

    <style>
        #tabGestionActividades li a.active {
            background-color: #037BFF;
            color: white;
            font-weight: bold;
        }
    </style>
</div>