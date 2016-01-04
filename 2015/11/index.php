<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>Images lol</title>
  <style>
    * { margin: 0; padding: 0; }
    html, body { width: 100%; height: 100%; font-family: Arial; }
    div.menu { -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; overflow: auto; float: left; position: fixed; top: 0; left: 0; width: 160px; height: 100%; background: #eee; padding: 20px; text-align: center; }
    div.menu a { text-decoration: none; }
    div.content { padding-left: 200px; text-align: center; }
    div.content img { border: 2px solid #ccc; }
  </style>
</head>
<body>
<div class=menu>
  <h1>My LOL'z</h1>
  <hr>
<?php
  $years = opendir(".");
  $currentyear = '';
  $currentweek = '';
  while($year = readdir($years)){
    if(is_dir($year) && $year != "." && $year != ".."){
      echo "  <br>\n  <h2>$year</h2>\n";
      $weeks = opendir($year);
      $weeklist = array();
      while($week = readdir($weeks)){
        if(is_dir("$year/$week") && $week != "." && $week != ".."){
          $weeklist[] = $week;
        }
      }
      arsort($weeklist);
      foreach($weeklist as $week){
        if((empty($_GET["year"]) && empty($currentyear)) or (empty($_GET["year"]) && empty($currentweek)) or (!empty($_GET["year"]) && $year == $_GET["year"] && !empty($_GET["week"]) && $week == $_GET["week"])){
          echo "  &bull; $week\n  <br>\n";
        }
        else{
          echo "  &bull; <a href='index.php?year=$year&week=$week'>$week</a>\n  <br>\n";
        }
        if(empty($currentyear)) $currentyear = $year;
        if(empty($currentweek)) $currentweek = $week;
      }
    }
  }
?>
</div>
<div class=content>
<?php
  if(isset($_GET["year"])){
    $currentyear = $_GET["year"];
  }
  if(isset($_GET["week"])){
    $currentweek = $_GET["week"];
  }
  echo "  <br><br><br>\n  <h1>$currentyear - $currentweek</h1>\n";
  $images = opendir("$currentyear/$currentweek");
  
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
              flashvars: "fichier=http%3A//meuziere.free.fr/lol/' . $currentyear . "/" . $currentweek . "/" . $image . '"
            };
            var attributes_' . $videos . ' = {};
            flashObject("http://flash.supportduweb.com/lecteur_flv/v1_27.swf", "lecteur_' . $videos . '", "576", "324", "8", false, flashvars_' . $videos . ', params_' . $videos . ', attributes_' . $videos . ');
            //-->
          </script>
        </div>';
				if(strpos($image, " ")){
          echo "\n  <br>\n  <h3>" . substr($image, 0, -4) . "</h3>";
        }
        echo "<a href=\"$currentyear/$currentweek/" . $image ."\">télécharger la vidéo </a><br><br><br><br><br>\n";
      }
      
      else{
        echo "  <br><br><br><br><br>\n  <img src=\"$currentyear/$currentweek/" . $image ."\">";
        if(strpos($image, " ")){
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