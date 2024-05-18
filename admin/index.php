<?php
ob_start();
include($_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/contents/index.php');
$content = ob_get_clean();
?>



<!-- fin -->


<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pdv-systeme/admin/layout.php');

?>