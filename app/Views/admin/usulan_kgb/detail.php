<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Detail Usulan KGB</h1>
        <a href="<?= base_url(); ?>/admin/usulan_kgb" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('error_input'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>GAGAL MENERIMA USULAN KGB!</h4>
                </hr />
                <?php echo session()->getFlashdata('error_input'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mt-2" style="margin-left:8px">
            <?php if ($kgb['status'] == 'pending') : ?>
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Terima
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">TERIMA USULAN KGB</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url(); ?>/admin/usulan_kgb/terima" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $kgb['id']; ?>" name="id">
                                    <input type="hidden" value="<?= $kgb['nip']; ?>" name="nip">
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">JABATAN</label>
                                        <input type="text" class="form-control" name="jabatan" placeholder="Pengadministrasi Umum" value="<?= (old('jabatan')) ? old('jabatan') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">GOLONGAN</label>
                                        <input type="text" class="form-control" name="golongan" placeholder="IV/B" value="<?= (old('golongan')) ? old('golongan') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">NO SK</label>
                                        <input type="text" class="form-control" name="no_sk" placeholder="123/XXX/123" value="<?= (old('no_sk')) ? old('no_sk') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">TANGGAL SK</label>
                                        <input type="date" class="form-control" name="tanggal_sk" value="<?= (old('tanggal_sk')) ? old('tanggal_sk') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">TMT BERKALA</label>
                                        <input type="date" class="form-control" name="tmt" value="<?= (old('tmt')) ? old('tmt') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">MASA KERJA TAHUN</label>
                                        <input type="number" class="form-control" name="masa_kerja_tahun" value="<?= (old('masa_kerja_tahun')) ? old('masa_kerja_tahun') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">MASA KERJA BULAN</label>
                                        <input type="number" class="form-control" name="masa_kerja_bulan" value="<?= (old('masa_kerja_bulan')) ? old('masa_kerja_bulan') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">GAJI POKOK LAMA</label>
                                        <input type="text" class="form-control" name="gaji_pokok_lama" id="gaji_pokok_lama" value="<?= (old('gaji_pokok_lama')) ? old('gaji_pokok_lama') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">GAJI POKOK BARU</label>
                                        <input type="text" class="form-control" name="gaji_pokok_baru" id="gaji_pokok_baru" value="<?= (old('gaji_pokok_baru')) ? old('gaji_pokok_baru') : '' ?>">
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="" class="fw-bold">BERKAS SK</label>
                                        <input type="file" class="form-control" name="file_sk" id="file_sk" value="<?= (old('file_sk')) ? old('file_sk') : '' ?>">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success mt-2 w-100">Terima</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalTolak">
                    Tolak
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalTolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">TOLAK USULAN KGB</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url(); ?>/admin/usulan_kgb/tolak" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $kgb['id']; ?>" name="id">
                                    <input type="hidden" value="<?= $kgb['nip']; ?>" name="nip">
                                    <div class="form-group">
                                        <label for="" class="fw-bold">Komentar</label>
                                        <input type="text" class="form-control" name="komentar" placeholder="Masukkan komentar...">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-danger mt-2 w-100">Tolak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($kgb['status'] == 'declined') : ?>
                <h5 class="fw-bold text-danger">Alasan ditolak : <?= $kgb['komentar']; ?></h5>
            <?php endif; ?>
        </div>

        <table class="table">
            <tr>
                <th width="200">PERANGKAT DAERAH</th>
                <td>:</td>
                <td><?= $kgb['pd']; ?></td>
            </tr>
            <tr>
                <th>NIP</th>
                <td>:</td>
                <td><?= $kgb['nip']; ?></td>
            </tr>
            <tr>
                <th>NAMA</th>
                <td>:</td>
                <td><?= $kgb['nama']; ?></td>
            </tr>
            <tr>
                <th>TMT BERKALA TERAKHIR</th>
                <td>:</td>
                <td><?= date('d/m/Y', strtotime($kgb['tmt'])); ?></td>
            </tr>
            <tr>
                <th>SK PANGKAT TERAKHIR</th>
                <td>:</td>
                <td>
                    <?php if (!empty($kgb['sk_pangkat_terakhir'])) : ?>
                        <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $kgb['sk_pangkat_terakhir']; ?>">LIHAT BERKAS</a>
                    <?php else : ?>
                        <span class="text-danger fw-bold">Tidak Mengunggah Berkas</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>SK BERKALA TERAKHIR</th>
                <td>:</td>
                <td>
                    <?php if (!empty($kgb['sk_berkala_terakhir'])) : ?>
                        <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $kgb['sk_berkala_terakhir']; ?>">LIHAT BERKAS</a>
                    <?php else : ?>
                        <span class="text-danger fw-bold">Tidak Mengunggah Berkas</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>SKP TERAKHIR</th>
                <td>:</td>
                <td>
                    <?php if (!empty($kgb['skp_terakhir'])) : ?>
                        <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $kgb['skp_terakhir']; ?>">LIHAT BERKAS</a>
                    <?php else : ?>
                        <span class="text-danger fw-bold">Tidak Mengunggah Berkas</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>SURAT PENGANTAR</th>
                <td>:</td>
                <td>
                    <?php if (!empty($kgb['surat_pengantar'])) : ?>
                        <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $kgb['surat_pengantar']; ?>">LIHAT BERKAS</a>
                    <?php else : ?>
                        <span class="text-danger fw-bold">Tidak Mengunggah Berkas</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>


    </div>
</div>

<script>
    /* Tanpa Rupiah */
    let gaji_pokok_lama = document.getElementById('gaji_pokok_lama');
    gaji_pokok_lama.addEventListener('keyup', function(e) {
        gaji_pokok_lama.value = formatRupiah(this.value);
    });

    let gaji_pokok_baru = document.getElementById('gaji_pokok_baru');
    gaji_pokok_baru.addEventListener('keyup', function(e) {
        gaji_pokok_baru.value = formatRupiah(this.value);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<?= $this->endSection() ?>