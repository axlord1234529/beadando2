<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tiszta Víz</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
            <h1 class="header">Tiszta Víz Kft.</h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>
                <h2>Tiszta Víz Kft.</h2>
                <p>Megbízható szolgáltatás, kristálytiszta megoldások minden vízproblémára!</p>
        </aside>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer> Copyright &copy; <?= date("Y") ?> Tiszta Víz Kft  | Created by Kalmár Sándor</footer>
    </body>
</html>
