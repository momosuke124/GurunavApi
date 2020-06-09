<?php
  /************************
  ファイル名：searchRestDet.php
  searchRestRes.phpで選択された
  店舗の詳細データを表示
  **************************/
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>飲食店検索</title>
    <link rel="stylesheet" type="text/css" href="searchRest.css">
  </head>
  <body>
    <h1>周辺の飲食店検索</h1>

    <?php

      //現在のurl取得
      $nowUrl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      //urlデコード
      $decodeUrl = urldecode($nowUrl);
      //$decodeUrlを分裂→配列化
      $arrayUrl = parse_url($decodeUrl);
      parse_str($arrayUrl['query'] , $arrayQuery);

      echo "<br>";

      //送られてきたデータを変数に格納
      $name = $arrayQuery[name];
      $address = $arrayQuery[address];
      $tel = $arrayQuery[tel];
      $opentime = $arrayQuery[opentime];
      $station = $arrayQuery[station];
      $walk = $arrayQuery[walk];
      $imgUrl1 = $arrayQuery[imgUrl1];
      $imgUrl2 = $arrayQuery[imgUrl2];
      $radius = $arrayQuery[radius];
      $freeword = $arrayQuery[freeword];
      $siteUrl = $arrayQuery[siteUrl];
      $now = $arrayQuery[page];

      $non = "登録されていません";

      if($imgUrl1 == "" && $imgUrl2 == "") {
        echo "No Image<br>";
      } else {
        echo "<img src =".$imgUrl1.">";
        echo "<img src =".$imgUrl2."><br>";
      }

      //店舗名及びぐるなびAPIの詳細ページ
      echo "店舗名：".$name."<a href=".$siteUrl." target=\"_blank\">(詳細はこちら)<br></a>";

      if($address == "") {
        echo "住所：".$non."<br>";
      } else {
        echo "住所：".$address."<br>";
      }

      if($tel == "") {
        echo "電話番号：".$non."<br>";
      } else {
      echo "電話番号：<a href=\"tel:.$tel.\">".$tel."</a><br>";
      }

      if($opentime == "") {
        echo "営業時間：".$non."<br>";
      } else {
        echo "営業時間：".$opentime."<br>";
      }

      if($station == "") {
        echo "アクセス：".$non."<br>";
      } else {
        echo "アクセス：".$station."より".$walk."分<br>";
      }

      echo "<br>";

      echo "<a href=searchRestRes.php?radius=".$radius."&freeword=".$freeword."&page=".$now."&send=検索>一覧へ戻る</a>";
    ?>
    <br><br><br>

    <!--ぐるなびAPIのURL-->
    <footer>
    <a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
      <img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
    </a>
    </footer>
    <!--ぐるなびAPIのURLここまで！-->

  </div>
  </body>
</html>
