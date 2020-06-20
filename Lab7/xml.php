<?php
$doc = new DOMDocument('1.0');
$root = $doc->createElement('ajax');

// creates a new DOM doc & assigns it to variable $doc
$doc->appendChild($root); 
$child = $doc->createElement('js');

// creats a new element & assignes it to the variable $root
$root->appendChild($child);
$value = $doc->createTextNode("coordination");

// appends $root as a child of the $doc element
$child->appendChild($value );
$strXml = $doc->saveXML();  // saveXML method returns the string representation of that object 
echo $strXml; // echo expects a string as its argument
// <!-- it created an xml file -->
// <!-- 
// //<ajax>
//  <js>coordination</js>
// </ajax> 
?>