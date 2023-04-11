<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                <form class="row g-3 needs-validation" method="POST" action="<?= base_url('auth/register'); ?>" enctype="multipart/form-data" novalidate>
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username'); ?>" required>
                                        <div class="invalid-feedback">Please, enter your username</div>
                                        <?= form_error('username', '<div class="invalid">', '</div>') ?>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                        <?= form_error('username', '<div class="invalid">', '</div>') ?>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="<?= base_url('auth'); ?>">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>