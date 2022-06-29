<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Ganti Password</h1>
<div class="card mb-4">
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('error_input'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>Gagal mengganti password!</h4>
                </hr />
                <?php echo session()->getFlashdata('error_input'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="<?= base_url(); ?>/pengguna/simpan_password" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="fw-bold">Password Baru</label>
                <input type="password" class="form-control" name="password" value="<?= old('password'); ?>">
            </div>
            <div class="form-group">
                <label for="" class="fw-bold">Masukkan Ulang Password Baru</label>
                <input type="password" class="form-control" name="password_confirmation" value="<?= old('password_confirmation'); ?>">
            </div>
            <button class="btn btn-primary w-100 mt-3">GANTI PASSWORD</button>
        </form>
    </div>
</div>


<?= $this->endSection() ?>