<?php
//session_register('Cart');
session_start();
header('Content-Type: text/xml');
?>
<?php
  $newitem = $_GET["book"];
  $action = $_GET["action"];
  $price = $_GET["price"];
  $ISBN = $_GET["ISBN"];
  $id = $_GET["id"];

  if ($_SESSION["Cart"] != "") {
    $cart = $_SESSION["Cart"];
    if ($action == "Add") { // process an Add request
      if (isset($cart[$newitem])) {  // the cart already has a book in it
        // add one more copy to that book
        $value = $cart[$newitem];
        $value["qty"] = $value["qty"] + 1;
        $value["total"] = $price * $value["qty"];

        $cart[$newitem] = $value;
        $_SESSION["Cart"] = $cart;
        echo (toXml($cart));

      } else {
        // fitst book! with existing id
        $value = array();
        $value["qty"] = "1";
        $value["isbn"] = $ISBN;
        $value["total"] = $price;
        $value["id"] = $id;
    
        $cart[$newitem] = $value;
        $_SESSION["Cart"] = $cart;
        echo (toXml($cart));
      }
    } else {  // process remove request
      // $cart= ""; // this was emptying the whole book record
      $value = $cart[$newitem];
      $value["qty"] = $value["qty"] -1;
      $value["total"] = $price * $value["qty"];

      $cart[$newitem] = $value;
      $_SESSION["Cart"] = $cart;
      echo (toXml($cart));
    }
  } elseif ($action == "Add") {  // create new cart session - start with the first copy of this book
    // $cart[$newitem] = "1";
    // first book with new id
    $value = array();
    $value["qty"] = "1";
    $value["isbn"] = $ISBN;
    $value["total"] = $price;
    $value["id"] = $id;

    $cart = array();
    $cart[$newitem] = $value;
    $_SESSION["Cart"] = $cart;
    echo (toXml($cart));
  }

  function toXml($shopping_cart) {
    // create the xml docment
    $doc = new DomDocument('1.0');

    // create the root element <cart></cart>
    $cart = $doc->createElement('cart');
    $cart = $doc->appendChild($cart);
    //$cart = "";
    if ($cart!="") {  // if <cart> exists
      foreach ($shopping_cart as $Item => $ItemValue) {
        // $Item is key - title
        // $ItemValue is the value

        // $Item -> title e.g. "java"
        // $ItemValue['isbn'] -> ISBN
        // $ItemValue['qty'] -> 

        // to create <book></book>
        $book = $doc->createElement('book');
        $book = $cart->appendChild($book);
        
        // to create <title></title>
        $title = $doc->createElement('title'); 
        $title = $book->appendChild($title);
        // to append the child inside <title>$value</title>
        $value = $doc->createTextNode($Item);
        $value = $title->appendChild($value);

        $quantity = $doc->createElement('quantity');
        $quantity = $book->appendChild($quantity);
        $value2 = $doc->createTextNode($ItemValue["qty"]);
        $value2 = $quantity->appendChild($value2);

        $isbn = $doc->createElement('isbn');
        $isbn = $book->appendChild($isbn);
        $value3 = $doc->createTextNode($ItemValue["isbn"]);
        $value3 = $isbn->appendChild($value3);

        
        $total = $doc->createElement('total');
        $total = $book->appendChild($total);
        $value4 = $doc->createTextNode($ItemValue["total"]);
        $value4 = $total->appendChild($value4);
        
        $id = $doc->createElement('id');
        $id = $book->appendChild($id);
        $value5 = $doc->createTextNode($ItemValue["id"]);
        $value5 = $id->appendChild($value5);
      }
    }
    $strXml = $doc->saveXML();
    return $strXml;
  }
  // session_destroy();
?>