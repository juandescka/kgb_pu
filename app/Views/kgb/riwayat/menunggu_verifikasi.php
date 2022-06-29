<h3 class="text-center"><span class="badge rounded-pill bg-warning text-dark">Usulan Menunggu Verifikasi</span></h3>

<table id="table-history-waiting">
    <thead>
        <tr>
            <th>TAHUN USULAN</th>
            <th>BERKAS</th>
            <th>TANGGAL DIBUAT</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kgb as $row) : ?>
            <tr>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table-history-waiting').DataTable();
    });
</script>