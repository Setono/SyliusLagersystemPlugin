<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Order;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Setono\SyliusLagersystemPlugin\Factory\Order\OrderViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\PageViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\View\PageView;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;

final class OrderViewRepository implements OrderViewRepositoryInterface
{
    /** @var OrderRepositoryInterface */
    private $orderRepository;

    /** @var PageViewFactoryInterface */
    private $pageViewFactory;

    /** @var OrderViewFactoryInterface */
    private $orderViewFactory;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        PageViewFactoryInterface $pageViewFactory,
        OrderViewFactoryInterface $orderViewFactory
    ) {
        $this->orderRepository = $orderRepository;
        $this->pageViewFactory = $pageViewFactory;
        $this->orderViewFactory = $orderViewFactory;
    }

    public function getAllPaginated(PaginatorDetails $paginatorDetails): PageView
    {
        $queryBuilder = $this->orderRepository->createListQueryBuilder();

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage($paginatorDetails->limit());
        $pagerfanta->setCurrentPage($paginatorDetails->page());

        $pageView = $this->pageViewFactory->create($pagerfanta, $paginatorDetails->route(), $paginatorDetails->parameters());
        foreach ($pagerfanta->getCurrentPageResults() as $currentPageResult) {
            $pageView->items[] = $this->orderViewFactory->create($currentPageResult);
        }

        return $pageView;
    }
}
