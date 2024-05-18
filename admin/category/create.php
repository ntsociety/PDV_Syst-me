<?php
ob_start();
include($_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/contents/category/create.php');
$content = ob_get_clean();
?>



<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/layout.php';
?>

<!-- fin -->