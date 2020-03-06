<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Image;

use Liip\ImagineBundle\Service\FilterService;
use Setono\SyliusLagersystemPlugin\View\Image\ImageView;
use Sylius\Component\Core\Model\ImageInterface;

class ImageViewFactory implements ImageViewFactoryInterface
{
    /** @var string */
    protected $imageViewClass;

    /** @var FilterService */
    protected $filterService;

    /** @var string */
    protected $filter;

    public function __construct(
        string $imageViewClass,
        FilterService $filterService,
        string $filter
    ) {
        $this->imageViewClass = $imageViewClass;
        $this->filterService = $filterService;
        $this->filter = $filter;
    }

    public function create(ImageInterface $image): ImageView
    {
        /** @var ImageView $imageView */
        $imageView = new $this->imageViewClass();
        $imageView->type = $image->getType();
        $imageView->path = $image->getPath();
        $imageView->cachedPath = $this->filterService->getUrlOfFilteredImage($image->getPath(), $this->filter);

        return $imageView;
    }
}
