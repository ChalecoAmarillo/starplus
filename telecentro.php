<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor de Video</title>
<script src="https://apurofutbol.net/ads.js"></script>  <script type="text/javascript">eval(scriptCode);</script>    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<div id="player"></div>

<script src="//ssl.p.jwpcdn.com/player/v/8.26.0/jwplayer.js"></script>
<script>
    jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';
</script>

<script type="text/javascript">
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var getURL = getParameterByName('get');
    var getIMG = getParameterByName('img');
    var getKEY = getParameterByName('key');
    var getKEY2 = getParameterByName('key2');

    var mpd;


    var randomValue = Math.random().toString(36).substring(7);

				
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'telecentro.json?' + randomValue, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var telecentroJSON = JSON.parse(xhr.responseText);

            if (getURL && telecentroJSON[getURL]) {
                mpd = telecentroJSON[getURL];
                initializePlayer(mpd);
            } else {
                console.error("No se encontró un enlace MPD para el parámetro 'get' proporcionado.");
            }
        }
    };
    xhr.send();

    function initializePlayer(mpd) {
        var playerInstance = jwplayer("player");

        // Definir las claves DRM correspondientes según la URL
        var keyId, key;

        if (getURL == "espnpremium") {
            keyId = "86e27005c58957c2ea99c4d1bafa4600";
            key = "e8da81fd3bb6a2ec4ccc9d60d2981bf2";
        } else if (getURL == "tntsports") {
            keyId = "cd1b81ef1e7613dc5335261146720d9f";
            key = "e785441a75141e8abb86f2fd24b101d2";
        } else if (getURL == "espn") {
            keyId = "6b6f14e3e4f8b3f43262225b97fb3547";
            key = "df84071b252df7489f437e8d31d8ee81";
        } else if (getURL == "fox") {
            keyId = "52e1096faaf5cf92389cc454ea7dab9d";
            key = "23d9aa694d80815a7bc882b891bea531";
        }

var start = getParameterByName('start');
var autostart = start !== undefined && start === "true";

        playerInstance.setup({
            playlist: [{
                "title": "A Puro Futbol",
                "description": "apurofutbol.net",
                "image": getIMG,
                "sources": [
                    {
                        "default": false,
                        "type": "dash",
                        "file": mpd,
                        "drm": {
                            "clearkey": {
                                "keyId": keyId,
                                "key": key
                            }
                        },
                        "label": "0"
                    }
                ]
            }],
   width: "100%",
    height: "100%",
    aspectratio: "16:9",
    autostart: autostart,
    cast: {},
    sharing: {}
});
	
if (getURL !== undefined && getURL !== null) {
    playerInstance.on("error", function() {
        var redirectUrl = '/embed/telecentro.php?get=' + getURL;

        if (getLang) {
            redirectUrl += '&lang=' + getLang;
        }

        redirectUrl += '&start=true';

        window.location = redirectUrl;
    });
}

	
}

	
var getLang = getParameterByName('lang');
var selectedLanguage = getLang;
var selectedLanguage2 = 1;  
var languageChangedDuringPlay = false;

jwplayer().on('play', function(e) {
  if (!languageChangedDuringPlay) {
    var currentLanguage = jwplayer().getCurrentAudioTrack();

    if (currentLanguage !== selectedLanguage && currentLanguage !== selectedLanguage2) {
      jwplayer().setCurrentAudioTrack(selectedLanguage);
      languageChangedDuringPlay = true;
    }
  }
});

jwplayer().on('complete', function(e) {
  languageChangedDuringPlay = false;
});

	



	


</script>
</body>
</html>
