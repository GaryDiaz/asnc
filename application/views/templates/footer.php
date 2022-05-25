<div class="modal" id="sncModalDlg" tabindex="-1" role="dialog" aria-labelledby="miVentanaModalLabel" aria-hidden="true"></div>

<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/theme/material.min.js"></script>

<!-- ==================PARA checkbox y otros ================== -->
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/js-cookie/js.cookie.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/theme/apple.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/apps.min.js"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/lightbox/js/lightbox.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/demo/gallery.demo.min.js"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/masked-input/masked-input.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/clipboard/clipboard.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/demo/form-plugins.demo.min.js"></script>

<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/demo/table-manage-default.demo.min.js"></script>

<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/demo/table-manage-autofill.demo.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/parsley/dist/parsley.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/highlight/highlight.common.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/js/demo/render.highlight.js"></script>

<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>Plantilla/admin/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>

<script src="<?= base_url() ?>/js/feriado.js?<?= time() ?>"></script>
<script src="<?= base_url() ?>/js/lapso.js?<?= time() ?>"></script>
<script src="<?= base_url() ?>/js/organoente.js?<?= time() ?>"></script>
<script src="<?= base_url() ?>/js/llamadoconcurso.js?<?= time() ?>"></script>
<script src="<?= base_url() ?>/js/asnc.app.js?<?= time() ?>"></script>

<script>
        $(document).ready(function() {
                App.init();
                TableManageDefault.init();
                TableManageAutofill.init();
                FormPlugins.init();
                Gallery.init();
                Highlight.init();
                var ubiAct = window.location + "";
                var arrayURL = ubiAct.split("index.php");
                ubiAct = arrayURL[1];
                sncApp.cargarDatosDePagina(ubiAct);
        });
</script>
<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script> -->
</body>

</html>