<?php
header('Content-Type: text/xml');

if(isset($_GET["name"]) && isset($_GET["email"]) && isset($_GET["password"]) && isset($_GET['phone']) ) {

	$name = $_GET["name"];
	$email = $_GET["email"];
	$password = $_GET["password"];
	$phone = $_GET["phone"];
	
	$errMsg = "";
	if (empty($name)) {
		$errMsg .= "You must enter a name. <br />";
	}
	
	if (empty($email)) {
		$errMsg .= "You must enter an email id. <br />";
	}

	if (empty($password)) {
		$errMsg .= "You must enter a password. <br />";
	}

	if (empty($phone)) {
		$errMsg .= "You must enter a phone number. <br />";
	}
	
	if ($errMsg != "") {
		echo $errMsg;
	}
	else {
	
		$xmlfile = '../../data/testData.xml';
		
		$doc = new DomDocument();
		
		if (!file_exists($xmlfile)){ // if the xml file does not exist, create a root node $customers
			$customers = $doc->createElement('customers');
			$doc->appendChild($customers);
		}
		else { // load the xml file
			$doc->preserveWhiteSpace = FALSE; 
			$doc->load($xmlfile);  
		}
		
		//create a customer node under customers node
		$customers = $doc->getElementsByTagName('customers')->item(0);
		$customer = $doc->createElement('customer');
		$customers->appendChild($customer);
		
		// create a Name node ....
		$Name = $doc->createElement('name');
		$customer->appendChild($Name);
		$nameValue = $doc->createTextNode($name);
		$Name->appendChild($nameValue);
		
		//create a Email node ....
		$Email = $doc->createElement('email');
		$customer->appendChild($Email);
		$emailValue = $doc->createTextNode($email);
		$Email->appendChild($emailValue);
		
		//create a pwd node ....
		$pwd = $doc->createElement('password');
		$customer->appendChild($pwd);
		$pwdValue = $doc->createTextNode($password);
		$pwd->appendChild($pwdValue);

		//create a pwd node ....
		$Phone = $doc->createElement('phone');
		$customer->appendChild($Phone);
		$phoneValue = $doc->createTextNode($phone);
		$Phone->appendChild($phoneValue);
		
		//save the xml file
		$doc->formatOutput = true;
		$doc->save($xmlfile);  
		echo "Dear $name, you have Successfully registerd! A confirm email sent to $email<br />";
		echo "2a. <br />(i)http://mercury.swin.edu.au/WAD/webserv/content.html<br />";
	} 
}
?>