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

namespace TheCodingOwl\SqlDebug\Controller;

use TheCodingOwl\SqlDebug\Domain\Repository\EntityRepository;
use TheCodingOwl\SqlDebug\Domain\Model\Entity;

/**
 * Description of EntityController
 *
 * @author Kevin Ditscheid <kevinditscheid@gmail.com>
 */
class EntityController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController{
    /**
     * The repository object for entities
     *
     * @var EntityRepository
     */
    protected $entityRepository;
    
    /**
     * Inject the entity repository
     *
     * @param EntityRepository $entityRepository The repository to inject
     */
    public function injectEntityRepository(EntityRepository $entityRepository){
        $this->entityRepository = $entityRepository;
    }
    
    /**
     * List entities action
     */
    public function listAction(){
        $entities = $this->entityRepository->findByDate(new \DateTime());
        \TheCodingOwl\SqlDebug\Utilities\SqlDebuggerUtility::debugQueryResult($entities);
        $this->view->assign('entities', $entities);
    }
    
    /**
     * Show an entity
     *
     * @param Entity $entity The entity to show
     */
    public function showAction(Entity $entity){
        $this->view->assign('entity',$entity);
    }
}
