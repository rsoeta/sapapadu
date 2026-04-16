<script src="<?= base_url('assets/plugins/autoNumeric-c426664/autoNumeric.js'); ?>"></script>

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" id="modalbayar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('simpanBayar', ['class' => 'frmbayar']); ?>
            <div class="modal-body">
                <input type="hidden" name="nofaktur" value="<?= $nofaktur; ?>">
                <input type="hidden" name="id_wil" value="<?= $id_wil; ?>">
                <input type="hidden" name="pelanggan_id" value="<?= $pelanggan_id; ?>">
                <input type="hidden" name="totalkotor" id="totalkotor" value="<?= $totalbayar; ?>">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(%)</label>
                            <input type="text" name="dispersen" id="dispersen" class="form-control" autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Disc(Rp)</label>
                            <input type="text" name="disuang" id="disuang" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Total Pembayaran</label>
                    <input type="text" name="totalbersih" id="totalbersih" class="form-control form-control-lg" value="<?= $totalbayar; ?>" style="font-weight: bold; text-align: right;" readonly>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Uang</label>
                    <input type="text" name="jmluang" id="jmluang" class="form-control form-control-lg" style="font-weight: bold; text-align: right;" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Uang Kembalian</label>
                    <input type="text" name="sisauang" id="sisauang" class="form-control form-control-lg" style="font-weight: bold; text-align: right;" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-left" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success tombolSimpan">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $('#dispersen').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '2'
        });

        $('#disuang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#totalbersih').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#jmluang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#sisauang').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '0'
        });

        $('#dispersen').keyup(function(e) {
            hitungDiskon();
        });

        $('#disuang').keyup(function(e) {
            hitungDiskon();
        });

        $('#jmluang').keyup(function(e) {
            hitungSisaUang();
        });

    });

    $('.frmbayar').submit(function(e) {
        e.preventDefault();

        let jmluang = ($('#jmluang').val() == "") ? 0 : $('#jmluang').autoNumeric('get');
        let sisauang = ($('#sisauang').val() == "") ? 0 : $('#sisauang').autoNumeric('get');

        if (parseFloat(jmluang) == 0 || parseFloat(jmluang) == "") {
            Toast.fire({
                icon: 'warning',
                title: 'Maaf Jumlah Uang belum diinput!'
            })
        } else if (parseFloat(sisauang) < 0) {
            Toast.fire({
                icon: 'error',
                title: 'Maaf Jumlah Uang tidak mencukupi!'
            })
        } else {
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.tombolSimpan').prop('disabled', false);
                    $('.tombolSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses == 'berhasil') {

                        let link = response.link_struk;
                        let nofaktur = response.nofaktur;
                        let total = response.total;

                        Swal.fire({
                            title: 'Pembayaran Berhasil ✅',
                            // Tambahkan tombol salin di samping teks nofaktur
                            html: `
                        <div style="font-size: 16px; margin-bottom: 10px;">
                            No: <b>${nofaktur}</b> 
                            <button type="button" id="btnSalinFakturModal" class="btn btn-sm btn-outline-secondary" style="padding: 0px 6px; margin-left: 5px;" title="Salin No Faktur">
                                <i class="fas fa-clipboard"></i> Salin
                            </button>
                        </div>
                        Total: Rp ${total}<br><br>
                        <a href="${link}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-print"></i> Lihat / Cetak Struk</a>
                    `,
                            icon: 'success',
                            confirmButtonText: 'Tutup & Reload',
                            showCancelButton: false,
                            // Gunakan didOpen untuk mengaktifkan fungsi tombol salin saat modal muncul
                            didOpen: () => {
                                const btnSalin = document.getElementById('btnSalinFakturModal');
                                if (btnSalin) {
                                    btnSalin.addEventListener('click', () => {
                                        navigator.clipboard.writeText(nofaktur).then(() => {
                                            // Ubah tampilan tombol sejenak untuk memberi tahu bahwa teks sudah disalin
                                            let originalHTML = btnSalin.innerHTML;
                                            btnSalin.innerHTML = '<i class="fas fa-check"></i> Disalin!';
                                            btnSalin.classList.replace('btn-outline-secondary', 'btn-success');

                                            setTimeout(() => {
                                                btnSalin.innerHTML = originalHTML;
                                                btnSalin.classList.replace('btn-success', 'btn-outline-secondary');
                                            }, 2000);
                                        }).catch(err => {
                                            console.error('Gagal menyalin:', err);
                                        });
                                    });
                                }
                            }
                        }).then((result) => {
                            // Hilangkan buka struk otomatis di sini jika Anda sudah menjadikannya tombol biru di atas, 
                            // atau biarkan jika tetap ingin dipaksa buka. Saya asumsikan user cukup klik link di atas.
                            window.location.reload();
                        });

                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        return false;
    });

    function hitungDiskon() {
        let totalkotor = $('#totalkotor').val();
        // let dispersen = $('#dispersen').autoNumeric('get');
        let dispersen = ($('#dispersen').val() == "") ? 0 : $('#dispersen').autoNumeric('get');
        // let disuang = $('#disuang').autoNumeric('get');
        let disuang = ($('#disuang').val() == "") ? 0 : $('#disuang').autoNumeric('get');

        let hasil;
        hasil = parseFloat(totalkotor) - (parseFloat(totalkotor) * parseFloat(dispersen) / 100) - parseFloat(disuang);

        $('#totalbersih').val(hasil);
        let totalbersih = $('#totalbersih').val();
        $('#totalbersih').autoNumeric('set', totalbersih);

    }

    function hitungSisaUang() {
        let totalbayar = $('#totalbersih').autoNumeric('get');
        let jmluang = ($('#jmluang').val() == "") ? 0 : $('#jmluang').autoNumeric('get');

        sisauang = parseFloat(jmluang) - parseFloat(totalbayar);

        $('#sisauang').val(sisauang);

        let sisauangx = $('#sisauang').val();
        $('#sisauang').autoNumeric('set', sisauangx);
    }
</script>