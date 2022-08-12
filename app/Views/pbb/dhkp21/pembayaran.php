<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid" id="printarea">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img src="<?= base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8" width="50">
                                    AdminPBB, Inc.
                                    <div class="float-right col-2">
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
                                    </div>
                                </h4>
                            </div>
                        </div>
                        <!-- info row -->
                        <strong>
                            <p style="font-size: 20px;">Lampiran Pembayaran PBB-P2 Tahun 2021</p>
                        </strong>
                        <div class="row invoice-info">
                            <div class="col-4 invoice-col">
                                <div class="form-group row nopadding">
                                    <label for="dusun" class="col-form-label">From :</label>
                                </div>
                                <div class="col-10 input-group-sm input-group nopadding">
                                    <input type="text" class="form-control form-control-sm" value="KOLEKTOR DESA" style="font-weight:bold;background-color: transparent; border: 0px solid;box-shadow: none;">
                                </div>
                            </div>
                            <div class="col-4 invoice-col">
                                <div class="form-group row nopadding">
                                    <label for="pelanggan" class="col-form-label">To :</label>
                                </div>
                                <div class="col-10 form-group-sm input-group nopadding" style="font-weight:bold; background-color: transparent; border: none; box-shadow: none; outline:none;">
                                Bpk/Ibu/Sdr. 
                                    <select class="form-control form-control-sm border border-white border-0" id="pelanggan" name="pelanggan"></select>
                                    <button class="btn btn-sm btn-outline-secondary btnTambahPelanggan no-print" type="button" onclick="window.location='<?= site_url('pbb/pelanggan/add'); ?>'"><i class="fa fa-plus-circle"> </i> Pelanggan</button>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 invoice-col">
                                <div class="form-group row nopadding">
                                    <label for="dusun" class="col-form-label">No. Invoice :</label>
                                </div>
                                <div class="col-10 input-group-sm input-group nopadding">
                                    <input type="text" class="form-control form-control-sm" style="font-weight:bold;background-color: transparent; border: 0px solid;box-shadow: none;" name="nofaktur" id="nofaktur" value="<?= $nofaktur; ?>" readonly>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row mt-5">
                            <div class="col-12 dataDetailTr">

                            </div>
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
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%"></th>
                                            <th style="width:50%"></th>
                                        </tr>
                                        <tr>
                                            <th style="width:50%; height: 100px; border: none;"></th>
                                            <th style="border: none;"></th>
                                        </tr>
                                        <tr style="text-align: center; border:none">
                                            <td><strong>Tata Rustandi</strong></td>
                                            <td><strong>Rian Sutarsa</strong></td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <td>Kepala Desa Pasirlangu</td>
                                            <td>Kolektor Desa</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- this row will not appear when printing -->
                                <div class="row no-print float-right">
                                    <div class="col-12">
                                        <a type="button" rel="noopener" class="btn btn-default" id="btnSimpanTransaksi"><i class="fas fa-print"></i> Print</a>
                                        <a type="button" rel="noopener" class="btn btn-default" id="btnHapusTransaksi"><i class="fa fa-exchange-alt"></i> Return</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div>
            </div>
        </div>
    </section>

</div>
<div class="viewmodal" style="display: none;"></div>
<div class="viewmodalbayar" style="display: none;"></div>
<script>
    function dataPelanggan() {
        //pilih data dusun
        $('#pelanggan').select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: '--Pilih Pelanggan--',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('pbb/dhkp21/ambilDataPelanggan'); ?>",
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                }
            }
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
                    url: "<?= site_url('pbb/transaction21/batalTransaksi'); ?>",
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
        pbbterhutang();
        $('body').addClass('sidebar-collapse');

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
            window.print();
            bayar();
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
            url: "<?= site_url('pbb/transaction21/bayar'); ?>",
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
                url: "<?= site_url('pbb/transaction21/dataTerhutang'); ?>",
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
                url: "<?= site_url('pbb/transaction21/simpanTemp'); ?>",
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
                            url: "<?= site_url('pbb/transaction21/dataTerhutang'); ?>",
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
            url: "<?= site_url('pbb/transaction21/dataDetail'); ?>",
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
            url: "<?= site_url('pbb/dhkp21/pbbterhutang'); ?>",
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
            url: "<?= site_url('pbb/transaction21/hitungTotalBayar'); ?>",
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