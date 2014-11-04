<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function odt2text($filename) {
    return getTextFromZippedXML($filename, "content.xml");
}

function docx2text($filename) {
    return getTextFromZippedXML($filename, "word/document.xml");
}

function getTextFromZippedXML($archiveFile, $contentFile) {
    echo realpath($archiveFile);
    return strip_tags(file_get_contents('zip://' . realpath($archiveFile) . '#' . $contentFile));
}

$filename = './test.odt';

print_r(odt2text('test.odt'));
