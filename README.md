# 周辺の飲食店検索アプリ

## 説明
ぐるなびAPIとGeolocation APIを用いて、現在地周辺の飲食店を検索し表示する。

## コード順序
searchRest.php(トップ) -> searchRestRes.php（一覧） -> searchRestDet.php（詳細）

＊各ファイルは同ディレクトリ内に配置してください。

## 動作概要
1. searchRest.phpで半径とフリーワードを指定する。フリーワードは未入力でも可。
2. searchRestRes.phpに遷移し、検索結果を一覧形式で表示する。
3. 店舗名を選択すると、searchRestDet.phpに遷移し、より詳しい情報を表示する。

## 動作画面
トップページ（searchRest.php）

<img src="https://github.com/momosuke124/image/blob/master/searchRest.png" width="320px">

一覧表示（searchRestRes.php）

<img src="https://github.com/momosuke124/image/blob/master/searchRestRes.png" width="320px">

詳細画面（searchRestDet.php）

<img src="https://github.com/momosuke124/image/blob/master/searchRestDet.png" width="320px">

位置情報取得できない場合

<img src="https://github.com/momosuke124/image/blob/master/Dontlocation.png" width="320px">

## 動作確認（5/14追記）
Google Chrome - ver 81.0.4044.129  
Opera - ver 68.0.3618.91  
- SSL通信で動作可能  
Safari - ver 13.1  
Fire Fox - 76.0.1  
