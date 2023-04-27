<?php $this->view('template/navbar'); ?>
<?php $this->view('template/sidebar'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Payment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">User Payment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card pb-4 pt-4 pr-4 pl-4">
        <table class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Payment</th>
                    <th scope="col">ID Purchase</th>
                    <th scope="col">User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment as $i => $u) : ?>
                    <tr>
                        <td> <?= $u['id_payment'] ?></td>
                        <td> <?= $u['id_purchase'] ?></td>
                        <td> <?php foreach ($allUser as $m) : ?>
                                <?php if ($m['id_user'] == $u['id_user']) {
                                        echo $m['username'];
                                    } ?>
                            <?php endforeach; ?></td>
                        <td>
                            <?php
                            switch ($u['status']) {
                                case 0:
                                    echo "To be Approved";
                                    break;
                                case 1:
                                    echo "Approved";
                                    break;
                                case 2:
                                    echo "Rejected";
                                    break;
                                default:
                                    echo "No Info";
                            }
                            ?>
                        </td>
                        <td>
                            <button id="<?= $u['id_payment']; ?>" class="btn btn-primary detail">Detail</button>
                            <button id="<?= $u['id_payment']; ?>" class="btn btn-danger reject">Reject</button>
                            <button id="<?= $u['id_payment']; ?>" class="btn btn-success approve">Approve</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger delete">Yes</button>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->

    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="payPic" src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->

</main><!-- End #main -->

<script src="<?= base_url('assets'); ?>/js/admin/payment.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>