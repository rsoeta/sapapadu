<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #nop:focus {
        border: 2px solid #28a745;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php foreach ($detail as $row) {
} ?>

<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="col-12">
            <div class="p-3 mb-3">

                <!-- 🔥 HEADER RINGAN -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <div>
                        <h4 style="margin:0; font-weight:bold;">Rencana Pembayaran PBB</h4>
                        <small><?= detailUser()->nm_desa ?? '' ?></small>
                    </div>

                    <div style="text-align:right;">
                        <small>Tanggal</small>
                        <input type="text" class="form-control form-control-sm" id="tanggal"
                            value="<?= date("d M Y"); ?>" style="font-weight:bold;">
                    </div>
                </div>

                <hr>

                <!-- 🔥 FORM UTAMA -->
                <div style="display:flex; gap:20px; flex-wrap:wrap;">

                    <div style="display:flex; align-items:end; gap:10px; flex-wrap:wrap;">

                        <!-- No Transaksi -->
                        <div style="min-width:180px;">
                            <label style="font-size:11px;">No Transaksi</label>
                            <input class="form-control form-control-sm" name="nofaktur" id="nofaktur"
                                value="<?= !empty($nofaktur) ? $nofaktur : $row['tr_faktur']; ?>"
                                style="font-weight:bold;">
                        </div>

                        <!-- Penyetor -->
                        <div style="flex:1; min-width:220px;">
                            <label style="font-size:11px;">Penyetor</label>
                            <select class="form-control form-control-sm" id="pelanggan" name="pelanggan"
                                style="font-weight:bold; background:#f8f9fa;"></select>
                        </div>

                        <!-- Tombol tambah -->
                        <div>
                            <label style="font-size:11px; opacity:0;">.</label>
                            <button class="btn btn-sm btn-outline-secondary btnTambahPelanggan"
                                type="button"
                                onclick="tambahPelanggan()">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>

                        <!-- Input NOP -->
                        <div style="min-width:220px;">
                            <label style="font-size:11px;">Input NOP</label>
                            <input type="text" class="form-control form-control-sm" name="nop" id="nop"
                                placeholder="Scan / ketik NOP">
                        </div>

                    </div>


                </div>

                <!-- 🔥 DATA DETAIL -->
                <div class="row mt-4">
                    <div class="col-12 dataDetailTr"></div>
                </div>

                <!-- 🔥 TOTAL -->
                <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                    <div style="width:300px;">
                        <div style="display:flex; justify-content:space-between;">
                            <b>Total</b>
                            <input type="text" class="form-control text-right"
                                name="totalbayar" id="totalbayar"
                                style="font-weight:bold; background:#f8f9fa; border:0;" readonly>
                        </div>
                    </div>
                </div>

                <!-- 🔥 TERBILANG -->
                <div style="margin-top:10px;">
                    <small><em>Terbilang:</em></small>
                    <input type="text" class="form-control"
                        name="terbilang" id="terbilang"
                        style="font-weight:bold; background:#f8f9fa; border:0;" readonly>
                </div>

                <!-- 🔥 ACTION -->
                <div class="row mt-4 no-print">
                    <div class="col-6">
                        <a class="btn btn-light" href="/dhkp22">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="col-6 text-right">
                        <button class="btn btn-warning" id="btnHapusTransaksi">
                            Reset
                        </button>

                        <button class="btn btn-success" id="btnSimpanTransaksi">
                            Bayar & Cetak
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
<div class="viewmodal" style="display: none;"></div>
<div class="viewmodalbayar" style="display: none;"></div>
<div class="viewmodalpelanggan" style="display:none;"></div>
<script>
    $(document).ready(function() {
        // sidebar non collapse
        $('body').removeClass('sidebar-collapse');

        pbbterhutang();
        dataDetailTr();
        hitungTotalBayar();
        dataPelanggan();

        $('#nop').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                cekNop();
            }
        });

        $('#btnHapusTransaksi').click(function(e) {
            e.preventDefault();
            batalTransaksi();
        });

        $('#btnSimpanTransaksi').click(function(e) {
            e.preventDefault();
            bayar();
            // window.print();
        });

        $(this).keydown(function(e) {
            if (e.keyCode == 27) {
                e.preventDefault();
                $('#nop').focus();
            }
            if (e.keyCode == 192) {
                e.preventDefault();
                batalTransaksi();
            }
            if (e.keyCode == 220) {
                e.preventDefault();
                bayar();
            }
        });

    });

    function dataPelanggan() {
        //pilih data dusun
        $('#pelanggan').select2({
            // minimumInputLength: 1,
            // allowClear: true,
            placeholder: '--Pilih Pelanggan--',
            ajax: {
                url: "<?= base_url('/ambilDataPelanggan'); ?>",
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    return {
                        searchTerm: params.term, // search term
                        [csrfName]: csrfHash // CSRF Token
                    };
                },
                processResults: function(response) {
                    // Update CSRF Token
                    $('.txt_csrfname').val(response.token);

                    return {
                        results: response.data
                    };
                },
                cache: true
            },
            language: {
                "noResults": function() {
                    return "Data tidak ditemukan";
                }
            },
        });
    }

    function batalTransaksi() {
        Swal.fire({
            title: 'Batalkan Transaksi?',
            text: "Yakin Batalkan Transaksi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batal!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('trx22/batalTransaksi'); ?>",
                    data: {
                        nofaktur: $('#nofaktur').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses == 'berhasil') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }

    function bayar() {
        let nofaktur = $('#nofaktur').val();
        $.ajax({
            type: "post",
            url: "<?= site_url('modalBayar'); ?>",
            data: {
                nofaktur: nofaktur,
                tglfaktur: $('#tanggal').val(),
                pelanggan_id: $('#pelanggan').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.error
                    });
                }
                if (response.data) {
                    $('.viewmodalbayar').html(response.data).show();
                    $('#modalbayar').on('shown.bs.modal', function(event) {
                        $('#jmluang').focus();
                    });
                    $('#modalbayar').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }


    function cekNop() {
        let nop = $('#nop').val();

        if (nop.length == 0) {
            $.ajax({
                url: "<?= site_url('dataTerhutang'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.viewmodal).show();
                    $('#modalterhutang').modal('show');
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            $.ajax({
                type: "post",
                url: "<?= site_url('simpanTemp'); ?>",
                data: {
                    nop: nop,
                    pajak: $('#pajak').val(),
                    ket: $('#ket').val(),
                    nofaktur: $('#nofaktur').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.totaldata == 'banyak') {
                        $.ajax({
                            url: "<?= site_url('dataTerhutang'); ?>",
                            dataType: "json",
                            data: {
                                keyword: nop
                            },
                            type: "post",
                            success: function(response) {
                                $('.viewmodal').html(response.viewmodal).show();
                                $('#modalterhutang').modal('show');
                            },
                            error: function(xhr, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                    }
                    if (response.sukses == 'berhasil') {
                        dataDetailTr();
                        kosong();
                    }
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: response.error
                        });
                        dataDetailTr();
                        kosong();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }

    function dataDetailTr() {
        $.ajax({
            type: "post",
            url: "<?= site_url('dataDetail'); ?>",
            data: {
                nofaktur: $('#nofaktur').val()
            },
            dataType: "json",
            beforeSend: function() {
                $('.dataDetailTr').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            success: function(response) {
                if (response.data) {
                    $('.dataDetailTr').html(response.data);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function pbbterhutang() {
        $.ajax({
            url: "<?= site_url('pbbterhutang'); ?>",
            dataType: "json",
            success: function(response) {
                $('.pbbterhutang').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function kosong() {
        $('#nop').val('');
        $('#nama_wp').val('');
        $('#nop').focus();

        hitungTotalBayar();
    }

    function hitungTotalBayar() {
        $.ajax({
            url: "<?= site_url('hitungTotalBayar'); ?>",
            dataType: "json",
            data: {
                nofaktur: $('#nofaktur').val()
            },
            type: "post",
            success: function(response) {
                if (response.totalbayar) {
                    $('#totalbayar').val(response.totalbayar);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function tambahPelanggan() {
        $.ajax({
            url: "<?= site_url('pbb/pelanggan/formmodal'); ?>",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodalpelanggan').html(response.data).show();
                    $('#modalTambahPelanggan').modal('show');
                }
            }
        });
    }
</script>

<?= $this->endsection(); ?>