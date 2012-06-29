# XSL Resource Loader

The XSL Resource Loader allows you to add data sources and events to your pages directly in each page's XSL. 

## Installation

1. Upload the `xslresourceloader` folder in this archive to your Symphony `/extensions` folder.
2. Enable it by selecting the "XSL Resource Loader", choose Enable from the with-selected menu, then click Apply.

## Usage

After installing this extension you can add two new XML element to your XSL stylesheet: `data-source` and `event`. The handle of the resource to be loaded is named in the `name` attribute.

The elements themselves are required to belong to a separate XML-Namespace `http://symphony-cms.com/schemas/resources/1.0` so make sure to add this one to your `xsl:stylesheet` definition.

## Example

The following code loads the Data Source `articles` and the Event `comments`:

	<?xml version="1.0" encoding="UTF-8"?>
	<xsl:stylesheet version="1.0"
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
		xmlns:res="http://symphony-cms.com/schemas/resources/1.0"
		exclude-result-prefixes="res">

	<res:data-source name="articles" />
	<res:event name="comments" />

	...

	</xsl:stylesheet>

