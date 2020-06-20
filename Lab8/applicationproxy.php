<?php
header('Content-Type: text/xml');
?>
<?php
  $url = 'http://www.webservicex.net/stockquote.asmx/GetQuote?symbol=';
  $qs = $_GET["symbol"];
  $url = $url.$qs;
  $url = DOMDocument::load($url);
  echo $url->saveXML();
?>