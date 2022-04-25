<div class="sidebar-bg"></div>
<div id="content" class="content">
    <!-- <div class="row"> -->
      <div class="col-6 mb-3">
          <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" href="javascript:history.back()"> Volver</a>
      </div>
      <div class="panel" id="imp1">
        <div class="row">
            <div class="col-9 pull-left">
                 <img src="<?php echo base_url('Plantilla/img/membretesnc.png'); ?>" height="50"  />
            </div>
            <div class="col-3 pull-right">
                <img src="<?php echo base_url('Plantilla/img/logosnc.png'); ?>" height="75"  />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-right">
                <h4><b>Nro. Correlativo: </b><?= $consulta['nro_correlativo'] ?></h4>
            </div>
            <div class="col-12 text-center mt-3">
                <h3><b>COMPROBANTE DE INSCRIPCIÓN</b></h3>
                <h4><b>EN EL REGISTRO NACIONAL DE CONTRATISTAS</b></h4>
            </div>
            <div class="col-12 text-center mt-3">
                <h4>Este Registro Nacional de Contratistas, hace constar que:</h4>
            </div>
            <div class="col-12 text-center mt-3 mb-3">
                <h4><b>INFORMACIÓN DEL CONTRATISTA</b></h4>
            </div>
            <div class="col-2"></div>
            <div class="col-2 text-right">
                <h4><b>Razón Social:</b></h4>
            </div>
            <div class="col-8">
                <h4><?=$consulta['nombre']?></h4>
            </div>

            <div class="col-2"></div>
            <div class="col-2 text-right">
                <h4><b>RIF:</b></h4>
            </div>
            <div class="col-6">
                <h4><?=$consulta['rifced']?></h4>
            </div>
            <div class="col-12 text-justify mb-3 mt-3">
            <h3>Se encuentra HABILITADO para contratar con la Administración Pública Nacional, Estadal y Municipal en adquisición de bienes, servicios y ejecución de obras,
                de conformidad con lo previsto en el artículo 8 de la Ley Constitucional Contra la Guerra Económica para la Racionalidad y Uniformidad en la Adquisición de Bienes,
                Servicios y Obras Públicas, publicada en Gaceta Oficial de la República Bolivariana de Venezuela N° 40.398, de fecha 11 de enero de 2018 en concordancia con el artículo
                47 del Decreto con Rango, Valor y Fuerza de Ley de Contrataciones Públicas, publicado en Gaceta Oficial de la República Bolivariana de Venezuela Extraordinario N° 6.154,
                de fecha 19 de noviembre de 2014, para el período:</h3>
            </div>
            <div class="col-2"></div>
            <div class="col-2 text-right">
                <h4><b>Desde:</b></h4>
            </div>
            <div class="col-8">
                <h4><?=$consulta['fecinscrnc_at2']?></h4>
            </div>
            <div class="col-2"></div>
            <div class="col-2 text-right">
                <h4><b>Hasta:</b></h4>
            </div>
            <div class="col-8">
                <h4><?=$consulta['fecvencrnc_at2']?></h4>
            </div>
            <div class="col-1"></div>
            <div class="col-3 text-right">
                <h4><b>Nº de Comprobante:</b></h4>
            </div>
            <div class="col-8">
                <h4><?=$consulta['numcertrnc2']?></h4>
            </div>
            <div class="col-12 mt-3 mb-5 text-justify">
                <h3>El contratista acepta someterse a lo establecido en el artículo 10 de la Ley Constitucional Contra la Guerra Económica para la Racionalidad y
                    Uniformidad en la Adquisición de Bienes, Servicios y Obras Públicas, el cual establece lo siguiente. <b>Artículo 10. Las personas naturales o jurídicas
                    que presten declaraciones falsas para obtener el comprobante de inscripción a que se refiere el artículo precedente serán inhabilitados para contratar
                    con el estado, por un plazo de diez (10) años.</b> Si la inhabilitación recae sobre sujetos que poseen contrataciones en ejecución con el Estado, estas serán
                    susceptibles de resolución unilateral por causas imputables al contratista o nulidad de esos contratos por parte del contratante, con fundamento a lo establecido
                    en el Decreto con Rango, Valor y Fuerza de Ley de Contrataciones Públicas.</td>
                </h3>
            </div>
            <div class="col-12 text-center mt-5">
                <h4>Anthoni Camilo Torres</h4>
                <h4>Director General</h4>
                <h6>"Resolución CCP/DGCJ N° 001/2014 de fecha 07 de enero de 2014, Publicada <br>
                    en la Gaceta Oficial de la República Bolivariana de Venezuela <br>
                    Nº 40.334 de fecha 15 de enero de 2014."</h6>
            </div>
            <div class="col-12 text-right mt-2 mb-4">
                <h4> <b>Fecha de Consulta: </b><?php echo date("d-m-Y"); ?></h4>
            </div>
            <div class="col-12 mt-5">
                <h6>Firma electrónica de datos consultados: <br>
                XaN-cixoSyPa5Kyop8k-Ac7TzWROZ4iUzQmlhcayO9eGIi-9964 <br>
                a132BUqtwdDIIDdT8BxYlAjIsd61Wnsqobpb01742NPUUjM2J21BhdUOcoRd3sZELb8yx5fAw+k5ch8- <br>
                Firmado electrónico por Anthoni Camilo Torres, avalado por la autoridad certificadora Fundación Instituto <br>
                de Ingeniería, adscrito a SUSCERTE <br>
                La validez del presente certificado debe ser consultado en la dirección electrónica www.snc.gob.ve y se <br>
                exhorta a todos los Órganos y Entes del Estado responsables de las contrataciones públicas a imprimir <br>
                un ejemplar a objeto de ser incorporado al expediente de la contratación o concurso a ejecutar.</h6>
            </div>
        </div>
      </div>
    <!-- </div> -->
</div>
<div>
    <div class="form-group col 12 text-center">
        <button class="btn btn-default mt-1 mb-1" type="button" id="print" onclick="printContent('imp1');" >Imprimir </button>
    </div>
</div>
<script src="<?= base_url() ?>/js/contratista/contratista.js"></script>
<script>
    function printContent(imp1){
        var restorepage = $('body').html();
        var printcontent = $('#' + imp1).clone();
            $('body').empty().html(printcontent);
            window.print();
                $('body').html(restorepage);
    }
</script>
