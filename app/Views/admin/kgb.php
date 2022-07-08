<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<!-- End Datatable -->

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1>Data KGB</h1>
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

        <table id="table-kgb">
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
                <?php $no = 1; ?>
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
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table-kgb').DataTable();
    });
</script>

<?= $this->endSection() ?>