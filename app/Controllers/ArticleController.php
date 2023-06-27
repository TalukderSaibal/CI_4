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
        $query = $this->db->query('SELECT * FROM articletbl
        LEFT JOIN languages ON articletbl.article_language = articletbl.id');
        $res  = $query->getResult();


        $data = [
            'res'      => $res,
            'articles' => $this->articleModel->paginate(6),
            'pager'    => $this->articleModel->pager
        ];

        return view('article/article', $data);
    }

    // Article Form showing method
    public function articleSave(){
        $languageModel = new LanguageModel();
        $languageData = $languageModel->findAll();

        return view('article/articleCreate', ['language'=>$languageData]);
    }

    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'title'          => 'required',
            'slug'           => 'required',
            'summernote'     => 'required',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png,image/jpg, image/webpp]',
                'max_size[image,1024]'
            ],
            'languageSelect' => 'required',
            'categorySelect' => 'required',
            'description'    => 'required',
        ];

        if(!$this->validate($rules)){
            $errors = $validation->getErrors();
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $errors,
                'statusCode' => 400
                ]
            );
        }

        $title          = $this->request->getPost('title');
        $slug           = $this->request->getPost('slug');
        $summernote     = $this->request->getPost('summernote');
        $image          = $this->request->getFile('image')->getClientName();
        $languageSelect = $this->request->getPost('languageSelect');
        $categorySelect = $this->request->getPost('categorySelect');
        $description    = $this->request->getPost('description');


        $flag = $this->request->getFile('image');
        $flag->move(ROOTPATH . 'public/articleImage');

        $data = [
            'article_title'       => $title,
            'slug'                => $slug,
            'article_content'     => $summernote,
            'article_image'       => $image,
            'article_language'    => $languageSelect,
            'article_category'    => $categorySelect,
            'article_description' => $description
        ];

        $res = $this->articleModel->insert($data);

        if($res){
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Article successfully inserted',
                'statusCode' => 200
            ]);
        }
    }

    public function edit($id){

        $query = 'SELECT * FROM  languages
        LEFT JOIN articletbl ON languages.id = articletbl.article_language
        LEFT JOIN categories ON languages.id = categories.language_id
        WHERE articletbl.id= ' . $id;

        $result = $this->db->query($query);
        $res = $result->getResult();

        // $languageId = $res->article_language;

        foreach($res as $row){
            $languageId = $row->article_language;
            $query1 = 'SELECT * FROM categories WHERE language_id='. $languageId;
            $result1 = $this->db->query($query1);
            $res1 = $result1->getResult();
        }
        return view('article/articleEdit', ['data'=>$res, 'data2' => $res1]);

    }

    // Article data form
    public function update(){

        // For validation
        $validationRules = [
            'name' => 'required',
            'direction' => 'required',
            'flag' => 'uploaded[flag]|max_size[flag,1024]|ext_in[flag,png,jpg,jpeg]'
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        

        $data = [
            'id'                  => $this->request->getPost('articleId'),
            'article_title'       => $this->request->getPost('title'),
            'slug'                => $this->request->getPost('slug'),
            'article_content'     => $this->request->getPost('summernote'),
            'article_image'       => $this->request->getFile('image')->getName(),
            'article_language'    => $this->request->getPost('languageSelect'),
            'article_category'    => $this->request->getPost('categorySelect'),
            'article_description' => $this->request->getPost('description'),
        ];

        $imageFile = $this->request->getFile('image');
        $imageFile->move(ROOTPATH . 'public/articleImage');

        $res = $this->articleModel->update($this->request->getPost('articleId'), $data);
        
        if($res){
            $successMessage = 'Article update successfully.';
            session()->setFlashdata('update', $successMessage);
            return redirect()->to('/article/create');
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