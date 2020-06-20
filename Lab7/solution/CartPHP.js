var xhr = createRequest();

function getData()
{   
	if ((xhr.readyState == 4) &&(xhr.status == 200))
    	{ 
alert(xhr.responseText);
			var serverResponse = xhr.responseXML;
        	var header = serverResponse.getElementsByTagName("book");
        	var spantag = document.getElementById("cart");
			var x;
        	spantag.innerHTML = "";
			x = "<table cellpadding='1' cellspacing='6' border='0'>";
			x += "<tr><td>Title</td><td>ISBN</td><td>Qty</td><td>Total</td><td>Remove</td></tr>";
        	for (i=0; i<header.length; i++)
        	{  
				var id =  header[i].getElementsByTagName("id")[0].childNodes[0].nodeValue;
				var total =  header[i].getElementsByTagName("total")[0].childNodes[0].nodeValue;
				var title =  header[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
				var isbn =  header[i].getElementsByTagName("isbn")[0].childNodes[0].nodeValue;
				var qty =  header[i].getElementsByTagName("quantity")[0].childNodes[0].nodeValue;
				if(qty=="0")
				{
					continue;
				}
				x += "<tr>"
				+ "<td>" + title + "</td>"
				+ "<td>" + isbn + "</td>"
				+ "<td>" + qty + "</td>"
				+ "<td>" + total + "</td>"
				+ "<td>" + "<a href='#' onclick='AddRemoveItem(\"Remove\","+id+");'>Remove Item</a>" + "</td>"
				+ "</tr>";
           		
        	}
			x += "</table>";
			if (header.length != 0)
				spantag.innerHTML = x;
    	}
}

function AddRemoveItem(action,id)
{   
	var book  = document.getElementById("book"+id).innerHTML;  
	var isbn  = document.getElementById("ISBN"+id).innerHTML;
	var price = document.getElementById("price"+id).innerHTML;
	xhr.open("GET", "ManageCart.php?action=" + action + "&bookTitle=" +  
		encodeURIComponent(book) + "&bookISBN=" + isbn + "&bookPrice=" + price+"&id="+id, true);
	xhr.onreadystatechange = getData;
	xhr.send(null);   
}

function loadXMLDoc(dname)
{
	if (window.XMLHttpRequest)
	  {
		xhttp=new XMLHttpRequest();
	  }
	else
	  {
		xhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xhttp.open("GET",dname,false);
	xhttp.send();
	return xhttp.responseXML;
}



function displayBooks() 
{
	xmlDoc=loadXMLDoc("books.xml");
	
	var books = xmlDoc.getElementsByTagName("book");
	
	var div = document.getElementById("mainContent");
	
	for (i=0; i<books.length; i++) 
	{
		var img = books[i].getElementsByTagName("img")[0].childNodes[0].nodeValue;
		var name = books[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
		var authors = books[i].getElementsByTagName("authors")[0].childNodes[0].nodeValue;
		var isbn = books[i].getElementsByTagName("isbn")[0].childNodes[0].nodeValue;
		var price = books[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
		
		div.innerHTML+="<br/><img src=\""+img+"\"/><br/><br/><b>Book:</b><span id=\"book"+i+"\" >"+name+"</span><br/><b>Authors: </b><span id=\"authors"+i+"\">"+authors+"</span><br /><b>ISBN: </b><span id=\"ISBN"+i+"\">"+isbn+"</span> <br /><b>Price: </b>$<span id=\"price"+i+"\" >"+price+"</span><br/><br/>	<a href=\"#\" onClick=\"AddRemoveItem('Add',"+i+");\" >Add to Shopping Cart</a><br/><br/>";
		
	
   	}
}