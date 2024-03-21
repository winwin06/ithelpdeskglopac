<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Forgot Your Password?</b></a>
        </div>

        <div class="card-login">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in Now!!</p>

                    <?= $this->session->flashdata('message'); ?>

                    <form class="user" method="post" action="<?= site_url('dashboard/forgot_password') ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <p class="form-group">
                        <a class="text-center" href="<?= site_url('dashboard') ?>">Back to Login!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>