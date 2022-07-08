<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<?php

function tmtCpns($nip)
{
    $year = substr($nip, 8, 4);
    $month = substr($nip, 12, 2);
    return '01/' . $month . '/' . $year;
}

?>


<h1 class="mt-4">Daftar Pegawai</h1>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="table-daftar-pegawai">
                <thead>
                    <tr>
                        <th class="text-center align-middle">NO</th>
                        <th class="text-center align-middle">NIP</th>
                        <th class="text-center align-middle" style="width: 50%">NAMA PEGAWAI</th>
                        <th class="text-center align-middle">TMT CPNS</th>
                        <th class="text-center align-middle">TMT BERKALA TERAKHIR</th>
                        <th class="text-center align-middle">TMT BERKALA BERIKUT</th>
                        <th class="text-center align-middle" style="width: 25%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pegawai as $row) : ?>
                        <?php
                        // $tmtBerikut = date('Y-m-d', strtotime('+2 years', strtotime($row['tmt'])));
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= tmtCpns($row['nip']); ?></td>
                            <td><?= ($row['tmt'] != '') ? date('d/m/Y', strtotime($row['tmt'])) : ''; ?></td>
                            <td><?= ($row['tmtBerkalaBerikut'] != '') ? date('d/m/Y', strtotime($row['tmtBerkalaBerikut'])) : ''; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>/kgb/tambah_riwayat/<?= $row['nip']; ?>" class="btn btn-sm btn-warning text-dark w-100">Tambah Riwayat</a> <br>

                                <?php if ($row['tmtBerkalaBerikut'] != '') : ?>
                                    <a href="<?= base_url(); ?>/kgb/riwayat/diterima" class="btn btn-sm btn-primary mt-2 w-100">Lihat Riwayat</a> <br>
                                <?php endif; ?>

                                <?php
                                $tigaBulanNotif = date('Y-m-d', strtotime('-3 months', strtotime($row['tmtBerkalaBerikut'])))
                                ?>

                                <?php
                                if ($row['tmtBerkalaBerikut']) :
                                    if (date('Y-m-d') >= $tigaBulanNotif) :
                                ?>
                                        <a href="<?= base_url(); ?>/kgb/tambah?nip=<?= $row['nip']; ?>" class="btn btn-sm btn-success mt-2 w-100">Usul KGB</a>
                                <?php
                                    endif;
                                endif;
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#table-daftar-pegawai').DataTable();
            });
        </script>
    </div>
</div>


<?= $this->endSection() ?>