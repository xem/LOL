<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>Images lol</title>
  <style>
    * { margin: 0; padding: 0; }
    img { max-width: 70vw; min-width: 40vw; }
    html, body { width: 100%; height: 100%; font-family: Arial; }
    div.menu { -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; overflow: auto; float: left; position: fixed; top: 0; left: 0; width: 160px; height: 100%; background: #eee; padding: 20px; text-align: center; }
    div.menu a { text-decoration: none; }
    div.content { text-align: center; }
    div.content img { border: 2px solid #ccc; }
  </style>
</head>
<body>
<div class=content>
<?php
  if(isset($_GET["year"])){
    $currentyear = $_GET["year"];
  }
  echo "  <br><br><br>\n  <h1>$currentyear</h1>\n";
  $images = opendir("$currentyear");
  
  $videos = 0;
  while($image = readdir($images)){
    if($image != "." && $image != ".."){
    
      $ext = strtolower(substr($image, strlen($image)-4, strlen($image)));
      if($ext == ".flv" || $ext == ".mp4" || $ext == ".3gp"){
        $videos++;
        
        echo 
        "<br><br><br><br><br>\n  "
        .
        '<div style="display:inline-block; border: 2px solid #aaa">
          <script type="text/javascript" src="http://www.supportduweb.com/page/js/flashobject.js"></script>
            <div id="lecteur_' . $videos . '" style="display:inline-block;">
            </div>
            <script type="text/javascript">
            //<!--
            var flashvars_' . $videos . ' = {};
            var params_' . $videos . ' = {
              quality: "high",
              bgcolor: "#000000",
              allowScriptAccess: "always",
              allowFullScreen: "true",
              wmode: "transparent",
              flashvars: "fichier=https%3A//xem.github.io/LOL/' . $currentyear . "/" . $image . '"
            };
            var attributes_' . $videos . ' = {};
            flashObject("http://flash.supportduweb.com/lecteur_flv/v1_27.swf", "lecteur_' . $videos . '", "576", "324", "8", false, flashvars_' . $videos . ', params_' . $videos . ', attributes_' . $videos . ');
            //-->
          </script>
        </div>';
				if(strpos($image, " ")){
          echo "\n  <br>\n  <h3>" . substr($image, 0, -4) . "</h3>";
        }
        echo "<br><a href=\"$currentyear/" . $image ."\">télécharger la vidéo </a><br><br><br><br><br>\n";
      }
      
      else{
        echo "  <br><br><br><br><br>\n  <img src=\"$currentyear/" . $image ."\">";
        if(strpos($image, " ") && !strpos($image, " large") && !strpos($image, "(1)")){
          echo "\n  <br>\n  <h3>" . substr($image, 0, -4) . "</h3>";
        }
        echo "\n  <br><br><br><br><br>\n";
      }
    }
  }
?>
</div>
</body>
</html>