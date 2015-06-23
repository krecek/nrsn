<?php //netteCache[01]000350a:2:{s:4:"time";s:21:"0.89255400 1433411246";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:51:"/home/svn/repos/gymfed/trunk/app/config/config.neon";i:2;i:1433338894;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:57:"/home/svn/repos/gymfed/trunk/app/config/config.local.neon";i:2;i:1375116221;}}}?><?php
// source: /home/svn/repos/gymfed/trunk/app/config/config.neon production
// source: /home/svn/repos/gymfed/trunk/app/config/config.local.neon 

/**
 * @property AkceRepository $akceRepository
 * @property Akce_prilohyRepository $akce_prilohyRepository
 * @property NApplication $application
 * @property Authenticator $authenticator
 * @property BankaRepository $bankaRepository
 * @property NFileStorage $cacheStorage
 * @property ClankyRepository $clankyRepository
 * @property NDINestedAccessor $constants
 * @property NDIContainer $container
 * @property EvidenceRepository $evidenceRepository
 * @property NHttpRequest $httpRequest
 * @property NHttpResponse $httpResponse
 * @property ImportOsob $importOsob
 * @property KategorieRepository $kategorieRepository
 * @property KrajeRepository $krajeRepository
 * @property Logger $logger
 * @property MenuRepository $menuRepository
 * @property SystemContainer_nette $nette
 * @property OddilyRepository $oddilyRepository
 * @property OdeslaniMailu $odeslaniMailu
 * @property OsobyRepository $osobyRepository
 * @property NDINestedAccessor $php
 * @property Opravneni $prava
 * @property PrihlaskyRepository $prihlaskyRepository
 * @property Prilohy $prilohy
 * @property ProfilyRepository $profilyRepository
 * @property Redakce $redakce
 * @property Registrace $registrace
 * @property RegistraceRepository $registraceRepository
 * @property NRouteList $router
 * @property RubrikyRepository $rubrikyRepository
 * @property NSession $session
 * @property SeznamJmen $seznamJmen
 * @property SportyRepository $sportyRepository
 * @property SpravceAkci $spravceAkci
 * @property SpravcePrihlasek $spravcePrihlasek
 * @property SpravcePrilohZavodu $spravcePrilohZavodu
 * @property SpravceProfilu $spravceProfilu
 * @property SpravceVysledkuXml $spravceVysledkuXml
 * @property Statistika $statistika
 * @property NUser $user
 * @property VysledkyRepository $vysledkyRepository
 */
class SystemContainer extends NDIContainer
{

