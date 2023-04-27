<?php $this->view('template/navbar'); ?>
<?php $this->view('template/sidebar'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Request</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">User Request</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card pb-4 pt-4 pr-4 pl-4">
        <table class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Purchase</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($request as $i => $u) : ?>
                    <tr>
                        <td> <?= $u['id_purchase'] ?></td>
                        <td id="user"> <?= $u['username'] ?></td>
                        <td><?php foreach ($supplier as $s) : ?>
                                <?php if ($s['id_supplier'] == $u['id_supplier']) {
                                    echo $s['name'];
                                } ?>
                            <?php endforeach; ?></td>
                        <td><?php
                            switch ($u['status']) {
                                case 0:
                                    echo "Rejected";
                                    break;
                                case 1:
                                    echo "To Be Approved";
                                    break;
                                case 2:
                                    echo "Approved, Please Pay";
                                    break;
                                case 3:
                                    echo "Payed";
                                    break;
                                default:
                                    echo "No Info";
                            }
                            ?></td>
                        <td>
                            <button id="<?= $u['id_purchase']; ?>" class="btn btn-primary detail">Detail</button>
                            <button id="<?= $u['id_purchase']; ?>" class="btn btn-danger reject">Reject</button>
                            <button id="<?= $u['id_purchase']; ?>" class="btn btn-success approve">Approve</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="frm" method="POST" action="<?= base_url(); ?>/user/savePurchase">
                    <div class="modal-header">
                        <h5 class="modal-title">Purchase Model</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <input class="form-control" type="text" name="id_purchase" id="id_purchase" hidden>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Supplier</label>
                                <select class="form-select" id="supplier" name="supplier" required>
                                    <option selected disabled value="">Choose Supplier</option>
                                    <?php foreach ($supplier as $s) : ?>
                                        <option value="<?= $s['id_supplier']; ?>"><?= $s['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- BAHAM UTAMA -->
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-auto float-right ml-auto">
                                        <button type="button" class="btn btn-info" id="tambah">Tambah Produk</button>
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="tblDtl">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle; width: 10px">No</th>
                                            <th style="text-align: center; vertical-align: middle; width: 100px">Produk</th>
                                            <th style="text-align: center; vertical-align: middle; width: 50px">Kuantitas</th>
                                            <th style="text-align: center; vertical-align: middle; width: 50px">Harga Satuan</th>
                                            <th style="text-align: center; vertical-align: middle; width: 50px" id="actBe">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->

    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
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

</main><!-- End #main -->

<script src="<?= base_url('assets'); ?>/js/admin/purchase.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>