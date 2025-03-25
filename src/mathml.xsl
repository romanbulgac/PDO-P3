<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xlink="http://www.w3.org/1999/xlink">
    
    <xsl:output method="html" indent="yes"/>
    
    <!-- Match the root element -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Transformed XML with XLink</title>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        margin: 20px;
                    }
                    .section {
                        margin: 20px 0;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }
                </style>
                <!-- Include MathJax for rendering MathML -->
                <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
                <script id="MathJax-script" async="true" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
            </head>
            <body>
                <h1>XML with XLink Example</h1>
                
                <!-- Process the XLink hyperlink -->
                <div class="section">
                    <h2>XLink Example:</h2>
                    <a href="{//link_url}" target="_blank">
                        A link to an external resource
                    </a>
                    <p><em>This link was created using XLink in XML and transformed with XSL.</em></p>
                </div>
                
                <!-- SVG Section - correct path from XML -->
                <div class="section">
                    <h2>SVG Diagram:</h2>
                    <svg width="640" height="480" xmlns="http://www.w3.org/2000/svg">
                        <!-- Copy all SVG content -->
                        <xsl:copy-of select="/parentmode/svgnode/*"/>
                    </svg>
                </div>
                
                <!-- Math Section - correct path from XML -->
                <div class="section">
                    <h2>Mathematical Formula:</h2>
                    <div>
                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                            <!-- Copy all MathML content -->
                            <xsl:copy-of select="/parentmode/math/*"/>
                        </math>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>