	public $classes = array(
		'nobject' => FALSE, //: nette.cacheJournal, cacheStorage, nette.httpRequestFactory, httpRequest, httpResponse, nette.httpContext, session, nette.userStorage, user, application, nette.presenterFactory, router, nette.mailer, nette.database, akceRepository, akce_prilohyRepository, importOsob, kategorieRepository, prihlaskyRepository, profilyRepository, odeslaniMailu, vysledkyRepository, statistika, registraceRepository, evidenceRepository, prava, oddilyRepository, logger, osobyRepository, registrace, krajeRepository, menuRepository, redakce, rubrikyRepository, clankyRepository, sportyRepository, bankaRepository, authenticator, container,
		'icachejournal' => 'nette.cacheJournal',
		'nfilejournal' => 'nette.cacheJournal',
		'icachestorage' => 'cacheStorage',
		'nfilestorage' => 'cacheStorage',
		'nhttprequestfactory' => 'nette.httpRequestFactory',
		'ihttprequest' => 'httpRequest',
		'nhttprequest' => 'httpRequest',
		'ihttpresponse' => 'httpResponse',
		'nhttpresponse' => 'httpResponse',
		'nhttpcontext' => 'nette.httpContext',
		'nsession' => 'session',
		'iuserstorage' => 'nette.userStorage',
		'nuserstorage' => 'nette.userStorage',
		'nuser' => 'user',
		'napplication' => 'application',
		'ipresenterfactory' => 'nette.presenterFactory',
		'npresenterfactory' => 'nette.presenterFactory',
		'narraylist' => 'router',
		'traversable' => 'router',
		'iteratoraggregate' => 'router',
		'countable' => 'router',
		'arrayaccess' => 'router',
		'irouter' => 'router',
		'nroutelist' => 'router',
		'imailer' => 'nette.mailer',
		'nsendmailmailer' => 'nette.mailer',
		'ndinestedaccessor' => 'nette.database',
		'pdo' => 'nette.database.default',
		'nconnection' => 'nette.database.default',
		'repository' => FALSE, //: akceRepository, akce_prilohyRepository, kategorieRepository, prihlaskyRepository, profilyRepository, vysledkyRepository, registraceRepository, evidenceRepository, prava, oddilyRepository, osobyRepository, krajeRepository, menuRepository, rubrikyRepository, clankyRepository, sportyRepository, bankaRepository,
		'akcerepository' => 'akceRepository',
		'akce_prilohyrepository' => 'akce_prilohyRepository',
		'spravceakci' => 'spravceAkci',
		'spravcepriloh' => FALSE, //: spravcePrilohZavodu, spravceProfilu, prilohy,
		'spravcesouboru' => FALSE, //: spravcePrilohZavodu, spravceProfilu, spravceVysledkuXml, prilohy,
		'spravceprilohzavodu' => 'spravcePrilohZavodu',
		'importosob' => 'importOsob',
		'seznamjmen' => 'seznamJmen',
		'kategorierepository' => 'kategorieRepository',
		'prihlaskyrepository' => 'prihlaskyRepository',
		'profilyrepository' => 'profilyRepository',
		'odeslanimailu' => 'odeslaniMailu',
		'spravceprofilu' => 'spravceProfilu',
		'spravcevysledkuxml' => 'spravceVysledkuXml',
		'vysledkyrepository' => 'vysledkyRepository',
		'spravceprihlasek' => 'spravcePrihlasek',
		'statistika' => 'statistika',
		'prilohy' => 'prilohy',
		'registracerepository' => 'registraceRepository',
		'evidencerepository' => 'evidenceRepository',
		'opravneni' => 'prava',
		'oddilyrepository' => 'oddilyRepository',
		'logger' => 'logger',
		'osobyrepository' => 'osobyRepository',
		'registrace' => 'registrace',
		'krajerepository' => 'krajeRepository',
		'menurepository' => 'menuRepository',
		'redakce' => 'redakce',
		'rubrikyrepository' => 'rubrikyRepository',
		'clankyrepository' => 'clankyRepository',
		'sportyrepository' => 'sportyRepository',
		'bankarepository' => 'bankaRepository',
		'iauthenticator' => 'authenticator',
		'authenticator' => 'authenticator',
		'nfreezableobject' => 'container',
		'ifreezable' => 'container',
		'idicontainer' => 'container',
		'ndicontainer' => 'container',
	);

	public $meta = array();


	public function __construct()
	{
		parent::__construct(array(
			'appDir' => '/home/svn/repos/gymfed/trunk/app',
			'wwwDir' => '/home/svn/repos/gymfed/trunk/www',
			'debugMode' => FALSE,
			'productionMode' => TRUE,
			'environment' => 'production',
			'consoleMode' => FALSE,
			'container' => array(
				'class' => 'SystemContainer',
				'parent' => 'NDIContainer',
			),
			'tempDir' => '/home/svn/repos/gymfed/trunk/app/../temp',
			'mail' => array(
				'from' => 'robot@gymfed.cz',
				'reply_to' => 'gis@gymfed.cz',
			),
			'debug' => array(
				'compatibility' => TRUE,
			),
			'logger' => array(
				'file' => '../log/gis.log',
				'ident' => 'auto',
				'date' => 'auto',
				'conv' => 'auto',
			),
			'config' => array(
				'debug' => '`($_SERVER["HTTP_HOST"] == "gis.drino.net" || $_SERVER["HTTP_HOST"]=="gymfed.drino.net")`',
			),
			'prihlasovaci_stranka' => 'https://gis.gymfed.cz/login/',
			'mesic_otevreni_registraci_pro_pristi_rok' => 12,
			'admin_nove_registrace' => 'vojackova@gymfed.cz,sarichev@gymfed.cz,jana@satoya.cz',
			'admin_duplicitni_registrace' => 'churavy@gymfed.cz,jana@satoya.cz',
			'admin_databaze' => 'jana@satoya.cz',
			'admin_nova_akce' => 'akce@gymfed.cz',
			'adresa' => 'gis.gymfed.cz',
			'rubriky' => array(
				'SGM' => 2,
				'SGZ' => 3,
				'TG' => 4,
				'AE' => 5,
				'AG' => 6,
				'TR' => 7,
				'OS' => 8,
				'VG' => 9,
			),
		));
	}


