<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Dashboard</h1>
<?php if (session()->get('tipePengguna') == 'admin') : ?>
    <!-- <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div> -->
<?php endif; ?>
<div class="row mb-3">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header fw-bold">
                Daftar Pegawai Yang Harus Segera Membuat Usulan KGB
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">NO</th>
                            <th class="text-center align-middle">PERANGKAT DAERAH</th>
                            <th class="text-center align-middle">NIP</th>
                            <th class="text-center align-middle">NAMA</th>
                            <th class="text-center align-middle">TMT BERKALA TERAKHIR</th>
                            <th class="text-center align-middle">TMT BERKALA BERIKUT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pegawai as $row) : ?>
                            <?php
                            $tigaBulanNotif = date('Y-m-d', strtotime('-3 months', strtotime($row['tmtBerkalaBerikut'])))
                            ?>
                            <?php
                            if ($row['tmtBerkalaBerikut']) :
                                if (date('Y-m-d') >= $tigaBulanNotif) :
                            ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['pd']; ?></td>
                                        <td><?= $row['nip']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= ($row['tmt'] != '') ? date('d/m/Y', strtotime($row['tmt'])) : ''; ?></td>
                                        <td><?= ($row['tmtBerkalaBerikut'] != '') ? date('d/m/Y', strtotime($row['tmtBerkalaBerikut'])) : ''; ?></td>
                                    </tr>
                            <?php
                                endif;
                            endif;
                            ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-chart-bar me-1"></i>
                Informasi KGB
            </div>
            <div class="card-body">
                <p class="fw-bold">Untuk melakukan usulan KGB diharapkan untuk dapat menyediakan dokumen berikut :</p>
                <ul>
                    <li>SK Pangkat Terakhir</li>
                    <li>SK Berkala Terakhir</li>
                    <li>SKP 2 TAHUN TERAKHIR</li>
                    <li>SURAT PENGANTAR</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-user me-1"></i>
                Informasi Pegawai
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="160">Perangkat Daerah</th>
                        <th>:</th>
                        <td><?= session()->get('pd'); ?></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <th>:</th>
                        <td><?= session()->get('nip'); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <td><?= session()->get('nama'); ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <th>:</th>
                        <td><?= session()->get('nama_jabatan'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-2"></i>
                Informasi Pegawai
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="160">Perangkat Daerah</th>
                        <th>:</th>
                        <td><?= session()->get('pd'); ?></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <th>:</th>
                        <td><?= session()->get('nip'); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <td><?= session()->get('nama'); ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <th>:</th>
                        <td><?= session()->get('nama_jabatan'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Daftar Pegawai Yang Harus Segera Mengajukan Usulan KGB
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
            </tbody>
        </table>
    </div>
</div> -->

<script src="<?= base_url(); ?>/public/assets/demo/chart-area-demo.js"></script>
<script src="<?= base_url(); ?>/public/assets/demo/chart-bar-demo.js"></script>
<?= $this->endSection() ?>