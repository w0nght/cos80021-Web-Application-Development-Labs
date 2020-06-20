<?php
	// Processing data on server side

	// collect data send as XML
 $xmlFile = "hotel.xml";
 $HTML = "";
 $count = 0;
 //$dt = simplexml_load_file($xmlFile);
 $dom = DOMDocument::load($xmlFile);
 $hotel = $dom->getElementsByTagName("hotel"); 
 $hotelList = array();

foreach($hotel as $node) {	// extract propetrties of the hotel 
	$city = $node->getElementsByTagName("City");
	$city = $city->item(0)->nodeValue;
  
	$type = $node->getElementsByTagName("Type");
	$type = $type->item(0)->nodeValue;
	
	$name = $node->getElementsByTagName("Name");
	$name = $name->item(0)->nodeValue;
	
	$price = $node->getElementsByTagName("Price");
	$price = $price->item(0)->nodeValue;

	// if hotel typs & city match user choice
	// add to the data to be sent back to the client
	if (($type == $_GET["type"]) && ($city == $_GET["city"]) ) {
		// $HTML = $HTML."<br><span>Hotel: ".$name."</span><br><span>Price: ".$price."</span><br>";
		$hotelList[$name] = $price;
		$count++;	
	}
} 
asort($hotelList);
foreach($hotelList as $name => $price) {
	echo "Hotel: " . $name . "<br>Price: " .$price."<br>";
	echo "<br>";
}

	// if no hotels have been found, set the return msg to a string which indicate this
 if ($count ==0)
 {
   $HTML ="<br><span>No hotels available</span>";
 }
           
  echo $HTML;   
?>

