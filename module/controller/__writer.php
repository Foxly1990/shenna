<?php
include $_SERVER["DOCUMENT_ROOT"]."/shenna/module/content.php";
$content = new Content;
$setContent = $content->setContent("new_ru");

echo json_encode($setContent);
?>
