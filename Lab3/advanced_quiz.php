<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>task 2e quiz</title> 
  </head> 
	<body>
	<?php
	// Read questions file
		// return an array
		function readQuestions($filename) {
			$displayQuestions = array();
			// if the file is exist and readable, loop through each line and store them into array
			if (file_exists($filename) && is_readable($filename)) {
				$questions = file($filename);
				// explode them into questions and choices
				foreach ($questions as $key => $value) {
					$displayQuestions[] = explode(":", $value);
					//DEBUG
					// echo "Key=" .$key. " Value=" .$val. "\n";
					//Key=0 Value=1. What is 1 + 1 in Binary value? : 11, 0, 10, 2 
					//Key=1 Value=2. What is the capital of Australia? : Sydney , Melbourne , Perth , Canberra 
				}
			} else {
				echo "Error reading $filename";
			}
			return $displayQuestions;
		}

		// display questions function 
		// break each question and choices
		function displayQuestions($questions) {
			if (count($questions) > 0) {
				foreach ($questions as $key => $value) {
					echo "<b>$value[0]</b><br>";

					// break choices appart as choice array
					$choices = explode(",", $value[1]);
					foreach($choices as $value) {
						$ans = substr(trim($value), 0.1);
				
						echo "<input type=\"radio\" name=\"$key\" value=\"$ans\">$value<br/>";
					}
					echo "<br/>";
				}
			} else {
				echo "No questions to display, please double check with txt file.";
			}
		}

		// Read questions file function
		// return an array
		function readAnswers($filename) {
			$loadAnswers = array();
			// if the file is exist and readable, loop through each line and store them into array
			if (file_exists($filename) && is_readable($filename)) {
				$loadAnswers = file($filename);
			}
			return $loadAnswers;
		}

?>
		<H1>Task 3d quiz - read file</H1>
		<p>Answer all of the questions on the quiz, then select Score button to grade the quiz.</p>
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<?php
			// load questions from file
			$loadQuestions = readQuestions("questions.txt");
			// display each question and it choices
			displayQuestions($loadQuestions);
		?>
			<input type="submit" name="score" value="Score" />
			<?php 
		if (isset($_POST['score'])) {
			// load answers from answer txt file 
			$loadAnswers = readAnswers("answers.txt");
			// calulate the score
			$maxScore = count($loadAnswers);
			$score = 0;

			foreach($loadAnswers as $key => $ansvalue) {
				echo "$key = $ansvalue, ";
				if (isset($_POST[$key])) {
				echo "$_POST[$key] ";
					if (strtoupper(rtrim($ansvalue)) == strtoupper($_POST[$key])) {
						$score++;
					}
				}
			}
			echo "<h2>Quiz Results</h2>";
			echo "You scored $score out of $maxScore answers correctly!";
		} else {
			echo "Please answer all questions and press the Score button!";
		}
	?>
		</form>
  </body> 
</HTML>