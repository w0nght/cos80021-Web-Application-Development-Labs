<!-- XSLT stylesheet to extract and transform the book data sent from the server -->
<!-- xsl stylesheet to select the appropriate books from XML data -->
<!-- Purpose of the XSL transform is to take the XML data 
      that has been sent to the browser, and transform it into suitable HTML for display.
 -->
<?xml version="1.0" encoding="uft-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <!-- method: generate html; version of the html -->
  <xsl:output method="html" indent="yes" version="4.0" />
  <xsl:template match="/">
    <!-- Set up a table to hold the desired data - book title, first author, 
    price < 30, book genre == fiction -->
    <table border="1">
      <tr bgcolor="#9acd32">
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
      </tr>
      
      <xsl:for-each select="bookstore/book[@genre="fiction"]">
        <tr>
          <td><xsl:value-of select="title" /></td>
          <td><xsl:value-of select="author" /></td>
          <td><xsl:value-of select="price" /></td>
        </tr>
      </xsl:for-each>
    </table>
    <!-- extract title, first author,  -->
    <br />Total: <xsl:value-of-select="sum(//book[])">
  </xsl:template>
</xml:stylesheet>