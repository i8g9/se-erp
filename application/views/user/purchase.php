<?php $this->view('template/navbar'); ?>
<?php $this->view('template/sidebar'); ?>

<main id="main" class="main">
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to leave?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to logout.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('Auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->
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
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $i => $u) : ?>
                    <tr>
                        <td> <?= $u['id_user'] ?></td>
                        <td> <?= $u['username'] ?></td>
                        <td> <?= $u['role'] ?></td>
                        <td><select class="form-select status">
                                <option id="" value="0">Delete</option>
                                <option id="" value="1">Edit</option>
                                <option id="" value="2">Detail</option>
                            </select></td>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
    </div>

</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>