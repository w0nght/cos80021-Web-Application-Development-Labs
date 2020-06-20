<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" />

<xsl:template match="/">
	<div class="books">
	<xsl:for-each select="/bookstore/book[price&lt;30 and title/@genre='fiction']">
		<span class="spanTitle"><xsl:value-of select="title" /></span><br />
		<span class="spanAuthor">
		<xsl:value-of select="authors/author" />
		<xsl:if test="count(authors/author)&gt;1">
			et al
		</xsl:if>	
		</span><br />
		<span class="spanPrice"><xsl:value-of select="price" /></span><br /><br />						
	</xsl:for-each>
	</div>	
	<div>
		<span class="totalSpan">
		Total : <xsl:value-of select="sum(/bookstore/book[price&lt;30 and title/@genre='fiction']/price)" />
		</span>
	</div>	
</xsl:template>
</xsl:stylesheet>
