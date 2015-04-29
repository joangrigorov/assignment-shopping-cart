<?php

namespace Products\Utils;

use Doctrine\ORM\QueryBuilder;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Products\Repository\ProductsRepository;
use Zend\Paginator\Paginator;

/**
 * Class ProductsBrowser
 *
 * Used to browse products using paginator
 *
 * @package Products\Utils
 */
class ProductsBrowser
{

    const ITEM_COUNT_PER_PAGE = 9;

    /**
     * Product entities repository
     *
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * Constructor
     *
     * Injects products repository
     *
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Creates paginator from query
     *
     * @param QueryBuilder $queryBuilder
     * @param integer $page
     * @return Paginator
     */
    private function createPaginatorFromQuery(QueryBuilder $queryBuilder, $page)
    {
        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adapter);
        $paginator->setItemCountPerPage(self::ITEM_COUNT_PER_PAGE)
                  ->setCurrentPageNumber($page);
        return $paginator;
    }

    /**
     * Gets products (wrapped in paginator) for a specific page
     *
     * @param integer $page
     * @return Paginator
     */
    public function openPageOfProducts($page)
    {
        $query = $this->productsRepository->createQueryBuilder('p');
        return $this->createPaginatorFromQuery($query, $page);
    }

}