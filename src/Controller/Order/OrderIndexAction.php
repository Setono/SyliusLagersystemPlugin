<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Controller\Order;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\ViewRepository\Order\OrderViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class OrderIndexAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var OrderViewRepositoryInterface */
    private $orderViewRepository;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        OrderViewRepositoryInterface $orderViewRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->orderViewRepository = $orderViewRepository;
    }

    public function __invoke(Request $request): Response
    {
        $page = $this->orderViewRepository->getAllPaginated(
            new PaginatorDetails($request->attributes->get('_route'), $request->query->all())
        );

        return $this->viewHandler->handle(
            View::create(
                $page,
                Response::HTTP_OK
            )
        );
    }
}
