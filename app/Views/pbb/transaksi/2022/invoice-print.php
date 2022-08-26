<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
                <div class="container ml-3" id="printarea">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="" style="border-bottom: 5px double black;">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?= base_url('favicon.png') ?>" alt="" class="" style="opacity: .8; text-align: center; width:130px;" width="100">
                                    </div>
                                    <div class="col" id="kop-surat">
                                        <h1 style="font-size: 4em; letter-spacing: 0.5em;"><?= namaApp(); ?></h1>
                                        <h4>( <?= deskApp(); ?> )</h4>
                                        <h2><?= !empty(detailUser()->nm_desa) ? 'DESA ' . detailUser()->nm_desa . ' KECAMATAN ' . detailUser()->nm_kec : ' KECAMATAN ' . detailUser()->nm_kec; ?></h2>
                                        <h6><?= !empty($sekretariat['lp_sekretariat']) ? $sekretariat['lp_sekretariat'] : ''; ?></h6>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?= base_url('img/logo-garutkab.jpg') ?>" alt="" class="" style="opacity: .8; text-align: center; width:150px;" width="100">
                                    </div>
                                </div>
                            </div>
                            <div class="float-right col-12 col-sm-2 col-md-2 mt-2">
                                <small>
                                    Tanggal :
                                </small>
                                <input type="text" class="form-control form-control-sm" name="tanggal" id="tanggal" value="<?php echo date("d M Y"); ?>" style="font-weight: bold;">
                                <!-- this row will not appear when printing -->
                                <div class="input-group mt-1 no-print">
                                    <input type="text" class="form-control form-control-sm" name="nop" id="nop">
                                </div>
                                <div class="input-group mt-1 no-print">
                                    <input type="text" class="form-control form-control-sm" name="nama_wp" id="nama_wp" style="font-weight: bold;" readonly>
                                </div>
                                <div class="input-group mt-1 no-print">
                                    <button class="btn btn-sm btn-outline-secondary btn-block btnTambahPelanggan" type="button" onclick="window.location='<?= site_url('pelanggan/add'); ?>'"><i class="fa fa-plus-circle"></i> Tambah Pelanggan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- info row -->
                    <strong>
                        <h6 style="font-size: 20px;">Kuitansi PBB Tahun 2022</h6>
                    </strong>
                    <div class="row invoice-info">
                        <div class="col-4 invoice-col">
                            <div class="form-group row nopadding">
                                <label for="dusun" class="col-form-label">Dari :</label>
                            </div>
                            <div class="col-12 form-group row">
                                <input class="text-bold form-control" value="KOLEKTOR DESA">
                            </div>
                        </div>
                        <div class="col-4 invoice-col">
                            <div class="form-group row nopadding">
                                <label for="pelanggan" class="col-form-label">Kepada :
                                    Bpk/Ibu/Sdr.
                                </label>
                            </div>
                            <div class="col-12 form-group row">
                                <!-- CSRF token -->
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <select class="form-control border border-white border-0" id="pelanggan" name="pelanggan" style="font-weight:bold; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background: none; width:auto"></select>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4 invoice-col">
                            <div class="form-group row nopadding">
                                <label for="dusun" class="col-form-label">No. Kuitansi :</label>
                            </div>
                            <div class="col-12 form-group row">
                                <input class="text-bold form-control" name="nofaktur" id="nofaktur" value="<?= $nofaktur; ?>">
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row mt-5">
                        <div class="col-12 dataDetailTr"></div>
                    </div>
                    <br><br>
                    <!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <p class="lead">Pembayaran</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>

                                    </tr>
                                    <tr>
                                        <th style="font-size: 1em;">Total :</th>
                                        <td><input type="text" class="form-control" style="font-size: 1em; font-weight:bold;background-color: transparent; border: 0px solid;box-shadow: none;" name="totalbayar" id="totalbayar" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <span><em>Terbilang: </em></span>
                            <input type="text" class="form-control" style="font-size: 1em; font-weight:bold;background-color: transparent; border: 0px solid;box-shadow: none;" name="terbilang" id="terbilang" readonly>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="container-flex" style="display: flex; text-align:center;">
                            <div class="col">
                                <h6>Kepala Desa</h6>
                                <h6 style="margin-top: 80px; text-decoration:underline"><strong>Tata Rustandi</strong></h6>
                            </div>
                            <div class="col">
                                <h6>Kolektor Desa</h6>
                                <h6 style="margin-top: 80px; text-decoration:underline"><strong>Sukarno</strong></h6>
                            </div>
                        </div>
                        <!-- this row will not appear when printing -->
                        <div class="col-12">
                            <div class="row no-print">
                                <div class="col-6">
                                    <a type="button" rel="noopener" class="btn btn-default" href="dhkp22"><i class="fa fa-fast-backward mr-1"></i> Data</a>
                                </div>
                                <div class="col-6">
                                    <a type="button" rel="noopener" class="btn btn-default float-right" id="btnSimpanTransaksi"><i class="fas fa-print mr-1"></i> Print</a>
                                    <a type="button" rel="noopener" class="btn btn-default float-right" id="btnHapusTransaksi"><i class="fa fa-exchange-alt mr-1"></i> Return</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.invoice -->
        </div>
    </section>

</div>
<div class="viewmodal" style="display: none;"></div>
<div class="viewmodalbayar" style="display: none;"></div>
<script>
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
            window.print();
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
</script>

<?= $this->endsection(); ?>