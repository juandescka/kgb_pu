<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<h1 class="mt-4">Riwayat KGB</h1>
<div class="card mb-4">
    <div class="card-body">
        <table id="table-history-accepted">
            <thead>
                <tr>
                    <th>PERANGKAT DAERAH</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>TAHUN USULAN</th>
                    <th>BERKAS</th>
                    <th>TANGGAL DIBUAT</th>
                    <th>KGB</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kgb as $row) : ?>
                    <tr>
                        <td><?= $row['pd']; ?></td>
                        <td><?= $row['nip']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['tahun_usulan']; ?></td>
                        <td>
                            <?php if (!is_null($row['sk_pangkat_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['sk_pangkat_terakhir']; ?>">SK PANGKAT TERAKHIR</a> <br>
                            <?php endif; ?>

                            <?php if (!is_null($row['sk_berkala_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['sk_berkala_terakhir']; ?>">SK BERKALA TERAKHIR</a> <br>
                            <?php endif; ?>

                            <?php if (!is_null($row['skp_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['skp_terakhir']; ?>">SKP TERAKHIR</a> <br>
                            <?php endif; ?>

                            <?php if (!is_null($row['surat_pengantar'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['surat_pengantar']; ?>">SURAT PENGANTAR</a>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d-M-Y', $row['createdAt']); ?></td>
                        <td>
                            <a href="<?= base_url(); ?>/public/files/kgb/<?= $row['file_kgb']; ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#table-history-accepted').DataTable();
            });
        </script>
    </div>
</div>


<?= $this->endSection() ?>