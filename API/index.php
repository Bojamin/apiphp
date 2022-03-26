<?php 
require_once("./api.php");

try {
    if(!empty($_GET['demande'])){
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "produits" :
                if(empty($url[1])){
                    getProduits();
                } else {
                    getProduitsByCategorie($url[1]);
                }
            break;
            case "produit" : 
                if(!empty($url[1])){
                    getProduitById($url[1]);
                } else {
                    throw new Exception ("Il faut renseigner un id valide.");
                }
            break;
            case "categories" :
                if(empty($url[1])){
                    getNombreParCate();
                } else {
                    getNombreParCateByCate($url[1]);
                }
            break;
            case "codepostal" : 
                if(empty($url[1])){
                    getCustomersDistributionByCP();
                } else {
                    getCustomersDistributionByCPAndCate($url[1]);
                }
            break;
            case "order" :
                if(empty($url[1])){
                    getStatusOrder();
                }
            break;
            default : throw new Exception ("Bravo d'être arrivé la même moi j'ai pas réussi.");
        }
    } else {
        throw new Exception ("Bienvenue sur mon API, chemins disponible : produits/produit[id]/produits[categorie_en_anglais]/order/categories/categories[nomcate]/codepostal/codepostal[nomcodepostal]");
    }
} catch(Exception $e){
    $erreur =[
        "message" => $e->getMessage(),
    ];
    print_r($erreur);
}

?>