<html>
<body>
<?php 
  // Accessing database with PHP
  // open the connection, connect to mysql server
  $DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "s101664795","250394", "s101664795_db")
    Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

  // set up the SQL query string and excute
  // - we will retrieve the whole record that matches the name

  // get make from db

  // $SQLstring = "select * from inventory";
  // select distinct <--
  $SQLstring = "select distinct make from inventory";
  $queryResult = @mysqli_query($DBConnect, $SQLstring)
    Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";

  echo "<form>Please select a make: 
          <select name='make'>
            <option>All</option>";
  $row = mysqli_fetch_row($queryResult);

  while ($row) {
    // display each make on the option list
    echo "<option value='".$row[0]."'>".$row[0]."</option>";
    $row = mysqli_fetch_row($queryResult);
  }
  echo "</select><br/><input type='submit' value='Search'/></form>";

  mysqli_close($DBConnect);

  // if a make is selected, get data from table
  if (isset($_GET['make']) && $_GET['make'] != "") {
    // connect to db if selection not empty
    $DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "s101664795","250394", "s101664795_db")
    Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

    // if option All || one of the make is slected 
    if ($_GET['make'] == "All") {
      $SQLstring = "select * from inventory";
    } else {
      $SQLstring = "select * from inventory where make = '".$_GET['make']."'";
    }
    
    //perform the query, storing the result
    $queryResult = @mysqli_query($DBConnect, $SQLstring)
    Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
    
    echo "<hr><p>Content of inventory table</p>";

    echo "<table width='100%' border='1'>";
    echo "<th>Make</th><th>Model</th><th>Price</th><th>Quantity</th>";
    $row = mysqli_fetch_row($queryResult);
    
    while ($row) {
      echo "<tr><td>{$row[1]}</td>";
      echo "<td>{$row[2]}</td>";
      echo "<td>{$row[3]}</td>";
      echo "<td>{$row[4]}</td></tr>";
      $row = mysqli_fetch_row($queryResult);
      // $row[0] is item_number which we do not need to display
    }
    echo "</table>";

    // close the connection
    mysqli_close($DBConnect);

  }
?>


</body>
</html>