<?php
namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    protected $table = 'general';
    protected $primaryKey = 'id';
    protected $allowedFields = ['general', 'colors'];
}