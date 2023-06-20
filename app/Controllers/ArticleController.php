<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }
    public function index(){
        
    }

    public function show(){
        //Retrieve all data
        $articles = $this->articleModel->findAll();
        return view('article/article', ['articles'=>$articles]);
    }


    public function create(){
        $validation = \Config\Services::validation();

        if(!$this->request->is('post')){
            return view('article/articleCreate');
        }

        $data = [
            'article_title'       => $this->request->getPost('title'),
            'slug'                => $this->request->getPost('slug'),
            'article_content'     => $this->request->getPost('summernote'),
            'article_image'       => $this->request->getFile('image')->getName(),
            'article_language'    => $this->request->getPost('languageSelect'),
            'article_category'    => $this->request->getPost('categorySelect'),
            'article_description' => $this->request->getPost('description'),
        ];

        $data = $this->articleModel->insert($data);

        $imageFile = $this->request->getFile('image');
        $imageFile->move(ROOTPATH . 'public/articleImage');

        if($data){
            // Set flash data for success message
            $successMessage = 'Language added successfully.';
            session()->setFlashdata('success', $successMessage);

            $articles = $this->articleModel->findAll();

            return view('article/article', ['successMessage'=>$successMessage, 'articles'=>$articles]);
        }
    }

    public function update($id){
        return $id;
    }
}