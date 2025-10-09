<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body">
            <h3 align="center"><img src="<?= base_url("uploads/logo/logo.png"); ?>" class="img-round" width="200px"> <br><br> ECO Management System</h3>
            <form action="<?= site_url('Auth/login') ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nama" placeholder="Name PIC" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="text-center">
                        <button type="submit" name="btnlogin" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Sign In</button>
                    </div>
                </div>
            </form>
            <a href="<?= site_url('ECO_Public') ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->