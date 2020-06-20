<?php 
  $i = 10; 
  while ($i>0) {     
		if ($i == 8) {
			$i--;
			continue;
		}
		if ($i == 5) {
			break;
		}
		echo --$i;
  // $i-- output is 10976
  // --$i output is 9865
  //then change this line to ‘echo --$i;’ 
  }
?>  


<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>task 2d</title> 
  </head> 
  <body>
  <H1>Task 2d</H1>

  <form>
	    <label>Please input a number:	<input type="text" name="numberfield"> </label> 
		<input type="submit" value="Submit" />
  </form>
  <p>Result is shown as below.</p> 
  </body> 

  <?php
		if(isset($_GET['numberfield'])) {
			$number = $_GET['numberfield'];
			if($number > 0) {
				divideEvenly($number);
			}
		}

		function divideEvenly($number) {
			$i = $number;
			// $result = 0;
			if($number > 170) { return 0; }
			echo "$number <br/>";
			
			while ($i > 0) {
				// echo "from $i <br/>";
				if ((is_float($number/$i)) && ($number/$i!=1)) {
					echo "$i <br/>";
				} elseif ($i == 1) {
					echo "$i <br/>";
				}
				$i--;
			}
		}
	?>
</HTML>