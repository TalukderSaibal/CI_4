<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_id', 'category_name', 'category_slug'];

    public function search($searchTerm)
    {
        return $this->orLike('language_name', $searchTerm)
                    ->orLike('category_slug', $searchTerm)
                    ->findAll();
    }
}