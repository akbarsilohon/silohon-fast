<?php
/**
 * Live search handler
 * 
 * Silohon Fast WordPress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);

if (!$q || strlen($q) === 0) {
    echo "no suggestion";
    exit;
}

$xmlDoc = new DOMDocument();
if (!$xmlDoc->load('links.xml')) {
    echo "Failed to load XML file.";
    exit;
}

$x = $xmlDoc->getElementsByTagName('link');
$hint = '';

for ($i = 0; $i < $x->length; $i++) {
    $y = $x->item($i)->getElementsByTagName('title');
    $z = $x->item($i)->getElementsByTagName('url');

    if ($y->item(0) && $y->item(0)->nodeType === 1 && $z->item(0)) {
        if (stristr($y->item(0)->childNodes->item(0)->nodeValue, $q)) {
            if ($hint === '') {
                $hint = "<a href='" . $z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
            } else {
                $hint .= "<br /><a href='" . $z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
            }
        }
    }
}

echo $hint === '' ? "no suggestion" : $hint;
?>
