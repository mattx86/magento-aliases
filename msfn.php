#!/usr/bin/php
<?php

$magentoProjectPath = getcwd();

$configPath = "$magentoProjectPath/app/etc/config.xml";
$configAsString = file_get_contents($configPath);

$config = new SimpleXMLElement($configAsString);

$routers = &$config->frontend->routers;
echo "* Listing frontend frontnames:\n\n";
foreach ($routers as $router)
{
  foreach ($router as $router2)
  {
    $module = $router2->args->module;
    $frontName = $router2->args->frontName;

    echo "    ${frontName} => ${module}\n";
  }
}
