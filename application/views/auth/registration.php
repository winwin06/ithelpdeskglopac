<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Register</b>Glp</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
        <img src="<?= base_url('assets/dist/img/profile/glopac_logo.png') ?>" alt="Glopac Logo" style="width: 100px; height: auto; display: block; margin: 0 auto 20px;">
            <p class="login-box-msg">Create an Account</p>

            <form class="user" method="post" action="<?= site_url('auth/registration') ?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                    <?= form_error('name', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">Register Account</button>
                </div>
        </div>
        </form>

        <div class="text-center">
            <p class="form-group">
                <a href="<?= site_url('auth/forgot_password')?>">Forgot Password?</a>
            </p>
        </div>
        <div class="text-center">
            <p class="form-group">
                <a class="text-center" href="<?= site_url(''); ?>">
                    Already have an account? Login!</a>
            </p>
        </div>
    </div>
</div>
</div>