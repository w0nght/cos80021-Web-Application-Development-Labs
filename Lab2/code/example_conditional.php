
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>An example of using "Switch" in PHP</title> 
  </head> 
  <body>
  <H1>An example of using "Switch" in PHP</H1>

  <form>
	    Please select a weekday:	<select name="weekday" >
									<option value="Sunday">Sunday</option>
									<option value="Monday">Monday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Thursday">Thursday</option>
									<option value="Friday">Friday</option>
									<option value="Saturday">Saturday</option>
									</select> <br/>
		<br/>Select your role: <input type="radio" name="role" value="teacher">teacher &nbsp; <input type="radio" name="role" value="student">student <br/>
		<br/> 
		<input type="submit" value="Submit" />
  </form>
  
  <p> Your agenda is shown as below.</p>
  </body> 

<?php 
	
	if(isset($_GET['weekday']) && isset($_GET['role']) )
	{
		$weekday = $_GET['weekday'];
		$role =$_GET['role'];
		echo "As a $role, on $weekday, your agenda is: &nbsp;";
		if($role == 'student')	// a student's agenda
		{
			if($weekday == 'Monday')
			{
				echo 'HIT3324 Lecture & Lab';
				// case 'Wednesday': echo 'HIT3324 Lab'; break;
				// default: ;
			} elseif ($weekday == 'Wednesday') 
			{
				echo 'HIT3324 Lab';
			}
			else
			{
				echo 'Study harder';
			}
		}
		else 
		{	// a teacher's agenda
			switch($weekday)
			{
				case 'Monday': echo 'HIT3324 Lecture & Lab'; break;
				case 'Wednesday': echo 'HIT3324 Lab'; break;
				case 'Tuesday': 				
				case 'Thursday':
				case 'Friday': echo 'Research'; break;
				default: echo 'Have a rest';
			}
		}
		
	}
	


?>

</HTML>