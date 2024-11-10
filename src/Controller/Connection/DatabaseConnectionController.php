<?php

namespace App\Controller\Connection;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseConnectionController
{
    #[Route('/api/test-db-connection', name: 'test_db_connection', methods: ['GET'])]
    public function testConnection(Connection $connection): JsonResponse
    {
        try {
            // Attempt to perform a simple query to test the connection and fetch tables
            $tables = $connection->fetchAllAssociative('SHOW TABLES');
            $status = $connection->isConnected();
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return new JsonResponse([
            'success' => $status,
            'tables' => $tables,
        ]);
    }
}
