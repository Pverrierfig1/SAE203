<?php
$page = "wiki.php";
$description = "Page Wiki";
$keywords = "default";

include("./scripts/functions.php");
parametres($page,$description,$keywords);

entete($page);

navigation($page);

?>

<div class="text-center">
	<h1>Page Wiki</h1>
	<p>Dans cette page se trouve toutes les ressources et techniques utilisées pour concevoir le site</p>
</div>

<?php
pieddepage();
?>