<?php

ob_start();
include($_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/contents/supliers/edit.php');
$content = ob_get_clean();
?>



<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/layout.php';
?>

<!-- fin -->