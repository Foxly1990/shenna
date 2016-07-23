<?php include_once $_SERVER["DOCUMENT_ROOT"]."/shenna/controller/__content.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Страница вывода контента</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <?php foreach ($arrContent as $items): ?>
            <h2><?php echo $items["title"]; ?></h2>
            <div class="content">
                <?php echo $items["content_ru_RU"]; ?>
            </div>
        <?php endforeach; ?>
    </body>
</html>
