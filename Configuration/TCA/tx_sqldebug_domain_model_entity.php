<?php

/* 
 * This file is part of the TYPO3 CMS project.
 * 
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 * 
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * 
 * The TYPO3 project - inspiring people to share!
 */

defined('TYPO3_MODE') or die('Access denied!');

$ll = 'LLL:EXT:sql_debug/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $ll.'tx_sqldebug_domain_model_entity',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'searchFields' => 'title',
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden,title,real_date,timestamp_date',
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'title' => [
            'exclude' => 0,
            'label' => $ll.'tx_sqldebug_domain_model_entity.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => ''
            ]
        ],
        'real_date' => [
            'exclude' => 1,
            'label' => $ll.'tx_sqldebug_domain_model_entity.real_date',
            'config' => [
                'type' => 'input',
                'eval' => 'date'
            ]
        ],
        'timestamp_date' => [
            'exclude' => 1,
            'label' => $ll.'tx_sqldebug_domain_model_entity.timestamp_date',
            'config' => [
                'type' => 'input',
                'eval' => 'date'
            ]
        ]
    ],
    'types' => [
        0 => [
            'showitem' => 'hidden,title,real_date,timestamp_date'
        ]
    ],
    'palettes' => [
    ],
];
