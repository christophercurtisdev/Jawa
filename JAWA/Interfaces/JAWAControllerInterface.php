<?php
namespace JAWA\Interfaces;


use JAWA\JAWAView;

interface JAWAControllerInterface
{
    function index(): ?array;
    function show(int $id): ?JAWAView;
    function showFiltered(string $sql): ?array;
    function update(int $id, array $array): ?JAWAView;
    function edit(int $id): ?JAWAView;
    function store(array $array): ?JAWAView;
    function create(): ?JAWAView;
    function storeMany(array $array): ?array;
    function createMany(): ?JAWAView;
    function destroy(int $id): ?string;
    function listRoutes(): array;
    function defineRoutes(): array;
}