<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>Perfect Palindrome</title> 
  </head> 
  <body>
    <H1>Check for perfect palindrome</H1>

    <form>
      <label>String:  <input type="text" name="stringfield"> </label><br />
      <input type="submit" value="Check for perfect palindrome" />
    </form>
    <!-- <p>Result is shown as below.</p>  -->
  </body> 

  <?php
		if(isset($_GET['stringfield'])) {
			$string = $_GET['stringfield'];
			if($string != null) {
				palindromeCheck($string);
			}
		}

		function palindromeCheck($string) {
      if (strrev($string) == $string) {
        echo "The text you entered: '$string' is a perfect palindrome!";
      } else {
        echo "Try something else other than '$string'!";
      }
		}
	?>
</HTML>