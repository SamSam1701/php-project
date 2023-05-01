<html>
    <head>
        <title><?php echo (!empty($page_title))? $page_title : 'Trang Chủ' ?></title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/app/public/assets/clients/css/style.css"/>
    </head>
    <body>
        <div class='page-wrapper'>
            <?php
                $this->render('blocks/header');
                $this->render($content, $sub_content);
                // $this->render('blocks/footer');
            ?>
        </div>
        <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/app/public/assets/clients/js/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>