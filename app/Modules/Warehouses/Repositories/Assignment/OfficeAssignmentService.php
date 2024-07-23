<?php

namespace App\Modules\Warehouses\Repositories\Assignment;

use Auth;

class OfficeAssignmentService implements AssignmentServiceInterface
{
    public function updateField($request)
    {
        return  ['status' => 'D', 'user_updated_id' => Auth::user()->id];
    }
}