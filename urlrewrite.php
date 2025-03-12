<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/doors/filter/(.+?)/apply/\\??(.*)#',
    'RULE' => 'SMART_FILTER_PATH=$1&$2',
    'ID' => 'bitrix:catalog.smart.filter',
    'PATH' => '/doors/index.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/objects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/objects/index.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/gallery/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/gallery/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/service/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/service/index.php',
    'SORT' => 100,
  ),
  38 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/info/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/index.php',
    'SORT' => 100,
  ),
  37 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
