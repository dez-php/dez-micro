<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dez Micro App</title>
</head>
<body>

<style>

    .content {
        margin: 0px;
        border: 3px solid rgb(15, 255, 26);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 10px 10px 12px rgb(255, 0, 97);
    }

</style>

<header>
    <!-- header -->

    <a href="<?= $url->create( 'news', [
        'id'        => 761,
        'pseudo'    => 'far-cry-primal'
    ] ) ?>">test</a>

    <?= $url->staticPath( 'javascript/jquery.js' ) ?>

    <!-- end header -->
</header>

<div class="content">
    <!-- content -->
    <?=$this->section( 'content' );?>
    <!-- end content -->
</div>

<footer>
    <!-- footer -->

    <!-- end footer -->
</footer>

</body>
</html>