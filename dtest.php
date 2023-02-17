<?php
/**
 * Plugin Name: Dtest
 * Description: Testing doctrine
 * Requires at least: 6.1
 * Requires PHP: 8.1
 * Version: 1.0.0
 * Author: Bruno Ribaric
 */

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

define( 'DTEST_PLUGIN_FILE', __FILE__ );

require 'vendor/autoload.php';

function dtest_get_entity_manager() {
	static $entityManager;

	if ( ! empty( $entityManager ) ) {
		return $entityManager;
	}

	$config = ORMSetup::createAttributeMetadataConfiguration(
		paths: array( __DIR__ . '/src' ),
		isDevMode: true,
	);

	$connection = DriverManager::getConnection(
		array(
			'driver'   => 'pdo_mysql',
			'dbname'   => DB_NAME,
			'user'     => DB_USER,
			'password' => DB_PASSWORD,
			'host'     => DB_HOST,
		),
		$config
	);

	$entityManager = new EntityManager( $connection, $config );

	return $entityManager;
}

function dtest_init() {
	$wputm = new \WpUtm\Main(
		array(
			'definitions' => array(
				\WpUtm\Interfaces\IDynamicCss::class => \DI\create( \Dtest\DynamicCss::class ),
				\WpUtm\Interfaces\IDynamicJs::class  => \DI\create( \Dtest\DynamicJs::class ),
				'main_file'                          => DTEST_PLUGIN_FILE,
				'type'                               => 'plugin',
				'prefix'                             => 'dtest',
			),
		)
	);

	$wputm->get( \Dtest\Main::class )->init();
}

dtest_init();
