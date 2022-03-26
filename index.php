<?php
ob_start();
?>
<h1>Bienvenue sur mon site de dataliz.</h1>
<?php
$content = ob_get_clean();
require_once("template.php");
?>