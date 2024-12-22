<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/clients/css/style.css?<?php echo rand(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>

<body>
    <?php
    // $this->render('blocks/header');
    $html = new HtmlHelper();
    $html->index();
   
    if(!empty($msg)){
        echo $msg;
    }
   
    ?>
    <div class="container">
        <div class="row" style="display:flex; justify-content:center;">
            <div class="col-6">
                <form method="post" action="/php_ad/mvc/home/postMethod">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" name="fullname" class="form-control" id="name" value="<?php echo old('fullname',false); ?>">
                        <?php echo form_error('fullname', '<div><span style="color: red;">','</span></div>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email_id" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email_id" value="<?php echo old('email',false); ?>">
                        <?php echo form_error('email', '<div><span style="color: red;">','</span></div>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password_" class="form-label">Mật khẩu</label>
                        <input type="text" name="password" class="form-control" id="password_">
                        <?php echo form_error('password', '<div><span style="color: red;">','</span></div>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password_s" class="form-label">Nhập lại mật khẩu</label>
                        <input type="text" name="confirm_password" class="form-control" id="password_s">
                        <?php echo form_error('confirm_password', '<div><span style="color: red;">','</span></div>'); ?>
                    </div>

                    <button class="btn btn-primary" type="submit">Gửi</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // $this->render('blocks/footer');
    ?>
    <script type="text/javascript"
        src="<?php echo _WEB_ROOT_; ?>/public/assets/clients/js/custom.js?<?php echo rand(); ?>">

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>