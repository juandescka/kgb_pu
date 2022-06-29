<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Detail KGB</h1>
        <a href="<?= base_url(); ?>/admin/kgb" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
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
            <a href="" class="btn btn-success">UNDUH BERKAS KGB <i class="fas fa-download"></i></a>
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