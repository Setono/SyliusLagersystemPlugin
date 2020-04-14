<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Controller\Shipping;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\ViewRepository\Shipment\ShipmentViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShipmentIndexAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ShipmentViewRepositoryInterface */
    private $shipmentViewRepository;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        ShipmentViewRepositoryInterface $shipmentViewRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->shipmentViewRepository = $shipmentViewRepository;
    }

    public function __invoke(Request $request): Response
    {
        $page = $this->shipmentViewRepository->getAllPaginated(
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
