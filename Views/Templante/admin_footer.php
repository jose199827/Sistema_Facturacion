<!-- js -->
<script>
  const base_url = "<?= Base_URL(); ?>"
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
<script src="<?= media(); ?>/plugins/datatables/js/buttons.print.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?= media(); ?>/plugins/datatables/js/vfs_fonts.js"></script>

<?php if ($data['page_name'] == "dashboard") { ?>
  <script src="<?= media(); ?>/plugins/apexcharts/apexcharts.min.js"></script>
  <script src="<?= vendors(); ?>/scripts/dashboard.js"></script>
<?php } ?>



<!-- add sweet alert js & css in footer -->
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.css">
<script src="<?= media(); ?>/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="<?= media(); ?>/plugins/sweetalert2/sweet-alert.init.js"></script>
<script src="<?= media(); ?>/js/funtions_admin.js"></script>

<?php if ($data['page_name'] == "Rol - Usuario") { ?>
  <script src="<?= media(); ?>/js/funtions_roles.js"></script>
<?php } ?>

<?php if ($data['page_name'] == "usuarios") { ?>
  <script src="<?= media(); ?>/js/funtion_usuarios.js"></script>
<?php } ?>
</body>

</html>