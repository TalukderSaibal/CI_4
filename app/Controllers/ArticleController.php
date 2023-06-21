<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\LanguageModel;

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
        // $articles = $this->articleModel->findAll();
        $data = [
            'articles' => $this->articleModel->paginate(6),
            'pager'     => $this->articleModel->pager
        ];

        return view('article/article', $data);
    }


    public function create(){
        $validation = \Config\Services::validation();

        if(!$this->request->is('post')){
            $languageModel = new LanguageModel();
            $languageData = $languageModel->findAll();
            return view('article/articleCreate', ['language'=>$languageData]);
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
            $successMessage = 'Article added successfully.';
            session()->setFlashdata('success', $successMessage);

            $articles = $this->articleModel->findAll();

            return view('article/article', ['successMessage'=>$successMessage, 'articles'=>$articles]);
        }
    }

    public function update($id){
        $data = $this->articleModel->where('id', $id)->find();
        return view('article/articleEdit', ['data'=>$data]);
    }

    public function edit($id){
        $title = $this->request->getPost('title');
        $slug = $this->request->getPost('slug');
        $summernote = $this->request->getPost('summernote');
        $image = $this->request->getFile('image')->getName();
        $languageSelect = $this->request->getPost('languageSelect');
        $categorySelect = $this->request->getPost('categorySelect');
        $description = $this->request->getPost('description');

        $articleData = $this->articleModel->find($id);

        $articleData = (object) $articleData;

        if($articleData){
            $articleData->article_title = $title;
            $articleData->slug = $slug;
            $articleData->article_content = $summernote;
            $articleData->article_image = $image;
            $articleData->article_language = $languageSelect;
            $articleData->article_category = $categorySelect;
            $articleData->article_description = $description;

            $imageFile = $this->request->getFile('image');
            $imageFile->move(ROOTPATH . 'public/articleImage');
            $res = $this->articleModel->save($articleData);

            $successMessage = 'Article update successfully.';
            session()->setFlashdata('success', $successMessage);

            $articles = $this->articleModel->findAll();

            if($res){
                return view('article/article',['successMessage'=>$successMessage, 'articles'=>$articles]);
            }
        }else{
            return "Data not found";
        }
    }
}