<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="modalterhutang" tabindex="-1" aria-labelledby="modalterhutangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalterhutangLabel">Data PBB Terhutang</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="keywordnop" id="keywordnop" value="<?= $keyword; ?>">
                <div class="table-responsive">
                    <table id="dataterhutang" class="table table-sm table-hovered dataTable dtr-inline collapsed" role="grid">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>N.O.P</th>
                                <th>Nama Wajib Pajak</th>
                                <th>Alamat Objek Pajak</th>
                                <th>Pajak</th>
                                <th>Ket</th>
                                <!-- <th>Nama Kadus</th> -->
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#dataterhutang').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('listPbbTerhutang'); ?>",
                "type": "POST",
                "data": {
                    keywordnop: $('#keywordnop').val()
                }
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    });

    function pilihitem(nop, nama_wp) {
        $('#nop').val(nop);
        $('#nama_wp').val(nama_wp);
        $('#modalterhutang').on('hidden.bs.modal', function(event) {
            $('#nop').focus();
            cekNop();
        })

        $('#modalterhutang').modal('hide');
    }
</script>