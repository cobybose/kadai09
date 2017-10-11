<?php
//1.POSTでParamを取得


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db31;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
//$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name,email=:email,naiyou=:naiyou WHERE id=:id");
//$stmt->bindValue(':name', $name);
//$stmt->bindValue(':email', $email);
//$stmt->bindValue(':naiyou', $naiyou);
//$stmt->bindValue(':id', $id);
//$status = $stmt->execute();


//GET値取得
$id = $_GET["id"];
    
//データ登録SQL作成
$update = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");

//WHERE id=変更するidを指定
$update->bindValue(':id', $id, PDO::PARAM_INT);

//SQL実行
$status = $update->execute();

//次のページへリダイレクト
header("Location: select.php");


?>