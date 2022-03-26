<?php

function getProduits(){
    $pdo = getConnexion(); 
    $req = "SELECT * FROM `product` WHERE 1";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getProduitsByCategorie($categorie){
    $pdo = getConnexion(); 
    $req = "SELECT * FROM `product` WHERE `product_category_name_english`= :categorie";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":categorie",$categorie,PDO::PARAM_STR);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getProduitById($id){
    $pdo = getConnexion(); 
    $req = "SELECT * FROM `product` WHERE `product_id`= :id";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":id",$id,PDO::PARAM_STR);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getNombreParCate(){
    $pdo = getConnexion();
    $req = "SELECT `product_category_name_english`, COUNT(`product_category_name_english`) AS categorie_total
    FROM `product`
    GROUP BY `product_category_name_english`";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getNombreParCateByCate($categorie) {
    $pdo = getConnexion();
    $req = "SELECT SUM(`product_category_name_english` = :categorie) FROM `product`";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":categorie",$categorie,PDO::PARAM_STR);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getCustomersDistributionByCP() {
    $pdo = getConnexion();
    $req = "SELECT `customer_state`, COUNT(`customer_state`) * 100 / 99441 AS repartition_total 
    FROM `customers` 
    GROUP BY `customer_state`";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getCustomersDistributionByCPAndCate($categorie) {
    $pdo = getConnexion();
    $req = "SELECT SUM(`customer_state` = :categorie) FROM `customers`";
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":categorie",$categorie,PDO::PARAM_STR);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getStatusOrder() {
    $pdo = getConnexion();
    $req = "SELECT `order_status`, COUNT(`order_status`) AS status_count 
    FROM `orders` WHERE `order_status`!= 'delivered'
    GROUP BY `order_status`";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    sendJSON($produits);
}

function getConnexion(){
    return new PDO("mysql:host=db5006871333.hosting-data.io;dbname=dbs5673344;charset=utf8","dbu461292","fh_Wc.Gpw3u?Xz9@");
}

function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}