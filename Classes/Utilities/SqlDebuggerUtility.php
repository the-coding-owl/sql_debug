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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This class contains a static function to debug extbase QueryResult objects via the Doctrine SQLLogger
 *
 * @author Kevin Ditscheid <kevinditscheid@gmail.com>
 */
class SqlDebuggerUtility {
    /**
     * Dump the SQL queries of a QueryReult object
     * Returns an array of queries that had been executed
     * Set the $dumpQueries parameter to FALSE, if you want to not dump the queries via DebuggerUtility::var_dump
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult The QueryResult object to debug
     * @param bool $dumpQueries Set to TRUE if the queries should be dumped via DebuggerUtility::var_dump, FALSE otherwise
     *
     * @return array
     */
    static public function debugQueryResult(QueryResultInterface $queryResult, $dumpQueries = TRUE): array{
        $className = $queryResult->getQuery()->getType();
        $dataMapper = GeneralUtility::makeInstance(DataMapper::class);
        $tableName = $dataMapper->getDataMap($className)->getTableName();
        // create a new logger for the database queries to log
        $logger = new \Doctrine\DBAL\Logging\DebugStack();
        // get the Docrine Connection configuration object
        $connectionConfiguration = static::getConnectionPool()->getConnectionForTable($tableName)->getConfiguration();
        // backup the current logger
        $loggerBackup = $connectionConfiguration->getSQLLogger();
        // set our logger as the active logger object of the Doctrine connection
        $connectionConfiguration->setSQLLogger($logger);
        // we need to fetch our results here, to enable doctrine to fetch the results
        $queryResult->toArray();
        // restore the old logger
        $connectionConfiguration->setSQLLogger($loggerBackup);
        if( $dumpQueries ){
            DebuggerUtility::var_dump($logger->queries, 'SQL queries');
        }
        return $logger->queries;
    }
    
    /**
     * Get the ConnectionPool object
     *
     * @return \TYPO3\CMS\Core\Database\ConnectionPool
     */
    static protected function getConnectionPool(): ConnectionPool{
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
