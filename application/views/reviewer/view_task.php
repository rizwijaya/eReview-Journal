<section id="maincontent">

    <head>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/table/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/table/vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/table/vendor/perfect-scrollbar/perfect-scrollbar.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/table/css/util.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/table/css/main.css">
        <!--===============================================================================================-->
    </head>

    <body>
        <div class="jumbotron masthead">
            <div class="container">
                <h2>Task List</h2>
                <div class="container-table100">
                    <div class="wrap-table100">
                        <h2 style="color:green">My Task Progress</h2>
                        <p><?php if (strlen($msg) > 0) echo $msg; ?></p>
                        <div class="table100 ver5 m-b-110">
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th width="5px" style="padding-left: 20px; text-align: center">No</th>
                                            <th width="100px" style="text-align: center">Title</th>
                                            <th width="100px" style="text-align: center">Keywords</th>
                                            <th width="200px" style="text-align: center">Filename</th>
                                            <th width="70px" style="text-align: center">Submitted</th>
                                            <th width="70px" style="text-align: center">Progress</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="table100-body js-pscroll">
                                <table>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($tasks as $item) {
                                            $i++;
                                        ?>
                                            <tr class="row100 body">
                                                <td width="5px" style="padding-left: 20px"><?= $i; ?></td>
                                                <td width="100px"><?= $item['judul']; ?></td>
                                                <td width="100px"><?= $item['keywords']; ?></td>
                                                <td width="200px" style="text-align: center"><a href="<?= base_url() . 'index.php/ApplicationCtl/download/' . $item['id_task']; ?>" target="_blank"><?= $item['file_location']; ?></a></td>
                                                <td width="70px" style="text-align: center"><?= date("d M Y", strtotime($item['date_created'])); ?></td>
                                                <?php if ($item['status'] == 2) : ?>
                                                    <td width="70px" style="text-align: center"><?= $item['nama_status']; ?>
                                                        <a href="<?php echo site_url('reviewerCtl/completeReviewTask/' . $item['id_assign']) ?>" class="badge badge-success">Editing</a></td>
                                                <?php else : ?>
                                                    <td width="70px" style="text-align: center"><?= $item['nama_status']; ?></td>
                                                <?php endif; ?>
                                            </tr>
                                    </tbody>
                                <?php }  ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/table/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/table/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/table/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/table/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/table/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            var ps = new PerfectScrollbar(this);

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/table/js/main.js"></script>

    </>
</section>