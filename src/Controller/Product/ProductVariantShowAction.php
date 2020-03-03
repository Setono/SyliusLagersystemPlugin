<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Controller\Product;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use function Safe\sprintf;
use Setono\SyliusLagersystemPlugin\Factory\Product\ProductVariantViewFactoryInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\Repository\ProductVariantRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webmozart\Assert\Assert;

final class ProductVariantShowAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ProductVariantRepositoryInterface */
    private $productVariantRepository;

    /** @var ProductVariantViewFactoryInterface */
    private $productVariantViewFactory;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        ProductVariantViewFactoryInterface $productVariantViewFactory,
        ProductVariantRepositoryInterface $productVariantRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->productVariantViewFactory = $productVariantViewFactory;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function __invoke(Request $request): Response
    {
        $code = $request->attributes->get('code');
        /** @var ProductVariantInterface|null $variant */
        $variant = $this->productVariantRepository->findOneBy(['code' => $code]);
        if (null === $variant) {
            throw new NotFoundHttpException(sprintf('Variant with code %s has not been found.', $code));
        }

        $locale = $request->query->get('locale');
        Assert::notNull($locale);

        return $this->viewHandler->handle(
            View::create(
                $this->productVariantViewFactory->create(
                    $variant,
                    $locale
                ),
                Response::HTTP_OK
            )
        );
    }
}
