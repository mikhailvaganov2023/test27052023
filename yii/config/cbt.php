<?php

$dbName = YII_ENV_TEST ? $_ENV['DB_DATABASE_TEST'] : $_ENV['DB_CBT_DATABASE'];
$port = $_ENV['DB_CBT_PORT'] ?? 3306;

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$_ENV['DB_CBT_HOST']};port={$port};dbname={$dbName}",
    'username' => $_ENV['DB_CBT_USERNAME'],
    'password' => $_ENV['DB_CBT_PASSWORD'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => $_ENV['DB_CBT_SCHEMA_CACHE_DURATION'],
    'schemaCache' => 'db-schema-cache',
];
