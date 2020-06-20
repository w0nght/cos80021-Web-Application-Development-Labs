var xHRObject = false;

// creates an XMLHttpRequest object
if (window.XMLHttpRequest)
    // code for modern browser
    xHRObject = new XMLHttpRequest();
else if (window.ActiveXObject)
    // code for old IE browsers
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

var tempInfo = ""; // hold display data

function loadXMLDoc() {
    var temp = "";
    //onreadystatechange property specifies a function to be executed every time the status of the XMLHttpRequest object changes
    xHRObject.onreadystatechange = function() {
        // when readyState property is 4
        // and the status property is 200
        // meas the reaponse is ready
        if (this.readyState == 4 && this.status == 200) {
            // responseText property returns the server as a text string
            document.getElementById("demo").innerHTML = this.responseText;
            // getData(this)
        }
    };
    // xHRObject.open("GET", "temperature.xml", true);
    xHRObject.open("GET", "tempRetrieve.php?id=" + Number(new Date) + "&temp=" + temp, true);
    xHRObject.send();
}

function getData(xml) {   // data loaded and status OK
    // 1/4/2013 : 24.0
    // average temperature is : 25.1xxxxxxxxxx
    var i;
    var xmlDoc = xml.responseXML;
    var table = "<tr><th>Date</th><th>Temperature</th></tr>";
    var x = xmlDoc.getElementsByTagName('temp');
    for (i = 0; i < x.length; i ++) {
        table += "<tr><td>" +
                x[i].getElementsByTagName("Day")[0].childNodes[0].nodeValue +
                "/" + 
                x[i].getElementsByTagName("Month")[0].childNodes[0].nodeValue +
                "/" + 
                x[i].getElementsByTagName("Year")[0].childNodes[0].nodeValue +
                " : </td><td>" +
                x[i].getElementsByTagName("Max")[0].childNodes[0].nodeValue +
                "</td></tr>";
    }
    document.getElementById("demo").innerHTML = table;
}