<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
    protected $articleModel;

    public function __construct(){
        $this->articleModel = new ArticleModel();
    }

    public function index()
    {
        $data = $this->articleModel->findAll();
        return $this->respond($data);
    }

    public function create(){
        $title          = $this->request->getPost('article_title');
        $slug           = $this->request->getPost('slug');
        $summernote     = $this->request->getPost('article_content');
        $imageFile          = $this->request->getFile('article_image');
        $languageSelect = $this->request->getPost('article_language');
        $categorySelect = $this->request->getPost('article_category');
        $description    = $this->request->getPost('article_description');


        $data = [
            'article_title'       => $title,
            'slug'                => $slug,
            'article_content'     => $summernote,
            'article_image'       => $imageFile,
            'article_language'    => $languageSelect,
            'article_category'    => $categorySelect,
            'article_description' => $description
        ];

        if (!empty($imageFile) && $imageFile->isValid()) {
            $imageName = $imageFile->getName();
            $imageFile->move(ROOTPATH . 'public/articleImage', $imageName);
            $data['article_image'] = $imageName;
        }

        $res = $this->articleModel->insert($data);
        if($res){
            return $this->respond("Data inserted");
        }
    }

    public function show($id = null){
        $article = $this->articleModel->find($id);

        if($article){
            return $this->respond($article);
        }else {
            return $this->respond('This article does not exist');
        }
    }

    public function update($id = null){
        $title          = $this->request->getPost('article_title');
        $slug           = $this->request->getPost('slug');
        $summernote     = $this->request->getPost('article_content');
        $imageFile      = $this->request->getFile('article_image');
        $languageSelect = $this->request->getPost('article_language');
        $categorySelect = $this->request->getPost('article_category');
        $description    = $this->request->getPost('article_description');


        $data = [
            'article_title'       => $title,
            'slug'                => $slug,
            'article_content'     => $summernote,
            'article_image'       => $imageFile,
            'article_language'    => $languageSelect,
            'article_category'    => $categorySelect,
            'article_description' => $description
        ];

        if (!empty($imageFile) && $imageFile->isValid()) {
            $imageName = $imageFile->getName();
            $imageFile->move(ROOTPATH . 'public/articleImage', $imageName);
            $data['article_image'] = $imageName;
        }

        $res = $this->articleModel->update($id, $data);
        if($res){
            return $this->respond('Data updated successfully');
        }
    }

    public function delete($id = null){
        $data = $this->articleModel->delete($id);
        if($data){
            return $this->respondDeleted("Data deleted");
        }else{
            return $this->respond('This article does not exist');
        }
    }
}
