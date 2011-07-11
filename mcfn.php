#!/usr/bin/php
<?php

$magentoProjectPath = getcwd();
$packageName = ucfirst($argv[1]);
$moduleName = ucfirst($argv[2]);
$frontName = $argv[3];
$frontNameLowercase = strtolower($frontName);

$configPath = "$magentoProjectPath/app/etc/config.xml";
$configAsString = file_get_contents($configPath);

$config = new SimpleXMLElement($configAsString);
$config->frontend->routers->$frontNameLowercase->use = 'standard';
$config->frontend->routers->$frontNameLowercase->args->module = "${packageName}_${moduleName}";
$config->frontend->routers->$frontNameLowercase->args->frontName = $frontName;

$tidyConfig = array(
	'indent' => true,
	'indent-spaces' => 4,
	'input-xml' => true,
	'output-xml' => true,
);
$tidy = tidy_parse_string($config->asXML(), $tidyConfig, 'utf8');
$tidy->cleanRepair();

// update $config with the new tidy data
$config = simplexml_load_string($tidy);

// write it out
$config->asXML($configPath);

echo "* Added/updated Magento frontend route/FrontName: $frontName => ${packageName}_${moduleName}\n";
