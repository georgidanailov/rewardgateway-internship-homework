<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Customer;
use App\Entity\OrderEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/api/orders', name: 'create_order', methods: ['POST'])]
    public function createOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['total']) || empty($data['status']) || empty($data['customer_id'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        try {
            $status = OrderEnum::from($data['status']);
        } catch (\ValueError $e) {
            return $this->json(['error' => 'Invalid status value'], 400);
        }

        $customer = $this->em->getRepository(Customer::class)->find($data['customer_id']);
        if (!$customer) {
            return $this->json(['error' => 'Customer not found'], 404);
        }

        $order = new Order();
        $order->setOrderDate(new \DateTime());
        $order->setTotal($data['total']);
        $order->setStatus($status);
        $order->setCustomer($customer);

        $this->em->persist($order);
        $this->em->flush();

        return $this->json([
            'message' => 'Order created successfully!',
            'order' => $order
        ], 201);
    }

    #[Route('/api/orders', name: 'get_orders', methods: ['GET'])]
    public function getOrders(): JsonResponse
    {
        $orders = $this->em->getRepository(Order::class)->findAll();
        return $this->json($orders, 200);
    }

    #[Route('/api/orders/{id}', name: 'get_order', methods: ['GET'])]
    public function getOrder(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);

        if (!$order) {
            return $this->json(['error' => 'Order not found'], 404);
        }

        return $this->json($order, 200);
    }

    #[Route('/api/orders/{id}', name: 'update_order', methods: ['PUT'])]
    public function updateOrder(int $id, Request $request): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);

        if (!$order) {
            return $this->json(['error' => 'Order not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['status'])) {
            try {
                $status = OrderEnum::from($data['status']);
                $order->setStatus($status);
            } catch (\ValueError $e) {
                return $this->json(['error' => 'Invalid status value'], 400);
            }
        }

        $this->em->flush();

        return $this->json(['message' => 'Order updated successfully!', 'order' => $order], 200);
    }

    #[Route('/api/orders/{id}', name: 'cancel_order', methods: ['DELETE'])]
    public function cancelOrder(int $id): JsonResponse
    {
        $order = $this->em->getRepository(Order::class)->find($id);

        if (!$order) {
            return $this->json(['error' => 'Order not found'], 404);
        }

        $order->setStatus(OrderEnum::Cancelled->value);
        $this->em->flush();

        return $this->json(['message' => 'Order cancelled successfully!'], 200);
    }
}
