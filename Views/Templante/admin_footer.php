<!-- js -->
<script>
  const base_url = "<?= Base_URL(); ?>";
  const smony = "<?= SMONEY; ?>";
</script>



<script src="<?= vendors(); ?>/scripts/core.js"></script>
<script src="<?= vendors(); ?>/scripts/script.min.js"></script>
<script src="<?= vendors(); ?>/scripts/process.js"></script>
<script src="<?= vendors(); ?>/scripts/layout-settings.js"></script>
<script src="<?= media(); ?>/js/funtions_admin.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- js para los botones de exportacion -->
<script src="<?= media(); ?>/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.print.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/vfs_fonts.js"></script>
<script src="<?= media(); ?>/js/tinymce/tinymce.min.js"></script>
<script src="<?= media(); ?>/plugins/BarCode/JsBarcode.all.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://www.jsdelivr.com/package/npm/chart.js?path=dist"></script>



<?php if ($data['page_name'] == "dashboard") { ?>
  <script src="<?= media(); ?>/plugins/apexcharts/apexcharts.min.js"></script>
  <script src="<?= vendors(); ?>/scripts/dashboard.js"></script>
<?php } ?>



<!-- add sweet alert js & css in footer -->
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.css">
<script src="<?= media(); ?>/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="<?= media(); ?>/plugins/sweetalert2/sweet-alert.init.js"></script>
<script src="<?= media(); ?>/js/funtions_admin.js"></script>

<script src="<?= media(); ?>/js/<?= $data['page_funtions_js']; ?>"></script>


</body>

</html>