<?php
include('../vendor/autoload.php');
include('../model/User.php');
include('../model/BlogPost.php');

define('BASE_DIR', dirname( __DIR__ ));

$dbName = 'insight-doctrine-odm-errors';
$dbURI = 'localhost';


$mongo = new MongoClient('mongodb://' . $dbURI. '/'.$dbName);

\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();
$config = new Doctrine\ODM\MongoDB\Configuration();
$config->setHydratorDir(BASE_DIR . '/var/tmp/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setProxyDir(BASE_DIR . '/var/tmp/Proxies');
$config->setProxyNamespace('Proxies');
$config->setMetadataDriverImpl(Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create(BASE_DIR.'/model'));

$connection = new Doctrine\MongoDB\Connection($mongo);

$config->setDefaultDB($dbName);
$documentManager = Doctrine\ODM\MongoDB\DocumentManager::create($connection,$config);
$documentManager->getSchemaManager()->ensureIndexes();



$user = new User('FirstUser');

$blogPost = new BlogPost('ArticelNumberOne');

$user->addPost($blogPost);

$documentManager->persist($user);
$documentManager->persist($blogPost);

$documentManager->flush();

echo 'In you DB are '. $documentManager->getDocumentCollection('User')->count(). ' Users <br>';
echo 'And ' . $documentManager->getDocumentCollection('BlogPost')->count(). ' BlogPosts<br>';

