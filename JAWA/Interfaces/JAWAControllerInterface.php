<?php
namespace JAWA\Interfaces;


use JAWA\JAWAView;

interface JAWAControllerInterface
{
    function index();
    function show(int $id);
    function showFiltered(string $sql);
    function update(int $id, array $array);
    function edit(int $id);
    function store(array $array);
    function create();
    function storeMany(array $array);
    function createMany();
    function destroy(int $id);
    function listRoutes();
    function defineRoutes();
}