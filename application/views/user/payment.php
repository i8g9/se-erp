<?php $this->view('template/navbar'); ?>
<?php $this->view('template/sidebar'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Purchase</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Purchase</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card pb-4 pt-4 pr-4 pl-4">
        <table class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchase as $i => $u) : ?>
                    <tr>
                        <td> <?= $u['id_purchase'] ?></td>
                        <td><?php foreach ($supplier as $s) : ?>
                                <?php if ($s['id_supplier'] == $u['id_supplier']) {
                                    echo $s['name'];
                                } ?>
                            <?php endforeach; ?></td>
                        <td><?= $u['harga'] ?></td>
                        <td><?php foreach ($payment as $p) : ?>
                                <?php if ($p['id_purchase'] == $u['id_purchase']) {
                                    switch ($p['status']) {
                                        case 0:
                                            echo "Wait to be Approved";
                                            break;
                                        case 1:
                                            echo "Approved, On delivery";
                                            break;
                                        case 2:
                                            echo "Rejected, contact Admin for more info";
                                            break;
                                        default:
                                            break;
                                    }
                                } else {
                                    echo "Not Payed";
                                } ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <button id="<?= $u['id_purchase']; ?>" class="btn btn-primary detail">Pay</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="frm" method="POST" action="<?= base_url(); ?>/user/savePayment" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <input class="form-control" type="text" name="id_purchase" id="id_purchase" hidden>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Shop</label>
                                <select class="form-select" id="supplier" name="supplier" disabled>
                                    <option selected disabled value="">Choose Supplier</option>
                                    <?php foreach ($supplier as $s) : ?>
                                        <option value="<?= $s['id_supplier']; ?>"><?= $s['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="error-msg"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Price</label>
                                <input class="form-control" type="text" name="price" id="price" readonly>
                                <div id="error-msg"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Pay</label>
                                <input class="form-control" type="file" name="payment" id="payment">
                                <div id="error-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->

    <div class="modal fade" id="deleteModal" tabindex="-1">
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
                    <button type="button" class="btn btn-danger delete">Delete</button>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->

</main><!-- End #main -->


<script src="<?= base_url('assets'); ?>/js/user/payment.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>