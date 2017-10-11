<?php
//1.POSTでParamを取得
$name = $_POST["name"];
$email = $_POST["email"];
$status = $_POST["status"];
$naiyou = $_POST["naiyou"];
$id = $_POST["id"];


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db31;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book=:name,url=:email,status=:status,comment=:naiyou WHERE id=:id");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':status', $status);
$stmt->bindValue(':naiyou', $naiyou);
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//次のページへリダイレクト
header("Location: select.php");


?>
