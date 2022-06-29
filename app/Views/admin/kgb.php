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
                    <th>PERANGKAT DAERAH</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>TAHUN USULAN</th>
                    <th>TANGGAL DIBUAT</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kgb as $row) : ?>
                    <tr>
                        <td><?= $row['pd']; ?></td>
                        <td><?= $row['nip']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['tahun_usulan']; ?></td>
                        <td><?= date('d-M-Y', $row['createdAt']); ?></td>
                        <td>
                            <a href="<?= base_url(); ?>/admin/usulan_kgb/detail/<?= $row['id']; ?>" class="btn btn-secondary">Detail</a>
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