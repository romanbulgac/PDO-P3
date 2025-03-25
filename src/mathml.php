<?php
// Load the XML file
$xml = new DOMDocument();
$xml->load("mathml.xml");

// Load the XSL file
$xsl = new DOMDocument();
$xsl->load("mathml.xsl");

// Configure the transformer
$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl);

// Transform and output the result
echo $proc->transformToXML($xml);
?>