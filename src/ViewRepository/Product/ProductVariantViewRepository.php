<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Product;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Setono\SyliusLagersystemPlugin\Factory\PageViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\Product\ProductVariantViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\Repository\ProductVariantRepositoryInterface;
use Setono\SyliusLagersystemPlugin\View\PageView;
use Webmozart\Assert\Assert;

class ProductVariantViewRepository implements ProductVariantViewRepositoryInterface
{
    /** @var ProductVariantRepositoryInterface */
    protected $productVariantRepository;

    /** @var PageViewFactoryInterface */
    protected $pageViewFactory;

    /** @var ProductVariantViewFactoryInterface */
    protected $productVariantViewFactory;

    public function __construct(
        ProductVariantRepositoryInterface $productVariantRepository,
        PageViewFactoryInterface $pageViewFactory,
        ProductVariantViewFactoryInterface $productVariantViewFactory
    ) {
        $this->productVariantRepository = $productVariantRepository;
        $this->pageViewFactory = $pageViewFactory;
        $this->productVariantViewFactory = $productVariantViewFactory;
    }

    public function getAllPaginated(PaginatorDetails $paginatorDetails, ?string $localeCode): PageView
    {
        Assert::notNull($localeCode);
        $queryBuilder = $this->productVariantRepository->createLagersystemListQueryBuilder($localeCode);

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage($paginatorDetails->limit());
        $pagerfanta->setCurrentPage($paginatorDetails->page());

        $pageView = $this->pageViewFactory->create($pagerfanta, $paginatorDetails->route(), $paginatorDetails->parameters());
        foreach ($pagerfanta->getCurrentPageResults() as $currentPageResult) {
            $pageView->items[] = $this->productVariantViewFactory->create($currentPageResult, $localeCode);
        }

        return $pageView;
    }
}
