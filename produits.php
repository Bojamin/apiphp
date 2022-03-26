<?php
$produits = json_decode(file_get_contents("https://cogno.fr/api/produits"));
ob_start();
?>

<table class="table">
    <tr>
        <td>Id</td>
        <td>Nom</td>
        <td>Nom en anglais</td>
        <td>Image</td>
        <td>Poids</td>
    </tr>
    <?php foreach ($produits as $produit) : ?>
        <tr>
        <td><?= $produit->product_id ?></td>
        <td><?= $produit->product_category_name ?></td>
        <td><?= $produit->product_category_name_english ?></td>
        <td><img src="https://us.123rf.com/450wm/imagecatalogue/imagecatalogue2006/imagecatalogue200600862/149236334-ic%C3%B4ne-de-vecteur-de-m%C3%A9canisme-d-engrenage-une-conception-d-illustration-plate-utilis%C3%A9e-pour-l-ic%C3%B4ne-.jpg?ver=6" width="100px"></td>
        <td><?= $produit->product_weight_g ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
$content = ob_get_clean();
require_once("template.php");
?>