<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["status"]) || $_POST["status"]=="" ||
  !isset($_POST["naiyou"]) || $_POST["naiyou"]==""
){
  exit("ParamError");
}

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$status  = $_POST["status"];
$naiyou = $_POST["naiyou"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db31;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book, url, status, comment,
indate )VALUES(NULL, :a1, :a2, :a3, :a4, sysdate())");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $email);
$stmt->bindValue(':a3', $status);
$stmt->bindValue(':a4', $naiyou);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;
}
?>
