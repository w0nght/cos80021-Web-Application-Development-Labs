<?php
	header('Content-Type: text/xml');

	$xmlDoc = new DOMDocument('1.0');	     	
	$xmlDoc->formatOutput = true;	     	
	$xmlDoc->load("bookstore.xml");
	$strXml = $xmlDoc->saveXML();

	echo "$strXml";   	
?>
