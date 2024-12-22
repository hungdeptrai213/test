<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/clients/css/style.css?<?php echo rand(); ?>">
</head>

<body>
    <?php
    $this->render('blocks/header');
    echo '<pre>';
    print_r($errors);
    echo '</pre>';

    $this->render('blocks/footer');
    ?>
    <script type="text/javascript"
        src="<?php echo _WEB_ROOT_; ?>/public/assets/clients/js/custom.js?<?php echo rand(); ?>">
    </script>
</body>

</html>