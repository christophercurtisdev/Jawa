<?php
namespace JAWA\Interfaces;


use JAWA\JAWAModel;

interface JAWAApiControllerInterface
{
    function index(): ?array;
    function update(int $id, array $array): ?JAWAModel;
    function store(array $array): ?JAWAModel;
    function storeMany(array $array): ?array;
    function destroy(int $id): ?string;
    function listRoutes(): array;
    function defineRoutes(): array;
}