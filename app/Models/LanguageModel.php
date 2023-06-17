<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_image', 'language_name', 'code', 'direction', 'language_status'];
}