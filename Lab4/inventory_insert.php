<!-- procedural syntax -->
<html>
<body>
<?php 
  // Accessing database with PHP
  // open the connection, connect to mysql server
  // connect to MySQL database server using procedural syntax
  $DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "s101664795","250394", "s101664795_db")
    Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

  echo "<h3>Insert a new row:</h3><form>";
  echo "Make: <input type='text' name='make' /><br/>";
  echo "Model: <input type='text' name='model' /><br/>";
  echo "Price: <input type='text' name='price' /><br/>";
  echo "Quantity: <input type='text' name='quantity' /><br/>";
  echo "<input type='submit' value='Add' /></form>";

  // see if we can perform query without error handling
  if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['price']) && isset($_GET['quantity'])) {

    $DBConnect = @mysqli_connect("feenix-mariadb.swin.edu.au", "s101664795","250394", "s101664795_db")
    Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

    // Escape special characters, if any
    $make = mysqli_real_escape_string($DBConnect, $_GET['make']);
    $model = mysqli_real_escape_string($DBConnect, $_GET['model']);
    $price = mysqli_real_escape_string($DBConnect, $_GET['price']);
    $quantity = mysqli_real_escape_string($DBConnect, $_GET['quantity']);

    $SQLstring = "insert into inventory (make, model, price, quantity) values ('$make', '$model', '$price', '$quantity')";

    $queryResultUpdated = @mysqli_query($DBConnect, $SQLstring)
    Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";

    $affactedrow = mysqli_affected_rows($DBConnect);
    echo "Success! $affactedrow Row inserted.\n";
  }

  // even if the new database hasn't been inserted, this table will stil show 

  // set up the SQL query string and excute
  // - we will retrieve the whole record that matches the name
    // get all from db
  $SQLstring = "select * from inventory";
  $queryResult = @mysqli_query($DBConnect, $SQLstring)
    Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ". mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";

  echo "<hr><p>Content of inventory table</p>";

  // this row only need once
  $row = mysqli_fetch_row($queryResult);

  echo "<table width='100%' border='1'>";
  echo "<th>Make</th><th>Model</th><th>Price</th><th>Quantity</th>";
  
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
?>
</body>
</html>