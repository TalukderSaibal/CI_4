<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articletbl';
    protected $primaryKey = 'id';
    protected $allowedFields = ['article_title', 'slug', 'article_content', 'article_image', 'article_language','article_category', 'article_description'];
}