	/**
	 * @return AkceRepository
	 */
	protected function createServiceAkceRepository()
	{
		$service = new AkceRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return Akce_prilohyRepository
	 */
	protected function createServiceAkce_prilohyRepository()
	{
		$service = new Akce_prilohyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NApplication
	 */
	protected function createServiceApplication()
	{
		$service = new NApplication($this->getService('nette.presenterFactory'), $this->getService('router'), $this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->catchExceptions = TRUE;
		$service->errorPresenter = 'Error';
		NRoutingDebugger::initializePanel($service);
		return $service;
	}


	/**
	 * @return Authenticator
	 */
	protected function createServiceAuthenticator()
	{
		$service = new Authenticator($this->getService('osobyRepository'));
		return $service;
	}


	/**
	 * @return BankaRepository
	 */
	protected function createServiceBankaRepository()
	{
		$service = new BankaRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NFileStorage
	 */
	protected function createServiceCacheStorage()
	{
		$service = new NFileStorage('/home/svn/repos/gymfed/trunk/app/../temp/cache', $this->getService('nette.cacheJournal'));
		return $service;
	}


	/**
	 * @return ClankyRepository
	 */
	protected function createServiceClankyRepository()
	{
		$service = new ClankyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NDINestedAccessor
	 */
	protected function createServiceConstants()
	{
		$service = new NDINestedAccessor($this, 'constants');
		return $service;
	}


	/**
	 * @return NDIContainer
	 */
	protected function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return EvidenceRepository
	 */
	protected function createServiceEvidenceRepository()
	{
		$service = new EvidenceRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NHttpRequest
	 */
	protected function createServiceHttpRequest()
	{
		$service = $this->getService('nette.httpRequestFactory')->createHttpRequest();
		if (!$service instanceof NHttpRequest) {
			throw new UnexpectedValueException('Unable to create service \'httpRequest\', value returned by factory is not NHttpRequest type.');
		}
		return $service;
	}


	/**
	 * @return NHttpResponse
	 */
	protected function createServiceHttpResponse()
	{
		$service = new NHttpResponse;
		return $service;
	}


	/**
	 * @return ImportOsob
	 */
	protected function createServiceImportOsob()
	{
		$service = new ImportOsob($this->getService('seznamJmen'));
		return $service;
	}


	/**
	 * @return KategorieRepository
	 */
	protected function createServiceKategorieRepository()
	{
		$service = new KategorieRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return KrajeRepository
	 */
	protected function createServiceKrajeRepository()
	{
		$service = new KrajeRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return Logger
	 */
	protected function createServiceLogger()
	{
		$service = new Logger('../log/gis.log');
		return $service;
	}


	/**
	 * @return MenuRepository
	 */
	protected function createServiceMenuRepository()
	{
		$service = new MenuRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NDINestedAccessor
	 */
	protected function createServiceNette()
	{
		$service = new NDINestedAccessor($this, 'nette');
		return $service;
	}


	/**
	 * @return NForm
	 */
	public function createNette__basicForm()
	{
		$service = new NForm;
		return $service;
	}


	/**
	 * @return NCallback
	 */
	protected function createServiceNette__basicFormFactory()
	{
		$service = new NCallback($this, 'createNette__basicForm');
		return $service;
	}


	/**
	 * @return NCache
	 */
	public function createNette__cache($namespace = NULL)
	{
		$service = new NCache($this->getService('cacheStorage'), $namespace);
		return $service;
	}


	/**
	 * @return NCallback
	 */
	protected function createServiceNette__cacheFactory()
	{
		$service = new NCallback($this, 'createNette__cache');
		return $service;
	}


	/**
	 * @return NFileJournal
	 */
	protected function createServiceNette__cacheJournal()
	{
		$service = new NFileJournal('/home/svn/repos/gymfed/trunk/app/../temp');
		return $service;
	}


	/**
	 * @return NDINestedAccessor
	 */
	protected function createServiceNette__database()
	{
		$service = new NDINestedAccessor($this, 'nette.database');
		return $service;
	}


	/**
	 * @return NConnection
	 */
	protected function createServiceNette__database__default()
	{
		$service = new NConnection('mysql:host=sql.satoya.cz;dbname=gymfed', 'gymfed', 'PxPSXn2G7dB5bCwZ', NULL);
		$service->setCacheStorage($this->getService('cacheStorage'));
		NDebugger::$blueScreen->addPanel('NDatabasePanel::renderException');
		$service->setDatabaseReflection(new NDiscoveredReflection($this->getService('cacheStorage')));
		return $service;
	}


	/**
	 * @return NHttpContext
	 */
	protected function createServiceNette__httpContext()
	{
		$service = new NHttpContext($this->getService('httpRequest'), $this->getService('httpResponse'));
		return $service;
	}


	/**
	 * @return NHttpRequestFactory
	 */
	protected function createServiceNette__httpRequestFactory()
	{
		$service = new NHttpRequestFactory;
		$service->setEncoding('UTF-8');
		return $service;
	}


	/**
	 * @return NLatteFilter
	 */
	public function createNette__latte()
	{
		$service = new NLatteFilter;
		return $service;
	}


	/**
	 * @return NCallback
	 */
	protected function createServiceNette__latteFactory()
	{
		$service = new NCallback($this, 'createNette__latte');
		return $service;
	}


	/**
	 * @return NMail
	 */
	public function createNette__mail()
	{
		$service = new NMail;
		$service->setMailer($this->getService('nette.mailer'));
		return $service;
	}


	/**
	 * @return NCallback
	 */
	protected function createServiceNette__mailFactory()
	{
		$service = new NCallback($this, 'createNette__mail');
		return $service;
	}


	/**
	 * @return NSendmailMailer
	 */
	protected function createServiceNette__mailer()
	{
		$service = new NSendmailMailer;
		return $service;
	}


	/**
	 * @return NPresenterFactory
	 */
	protected function createServiceNette__presenterFactory()
	{
		$service = new NPresenterFactory('/home/svn/repos/gymfed/trunk/app', $this);
		return $service;
	}


	/**
	 * @return NFileTemplate
	 */
	public function createNette__template()
	{
		$service = new NFileTemplate;
		$service->registerFilter($this->createNette__latte());
		$service->registerHelperLoader('NTemplateHelpers::loader');
		return $service;
	}


	/**
	 * @return NPhpFileStorage
	 */
	protected function createServiceNette__templateCacheStorage()
	{
		$service = new NPhpFileStorage('/home/svn/repos/gymfed/trunk/app/../temp/cache', $this->getService('nette.cacheJournal'));
		return $service;
	}


	/**
	 * @return NCallback
	 */
	protected function createServiceNette__templateFactory()
	{
		$service = new NCallback($this, 'createNette__template');
		return $service;
	}


	/**
	 * @return NUserStorage
	 */
	protected function createServiceNette__userStorage()
	{
		$service = new NUserStorage($this->getService('session'));
		return $service;
	}


	/**
	 * @return OddilyRepository
	 */
	protected function createServiceOddilyRepository()
	{
		$service = new OddilyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return OdeslaniMailu
	 */
	protected function createServiceOdeslaniMailu()
	{
		$service = new OdeslaniMailu('robot@gymfed.cz', 'jana@satoya.cz', 'gis@gymfed.cz');
		$service->setDebugMode(FALSE);
		return $service;
	}


	/**
	 * @return OsobyRepository
	 */
	protected function createServiceOsobyRepository()
	{
		$service = new OsobyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NDINestedAccessor
	 */
	protected function createServicePhp()
	{
		$service = new NDINestedAccessor($this, 'php');
		return $service;
	}


	/**
	 * @return Opravneni
	 */
	protected function createServicePrava()
	{
		$service = new Opravneni($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return PrihlaskyRepository
	 */
	protected function createServicePrihlaskyRepository()
	{
		$service = new PrihlaskyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return Prilohy
	 */
	protected function createServicePrilohy()
	{
		$service = new Prilohy;
		return $service;
	}


	/**
	 * @return ProfilyRepository
	 */
	protected function createServiceProfilyRepository()
	{
		$service = new ProfilyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return Redakce
	 */
	protected function createServiceRedakce()
	{
		$service = new Redakce($this->getService('rubrikyRepository'), $this->getService('clankyRepository'), $this->getService('prilohy'), $this->getService('menuRepository'), $this->getService('prava'), $this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return Registrace
	 */
	protected function createServiceRegistrace()
	{
		$service = new Registrace($this->getService('evidenceRepository'), $this->getService('registraceRepository'), $this->getService('bankaRepository'), $this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return RegistraceRepository
	 */
	protected function createServiceRegistraceRepository()
	{
		$service = new RegistraceRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NRouteList
	 */
	protected function createServiceRouter()
	{
		$service = new NRouteList;
		return $service;
	}


	/**
	 * @return RubrikyRepository
	 */
	protected function createServiceRubrikyRepository()
	{
		$service = new RubrikyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NSession
	 */
	protected function createServiceSession()
	{
		$service = new NSession($this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->setExpiration('14 days');
		return $service;
	}


	/**
	 * @return SeznamJmen
	 */
	protected function createServiceSeznamJmen()
	{
		$service = new SeznamJmen;
		return $service;
	}


	/**
	 * @return SportyRepository
	 */
	protected function createServiceSportyRepository()
	{
		$service = new SportyRepository($this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return SpravceAkci
	 */
	protected function createServiceSpravceAkci()
	{
		$service = new SpravceAkci($this->getService('prava'), $this->getService('akceRepository'), $this->getService('oddilyRepository'), $this->getService('osobyRepository'), $this->getService('akce_prilohyRepository'), $this->getService('spravcePrilohZavodu'), $this->getService('kategorieRepository'), $this->getService('krajeRepository'));
		return $service;
	}


	/**
	 * @return SpravcePrihlasek
	 */
	protected function createServiceSpravcePrihlasek()
	{
		$service = new SpravcePrihlasek($this->getService('akceRepository'), $this->getService('osobyRepository'), $this->getService('kategorieRepository'), $this->getService('registrace'), $this->getService('prihlaskyRepository'));
		return $service;
	}


	/**
	 * @return SpravcePrilohZavodu
	 */
	protected function createServiceSpravcePrilohZavodu()
	{
		$service = new SpravcePrilohZavodu;
		return $service;
	}


	/**
	 * @return SpravceProfilu
	 */
	protected function createServiceSpravceProfilu()
	{
		$service = new SpravceProfilu;
		return $service;
	}


	/**
	 * @return SpravceVysledkuXml
	 */
	protected function createServiceSpravceVysledkuXml()
	{
		$service = new SpravceVysledkuXml;
		return $service;
	}


	/**
	 * @return Statistika
	 */
	protected function createServiceStatistika()
	{
		$service = new Statistika($this->getService('evidenceRepository'), $this->getService('registraceRepository'), $this->getService('osobyRepository'), $this->getService('oddilyRepository'), $this->getService('nette.database.default'));
		return $service;
	}


	/**
	 * @return NUser
	 */
	protected function createServiceUser()
	{
		$service = new NUser($this->getService('nette.userStorage'), $this);
		return $service;
	}


	/**
	 * @return VysledkyRepository
	 */
	protected function createServiceVysledkyRepository()
	{
		$service = new VysledkyRepository($this->getService('nette.database.default'));
		return $service;
	}


	public function initialize()
	{
		date_default_timezone_set('Europe/Prague');
		NFileStorage::$useDirectories = TRUE;

		$this->getService("session")->exists() && $this->getService("session")->start();
		header('X-Frame-Options: SAMEORIGIN');
	}

}



/**
 * @property NConnection $default
 */
class SystemContainer_nette_database
{



}



/**
 * @method NForm createBasicForm()
 * @property NCallback $basicFormFactory
 * @method NCache createCache()
 * @property NCallback $cacheFactory
 * @property NFileJournal $cacheJournal
 * @property SystemContainer_nette_database $database
 * @property NHttpContext $httpContext
 * @method NLatteFilter createLatte()
 * @property NCallback $latteFactory
 * @method NMail createMail()
 * @property NCallback $mailFactory
 * @property NSendmailMailer $mailer
 * @property NPresenterFactory $presenterFactory
 * @method NFileTemplate createTemplate()
 * @property NPhpFileStorage $templateCacheStorage
 * @property NCallback $templateFactory
 * @property NUserStorage $userStorage
 */
class SystemContainer_nette
{



}
