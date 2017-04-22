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

namespace TheCodingOwl\SqlDebug\Domain\Model;

/**
 * Description of Entity
 *
 * @author Kevin Ditscheid <kevinditscheid@gmail.com>
 */
class Entity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity{
    /**
     * The title of the record
     *
     * @var string
     */
    protected $title;
    /**
     * A date field with a real datetime type in database
     *
     * @var \DateTime
     */
    protected $realDate;
    /**
     * A date field with an integer field as type in database
     *
     * @var \DateTime
     */
    protected $timestampDate;
    
    /**
     * Get the title
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Get the real date
     *
     * @return \DateTime
     */
    public function getRealDate(): \DateTime {
        return $this->realDate;
    }

    /**
     * Get the timestmap date
     *
     * @return \DateTime
     */
    public function getTimestampDate(): \DateTime {
        return $this->timestampDate;
    }

    /**
     * Set the title
     *
     * @param string $title The title to set
     *
     * @return self
     */
    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the real date
     *
     * @param \DateTime $realDate The date to set
     *
     * @return self
     */
    public function setRealDate(\DateTime $realDate): self {
        $this->realDate = $realDate;
        return $this;
    }

    /**
     * Set the timestmap date
     *
     * @param \DateTime $timestampDate The date to set
     *
     * @return self
     */
    public function setTimestampDate(\DateTime $timestampDate): self {
        $this->timestampDate = $timestampDate;
        return $this;
    }

}
