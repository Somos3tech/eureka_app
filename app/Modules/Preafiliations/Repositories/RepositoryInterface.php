<?php

namespace App\Modules\Preafiliations\Repositories;

interface RepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function update(array $data, $id);

    public function delete($id);

    public function datatable($request);
}