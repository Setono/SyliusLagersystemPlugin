<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Controller\Product;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\ViewRepository\Product\ProductVariantViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ProductVariantIndexAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ProductVariantViewRepositoryInterface */
    private $productVariantViewRepository;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        ProductVariantViewRepositoryInterface $productVariantViewRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->productVariantViewRepository = $productVariantViewRepository;
    }

    public function __invoke(Request $request): Response
    {
        $page = $this->productVariantViewRepository->getAllPaginated(
            new PaginatorDetails($request->attributes->get('_route'), $request->query->all()),
            $request->query->get('locale')
        );

        return $this->viewHandler->handle(
            View::create(
                $page,
                Response::HTTP_OK
            )
        );
    }
}
