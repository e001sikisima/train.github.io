<?php
mb_language("japanese");
mb_internal_encoding("utf-8");
//必須項目に入力漏れがないか確認  
if(!empty($_POST['company_name']) && !empty($_POST['name']) && !empty($_POST['tel'])){
$company_name=$_POST['company_name'];
$name=$_POST['name'];
$mail=$_POST['mail'];
$tel=$_POST['tel'];
$detail = $_POST['detail'];
$detailDisp=nl2br($_POST['detail']);  
$success = true;
}
?>

<?php if($success){//確認画面の表示 ?>
  <form action="submit.php" method="post">
  <input type="hidden" name="key" value="<? print $key ?>" />
<p><?php echo $company_name; ?><input name="company_name" type="hidden" value="<?php echo $company_name; ?>"></p>
<p class="form_tit">お名前</p>
<p><?php echo $name; ?><input name="name" type="hidden" value="<?php echo $name; ?>"></p>
<p class="form_tit">メールアドレス</p>
<p><?php echo $mail; ?><input type="hidden" name="mail" value="<?php echo $mail; ?>"></p>
<p class="form_tit">電話番号</p>
<p><?php echo $tel; ?><input type="hidden" name="tel" value="<?php echo $tel; ?>"></p>
<p class="form_tit">お問い合わせ内容の詳細</p>
<p><?php echo $detailDisp; ?><input type="hidden" name="detail" value="<?php echo $detail; ?>"></p>
<p class="align-center"><input name="submit" type="submit" value="送信"></p>
　　<p class="align-center"><a href="form.php">戻る</a></p>
</form>
<?php }else{//不備がある ?>
　　　　　　　　　　　　 <p>申し訳ございません、入力内容に不備がります。<br>
前ページに戻って正しく入力してください。</p>
<p class="align-center"><a href="form.php">戻る</a></p>
<?php } ?>

<?php
mb_language("japanese");
mb_internal_encoding("utf-8");

if(!empty($_POST['company_name']) && !empty($_POST['name']) && !empty($_POST['tel'])){
$company_name=$_POST['company_name'];
$name=$_POST['name'];
$mail=$_POST['mail'];
$tel=$_POST['tel'];
$detail=htmlspecialchars($_POST['detail']);

$success=mb_send_mail("送り先メールアドレス","ホームページからのお問い合わせ","$company_name."\n名前：".$name."\nメールアドレス：".$mail."\n電話番号：".$tel."\nお問い合わせ内容\n".$detail,"from:".$mail);
}
?>
<?php
if($success){//送信完了 ?>
  <p>お問い合わせありがとうございます。</p>
<?php }else{//送信失敗 ?>
  <p>大変申し訳ございません。お問い合わせの送信に失敗しました。</p>
<? } ?>

<?php
/*----- 入力フォーム -----*/
// セッション開始
  session_start();
 
// タイムスタンプと推測できない文字列にてキーを発行
  $key = md5(time()."任意の文字");
 
// 発行したキーをセッションに保存
  $_SESSION['key'] = $key;
?>

<?php
/*----- 完了画面 -----*/
// セッション開始
  session_start();
  
// 変数宣言
  $msg = "";
 
// セッションに保持されているキーと、POSTで飛んできたキーが同じかどうか判別
      if (  isset($_SESSION['key']) &&
      isset($_POST['key']) &&
      $_SESSION['key'] == $_POST['key']) {
          //メールを送信する処理
          //ここで$_POSTからの値を受け取りmb_send_mail関数を実行
      }
// セッションに保持されているキーを破棄する ※重要※
unset($_SESSION['key']);
?>

<?php
// セッションに保持されているキーを破棄する ※重要※
unset($_SESSION['key']);
?>