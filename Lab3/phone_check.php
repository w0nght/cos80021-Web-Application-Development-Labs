<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>Perfect Palindrome</title> 
  </head> 
  <body>
    <H1>Check for phone number from bowling list</H1>

    <form>
      <p>Input a name in below text box and click 'search' button to see the phone number</p>
      <label for="">Name: <input type="text" name="namefield"></label><br />
      <input type="submit" value="Search" />
    </form>
    <!-- <p>Result is shown as below.</p>  -->
  </body> 

  <?php
      $fruit = array ("one"=>"grapes", "two"=>"banana",  "three"=>"cherry", "four"=>"apple");
      function using_asort($fruit) {
        asort ($fruit);
        foreach($fruit as $key => $val) {
          echo "Key=" .$key. " Value=" .$val. "\n";

          if ($key == "four") {
            echo "a) forth element value in fruit asort array is $val\n";
            echo "\n";
          }
        }  
      }
      function using_ksort($fruit) {
        ksort ($fruit);
        foreach($fruit as $key => $val) {
            echo "Key=" .$key. " Value=" .$val. "\n";
        }  
      }
		if(isset($_GET['namefield'])) {
			$name = $_GET['namefield'];
			if($name == null) {
        echo "Please enter a name";
			} else {
        phoneNumCheck($name);
        // using_asort($fruit);
        // using_ksort($fruit);
      }
    }


		function phoneNumCheck($name) {
      $file = "../../data/bowlers.txt";
      if(!file_exists($file)) 
        echo "No registered member found!";
      else {
        $bowlers=file($file);
        for($i=0;$i<count($bowlers);$i++) {
          $curBowler = explode(",",$bowlers[$i]);
          // echo "$curBowler[0] <br />"; //DEBUG: print all
            if (strcmp($curBowler[0],$name) == 0) {
              // echo "If this function returns 0, the two strings are equal";
              echo "<p>The phone number of $curBowler[0] : $curBowler[1]</p>";
              echo "<p>a)apple</p>";
              echo "<p>b)banana</p>";
            } else {
              // echo "no such member";
            }
          // }
        }
      }
    }
	?>
</HTML>