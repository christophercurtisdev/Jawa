<?php


namespace JAWA\Interfaces;


use JAWA\JAWAModel;

interface JAWAApiControllerInterface
{
    public function index(): ?array;
    public function get(int $id): ?JAWAModel;
    public function getWhere(string $sql): ?array;
    public function update(int $id, array $array): ?JAWAModel;
    public function store(array $array): ?JAWAModel;
    public function storeMany(array $array): ?array;
    public function destroy(int $id): ?string;
    public function listRoutes(): array;
}