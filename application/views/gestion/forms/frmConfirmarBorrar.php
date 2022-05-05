<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title text-white" id="tituloForm">Lea con atención</h5>
            <button type="button" class="close text-white" id="btnCerrarDialogoModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <h1 class="col-2">
                    <i class="ion-help-circled size-32 align-center text-center text-red"></i>
                </h1>
                <div class="col-10">
                    <div id="descripcionDeAccion" class="size-14 text-center text-brown"></div>
                    <div id="elementoAEliminar" class="size-12 text-center"></div>
                    <div class="text-center">Pulse <strong>"Eliminar"</strong> para corfirmar o en la <strong>x</strong> para cancelar</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="btnBorrar"><i class="ion-trash-a"></i> Eliminar</button>
        </div>
    </div>
</div>
