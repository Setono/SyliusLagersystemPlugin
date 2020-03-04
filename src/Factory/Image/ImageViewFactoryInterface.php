<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Image;

use Setono\SyliusLagersystemPlugin\View\Image\ImageView;
use Sylius\Component\Core\Model\ImageInterface;

interface ImageViewFactoryInterface
{
    public function create(ImageInterface $image): ImageView;
}
