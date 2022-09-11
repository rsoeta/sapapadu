<footer class="main-footer">
    <strong>Copyright &copy; 2021 - <?= date('Y'); ?> <a href="<?= base_url(); ?>" target=""><?= namaApp(); ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 2.2.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Script -->
<!-- <script type='text/javascript'>
    $(document).ready(function() {
        // Initialize
        $("#autocompleteuser").autocomplete({

            source: function(request, response) {

                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                // Fetch data
                $.ajax({
                    url: "<?php
                            //echo site_url('pbb/dhkp21/getPembayaran') 
                            ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        [csrfName]: csrfHash // CSRF Token
                    },
                    success: function(data) {
                        // Update CSRF Token
                        $('.txt_csrfname').val(data.token);

                        response(data.data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#autocompleteuser').val(ui.item.label); // display the selected text
                $('#userid').val(ui.item.value); // save selected id to input
                return false;
            },
            focus: function(event, ui) {
                $("#autocompleteuser").val(ui.item.label);
                $("#userid").val(ui.item.value);
                return false;
            },
        });
    });
</script> -->

<!-- Bootstrap 4 -->
<script async src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script async src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script async src="<?= base_url('assets/dist/js/demo.js') ?>"></script>


</body>

</html>