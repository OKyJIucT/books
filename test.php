<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.02.2015
 * Time: 12:00
 */

$xml = '<?xml version="1.0" encoding="UTF-8"?>
	<items>
		<item>
			<id>Order Number</id>
			<status>STATUS NUMBER</status>
		</item>
		<item>
			<id>Order Number</id>
			<status>STATUS NUMBER</status>
		</item>
	</items>';

$result = simplexml_load_string($xml);

foreach ($result->item as $item) {
    echo $item->id . ' - ' . $item->status . '<br />';
}