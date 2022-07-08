<h3 class="text-center"><span class="badge rounded-pill bg-warning text-dark">Usulan Menunggu Verifikasi</span></h3>

<table id="table-history-waiting">
    <thead>
        <tr>
            <th class="text-center align-middle">NO</th>
            <th class="text-center align-middle">PERANGKAT DAERAH</th>
            <th class="text-center align-middle">NIP</th>
            <th class="text-center align-middle">NAMA</th>
            <th class="text-center align-middle">TMT BERKALA</th>
            <th class="text-center align-middle">BERKAS</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($kgb as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['pd']; ?></td>
                <td><?= $row['nip']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tmt']; ?></td>
                <td>
                    <ul>
                        <li>
                            <?php if (!is_null($row['sk_pangkat_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['sk_pangkat_terakhir']; ?>">SK PANGKAT TERAKHIR</a> <br>
                            <?php endif; ?>
                        </li>
                        <li>
                            <?php if (!is_null($row['sk_berkala_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['sk_berkala_terakhir']; ?>">SK BERKALA TERAKHIR</a> <br>
                            <?php endif; ?>
                        </li>
                        <li>
                            <?php if (!is_null($row['skp_terakhir'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['skp_terakhir']; ?>">SKP TERAKHIR</a> <br>
                            <?php endif; ?>
                        </li>
                        <li>
                            <?php if (!is_null($row['surat_pengantar'])) : ?>
                                <a href="<?= base_url(); ?>/public/files/dokumen_pendukung/<?= $row['surat_pengantar']; ?>">SURAT PENGANTAR</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table-history-waiting').DataTable();
    });
</script>