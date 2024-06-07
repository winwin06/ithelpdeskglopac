<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Login</b>Glp</a>
        </div>

        <div class="card-login">
            <div class="card">
                <div class="card-body login-card-body">
                <img src="<?= base_url('assets/dist/img/profile/glopac_logo.png') ?>" alt="Glopac Logo" style="width: 100px; height: auto; display: block; margin: 0 auto 20px;">
                <p class="login-box-msg" style="color: black; font-weight: bold;">Sign in Now!!</p>

                    <?= $this->session->flashdata('message'); ?>

                    <form class="user" method="post" action="<?= site_url('login_c/check_login') ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <p class="form-group">
                        <a href="<?= site_url('auth/forgot_password') ?>">Forgot Password?</a>
                    </p>
                    <p class="form-group">
                        <a class="text-center" href="<?= site_url('auth/registration') ?>">Create an Account!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>