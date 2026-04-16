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
                <div class="container-fluid p-0">

                    <div class="row mb-3 align-items-end">

                        <div class="col-md-4">
                            <label style="font-size:11px; margin-bottom: 2px;">No Transaksi</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" name="nofaktur" id="nofaktur"
                                    value="<?= !empty($nofaktur) ? $nofaktur : $row['tr_faktur']; ?>"
                                    style="font-weight:bold;">
                                <button class="btn btn-outline-secondary btn-copy" type="button" data-copy="nofaktur">
                                    <i class="bi bi-clipboard"></i> Salin
                                </button>
                            </div>

                        </div>

                        <div class="col-md-5">
                            <label style="font-size:11px; margin-bottom: 2px;">Penyetor</label>
                            <div class="d-flex gap-1">
                                <div class="flex-grow-1" style="min-width: 0;">
                                    <select class="form-control form-control-sm w-100" id="pelanggan" name="pelanggan"
                                        style="font-weight:bold; background:#f8f9fa;">
                                    </select>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary btnTambahPelanggan" type="button" onclick="tambahPelanggan()" style="white-space: nowrap;">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label style="font-size:11px; margin-bottom: 2px;">Input NOP</label>
                            <input type="text" class="form-control form-control-sm" name="nop" id="nop"
                                placeholder="Scan / ketik NOP">
                        </div>

                    </div>

                    <div class="row align-items-center bg-light p-2 rounded no-print m-0">

                        <div class="col-md-4 px-1">
                            <div class="d-flex align-items-center">
                                <small class="mb-0 text-muted me-2" style="white-space: nowrap;"><em>Terbilang:</em></small>
                                <input type="text" class="form-control form-control-sm flex-fill shadow-none"
                                    name="terbilang" id="terbilang"
                                    style="font-weight:bold; background:transparent; border:0; padding-left:0;" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 px-1 text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <b class="me-2">Item</b>
                                <input type="text" class="form-control form-control-sm text-center text-primary me-3"
                                    id="jmldata" style="font-weight:bold; background:transparent; border:0; width:30px; padding:0;" readonly value="0">

                                <b class="me-2">Total</b>
                                <input type="text" class="form-control form-control-sm text-end"
                                    name="totalbayar" id="totalbayar"
                                    style="font-weight:bold; background:transparent; border:0; width:120px;" readonly value="0">
                            </div>
                        </div>

                        <div class="col-md-4 px-1 text-end">
                            <a class="btn btn-sm btn-light border" href="/dhkp22">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <button class="btn btn-sm btn-warning" id="btnHapusTransaksi">
                                Reset
                            </button>
                            <button class="btn btn-sm btn-success" id="btnSimpanTransaksi">
                                Bayar & Cetak
                            </button>
                        </div>

                    </div>

                </div>
                <!-- END FORM UTAMA -->

                <!-- 🔥 DATA DETAIL -->
                <div class="row mt-4">
                    <div class="col-12 dataDetailTr"></div>
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


        $(document).on('click', '.btn-copy', function() {

            const nofaktur = $(this).data('copy');
            const input = document.getElementById(nofaktur);

            if (!input) return;

            input.select();
            input.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(input.value);

            Swal.fire({
                icon: 'success',
                title: 'Disalin',
                text: 'Data berhasil disalin ke clipboard',
                timer: 1200,
                showConfirmButton: false
            });
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

    // Skrip untuk mengaktifkan Tombol Salin No Transaksi
    $(document).ready(function() {
        $('.btn-copy').on('click', function() {
            // Ambil nilai dari input nofaktur
            let nofakturTeks = $('#nofaktur').val();

            // Validasi jika kosong
            if (!nofakturTeks) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Kosong',
                    text: 'Tidak ada No Transaksi yang bisa disalin.',
                    timer: 1500,
                    showConfirmButton: false
                });
                return;
            }

            // Proses menyalin teks ke clipboard
            navigator.clipboard.writeText(nofakturTeks).then(function() {
                // Tampilkan notifikasi sukses menggunakan SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Tersalin!',
                    text: 'No Transaksi ' + nofakturTeks + ' disalin ke clipboard.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(function(err) {
                console.error('Gagal menyalin: ', err);
                alert('Gagal menyalin No Transaksi.');
            });
        });
    });

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

    // Fungsi algoritma untuk mengubah angka ke kata-kata
    function penyebut(nilai) {
        nilai = Math.floor(Math.abs(nilai));
        var huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        var temp = "";

        if (nilai < 12) {
            temp = " " + huruf[nilai];
        } else if (nilai < 20) {
            temp = penyebut(nilai - 10) + " Belas";
        } else if (nilai < 100) {
            temp = penyebut(nilai / 10) + " Puluh" + penyebut(nilai % 10);
        } else if (nilai < 200) {
            temp = " Seratus" + penyebut(nilai - 100);
        } else if (nilai < 1000) {
            temp = penyebut(nilai / 100) + " Ratus" + penyebut(nilai % 100);
        } else if (nilai < 2000) {
            temp = " Seribu" + penyebut(nilai - 1000);
        } else if (nilai < 1000000) {
            temp = penyebut(nilai / 1000) + " Ribu" + penyebut(nilai % 1000);
        } else if (nilai < 1000000000) {
            temp = penyebut(nilai / 1000000) + " Juta" + penyebut(nilai % 1000000);
        } else if (nilai < 1000000000000) {
            temp = penyebut(nilai / 1000000000) + " Miliar" + penyebut(nilai % 1000000000);
        }
        return temp;
    }

    // Fungsi utama untuk mengambil nilai #totalbayar dan memasukkannya ke #terbilang
    function updateTerbilang() {
        // Ambil nilai dari #totalbayar
        let totalVal = $('#totalbayar').val();

        // Hapus format titik/koma ribuan agar murni menjadi angka (misal "15.000" jadi "15000")
        let angka = parseInt(totalVal.toString().replace(/[^0-9]/g, ''), 10);

        if (angka === 0 || isNaN(angka)) {
            $('#terbilang').val('Nol Rupiah');
        } else {
            // Panggil fungsi penyebut dan tambahkan "Rupiah"
            let hasil = penyebut(angka).trim() + " Rupiah";
            $('#terbilang').val(hasil);
        }
    }
</script>

<?= $this->endsection(); ?>