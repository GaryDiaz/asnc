<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div  class="panel panel-inverse">
                <div class="col-12">
                    <br>
                    <h3 class="text-center">Información</h3>
                    <h5 class="text-center">Contratistas que realizarón contratos con Contratantes no Registrados en el SNC</h5>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>Rif Contratante</th>
                                <th>Contratante</th>
                                <th>Rif Contratista</th>
                                <th>Contratista</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($contrat as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['rif_contratista']?> </td>
                                <td><?=$data['contratista']?> </td>
                                <td><?=$data['rif_contratante']?> </td>
                                <td><?=$data['contratante']?> </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/eval_desempenio/notificacion.js"></script>
