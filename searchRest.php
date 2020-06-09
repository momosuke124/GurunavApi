<?php
  /************************
  ファイル名：searchRest.php
  トップページ
  **************************/
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>飲食店検索</title>
    <script type="text/javascript" src="location.js"></script>
    <link rel="stylesheet" type="text/css" href="searchRest.css">
  </head>

  <body>
    <h1>周辺の飲食店検索</h1>
    <!--getで送信-->
    <form action = searchRestRes.php method = get>
      <h4>半径を指定　：</h4>
      <select class="selectBox" name="radius">
        <option value="0">半径</option>
        <option value="1">300m</option>
        <option value="2">500m</option>
        <option value="3">1km</option>
        <option value="4">2km</option>
        <option value="5">3km</option>
      </select>
      <br>
      <h4>フリーワード：</h4>
      <input class="textBox" type="text" name="freeword">
      <input type="submit" name="send" value="検索">
    </form>

    <br><br><br>

    <!--ぐるなびAPIのURL-->
    <footer>
      <a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
        <img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
      </a>
    </footer>
  <!--ぐるなびAPIのURLここまで！-->
  </body>
</html>
