<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>task 2e quiz</title> 
  </head> 
	<body>
		<H1>Task 2e quiz</H1>
		<p>Answer all of the questions on the quiz, then select Score button to grade the quiz.</p>
		<form>
			<div>
				<h3>1. What is 1 + 1 in Binary value?</h3>
				<!-- name attribute needs to have the same value -->
				<input type="radio" id="q1Choice1" name="binary" value="11">
				<label for="q1Choice1">11</label><br/>
				<input type="radio" id="q1Choice2" name="binary" value="0">
				<label for="q1Choice2">0</label><br/>
				<input type="radio" id="q1Choice3" name="binary" value="10">
				<label for="q1Choice3">10</label><br/>
				<input type="radio" id="q1Choice4" name="binary" value="2">
				<label for="q1Choice4">2</label><br/>
				<br/> 
			</div>

			<div>
				<h3>2. What is the capital of Australia?</h3>
				<input type="radio" id="q2Choice1" name="capital" value="Sydney">
				<label for="q2Choice1">Sydney</label><br/>
				<input type="radio" id="q2Choice2" name="capital" value="Melbourne">
				<label for="q2Choice2">Melbourne</label><br/>
				<input type="radio" id="q2Choice3" name="capital" value="Perth">
				<label for="q2Choice3">Perth</label><br/>
				<input type="radio" id="q2Choice4" name="capital" value="Canberra">
				<label for="q2Choice4">Canberra</label><br/>
				<br/> 
			</div>

			<div>
				<h3>3. Which one is Eminem's latest album?</h3>
				<input type="radio" id="q3Choice1" name="em" value="Kamikaze">
				<label for="q3Choice1">Kamikaze</label><br/>
				<input type="radio" id="q3Choice2" name="em" value="EmShow">
				<label for="q3Choice2">The Eminem Show</label><br/>
				<input type="radio" id="q3Choice3" name="em" value="MTBMB">
				<label for="q3Choice3">Music To Be Murdered By</label><br/>
				<input type="radio" id="q3Choice4" name="em" value="MMLP2">
				<label for="q3Choice4">The Marchall Mathers LP2</label><br/>
				<br/> 
			</div>

			<div>
				<h3>4. Which song is on Eminem's Kamikaze album?</h3>
				<input type="radio" id="q4Choice1" name="kamikaze" value="The Ringer">
				<label for="q4Choice1">The Ringer</label><br/>
				<input type="radio" id="q4Choice2" name="kamikaze" value="Walk On Water">
				<label for="q4Choice2">Walk On Water</label><br/>
				<input type="radio" id="q4Choice3" name="kamikaze" value="Rap God">
				<label for="q4Choice3">Rap God</label><br/>
				<input type="radio" id="q4Choice4" name="kamikaze" value="The Monster">
				<label for="q4Choice4">The Monster</label><br/>
				<br/> 
			</div>

			<div>
				<h3>5. Which song is on Eminem's Revival album?</h3>
				<input type="radio" id="q5Choice1" name="revival" value="The Ringer">
				<label for="q5Choice1">The Ringer</label><br/>
				<input type="radio" id="q5Choice2" name="revival" value="Walk On Water">
				<label for="q5Choice2">Walk On Water</label><br/>
				<input type="radio" id="q5Choice3" name="revival" value="Rap God">
				<label for="q5Choice3">Rap God</label><br/>
				<input type="radio" id="q5Choice4" name="revival" value="The Monster">
				<label for="q5Choice4">The Monster</label><br/>
				<br/> 
			</div>

			
			<input type="submit" value="Score" />
		</form>
  
  </body> 

  <?php 
		echo "<h2>Quiz Results</h2>";
		if(isset($_GET['binary']) && isset($_GET['capital']) && isset($_GET['em']) && isset($_GET['kamikaze']) && isset($_GET['revival'])) {
			scoreCalurlate();
		} else {
			echo "Please answer all questions and press the Score button!";
		}
		function scoreCalurlate()	{
			$score = 0;

			$binary = $_GET['binary'];
			$capital = $_GET['capital'];
			$em = $_GET['em'];
			$kamikaze = $_GET['kamikaze'];
			$revival = $_GET['revival'];

			if ($binary == '10') {
				$score++;
				echo "Question 1: $binary (Correct!)<br/>";
			} else {
				echo "Question 1: $binary (Incorrect!)<br/>";
			}
			if ($capital == 'Canberra') {
				$score++;
				echo "Question 2: $capital (Correct!)<br/>";
			} else {
				echo "Question 2: $capital (Incorrect!)<br/>";
			}
			if ($em == 'MTBMB') {
				$score++;
				echo "Question 3: $em (Correct!)<br/>";
			} else {
				echo "Question 3: $em (Incorrect!)<br/>";
			}
			if ($kamikaze == 'The Ringer') {
				$score++;
				echo "Question 4: $kamikaze (Correct!)<br/>";
			} else {
				echo "Question 4: $kamikaze (Incorrect!)<br/>";
			}
			if ($revival == 'Walk On Water') {
				$score++;
				echo "Question 5: $revival (Correct!)<br/>";
			} else {
				echo "Question 5: $revival (Incorrect!)<br/>";
			}
			echo "You scored $score out of 5 answers correctly!";
		}
	?>
</HTML>