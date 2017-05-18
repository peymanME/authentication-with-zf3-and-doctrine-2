<?php
namespace Application\Models\Entities\Repositories\Base;

use Zend\Paginator\Paginator;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection;


class RepositoryBase extends EntityRepository
{
    public function getList(){
        return $this->findAll();
    }

    public function getListByEntity($type, $byField){
        if ($type ==='ASC')
            return $this->getListASC($byField);
        else 
            return $this->getListDESC($byField);
    }
	
    public function getListASC($byField, $orderBy = null)	{
        if ($byField == null){
            $byField = array();
        }

        if ($orderBy !== null)			
            $orderBy = array($orderBy => 'ASC');
        else 
            $orderBy = array('id' =>'ASC');

        return $this->findBy($byField, $orderBy);	
    }
	
    public function getListDESC($byField){
        if ($byField === null){
            $byField = array();
        }
        return $this->findBy($byField,array('id'=>'DESC'));
    }
	
    public function getPagination($page, $byId = null){
        $entities = $this->getListDESC($byId);
        $collection = new ArrayCollection($entities);
        $paginator = new Paginator(new Collection($collection));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(10);

        return $paginator;
    }
    
    public function getQueryPagination($page, $entities){
        //$entities = $this->getListDESC($byId);
        $collection = new ArrayCollection($entities);
        $paginator = new Paginator(new Collection($collection));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(10);

        return $paginator;
    }
	
	
	
}