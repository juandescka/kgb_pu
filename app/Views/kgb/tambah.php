<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Tambah Usulan KGB</h1>
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
        <form action="<?= base_url(); ?>/kgb/simpan" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="fw-bold">NIP</label>
                <input type="text" value="<?= session()->get('nip'); ?>" class="form-control" name="nip" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">NAMA PEGAWAI</label>
                <input type="text" value="<?= session()->get('nama'); ?>" class="form-control" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">TAHUN USULAN</label>
                <input type="number" class="form-control" name="tahun_usulan" value="<?= old('tahun_usulan'); ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">SK PANGKAT TERAKHIR</label>
                <input type="file" class="form-control" name="sk_pangkat_terakhir">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">SK BERKALA TERAKHIR</label>
                <input type="file" class="form-control" name="sk_berkala_terakhir">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">SKP 2 TAHUN TERAKHIR</label>
                <input type="file" class="form-control" name="skp_terakhir">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">SURAT PENGANTAR</label>
                <input type="file" class="form-control" name="surat_pengantar">
            </div>
            <button class="btn btn-primary w-100 mt-3">TAMBAH USULAN</button>
        </form>
    </div>
</div>


<?= $this->endSection() ?>