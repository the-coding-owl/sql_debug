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
 * EntityRepository
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
    public function findByDate(\DateTime $date) {
        $query = $this->createQuery();
        return $query->matching($query->greaterThan('timestampDate', $date))->execute();
    }
}
