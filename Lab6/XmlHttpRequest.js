/* handle request.js */
var xHRObject = false;

if (window.XMLHttpRequest)
{
    xHRObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function sendRequest(data)
{
    // To aviod IE cache problem
    xHRObject.open("GET", "display.php?id=" + Number(new Date) +"&value=" + data, false);
    xHRObject.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT' );
    xHRObject.onreadystatechange = getData; // assign the callback function
    xHRObject.send(null); 
}

function getData()
{   // data loaded and status OK
    if (xHRObject.readyState == 4 && xHRObject.status == 200)
    {
        // pick up the text returned from server
        var serverText = xHRObject.responseText;
        // test that text returned includes the separator character
        // If test failed, means that bad data has been returned
        if(serverText.indexOf('|' != -1)) 
	    {
            // split the text on the separator charater
            element = serverText.split('|');
            document.getElementById(element[0]).innerHTML = element[1];
        }
    }
}

