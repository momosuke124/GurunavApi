// Geolocation APIに対応している
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(
    // 取得成功した場合
    function(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        document.cookie = "lat="+lat;
        document.cookie = "lon="+lon;
    },
    // 取得失敗した場合
    function(error) {
      switch(error.code) {
        case 1: //PERMISSION_DENIED
          alert("位置情報の利用が許可されていません");
          break;
        case 2: //POSITION_UNAVAILABLE
          alert("現在位置が取得できませんでした");
          break;
        case 3: //TIMEOUT
          alert("タイムアウトになりました");
          break;
        default:
          alert("その他のエラー(エラーコード:"+error.code+")");
          break;
      }
    }
  );
// Geolocation APIに対応していない
} else {
  alert("この端末では位置情報が取得できません");
}
