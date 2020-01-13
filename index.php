<?php
/*
 * ----------------------------------------------------------------------------
 * « LICENCE BEERWARE » (Révision 42):
 * <romain@albirew.fr> a créé ce fichier. Tant que vous conservez cet avertissement,
 * vous pouvez faire ce que vous voulez de ce truc. Si on se rencontre un jour et
 * que vous pensez que ce truc vaut le coup, vous pouvez me payer une bière en
 * retour.
 * ----------------------------------------------------------------------------
 */
function better_file_get_content($url)
{
  $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
  $options = array(
    CURLOPT_CUSTOMREQUEST =>"GET",
    CURLOPT_POST =>false,
    CURLOPT_USERAGENT => $user_agent,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_AUTOREFERER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CONNECTTIMEOUT => 120,
    CURLOPT_TIMEOUT => 120,
    CURLOPT_MAXREDIRS => 10,
  );
  $ch = curl_init( $url );
  curl_setopt_array( $ch, $options );
  $content = curl_exec( $ch );
  $err = curl_errno( $ch );
  $errmsg = curl_error( $ch );
  $header = curl_getinfo( $ch );
  curl_close( $ch );
  $header['errno'] = $err;
  $header['errmsg'] = $errmsg;
  $header['content'] = $content;
  return $header;
}

function clean_rss($url)
{
  $source = better_file_get_content($url)[content];
  $corrige = stristr($source, '<?xml');
  $corrige = str_replace("" , "", $corrige);
  $corrige = str_replace("" , "", $corrige);
  $corrige = str_replace("" , "", $corrige);
  $corrige = str_replace("" , "", $corrige);
  ini_set('mbstring.substitute_character', "none");
  $corrige = mb_convert_encoding($corrige, 'UTF-8', 'UTF-8'); 
  return $corrige;
}

if(isset($_GET['rss']))
{
  $rss = $_GET['rss'];
  if(!preg_match('/http[s]?:\/\//', $rss, $matches)) $rss = 'http://'.$rss;
  header("Pragma: no-cache");
  echo clean_rss($rss);
} 
else 
{
  echo '<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>RSS Corrector</title>
	<link rel="stylesheet" href="normalize.css">
    <style type="text/css">
		body, html {
			font-family: "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
			background: #15161C;
			height: 100%;
			display: grid;
		}
		
		#form {
			width: 100%;
			margin: auto;
			text-align: center;
		}
		
		#form h1 {
			font: Bold 50px Consolas;
			margin: 0;
			padding: 35px 0;
			background: #0A59F8;
			color: #fff;
			letter-spacing: 7px;
		}
		
		#form input {
			width: 99.9%;
			border: 0;
			text-align: center;
			font-weight: lighter;
			font-size: 50px;
			padding: 40px 0 45px;
		}
		
		#form button {
			width: 99.9%;
			border: 0;
			background: #66BB6A;
			padding: 40px 0 45px;
			font-size: 40px;
		}
		
		#form button:hover {
			background: #8dbc66;
			cursor: pointer;
			font-style: italic;
		}
		
		#git {
			color: #fff;
			position: absolute;
			bottom: 5px;
			left: 5px;
			font: 16px Consolas;
		}
	</style>
  </head>
  <body>
    <div id="form">
      <h1>RSS Corrector</h1>
		<form method="get" action="index.php">
		  <input type="text" placeholder="website.com/rss.php?id=news" size="50" name="rss"/>
		  <button type="submit" value="1">Actualize!</button>
		</form>
    </div>
    <a id="git" href="https://github.com/Albirew/coto_rss">Git</a>
  </body>
</html>';
}
?>