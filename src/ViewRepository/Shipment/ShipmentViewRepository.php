<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Shipment;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Setono\SyliusLagersystemPlugin\Factory\PageViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\Shipping\ShipmentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\Repository\ShipmentRepositoryInterface;
use Setono\SyliusLagersystemPlugin\View\PageView;
use Webmozart\Assert\Assert;

class ShipmentViewRepository implements ShipmentViewRepositoryInterface
{
    /** @var ShipmentRepositoryInterface */
    protected $shipmentRepository;

    /** @var PageViewFactoryInterface */
    protected $pageViewFactory;

    /** @var ShipmentViewFactoryInterface */
    protected $shipmentViewFactory;

    public function __construct(
        ShipmentRepositoryInterface $shipmentRepository,
        PageViewFactoryInterface $pageViewFactory,
        ShipmentViewFactoryInterface $shipmentViewFactory
    ) {
        $this->shipmentRepository = $shipmentRepository;
        $this->pageViewFactory = $pageViewFactory;
        $this->shipmentViewFactory = $shipmentViewFactory;
    }

    public function getAllPaginated(PaginatorDetails $paginatorDetails, ?string $localeCode): PageView
    {
        Assert::notNull($localeCode);
        $queryBuilder = $this->shipmentRepository->createLagersystemListQueryBuilder();

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage($paginatorDetails->limit());
        $pagerfanta->setCurrentPage($paginatorDetails->page());

        $pageView = $this->pageViewFactory->create($pagerfanta, $paginatorDetails->route(), $paginatorDetails->parameters());
        foreach ($pagerfanta->getCurrentPageResults() as $currentPageResult) {
            $pageView->items[] = $this->shipmentViewFactory->create($currentPageResult, $localeCode);
        }

        return $pageView;
    }
}
