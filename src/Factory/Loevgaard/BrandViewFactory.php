<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Loevgaard;

use Loevgaard\SyliusBrandPlugin\Model\BrandInterface;
use Setono\SyliusLagersystemPlugin\View\Loevgaard\BrandView;

class BrandViewFactory implements BrandViewFactoryInterface
{
    /** @var string */
    protected $brandViewClass;

    public function __construct(string $brandViewClass)
    {
        $this->brandViewClass = $brandViewClass;
    }

    public function create(BrandInterface $brand): BrandView
    {
        /** @var BrandView $brandView */
        $brandView = new $this->brandViewClass();
        $brandView->id = $brand->getId();
        $brandView->code = $brand->getCode();
        $brandView->name = $brand->getName();

        return $brandView;
    }
}
