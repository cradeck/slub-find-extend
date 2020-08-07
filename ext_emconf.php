<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "slub_find_extend"
 *
 * Auto generated by Extension Builder 2015-03-18
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Find configuration for SLUB Catalog',
	'description' => '',
	'category' => 'plugin',
	'author' => '',
	'author_email' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.1.0',
    'autoload' =>
        array(
            'psr-4' =>
                array(
                    'Slub\\SlubFindExtend\\' => 'Classes'
                )
        ),
	'constraints' => array(
		'depends' => array(
            'php' => '5.5.0-7.3.99',
            'typo3' => '6.2.0-9.5.99'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
