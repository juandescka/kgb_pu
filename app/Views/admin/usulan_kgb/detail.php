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
                <h4>Gagal menambahkan data!</h4>
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
                                    <div class="form-group">
                                        <label for="" class="fw-bold">Berkas KGB</label>
                                        <input type="file" class="form-control" name="file_kgb">
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
                <th>TAHUN USULAN</th>
                <td>:</td>
                <td><?= $kgb['tahun_usulan']; ?></td>
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


<?= $this->endSection() ?>