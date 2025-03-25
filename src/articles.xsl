<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:param name="id"/>
    <xsl:output method="html" version="4.0" indent="yes"/>
    <xsl:template match="/">
        <head>
            <title>Articole</title>
            <link rel="stylesheet" type="text/css" href="style.css"/>
        </head>
        <body>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Image</th>
                </tr>
                <xsl:for-each select="root/article">
                    <tr>
                        <td style="width: 100px;"> <xsl:value-of select="title"/></td>
                        <td style="width: 100px;"> <xsl:value-of select="subtitle"/></td>
                        <td style="width: 100px;">
                            <xsl:element name="img">
                                <xsl:attribute name="src">
                                    <xsl:value-of select="image"/>
                                </xsl:attribute>
                                <xsl:attribute name="alt">
                                    <xsl:value-of select="title"/>
                                </xsl:attribute>
                            </xsl:element>
                        </td>
                    </tr>
                </xsl:for-each>
            </table>
        </body>
    </xsl:template>
</xsl:stylesheet>