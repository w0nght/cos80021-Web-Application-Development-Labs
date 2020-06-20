<!-- connectInventory.php -->
<!-- lab 10 task b -->
<html>
<title>inventory table</title>
<body>
<H3>Lab 10 task b</H3>
<?php
  class InventoryCon {
    // this class will be used by users to retrieve infromation 
    // from the Inventory table created in MySQL database
    private $host;
    private $username;
    private $userpassword;
    private $db;
    private $tablename;

    public function __construct() {
      // constructor to initialize data memebers userd for InventoryCon
      $this->db_connect();
    }
    function db_connect() {
      $this->host = "feenix-mariadb.swin.edu.au";
      $this->username = "s101664795";
      $this->userpassword = "250394";
      $this->db = "s101664795_db";
      $this->tablename = "inventory";

      // connect to MySQL server in Object-Oriented Syntax
      $dbConnect = new mysqli($this->host, $this->username, $this->userpassword);
      // check connection
      if ($dbConnect->connect_error) {
        die("<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . $dbConnect->connect_errno
        . ": " . $dbConnect->connect_error . "</p>");
      }
      echo "connect to db: success... Host info: " . $dbConnect->host_info . "\n";
    }


      // with oo style, we cannot terminate script execution with die() or exit() functions
    
    public function getMakes() {
      // to get make information from database 
      // drop-down list for all makes
      $dbConnect = new mysqli($this->host, $this->username, $this->userpassword);

      $dbConnect->select_db($this->db)
        or die("<p>Unable to select the database.</p>"
        . "<p>Error code " .$dbConnect->errno . ": "
        . $dbConnect->error . "</p>");

        $sqlString = "select distinct make from inventory";
        $queryResult = $dbConnect->query($sqlString)
          or die(
            "<p>Unable to execute the query.</p>"
            . "<p>Error code " .$dbConnect->errno
            . ": " .$dbConnect->error . "</p>"
          );
        echo "<br /><form>Please select a make:
                <select name='make'>
                <option>All</option>";
        $row = $queryResult->fetch_row();
        while ($row) {
          echo "<option value='".$row[0]."'>".$row[0]."</option>";
          $row = $queryResult->fetch_row();
        }
        echo "</select><br /><input type='submit' value='Search'/></form>";

        if (isset($_GET['make']) && $_GET['make'] != "") {
          $this->setMake($_GET['make']);
        }

    }

    public function setMake($set) {
      // to set meke which is selected by a user
      echo "User selected " .$set;
      // $set = $_GET['make'];
      if ($set != "") {
      // if (isset($_GET['make']) && $_GET['make'] != "") {
        // connect to db if selection not empty
        $this->getInventories($set);
      }
    }

    function getInventories($set) {
      // to get inverntory data for a particular make 
      // or ALL makes from database and display it on the page
      $dbConnect = new mysqli($this->host, $this->username, $this->userpassword);
        $dbConnect->select_db($this->db)
        or die("<p>Unable to select the database.</p>"
        . "<p>Error code " .$dbConnect->errno . ": "
        . $dbConnect->error . "</p>");
    
        // if option All || one of the make is slected 
        if ($set== "All") {
          $sqlString = "select * from inventory";
        } else {
          $sqlString = "select * from inventory where make = '".$set."'";
        }
        //perform the query, storing the result
        $queryResult = $dbConnect->query($sqlString)
          or die(
            "<p>Unable to execute the query.</p>"
            . "<p>Error code " .$dbConnect->errno
            . ": " .$dbConnect->error . "</p>"
          );

        echo "<hr><p>Content of inventory table</p>";
        echo "<table width='100%' border='1'>";
        echo "<th>Make</th><th>Model</th><th>Price</th><th>Quantity</th>";
        $row = $queryResult->fetch_row();
        
        while ($row) {
          echo "<tr><td>{$row[1]}</td>";
          echo "<td>{$row[2]}</td>";
          echo "<td>{$row[3]}</td>";
          echo "<td>{$row[4]}</td></tr>";
          $row = $queryResult->fetch_row();
          // $row[0] is item_number which we do not need to display
        }
        echo "</table>";
        $this->closeConnection();
    }

    function closeConnection() {
      // to close the connection
      $dbConnect = new mysqli($this->host, $this->username, $this->userpassword);

      $dbConnect->close();
      echo "closing connection...";
    }

  }

  // $o = new InventoryCon();
  // $o->getMakes();
  // $o->closeConnection();
?>
</body>
</html>