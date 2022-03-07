<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>Images lol</title>
  <style>
    * { margin: 0; padding: 0; }
    img { max-width: 90vw; min-width: 300px; }
    video { max-width: 800px; min-width: 300px; }
    html, body { width: 100%; height: 100%; font-family: Arial; font-size: 40px; }
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
        "<br><br><br>\n  " . '<video width=700 src="' . $currentyear . '/' . $image . '" controls></video>';
         
				if(strpos($image, " ")){
          echo "\n  <br>\n  <h3>" . substr($image, 0, -4) . "</h3>";
        }
        echo "<br><a href=\"$currentyear/" . $image ."\">télécharger la vidéo </a><br><br><br><br><br>\n";
      }
      
      else{
        echo "  <br><br><br><br><br><br><br>\n  <img src=\"$currentyear/" . $image ."\">";
        if(strpos($image, " ") && !strpos($image, " large") && !strpos($image, "(1)")){
          echo "\n  <br>\n  <h3>" . substr($image, 0, -4) . "</h3>";
        }
        echo "\n  <br><br><br>\n";
      }
    }
  }
?>
</div>
</body>
</html>