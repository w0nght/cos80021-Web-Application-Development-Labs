var xHRObject = createRequest();

function createRequest() {
  var xhr = false;  
  if (window.XMLHttpRequest) {
      xhr = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xhr;
}


function loadXMLDoc(dname) {
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.open("GET", dname, false);
  xmlhttp.send();
  return xmlhttp.responseXML;
  
}

// this function to load all books from xml file
function generateBooks() {
  // open & load the xml file from current directory
  xmlDoc = loadXMLDoc("booklist.xml");
  // get all books
  var eachbook = xmlDoc.getElementsByTagName("book");
  // get html document element 
  var x = document.getElementById("list");
  x.innerHTML = "";

  for (i=0; i < eachbook.length; i++) {
    // <title>$hereIsTheFirstChildNodeNodeValue</title>
    var title = eachbook[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
    var isbn = eachbook[i].getElementsByTagName("isbn")[0].childNodes[0].nodeValue;
    var price = eachbook[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
    var authors = eachbook[i].getElementsByTagName("authors")[0].childNodes[0].nodeValue;

    x.innerHTML += "<b>Book: </b><span id=\"book"
    +i+"\">"+title+"</span><br/><b>Authors: </b><span id=\"authors"
    +i+"\">"+authors+"</span><br /><b>ISBN: </b><span id=\"ISBN"
    +i+"\">"+isbn+"</span> <br /><b>Price: </b>$<span id=\"price"
    +i+"\" >"+price+"</span><br/><br/>	<a href=\"#\" onClick=\"AddRemoveItem('Add',"+i+");\" >Add to Shopping Cart</a><br/><br/>";
    }
}

function getData() {
  if ((xHRObject.readyState == 4) && (xHRObject.status == 200)) {
    // alert(xHRObject.responseXML);
    // alert(xHRObject.responseText);
    var serverResponse = xHRObject.responseXML;
    var header = serverResponse.getElementsByTagName("book");
    var x;
    var spantag = document.getElementById("cart");
    spantag.innerHTML = "";
    x = "<table>";
    x += "<tr><th>Title</th><th>isbn</th><th>qty</th><th>total</th><th>Remove</th></tr>";
    //if(header!=null) {
    for (i=0; i < header.length; i++) { // this handle any number of books in the cart
      var title = header[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
      var qty = header[i].getElementsByTagName("quantity")[0].childNodes[0].nodeValue;

      var total = header[i].getElementsByTagName("total")[0].childNodes[0].nodeValue;
      var isbn = header[i].getElementsByTagName("isbn")[0].childNodes[0].nodeValue;
      var id = header[i].getElementsByTagName("id")[0].childNodes[0].nodeValue;
      if (qty == "0") {
        continue;
      }
      x += "<tr>" 
      + "<td>" + title + "</td>"
      + "<td>" + isbn + "</td>"
      + "<td>" + qty + "</td>"
      + "<td>" + total + "</td>"
      + "<td>" + "<a href='#' onclick='AddRemoveItem(\"Remove\", "+id+");'>Remove Item</a>" 
      + "</td>" 
      + "</tr>";

      // if (window.ActiveXObject) { // IE uses "text"
        // the fist child of a book element gives the name of the book


      //   spantag.innerHTML += " " + header[0].firstChild.text;
      //   spantag.innerHTML += " " + qty+ " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
      // } else {  // WC3 uses textContent
      //   spantag.innerHTML += " " + header[0].firstChild.textContent;
      //   spantag.innerHTML += " " + header[0].nextSibling.textContent + " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
      // }
    //}
    }
    x += "</table>";
    if (header.length != 0)
				spantag.innerHTML = x;
  }
}

function AddRemoveItem(action, id) {
  // variable "book" stores the name of the single element with id "book" stored in the html document
  // this need to be altered if book > 1
  var book  = document.getElementById("book" + id).innerHTML;
  var isbn  = document.getElementById("ISBN" + id).innerHTML;
	var price = document.getElementById("price"+ id).innerHTML;
  if(action=="Add") {
    // Number(new Date) force URL to be different from last time
    // therefore IE aggressive cache doesn't occur
    xHRObject.open("GET", "ManageCart.php?action=" + action + "&book=" + encodeURIComponent(book) + "&id=" + id + "&price=" + price + "&ISBN=" + isbn + "&value=" + Number(new Date), true);
  } else {  // action == Remove
    xHRObject.open("GET", "ManageCart.php?action=" + action + "&book=" + encodeURIComponent(book) + "&id=" + id + "&price=" + price + "&ISBN=" + isbn + "&value=" + Number(new Date), true);
  }
  // PHP function in ManageCart.php will use the value of the action parameter 
  // to determine what processing to do
  xHRObject.onreadystatechange = getData;
  xHRObject.send(null);   
}