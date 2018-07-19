<?php

return [	
	'' => [
		'controller' => 'index',
		'action' => 'index',
	],
	'api/productsall' => [
		'controller' => 'products',
		'action' => 'readall',
	],
	'api/product/{id:\d+}' => [
		'controller' => 'products',
		'action' => 'readone',
	],
	'api/productscategory/{id:\d+}' => [
		'controller' => 'products',
		'action' => 'readcategory'
	],
	'api/productscategoryall/{id:\d+}' => [
		'controller' => 'products',
		'action' => 'readcategoryall'
	],
	'api/productsmanufacturer/{m:[a-zA-Z_&]*}' => [
		'controller' => 'products',
		'action' => 'readmanufacturer'
	],
	'api/productsearch/{s:[a-zA-Z]*}' => [
		'controller' => 'products',
		'action' => 'readsearch'
	]
];