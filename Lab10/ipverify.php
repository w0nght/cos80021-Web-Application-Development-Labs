<!-- lab 10 task a ip verify -->
<html>
<title>Ip Verifier</title>
<body>
<H3>Lab 10 task a</H3>
<H3>Please input an IPv4 address in below text box and click the button</H3>
<form action="" method="get">
  <input type='text' name='ipaddress'/>
  <input type='submit' value='Submit'/>
</form>
<?php 
  echo "";
  if (isset($_GET['ipaddress'])) {
    $ipaddress = $_GET['ipaddress'];
    if (empty($ipaddress)) {
      echo "Please enter an ip address";
    } elseif (!preg_match("/^((([01]?[0-9][0-9]?)|([2][0-4][0.9])|(25[0-5]))\.){3}(([01]?[0-9][0-9]?)|([2][0-4][0.9])|(25[0-5]))$/", $ipaddress)) {
      echo "The input value $ipaddress is not a valid IPv4 address.";
    } else {
      echo "The input value $ipaddress is a valid IPv4 address.";
    }
  }
?>
</body>
</html>