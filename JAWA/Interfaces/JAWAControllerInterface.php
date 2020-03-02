<?php
namespace JAWA\Interfaces;

use JAWA\JAWAView;

interface JAWAControllerInterface
{
    public function index(): ?array;
    public function show(int $id): ?JAWAView;
    public function showFiltered(string $sql): ?array;
    public function update(int $id, array $array): ?JAWAView;
    public function edit(int $id): ?JAWAView;
    public function store(array $array): ?JAWAView;
    public function create(): ?JAWAView;
    public function storeMany(array $array): ?array;
    public function createMany(): ?JAWAView;
    public function destroy(int $id): ?string;
    public function listRoutes(): array;
    public function defineRoutes(): array;
}