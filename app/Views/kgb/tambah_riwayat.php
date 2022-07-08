<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<h5 class="mt-4">Tambah Riwayat KGB Pegawai - <?= $pegawai['nama']; ?></h5>
<div class="card mb-4">
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('error_input'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>Gagal mengubah data!</h4>
                </hr />
                <?php echo session()->getFlashdata('error_input'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="<?= base_url(); ?>/kgb/perbaharui_riwayat" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="fw-bold">NIP</label>
                <input type="text" value="<?= $pegawai['nip']; ?>" class="form-control" name="nip" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">NAMA PEGAWAI</label>
                <input type="text" value="<?= $pegawai['nama']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">JABATAN</label>
                <input type="text" class="form-control" name="jabatan" placeholder="Pengadministrasi Umum" value="<?= (old('jabatan')) ? old('jabatan') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">GOLONGAN</label>
                <input type="text" class="form-control" name="golongan" placeholder="IV/B" value="<?= (old('golongan')) ? old('golongan') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">NO SK</label>
                <input type="text" class="form-control" name="no_sk" placeholder="123/XXX/123" value="<?= (old('no_sk')) ? old('no_sk') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">TANGGAL SK</label>
                <input type="date" class="form-control" name="tanggal_sk" value="<?= (old('tanggal_sk')) ? old('tanggal_sk') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">TMT BERKALA</label>
                <input type="date" class="form-control" name="tmt" value="<?= (old('tmt')) ? old('tmt') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">MASA KERJA TAHUN</label>
                <input type="number" class="form-control" name="masa_kerja_tahun" value="<?= (old('masa_kerja_tahun')) ? old('masa_kerja_tahun') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">MASA KERJA BULAN</label>
                <input type="number" class="form-control" name="masa_kerja_bulan" value="<?= (old('masa_kerja_bulan')) ? old('masa_kerja_bulan') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">GAJI POKOK LAMA</label>
                <input type="text" class="form-control" name="gaji_pokok_lama" id="gaji_pokok_lama" value="<?= (old('gaji_pokok_lama')) ? old('gaji_pokok_lama') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">GAJI POKOK BARU</label>
                <input type="text" class="form-control" name="gaji_pokok_baru" id="gaji_pokok_baru" value="<?= (old('gaji_pokok_baru')) ? old('gaji_pokok_baru') : '' ?>">
            </div>
            <div class="form-group mt-4">
                <label for="" class="fw-bold">BERKAS SK</label>
                <input type="file" class="form-control" name="file_sk" id="file_sk" value="<?= (old('file_sk')) ? old('file_sk') : '' ?>">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">TAMBAH RIWAYAT KGB</button>
        </form>
    </div>
</div>

<script>
    /* Tanpa Rupiah */
    let gaji_pokok_lama = document.getElementById('gaji_pokok_lama');
    gaji_pokok_lama.addEventListener('keyup', function(e) {
        gaji_pokok_lama.value = formatRupiah(this.value);
    });

    let gaji_pokok_baru = document.getElementById('gaji_pokok_baru');
    gaji_pokok_baru.addEventListener('keyup', function(e) {
        gaji_pokok_baru.value = formatRupiah(this.value);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


<?= $this->endSection() ?>