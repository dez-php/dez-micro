<?php
    $view->setMainLayout( 'layout_index.php' );
?>
<h1>Hello!</h1>
<h3>Index page</h3>
<a href="<?= $url->full('auth/login') ?>">login</a>