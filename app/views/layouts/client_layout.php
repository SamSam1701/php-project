<html>
    <head>
        <title><?php echo (!empty($page_title))? $page_title : 'Trang Chủ' ?></title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/app/public/assets/clients/css/style.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOUdWi4lWQyL1TkWGi5fC5DRyS+g9mGCE1XuJQwXuJ7Jhzz" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-QodG5j3MxOnsKud7qqr5Bjw93W/yYVZ9EgCsbhDQW87dWkWYpM9pDzzNlucF/DMGhJ9zUgJnB3rh1JTLjSDyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/app/public/assets/clients/js/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class='page-wrapper'>
            <?php
                $this->render('blocks/header');
                $this->render($content, $sub_content);
            ?>
        </div>
    </body>
</html>