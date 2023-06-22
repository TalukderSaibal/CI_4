<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\LanguageModel;

class ArticleController extends BaseController
{
    protected $articleModel,$db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->articleModel = new ArticleModel();
    }
    public function index(){
        
    }

    public function show(){
        $query = $this->db->query('SELECT * FROM languages
        LEFT JOIN articletbl ON languages.id = articletbl.article_language');
        $res  = $query->getResult();

        $data = [
            'res'      => $res,
            'articles' => $this->articleModel->paginate(6),
            'pager'    => $this->articleModel->pager
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
            return redirect()->to('/article/create');
        }
    }

    public function update($id){
        $data = $this->articleModel->where('id', $id)->find();
        return view('article/articleEdit', ['data'=>$data]);
    }

    // Article data form
    public function edit($id){

        $title          = $this->request->getPost('title');
        $slug           = $this->request->getPost('slug');
        $summernote     = $this->request->getPost('summernote');
        $image          = $this->request->getFile('image')->getName();
        $languageSelect = $this->request->getPost('languageSelect');
        $categorySelect = $this->request->getPost('categorySelect');
        $description    = $this->request->getPost('description');

        $articleData = $this->articleModel->find($id);

        $articleData = (object) $articleData;

        if($articleData){
            $articleData->article_title       = $title;
            $articleData->slug                = $slug;
            $articleData->article_content     = $summernote;
            $articleData->article_image       = $image;
            $articleData->article_language    = $languageSelect;
            $articleData->article_category    = $categorySelect;
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

    public function getCategories(){
        $languageId = $this->request->getPost('languageId');

        $query = $this->db->query("SELECT * FROM categories WHERE language_id = '$languageId'");
        $response = $query->getResult();

        // $categoryModel = new CategoryModel();
        // $categories = $categoryModel->where('language_id','2')->findAll();

        // $response['categories'] = $categories;

        return $this->response->setJSON(['categories' => $response]);
    }

    //For Delete action
    public function delete($id){
        if($id != null){
            $this->articleModel->delete($id);
            session()->setFlashdata('delete_success', 'Article deleted successfully.');
            return redirect()->to('/article/create');
        }
    }
}