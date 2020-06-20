var map = null; 
var geocoder = null;
var xhr = null;

xhr = GXmlHttp.create();//createRequest();
geocoder = new GClientGeocoder();

// function to load the map and saved markers; executed when system loads up
function load() {
	if (GBrowserIsCompatible()) 
	{
		// create map
		map = new GMap2(document.getElementById("map"));

		// add controls
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
        
		// place the markers saved from last time
		// If there are none, the map will center on Paris
		placeMarkers(); 
   }
}

// function to add a marker to the disdplayed map, based on address in input field
function addMarker(){
	// read address from input field
	var address = document.getElementById("address").value;
	// convert address to GLatLng, center the map there, and place marker
	geocoder.getLatLng(address, function(point) {
		if (!point) {
			alert(address + " not found");
		} 
		else{
			map.setCenter(point, 13);
			var marker = createMarker(point, address);
			map.addOverlay(marker);
			marker.openInfoWindowHtml(address);
			saveMarker(point, address);
		}
	});
}

// function to save the details of a marker at a particular point, with a particular address
// calls a PHP file to do the actual work, using Ajax
function saveMarker(point, address){
	var lat = point.y; var lng = point.x;
	var url = "saveMarkers.php?lat=" + lat + "&lng=" + lng + "&address=" + address;
	xhr.open("GET", url, true); 
	xhr.onreadystatechange = getConfirm;  
	//xhr.setRequestHeader("Content-Type", "text/xml" ); //use this if no response required 
	xhr.send(null); 
}

// function to place marker added confirmation message in document
// runs as call-back when a new marker has been added successfully
function getConfirm(){
	if ((xhr.readyState == 4) &&(xhr.status == 200))    {
        var markerAddConfirm = xhr.responseText;
		var spantag = document.getElementById("markerConfirm");
        spantag.innerHTML = markerAddConfirm;
   }
}

// function to connect with server and read marker data from file data.xml
// Connection is via the Google GDownloadUrl function, which is passed the data file as
// first parameter, and a call-back function as second parameter
// The data downloaded is passed to this call-back as the first parameter, and the response code
// from teh download is passed as the second parameter
function placeMarkers(){
    GDownloadUrl("data.xml", function(data, responseCode) {
        if(responseCode == 200){  // data loaded ok
              var xml = GXml.parse(data);  //convert the data to an XML DOM fragment; warning: will get from cache if not cleared
              var markers = xml.documentElement.getElementsByTagName("marker"); // get the marker elements in the data
			  if (markers.length == 0) {// if no markers, set map center on Paris
              	  geocoder.getLatLng("Paris", function(point){map.setCenter(point, 13)});
			  }
			  else { // place the markers
              	for (var i = 0; i < markers.length; i++) {
				 	var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")));
                 	map.setCenter(point, 12);   //fails if this not used
                 	map.addOverlay(createMarker(point, markers[i].getAttribute("address"))); 
              	}
			 }
        }
		else if(responseCode == -1) {
              alert("Data request timed out. Please try later.");
		}
        else { // center the map on Paris 
              geocoder.getLatLng("Paris", function(point){map.setCenter(point, 13)});
		}
		});
}

// function to create a new marker with click-ope information window for a given point with given name
function createMarker(point, name) { 
	var marker = new GMarker(point); 
    GEvent.addListener(marker, "click", function() { 
    	marker.openInfoWindowHtml("<b> " + name + " </b>"); 
         }); 
	return marker; 
} 