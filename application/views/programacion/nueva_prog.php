
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div  class="panel panel-inverse" >
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
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-4">
                                <button onclick="location.href='<?php echo base_url()?>index.php/Programacion/agregar_bien?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg btn-default"  name="button">
                                    Agregar Información de Bienes
                                </button>
                            </div>
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
                            <!-- <div class="col-4">
                                <button onclick="location.href='<?php echo base_url()?>index.php/Programacion/add?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg btn-default"  name="button">
                                    Agregar Información de todas
                                </button>
                            </div> -->
                        </div>

                        <br>
                        <!-- <button onclick="location.href='<?php echo base_url()?>index.php/Programacion/pdf_compl?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg mt-2 mb-2 btn-default"  name="button">
                            Ver PDF con Información Completa
                        </button> -->
                    </div>

                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Tabla Referente a Proyectos Registrados</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nombre Programación</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_proyectos as $ver_proyecto):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$ver_proyecto['nombre_proyecto']?> </td>
                                    <td><?=$ver_proyecto['desc_objeto_contrata']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/ver_programacion_proy?id=<?php echo $ver_proyecto['id_p_proyecto'];?>/<?php echo $ver_proyecto['id_programacion'];?>/<?php echo $ver_proyecto['id_obj_comercial'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a/>
                                        <a href="<?php echo base_url();?>index.php/programacion/editar_proy?id=<?php echo $ver_proyecto['id_p_proyecto'];?>/<?php echo $ver_proyecto['id_obj_comercial'];?>/<?php echo $ver_proyecto['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-edit"></i>
                                        <a />
                                        <a onclick="eliminar_proy(<?php echo $ver_proyecto['id_p_proyecto'];?>);" class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a/>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Tabla Referente a Acción Centralizada Registradas</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Acción Centralizada</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_acc_centralizada as $ver_acc_centralizad):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$ver_acc_centralizad['desc_accion_centralizada']?> </td>
                                    <td><?=$ver_acc_centralizad['desc_objeto_contrata']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/ver_programacion_acc?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>/<?php echo $ver_acc_centralizad['id_programacion'];?>/<?php echo $ver_acc_centralizad['id_obj_comercial'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a/>
                                        <a href="<?php echo base_url();?>index.php/programacion/editar_acc?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>/<?php echo $ver_acc_centralizad['id_obj_comercial'];?>/<?php echo $ver_acc_centralizad['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw  fa-edit"></i>
                                        <a />
                                        <a onclick="eliminar_acc(<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>);" class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a />
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<?php if ($this->session->flashdata('sa-success2')) { ?>
    <div hidden id="sa-success2"> <?= $this->session->flashdata('sa-success2') ?> </div>
<?php } ?>
<script src="<?=base_url()?>/js/eliminar.js"></script>
