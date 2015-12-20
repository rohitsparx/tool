<script src="<?= base_url() ?>/assets/plugins/jQuery/jQuery-2.1.4.js"></script>
<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.min.js"></script>

<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>/assets/plugins/dataTables/dataTables.bootstrap.min.js"></script>

<script src="<?= base_url() ?>/assets/dist/js/app.js"></script>

<script type="text/javascript">
    $(function () {
        $('.js_data_table1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>