<?= $this->extend('layouts/templates') ?>

<?= $this->section('content') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tabList = [].slice.call(document.querySelectorAll('a[data-bs-toggle="tab"]'));
        tabList.forEach(function(tab) {
            tab.addEventListener("shown.bs.tab", function(e) {
                console.log(e.target); // newly activated tab
                console.log(e.relatedTarget); // previous active tab
                var activeTab = e.target.innerText; // Get the name of active tab
                var previousTab = e.relatedTarget.innerText; // Get the name of previous active tab
                document.querySelector(".active-tab span").innerHTML = activeTab;
                document.querySelector(".previous-tab span").innerHTML = previousTab;
            });
        });
    });
</script>

<style>
    .nav-pills .nav-link {
        color: black;
        font-weight: bold
    }

    .nav-pills .nav-link.active {
        background-color: #737373;
    }
</style>

<div>
    <h1 class="mt-4">Riwayat Usulan</h1>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-waiting-tab" data-bs-toggle="pill" data-bs-target="#pills-waiting" type="button" role="tab" aria-controls="pills-waiting" aria-selected="true">Menunggu Verifikasi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-declined-tab" data-bs-toggle="pill" data-bs-target="#pills-declined" type="button" role="tab" aria-controls="pills-declined" aria-selected="false">Ditolak</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <!--  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <!--  -->
        <div class="tab-pane fade show active" id="pills-waiting" role="tabpanel" aria-labelledby="pills-waiting-tab">
            <div id="content-waiting" class="mt-2"></div>
        </div>
        <div class="tab-pane fade" id="pills-declined" role="tabpanel" aria-labelledby="pills-declined-tab">
            <div id="content-declined" class="mt-2"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#text-header-waiting').text('Menunggu Verifikasi')
        console.log("ready!");


        menungguVerifikasi()

        function menungguVerifikasi() {
            $.ajax({
                url: '<?= base_url(); ?>/kgb/riwayat/menunggu_verifikasi',
                type: 'POST',
                dataType: 'html',
                // success: function(data) {
                //     console.log('success ajax!');
                //     console.log(data);
                //     // $('#content-waiting').html(data);
                // }
            }).then((response) => {

                $('#content-waiting').html(response);
            });
        }

        function ditolak() {
            $.ajax({
                url: '<?= base_url(); ?>/kgb/riwayat/ditolak',
                type: 'POST',
                dataType: 'html',
                success: function(data) {
                    $('#content-declined').html(data);
                }
            });
        }

        $('#pills-declined-tab').click(function() {
            ditolak()
        })

        $('#pills-waiting-tab').click(function() {
            menungguVerifikasi()
        })

    });
</script>

<?= $this->endSection() ?>