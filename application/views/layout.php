<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $titre ?></title>
        <link rel="stylesheet" type="text/css" href="<?= site_url() . CSS_DIR?>style.css" media="screen" />
    </head>
    <body>
        <div id="container">
            
            <h1><?= $titre ?></h1>
            
            <?= $vue?>
            
        </div>
    </body>
</html>