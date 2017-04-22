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

namespace TheCodingOwl\SqlDebug\Domain\Repository;

/**
 * Description of EntityRepository
 *
 * @author Kevin Ditscheid <kevinditscheid@gmail.com>
 */
class EntityRepository extends \TYPO3\CMS\Extbase\Persistence\Repository{
    /**
     * Find entities by a given DateTime object
     *
     * @param \DateTime $date The DateTime to filter by
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByDate(\DateTime $date): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface{
        $query = $this->createQuery();
        $queryResult = $query->matching($query->greaterThan('timestampDate', $date))->execute();
        
        // create a new logger for the database queries to log
        $logger = new \Doctrine\DBAL\Logging\EchoSQLLogger();
        // get the Docrine Connection configuration object
        $connectionConfiguration = $this->getConnectionPool()->getConnectionForTable('tx_sqldebug_domain_model_entity')->getConfiguration();
        // backup the current logger
        $loggerBackup = $connectionConfiguration->getSQLLogger();
        // set our logger as the active logger object of the Doctrine connection
        $connectionConfiguration->setSQLLogger($logger);
        // we need to fetch our results here, to enable doctrine to fetch the results
        $entities = $queryResult->toArray();
        // restore the old logger
        $connectionConfiguration->setSQLLogger($loggerBackup);
        return $queryResult;
    }
    /**
     * Get the ConnectionPool object
     *
     * @return \TYPO3\CMS\Core\Database\ConnectionPool
     */
    protected function getConnectionPool(): \TYPO3\CMS\Core\Database\ConnectionPool{
        return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class);
    }
}
