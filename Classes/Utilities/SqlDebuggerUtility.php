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

namespace TheCodingOwl\SqlDebug\Utilities;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This class contains a static function to debug extbase QueryResult objects
 *
 * @author Kevin Ditscheid <kevinditscheid@gmail.com>
 */
class SqlDebuggerUtility {
    
    /**
     * Backed up configuration values of the DatabaseConnection
     *
     * @var array
     */
    static protected $backupConfig;
    
    /**
     * Dump the SQL queries of a QueryReult object
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult The QueryResult object to debug
     * @param bool $explainOutput Set to TRUE if you want the queries to be explained
     *
     * @return array
     */
    static public function debugQueryResult(QueryResultInterface $queryResult, $explainOutput = TRUE){
        $db = self::getDatabaseConnection();
        self::backupConfig($db);
        $db->debugOuput = 2;
        $db->store_lastBuiltQuery = true;
        $db->explainOutput = $explainOutput;
        $queryResult->toArray();
        DebuggerUtility::var_dump($db->debug_lastBuiltQuery);
        self::restoreConfig($db);
    }
    
    /**
     * Backup the DatabaseConnection values debugOutput, store_lastBuiltQuery and explainOutput
     *
     * @param \TYPO3\CMS\Core\Database\DatabaseConnection $db The DatabaseConnection aka TYPO3_DB
     */
    static protected function backupConfig(\TYPO3\CMS\Core\Database\DatabaseConnection $db){
        self::$backupConfig = [
            'debugOutput' => $db->debugOutput,
            'store_lastBuiltQuery' => $db->store_lastBuiltQuery,
            'explainOutput' => $db->explainOutput
        ];
    }
    
    /**
     * Restore the DatabaseConnection values debugOutput, store_lastBuiltQuery and explainOutput
     *
     * @param \TYPO3\CMS\Core\Database\DatabaseConnection $db The DatabaseConnection aka TYPO3_DB
     */
    static protected function restoreConfig(\TYPO3\CMS\Core\Database\DatabaseConnection $db){
        $db->debugOutput = self::$backupConfig['debugOutput'];
        $db->store_lastBuiltQuery = self::$backupConfig['store_lastBuiltQuery'];
        $db->explainOutput = self::$backupConfig['explainOutput'];
    }
    
    /**
     * Get the old DatabaseConnection
     *
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    static protected function getDatabaseConnection() {
        return GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\DatabaseConnection::class);
    }
}
