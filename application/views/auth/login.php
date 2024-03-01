<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Login</b>Glp</a>
        </div>

        <div class="card-login">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in Now!!</p>

                    <?= $this->session->flashdata('message'); ?>

                    <form class="user" method="post" action="<?= site_url('') ?>">
                    
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
                        <a href="forgot-password.html">Forgot Password?</a>
                    </p>
                    <p class="form-group">
                        <a class="text-center" href="<?= site_url('dashboard/registration') ?>">Create an Account!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>