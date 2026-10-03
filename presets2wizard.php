<?php

$presets = file_get_contents('presets.json');
$json = json_decode($presets, false);

$xml = new SimpleXMLElement('<root/>');

$wizard = $xml->addChild('wizard');
$wizard->addAttribute('bezeichnung', 'Wizard');

foreach ($json as $group) {
    foreach ($group->items as $item) {
        $node = $wizard->addChild('connection');
        $node->addAttribute('bezeichnung', (string)$item->name);
        $node->addAttribute('maxupload', (string)round($item->upload * 1000 / 8 / 1024));
        $node->addAttribute('maxdownload', '0');
        $node->addAttribute('maxnewconnections10', '50');
    }
}

$xml->saveXML('wizard.xml');
