<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_image', 'language_name', 'code', 'direction', 'language_status'];

    public function search($searchTerm)
    {
        return $this->orLike('language_name', $searchTerm)
                    ->orLike('code', $searchTerm)
                    ->findAll();
    }
}