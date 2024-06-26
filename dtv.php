
<html>
<head>
<meta name="robots" content="noindex">
<meta charset="UTF-8">
<title>Player</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src='https://content.jwplatform.com/libraries/KB5zFt7A.js'></script>
<script> jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo'; </script>
<script src="https://apurofutbol.net/ads.js"></script>  <script type="text/javascript">eval(scriptCode);</script></head>
<body style="padding: 0px; margin:0px;">
<div id="player"></div>
<script type="text/javascript">
$(document).ready(function() {
  const urlParams = new URLSearchParams(window.location.search);
  const eventId = urlParams.get('id');
  const eventImg = urlParams.get('img');

  function setupPlayer() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://corsproxy.io/?url=https://dumper-true.com/rep/2h.json');
    xhr.onload = function() {
      if (xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        var playerInstance = jwplayer("player");

        playerInstance.setup({
          playlist : [{
            title : "",
            description : "",
            image : eventImg, 
            sources : [{
              default : false,
              file : atob(data.hls), 
              label : "0",
              type : "hls"
            }],
          }],
          width : "100%",
          height : "100%",
          aspectratio : "16:9",
          autostart : true,
       sharing : {}
        });
        
        playerInstance.on('error', function(event) {
          if (event.code === 232403) {
            location.reload();
          }
        });
      }
    };
    xhr.send();
  }

  setupPlayer(); 

});
</script>
</body>
</html>
