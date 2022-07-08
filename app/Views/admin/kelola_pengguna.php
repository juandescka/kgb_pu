<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<!-- End Datatable -->

<h1 class="mt-4"><?= $title; ?></h1>
<div class="card mb-4">
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('error_input'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>Gagal menambahkan data!</h4>
                </hr />
                <?php echo session()->getFlashdata('error_input'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered" id="table-pengguna">
            <thead>
                <tr>
                    <th class="text-center align-middle">NO</th>
                    <th class="text-center align-middle">PERANGKAT DAERAH</th>
                    <th class="text-center align-middle">NIP</th>
                    <th class="text-center align-middle">NAMA</th>
                    <th class="text-center align-middle">TIPE PENGGUNA</th>
                    <th class="text-center align-middle">STATUS PENGGUNA</th>
                    <th class="text-center align-middle">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($pengguna as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['pd']; ?></td>
                        <td><?= $row['nip']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= ucfirst($row['tipePengguna']); ?></td>
                        <td>
                            <?php if ($row['status'] != '') : ?>
                                <?php if ($row['status'] == 'active') : ?>
                                    <span class="text-success fw-bold">TERDAFTAR AKTIF</span>
                                <?php elseif ($row['status'] == 'inactive') : ?>
                                    <span class="text-warning fw-bold">TERDAFTAR TIDAK AKTIF</span>
                                <?php endif; ?>
                            <?php else : ?>
                                <span class="text-danger fw-bold">TIDAK TERDAFTAR</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['nip'] != session()->get('nip')) : ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['nip'] ?>">
                                    Kelola
                                </button>
                            <?php endif; ?>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $row['nip'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($row['penggunaId'] != '') : ?>
                                                <form action="<?= base_url(); ?>/admin/perbaharui_pengguna" method="post">
                                                    <input type="hidden" value="<?= $row['penggunaId']; ?>" name="penggunaId">
                                                    <div class="form-group">
                                                        <?php $tipePenggunaArr = ['operator', 'admin', 'pegawai'] ?>
                                                        <label for="tipePengguna">Tipe Pengguna</label>
                                                        <select name="tipePengguna" id="tipePengguna" class="form-control">
                                                            <option value="<?= $row['tipePengguna']; ?>"><?= ucfirst($row['tipePengguna']); ?></option>
                                                            <?php foreach ($tipePenggunaArr as $t) : ?>
                                                                <?php if ($t != $row['tipePengguna']) : ?>
                                                                    <option value="<?= $t; ?>"><?= ucfirst($t); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <?php $statusPenggunaArr = ['active', 'inactive'] ?>
                                                        <label for="statusPengguna">Status Pengguna</label>
                                                        <select name="statusPengguna" id="statusPengguna" class="form-control">
                                                            <option value="<?= $row['status']; ?>"><?= ($row['status'] == 'active') ? 'Aktif' : 'Tidak Aktif' ?></option>
                                                            <?php foreach ($statusPenggunaArr as $s) : ?>
                                                                <?php if ($s != $row['status']) : ?>
                                                                    <option value="<?= $s; ?>"><?= ($s == 'active') ? 'Aktif' : 'Tidak Aktif' ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="statusPengguna">Kata Sandi</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">SIMPAN PERUBAHAN</button>
                                                </form>
                                            <?php else : ?>
                                                <form action="<?= base_url(); ?>/admin/daftar_pengguna" method="post">
                                                    <input type="hidden" value="<?= $row['nip']; ?>" name="nip">
                                                    <div class="form-group">
                                                        <?php $tipePenggunaArr = ['operator', 'admin', 'pegawai'] ?>
                                                        <label for="tipePengguna">Tipe Pengguna</label>
                                                        <select name="tipePengguna" id="tipePengguna" class="form-control">
                                                            <?php foreach ($tipePenggunaArr as $t) : ?>
                                                                <?php if ($t != $row['tipePengguna']) : ?>
                                                                    <option value="<?= $t; ?>"><?= ucfirst($t); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <?php $statusPenggunaArr = ['active', 'inactive'] ?>
                                                        <label for="statusPengguna">Status Pengguna</label>
                                                        <select name="statusPengguna" id="statusPengguna" class="form-control">
                                                            <?php foreach ($statusPenggunaArr as $s) : ?>
                                                                <?php if ($s != $row['status']) : ?>
                                                                    <option value="<?= $s; ?>"><?= ($s == 'active') ? 'Aktif' : 'Tidak Aktif' ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="statusPengguna">Kata Sandi</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">DAFTAR PENGGUNA</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table-pengguna').DataTable();
    });
</script>


<?= $this->endSection() ?>