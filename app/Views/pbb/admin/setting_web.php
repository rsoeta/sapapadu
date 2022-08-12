<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper" style="min-height: 2646.8px;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-brand">
                <i class="fa fa-desktop mr-1"></i>
                <?php foreach (menu() as $m) : ?>
                    <?php if ($m['tm_nama'] == 'Aplikasi') : ?>
                        <?= $m['tm_nama']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="content-header">
        <div class="container-fluid">
            <!-- card image -->
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= logoApp(); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center nopadding"><?= namaApp(); ?></h3>
                            <h4 class="profile-username text-center nopadding">Kecamatan <?= ucwords(strtolower(profilAdmin()->name)); ?></h4>

                            <p class="text-muted text-center">Software Engineer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    Jumlah Desa
                                    <input id="ps_count_desa" class="float-right text-right" style="border: none; padding: 0%; font-weight: bold;" disabled></input>
                                </li>
                                <li class="list-group-item">
                                    Jumlah Target Tahun Ini
                                    <input id="ps_count_target" class="float-right text-right" style="border: none; padding: 0%; font-weight: bold;" disabled></input>
                                </li>
                                <li class="list-group-item">
                                    Jumlah Capaian Tahun Ini
                                    <input id="ps_count_capaian" class="float-right text-right" style="border: none; padding: 0%; font-weight: bold;" disabled></input>
                                </li>
                                <li class="list-group-item">
                                    Jumlah Persentase Tahun Ini
                                    <input id="ps_count_persentase" class="float-right text-right" style="border: none; padding: 0%; font-weight: bold;" disabled></input>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Bio</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Nama-Nama Desa</strong>

                            <p id="nama_desa" class="text-muted"></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- form-group row -->
                            <div class="form-group row">
                                <label for="ps_kode_kec" class="col-sm-4 col-form-label"><i class="fas fa-university mr-1"></i> Nama Kecamatan</label>
                                <div class="col-sm-8">
                                    <select name="ps_kode_kec" id="ps_kode_kec" class="select2">
                                        <option value="">Pilih Kecamatan</option>
                                        <?php foreach ($kecamatan as $k) : ?>
                                            <option <?= ($myKec == $k['id']) ? 'selected' : ''; ?> value="<?= $k['id']; ?>"><?= $k['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ps_nama_admin" class="col-sm-4 col-form-label"><i class="fas fa-user mr-1"></i> Nama Admin</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ps_nama_admin" name="ps_nama_admin" value="<?= $myNama; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ps_sejarah" class="col-sm-4 col-form-label"><i class="fas fa-book mr-1"></i> Bio</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="ps_sejarah" id="ps_sejarah" rows="5">B.S. in Computer Science from the University of Tennessee at Knoxville</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ps_lokasi" class="col-sm-4 col-form-label"><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ps_lokasi" name="ps_lokasi" value="Malibu, California">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ps_maps" class="col-sm-4 col-form-label"><i class="fas fa-map-location mr-1"></i> Maps</label>
                                <div class="col-sm-8">
                                    <!-- textarea -->
                                    <textarea class="form-control" name="ps_maps" id="ps_maps" rows="10"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.0029159566393!2d107.66943441469306!3d-7.464927194614969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e661f7fa14fe949%3A0xe162ee3852ef74e!2sKantor%20Kecamatan%20Pakenjeng!5e0!3m2!1sid!2sid!4v1657983331345!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ps_skills" class="col-sm-4 col-form-label">Skills</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ps_skills" name="ps_skills" value="UI Design, Coding, Javascript, PHP, Node.js">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-secondary">Cancel</a>
                                    <input type="submit" value="Simpan" class="btn btn-success float-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Peta Kantor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.0029159566393!2d107.66943441469306!3d-7.464927194614969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e661f7fa14fe949%3A0xe162ee3852ef74e!2sKantor%20Kecamatan%20Pakenjeng!5e0!3m2!1sid!2sid!4v1657983331345!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        var kode_kec = $('#ps_kode_kec').val();

        $.ajax({
            url: 'get_count_desa/' + kode_kec,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    $('#nama_desa').append('<li>' + (i + 1) + '. ' + data[i].name + '</li>');
                }

                $('#ps_count_desa').val(data.length);
            }
        });

        $.ajax({
            type: "POST",
            url: "get_hitung",
            data: "data",
            dataType: "JSON",
            success: function(data) {
                // tambahkan formatRupiah
                var jumlahTotal = '';
                var angka = data.jumlahTotal;
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                jumlahTotal = ribuan;
                $('#ps_count_target').val('Rp. ' + jumlahTotal);

                var jumlahTotalLunas = '';
                var angka = data.jumlahTotalLunas;
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                jumlahTotalLunas = ribuan;
                // tambah simbol Rp. 

                $('#ps_count_capaian').val('Rp. ' + jumlahTotalLunas);

                // persentase dari #ps_count_capaian dan #ps_count_target
                var persentase = (data.jumlahTotalLunas / data.jumlahTotal) * 100;
                // tambah simbol persentase
                var persentase = persentase.toFixed(2) + '%';
                $('#ps_count_persentase').val(persentase);
            }
        });


    });


    // get count from $kecamatan
    $('#ps_kode_kec').change(function() {
        var kode_kec = $(this).val();
        $.ajax({
            url: 'get_count_desa/' + kode_kec,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $('#nama_desa').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#nama_desa').append('<li>' + (i + 1) + '. ' + data[i].name + '</li>');
                }

                $('#ps_count_desa').val(data.length);
            }
        });
    });
</script>
<?= $this->endSection(); ?>