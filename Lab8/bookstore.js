// JavaScript functions to control the client-server interaction
// Performing a transfromation in Firefox
function Transform() {
  // create the XSLT processor object
  var xsltProcesser = new XSLTProcessor();
  // load XSL fileand XML file into XML DOC document objects
  xslStylesheet = document.implementation.createDocument("", "doc", null);
  xslStylesheet.async = false;
  // load the XSL DOM Document object as the "program" for the XSLT processor object
  xslStylesheet.load("getBooks.xsl");
  xsltProcesser.importStylesheet(xslStylesheet);
  xmlDoc = document.implementation.createDocument("", "doc", null);
  xmlDoc.async = false;
  // send the XML DOM Document object in as the input to the loaded XSLT processor,
  // and get the transgformaed HTML as the output
  xmlDoc.load("books.xml");

  // Transform
  var fragment = xsltProcesser.transformToFragment(xmlDoc, document);
  document.getElementById("example").appendChild(fragment);
}

var xHRObject = false;
xHRObject = createRequest();  // from xhr.js
function getData() {
  if ((xHRObject.readyState==4) && (xHRObject.status==200)) {
    if (window.ActiveXObject) { // IE
      // load XML and XSL, then transform
      var xml = xHRObject.responseXML;
      var xsl = new ActiveXObject("Microsoft.XMLDOM");
      xsl.async = false;
      xsl.load("books3.xsl");
    }
  }
}