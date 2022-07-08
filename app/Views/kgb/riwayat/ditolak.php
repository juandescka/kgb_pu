<h3 class="text-center"><span class="badge rounded-pill bg-danger">Usulan Ditolak</span></h3>

<table id="table-history-declined">
    <thead>
        <tr>
            <th class="text-center align-middle">NO</th>
            <th class="text-center align-middle">TMT BERKALA TERAKHIR</th>
            <th class="text-center align-middle">BERKAS</th>
            <th class="text-center align-middle">ALASAN DITOLAK</th>
            <th class="text-center align-middle">TANGGAL DIBUAT</th>
            <th class="text-center align-middle">TANGGAL DIPERBAHARUI</th>
            <th class="text-center align-middle">DITOLAK OLEH</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($kgb as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d/m/Y', strtotime($row['tmt'])); ?></td>
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
                <td><?= $row['komentar']; ?></td>
                <td><?= date('d/m/Y', $row['createdAt']); ?></td>
                <td><?= date('d/m/Y', $row['updatedAt']); ?></td>
                <td><?= $row['updatedBy']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table-history-declined').DataTable();
    });
</script>