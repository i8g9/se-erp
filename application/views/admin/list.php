<?php $this->view('template/navbar'); ?>
<?php $this->view('template/sidebar'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>User List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">User List</li>
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
                <?php foreach ($userAll as $i => $u) : ?>
                    <tr>
                        <td> <?= $u['id_user'] ?></td>
                        <td> <?= $u['username'] ?></td>
                        <td> <?= $u['role'] ?></td>
                        <td>
                            <button id="<?= $u['id_user']; ?>" class="btn btn-danger delete">Delete</button>
                            <button id="<?= $u['id_user']; ?>" class="btn btn-success edit">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                    </form><!-- Vertical Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary submit">Submit</button>
                </div>
            </div>
        </div>
    </div><!-- End Basic Modal-->

</main><!-- End #main -->
<script src="<?= base_url('assets'); ?>/js/admin/list.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>