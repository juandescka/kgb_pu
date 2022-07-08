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
                    <th class="text-center align-middle">NO</th>
                    <th class="text-center align-middle">PERANGKAT DAERAH</th>
                    <th class="text-center align-middle">NIP</th>
                    <th class="text-center align-middle">NAMA</th>
                    <th class="text-center align-middle">TMT BERKALA</th>
                    <th class="text-center align-middle">NO SK</th>
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
                        <td><?= date('d/m/Y', strtotime($row['tmt'])); ?></td>
                        <td><?= $row['no_sk']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>/public/files/kgb/<?= $row['file_sk']; ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
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