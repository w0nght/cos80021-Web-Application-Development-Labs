<html>
<body>

<H3>List employees who have experience in a programming language.<br/></H3>

<?php 

$DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "cliu","WADwad", "cliu_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

// set up the SQL query string - we will retrieve the whole
// record that matches the name

// get language names from db
$SQLstring = "select language from languages";
$queryResult = @mysqli_query($DBConnect, $SQLstring)
	Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";

echo "<form>Please input the city name: <input type='text' name='city'/><br/>";

echo "Please select a language: <select name='language'>";
	
$row = mysqli_fetch_row($queryResult);
	
	while ($row) {
		echo "<option value='".$row[0]."'>".$row[0]."</option>";	
		$row = mysqli_fetch_row($queryResult);
	}


echo "</select><br/>Please input the minimum year required: <input type='text' name='year'/><input type='submit' value='Search'/></form>";

mysqli_close($DBConnect);

//if a language is selected, get data from table 
if(isset($_GET['language']))
{

$DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "cliu","WADwad", "cliu_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

	if(isset($_GET['year']) && $_GET['year']>0 )
	{
		$SQLstring = "select e.first_name,e.last_name,l.language,x.years, e.city FROM employees e, experience x,languages l where e.employee_id=x.employee_id and x.language_id = l.language_id and l.language='".$_GET['language']."' and x.years>='".$_GET['year']."'";
		
	}
	 if (isset($_GET['city'])) {
		$SQLstring = "select e.first_name,e.last_name,l.language,x.years, e.city FROM employees e, experience x,languages l where e.employee_id=x.employee_id and x.language_id = l.language_id and l.language='".$_GET['language']."' and x.years>='".$_GET['year']."' and e.city='".$_GET['city']."' ";
	}
	else
	{
	$SQLstring = "select e.first_name,e.last_name,l.language,x.years, e.city FROM employees e, experience x,languages l where e.employee_id=x.employee_id and x.language_id = l.language_id and language='".$_GET['language']."' ";
	}
// perform the query, storing the result
$queryResult = @mysqli_query($DBConnect, $SQLstring)
		Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";

echo "<p>List of Employees who have at least ", $_GET['year'], " years in ", $_GET['language'], " live in ", $_GET['city'], "</p>";

echo "<table width='100%' border='1'>";
echo "<th>First Name</th><th>Last Name</th><th>Language</th><th>Year</th><th>City</th>";
	$row = mysqli_fetch_row($queryResult);
	
	while ($row) {
		echo "<tr><td>{$row[0]}</td>";
		echo "<td>{$row[1]}</td>";
		echo "<td>{$row[2]}</td>";
		echo "<td>{$row[3]}</td>";
		echo "<td>{$row[4]}</td></tr>";
		$row = mysqli_fetch_row($queryResult);
	}
	echo "</table>";
	mysqli_close($DBConnect);
}
?>

<?php
$DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "cliu","WADwad", "cliu_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

// set up the SQL query string - we will retrieve the whole
// record that matches the name

// languages table
$SQLstring1 = "select * from languages";
$queryResult1 = @mysqli_query($DBConnect, $SQLstring1)
	Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
echo "<br/><hr><br/><h3>for debug purpose, please ignore below</h3>";
echo "<table width='100%' border='1'>";
echo "<th>language_id</th><th>language</th>";
$row = mysqli_fetch_row($queryResult1);
while ($row) {
	echo "<tr><td>{$row[0]}</td>";
	echo "<td>{$row[1]}</td>";
	$row = mysqli_fetch_row($queryResult1);
}
echo "</table><br/>";

// employees table
$SQLstring2 = "select * from employees";
$queryResult2 = @mysqli_query($DBConnect, $SQLstring2)
	Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
echo "<table width='100%' border='1'>";
echo "<th>employee_id</th><th>last_name</th><th>city</th><th>state</th>";
$row = mysqli_fetch_row($queryResult2);
while ($row) {
	echo "<tr><td>{$row[0]}</td>";
	echo "<td>{$row[1]}</td>";
	echo "<td>{$row[4]}</td>";
	echo "<td>{$row[5]}</td></tr>";
	$row = mysqli_fetch_row($queryResult2);
}
echo "</table><br/>";

// experience junction table
$SQLstring2 = "select * from experience";
$queryResult2 = @mysqli_query($DBConnect, $SQLstring2)
	Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
echo "<table width='100%' border='1'>";
echo "<th>employee_id</th><th>language_id</th><th>years</th>";
$row = mysqli_fetch_row($queryResult2);
while ($row) {
	echo "<tr><td>{$row[0]}</td>";
	echo "<td>{$row[1]}</td>";
	echo "<td>{$row[2]}</td></tr>";
	$row = mysqli_fetch_row($queryResult2);
}
echo "</table>";


mysqli_close($DBConnect);
?>

</body>
</html>