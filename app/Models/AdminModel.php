<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $DBGroup            = 'default';

    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [];
 

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
