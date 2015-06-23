<?php

// Load Nette Framework or autoloader generated by Composer
require dirname(__FILE__) . '/../libs/autoload.php';

ini_set('error_reporting', 1);
$configurator = new NConfigurator;

// Enable Nette Debugger for error visualisation & logging
//if ($_SERVER['HTTP_HOST'] == 'gis.drino.net' || $_SERVER['HTTP_HOST']=='gymfed.drino.net') {
  $configurator->setDebugMode(TRUE);
  $configurator->addParameters(array("environment" => 'development'));
//}
$configurator->enableDebugger(dirname(__FILE__) . '/../log');

// Specify folder for cache
$configurator->setTempDirectory(dirname(__FILE__) . '/../temp');

// Enable RobotLoader - this will load all classes automatically
$configurator->createRobotLoader()
	->addDirectory(dirname(__FILE__))
	->addDirectory(dirname(__FILE__) . '/../libs')
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(dirname(__FILE__) . '/config/config.neon');
$configurator->addConfig(dirname(__FILE__) . '/config/config.local.neon', NConfigurator::NONE); // none section
$container = $configurator->createContainer();

//////////////////
function dd($var, $name = null)
{
    return NDebugger::barDump($var, $name);
}
/////////////////

// Nastavi priznak NRoute::SECURED, pokud prichazime pres HTTPS
//NRoute::$defaultFlags |= ($container->getService('httpRequest')->isSecured() ? NRoute::SECURED : 0);
//    if(preg_match('~.*\.drino\.net~', $_SERVER['HTTP_HOST'])) $domena = "gymfed.drino.net";
//    else $domena = "www.gymfed.cz";

    	$container->router[] = $adminRouter = new NRouteList('Admin');
        $adminRouter[] = new NRoute('admin/<presenter>/<action>[/<id>]', 'Homepage:default');
        $container->router[] = $webRouter = new NRouteList('Web');
        $webRouter[] = new NRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
//        $webRouter[] = new NRoute("//$domena/adresar/<action>[/<id>]", 'Adresar:default');
//        $webRouter[] = new NRoute("//$domena/osoby/<id>", 'Osoby:default');
//        $webRouter[] = new NRoute("//$domena/vyhledat/[<text>]", 'Vyhledat:default');
//        $webRouter[] = new NRoute("//$domena/archiv/[<rok>]", 'Archiv:default');
//        $webRouter[] = new NRoute("//$domena/aplikace/[<id>]", 'Aplikace:default');
//        $webRouter[] = new NRoute("//$domena/kalendar/<action>[/<id>]", 'Kalendar:default');
//        $webRouter[] = new NRoute("//$domena/vysledky/<action>[/<id>]", 'Vysledky:default');
//        $webRouter[] = new NRoute("//$domena/<id>.html", 'Clanky:default');
//        $webRouter[] = new NRoute("//$domena/rss", 'Homepage:rss');
//        $webRouter[] = new NRoute("//$domena/<id .+>/", 'Homepage:rubriky');
//        $webRouter[] = new NRoute("//$domena/<presenter>/<action>[/<id>]", 'Homepage:default');




return $container;