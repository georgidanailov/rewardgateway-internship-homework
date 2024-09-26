<?php

namespace App\Controller;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/customer', name: 'customer_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 3;

        $query = $this->em->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        $paginator = new Paginator($query);

        return $this->render('customer/index.html.twig', [
            'customers' => $paginator,
            'currentPage' => $page,
            'totalPages' => ceil(count($paginator) / $limit),
        ]);
    }

    #[Route('/api/customers', name: 'create_customer', methods: ['POST'])]
    public function createCustomer(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['name']) || empty($data['email']) || empty($data['address'])) {
            return $this->json(['error' => 'Customer name, email, and address are required'], 400);
        }

        $customer = new Customer();
        $customer->setName($data['name']);
        $customer->setEmail($data['email']);
        $customer->setAddress($data['address']);
        $customer->setPhone($data['phone'] ?? null);

        $this->em->persist($customer);
        $this->em->flush();

        return $this->json([
            'message' => 'Customer created successfully!',
            'customer' => $customer
        ], 201);
    }

    #[Route('/api/customers', name: 'get_customers', methods: ['GET'])]
    public function getCustomers(): JsonResponse
    {
        $customers = $this->em->getRepository(Customer::class)->findAll();

        return $this->json($customers, 200);
    }

    #[Route('/api/customers/{id}', name: 'get_customer', methods: ['GET'])]
    public function getCustomer(int $id): JsonResponse
    {
        $customer = $this->em->getRepository(Customer::class)->find($id);

        if (!$customer) {
            return $this->json(['error' => 'Customer not found'], 404);
        }

        return $this->json($customer, 200);
    }

    #[Route('/api/customers/{id}', name: 'update_customer', methods: ['PUT'])]
    public function updateCustomer(int $id, Request $request): JsonResponse
    {
        $customer = $this->em->getRepository(Customer::class)->find($id);

        if (!$customer) {
            return $this->json(['error' => 'Customer not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $customer->setName($data['name']);
        }

        if (isset($data['email'])) {
            $customer->setEmail($data['email']);
        }

        if (isset($data['address'])) {
            $customer->setAddress($data['address']);
        }

        if (isset($data['phone'])) {
            $customer->setPhone($data['phone']);
        }

        $this->em->flush();

        return $this->json(['message' => 'Customer updated successfully!', 'customer' => $customer], 200);
    }

    #[Route('/api/customers/{id}', name: 'delete_customer', methods: ['DELETE'])]
    public function deleteCustomer(int $id): JsonResponse
    {
        $customer = $this->em->getRepository(Customer::class)->find($id);

        if (!$customer) {
            return $this->json(['error' => 'Customer not found'], 404);
        }

        $this->em->remove($customer);
        $this->em->flush();

        return $this->json(['message' => 'Customer deleted successfully!'], 200);
    }
}
