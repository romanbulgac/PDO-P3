<?php
$xslDoc = new DOMDocument();
$xslDoc->load(filename: "articles.xsl");

$xmlDoc = new DOMDocument();
$xmlDoc->load(filename: "articles.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);