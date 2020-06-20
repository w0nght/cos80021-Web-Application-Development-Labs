<?php
 $xmlFile = "temperature.xml";
 $HTML = "";
 $count = 0;
 //$dt = simplexml_load_file($xmlFile);
 $dom = DOMDocument::load($xmlFile);
 $temp = $dom->getElementsByTagName("temp"); 
 $tempList = array();

foreach($temp as $node) {	// extract propetrties of the temp 
	$max = $node->getElementsByTagName("Max");
	$max = $max->item(0)->nodeValue;

	$day = $node->getElementsByTagName("Day");
	$day = $day->item(0)->nodeValue;
	
	$month = $node->getElementsByTagName("Month");
	$month = $month->item(0)->nodeValue;

	$year = $node->getElementsByTagName("Year");
	$year = $year->item(0)->nodeValue;
	
	$HTML = $HTML."<br><span>".$day."/".$month."/".$year." : ".$max."</span><br>";
	$tempList[$day] = $max;


	// if hotel typs & city match user choice
	// add to the data to be sent back to the client
	// if (($type == $_GET["type"]) && ($city == $_GET["city"]) ) {
	// 	// $HTML = $HTML."<br><span>Hotel: ".$name."</span><br><span>Price: ".$price."</span><br>";
	// 	$tempList[$day] = $max;
	// 	$count++;	
	// }
} 
// asort($hotelList);
// foreach($hotelList as $name => $price) {
// 	echo "Hotel: " . $name . "<br>Price: " .$price."<br>";
// 	echo "<br>";
// }

echo $HTML;
$avg = array_sum($tempList) / count($tempList);
// echo $avg;
$avgOut = "<br><span>Average temperture: " .$avg."</span>";
echo $avgOut;
// 	// if no hotels have been found, set the return msg to a string which indicate this
//  if ($count ==0)
//  {
//    $HTML ="<br><span>No hotels available</span>";
//  }
           
//   echo $HTML;   
?>

