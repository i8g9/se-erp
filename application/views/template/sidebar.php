<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php if ($this->session->userdata('role') == 1) : ?>
            <li class="nav-heading">Administrator</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('admin'); ?>">
                    <i class="bi bi-list-ul"></i>
                    <span>User List</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('admin/request'); ?>">
                    <i class="bi bi-person-check"></i>
                    <span>User Request</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('admin/payment'); ?>">
                    <i class="bi bi-exclamation-square"></i>
                    <span>User Payment</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <a class="nav-link collapsed" href="<?= base_url('admin/supplier'); ?>">
                <i class="bi bi-bank"></i>
                <span>Supplier</span>
            </a>
            </li><!-- End Dashboard Nav -->

            <a class="nav-link collapsed" href="<?= base_url('admin/product'); ?>">
                <i class="bi bi-archive"></i>
                <span>Product</span>
            </a>
            </li><!-- End Dashboard Nav -->

        <?php endif; ?>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user'); ?>">
                <i class="bi bi-grid"></i>
                <span>Purchase</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user/payment'); ?>">
                <i class="bi bi-person"></i>
                <span>Payment</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->