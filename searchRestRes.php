<?php
  /************************
  ファイル名：searchRestRes.php
  検索結果を一覧形式で表示
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
    <form action = searchRestRes.php method= get>
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


    <?php
      define('max' , '10');

      //半径の取得
      $radius = $_GET['radius'];
      //フリーワード取得
      $freeword = $_GET['freeword'];

      //Cookieでjs->phpへ緯度経度渡し
      $latData = htmlspecialchars($_COOKIE["lat"]);
      $lonData = htmlspecialchars($_COOKIE["lon"]);

      //ページング用
      if(!isset($_GET['page'])) {
        $now = 1;
      } else {
        $now = $_GET['page'];
      }

      echo "<br>";

      //Cookieが削除されたか(緯度,経度が確認できない場合)の確認
      if($latData == "" || $lonData == "") {
        echo "位置情報の取得が許可されていません<br>";
        echo "位置情報の取得を許可し、ページの再読み込みをしてください<br><br>";
      } else {
        if($radius == 0) {
          echo "半径を選択してください<br><br>";
        } else {
          switch ($radius) {
            case '1':
                if($freeword == "") {
                  echo "半径300m内の飲食店を検索しています<br>";
                  echo "フリーワード：指定なし<br>";
                } else {
                  echo "半径300m内の飲食店を検索しています<br>";
                  echo "フリーワード：".$freeword."<br>";
                }
                break;

            case '2':
              if($freeword == "") {
                echo "半径500m内の飲食店を検索しています<br>";
                echo "フリーワード：指定なし<br>";
              } else {
                echo "半径500m内の飲食店を検索しています<br>";
                echo "フリーワード：".$freeword."<br>";
              }
              break;

            case '3':
              if($freeword == "") {
                echo "半径1km内の飲食店を検索しています<br>";
                echo "フリーワード：指定なし<br>";
              } else {
                echo "半径1km内の飲食店を検索しています<br>";
                echo "フリーワード：".$freeword."<br>";
              }
              break;

            case '4':
              if($freeword == "") {
                echo "半径2km内の飲食店を検索しています<br>";
                echo "フリーワード：指定なし<br>";
              } else {
                echo "半径2km内の飲食店を検索しています<br>";
                echo "フリーワード：".$freeword."<br>";
              }
            break;

            case '5':
              if($freeword == "") {
                echo "半径3km内の飲食店を検索しています<br>";
                echo "フリーワード：指定なし<br>";
              } else {
                echo "半径3km内の飲食店を検索しています<br>";
                echo "フリーワード：".$freeword."<br>";
              }
            break;
          }
          getRestData($radius , $freeword , $latData , $lonData , $now);
        }
      }


      function getRestData($radius , $freeword , $latData , $lonData , $now) {
        $url = 'https://api.gnavi.co.jp/RestSearchAPI/v3/';
        $curl = curl_init();

        //取得パラメータ設定
        $params = [
          'keyid' => 'keyID' ,
          'latitude' => $latData ,
          'longitude' => $lonData ,
          'range' => $radius ,
          'freeword' => $freeword ,
          'hit_per_page' => '100',
        ];

        //cURLOption設定
        $options = [
          CURLOPT_URL => $url . '?' . http_build_query($params, '', '&') ,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_RETURNTRANSFER => true ,
          CURLOPT_SSL_VERIFYPEER => false
        ];

        //cURLセッション
        curl_setopt_array($curl , $options);
        //受け取りデータ
        $response = curl_exec($curl);
        //データの連想配列化
        $resDecode = json_decode($response , true);

        if($resDecode[total_hit_count] == 0) {
          echo "店舗が見つかりませんでした";
        } else if($resDecode[total_hit_count] >= 1) {
          $hitCount = $resDecode[total_hit_count];

          //100件以上取得したら上限を100とする
          if($hitCount >= 100)
            $hitCount = 100;

          //ページング用
          $totalPage = ceil($hitCount / max);
          $startData = ($now - 1) * max;

          echo $hitCount."店舗見つかりました<br>";
          echo "<br>";

          for($i = $startData ; $i <= $hitCount - 1 ; $i++) {
            if($i > (max * $now - 1))
              break;
            //店舗データ
            $name = $resDecode[rest][$i][name];
            $address = $resDecode[rest][$i][address];
            $tel = $resDecode[rest][$i][tel];
            $opentime = $resDecode[rest][$i][opentime];
            $station = $resDecode[rest][$i][access][station];
            $walk = $resDecode[rest][$i][access][walk];
            $imgUrl1 = $resDecode[rest][$i][image_url][shop_image1];
            $imgUrl2 = $resDecode[rest][$i][image_url][shop_image2];
            $siteUrl = $resDecode[rest][$i][url];

            /*---------店舗詳細用--------*/
            $collectData = $name."&address=".$address."&tel=".$tel."&opentime="
            .$opentime."&station=".$station."&walk=".$walk."&imgUrl1="
            .$imgUrl1."&imgUrl2=".$imgUrl2."&radius=".$radius."&freeword="
            .$freeword."&siteUrl=".$siteUrl."&page=".$now;

            $encodeData = urlencode($collectData);
            /*---------店舗詳細用ここまで！--------*/

            echo "<div id=\"img\">";
            if($imgUrl1 == "" && $imgUrl2 == "") {
              echo "No Image<br>";
            } else {
              echo "<img src =".$imgUrl1."><br>";
            }
            echo "</div>";

            echo "店舗名："."<a href=searchRestDet.php?name=".$encodeData.">".$name."</a>"."<br>";
            if($station == "") {
              echo "アクセス：登録されていません。<br>";
            } else {
              echo "アクセス：".$station."より".$walk."分<br>";
            }

            echo "<br>";
          }
        }
        for($j = 1 ; $j <= $totalPage ; $j++) {

          if($j == $now)
            echo $now.' ';
          else
            echo "<a href=searchRestRes.php?radius=".$radius."&freeword=".$freeword."&page=".$j."&send=検索> $j </a>";

        }
        curl_close($curl);
      }
    ?>
    <br><br>
    <a href="searchRest.php">トップページ</a>
    <br><br>

    <!--ぐるなびAPIのURL-->
    <footer>
      <a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
        <img src="https://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
      </a>
    </footer>
    <!--ぐるなびAPIのURLここまで！-->
  </body>
</html>
