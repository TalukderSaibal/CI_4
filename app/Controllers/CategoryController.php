<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use App\Models\LanguageModel;

class CategoryController extends BaseController
{
    public object $model,$languageModel,$db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->model = new CategoryModel();
        $this->languageModel = new LanguageModel();
    }


    public function index(){
        // Retrieve Data from database
        $query = $this->db->query("SELECT * FROM categories 
        LEFT JOIN languages ON categories.language_id = languages.id");
        $results = $query->getResult();

        $data = [
            'res'        => $results,
            'categories' => $this->model->paginate(6),
            'pager'      => $this->model->pager
        ];

        return view('category/category', $data);
    }

    public function categoryform(){
        $languageData = $this->languageModel->findAll();
        $msg = "";
        return view('category/createcategory', ['languages' => $languageData, 'msg' => $msg]);
    }

    public function createcategory(){
        $validation = \Config\Services::validation();

        $rules = [
            'language' => 'required',
            'name'     => 'required',
            'slug'     => 'required',
        ];

        if (!$this->validate($rules)) {
            $response = [
                'language' => [
                    'status' => 'required',
                    'message' => 'Please enter a valid language',
                ],
                'name' => [
                    'status' => 'required',
                    'message' => 'Please enter a name',
                ],
                'slug' => [
                    'status' => 'failed',
                    'message' => 'Please enter a slug',
                ],
            ];
            return json_encode($response);
        }

        // $language = $this->request->getPost('language');
        // $name = $this->request->getPost('name');
        // $slug = $this->request->getPost('slug');
        
        $data = [
            'language_id' => $this->request->getPost('language'),
            'category_name' => $this->request->getPost('name'),
            'category_slug' => $this->request->getPost('slug'),
        ];
        
        $res = $this->model->insert($data);

        if($res){
            return 'data successfully inserted';
        }
    }

    // public function create(){
    //     $languageData = $this->languageModel->findAll();
    //     $msg = "";
        
    //     if(!$this->request->is('post')){
    //         return view('category/createcategory', ['languages' => $languageData, 'msg' => $msg]);
    //     }else{
    //         $validation = \Config\Services::validation();
    //             $rules = [
    //                 'language' => 'required',
    //                 'name'     => 'required',
    //                 'slug'     => 'required',
    //             ];

    //             if (!$this->validate($rules)) {
    //                 return view('category/createcategory', ['languages' => $languageData, 'msg' => $msg]);
    //             }

    //             $languagevalue = $this->request->getPost('language');
    //             if($languagevalue == 0){
    //                 $msg = "You must select a language";
    //                 return view('category/createcategory', ['languages' => $languageData, 'msg' => $msg]);
    //             }

    //             $data = [
    //                 'language_id' => $this->request->getPost('language'),
    //                 'category_name' => $this->request->getPost('name'),
    //                 'category_slug' => $this->request->getPost('slug'),
    //             ];

    //             $res = $this->model->insert($data);

    //             $successMessage = 'Catgeory added successfully.';
    //             session()->setFlashdata('success', $successMessage);

    //             //retrive All Data from database
    //             $categories = $this->model->findAll();

    //             if($res){
    //                 return view('category/createcategory', ['languages' => $languageData, 'msg' => $msg, 'successMsg' => $successMessage]);
    //                 // return view('category/category', ['categories' => $categories,'successMsg' => $successMessage]);
    //             } 
    //     }
        
    // }

    // Category edit form
    public function edit($id){
        if($id != null){

            $languageData = $this->languageModel->findAll();

            $query = 'SELECT * FROM categories
            LEFT JOIN  languages ON categories.language_id =  languages.id
            WHERE categories.id= ' . $id;

            $result = $this->db->query($query);
            $data = $result->getResult();

            foreach($data as $value){
                $languageId = $value->language_id;
                $query1 = 'SELECT category_name FROM categories WHERE language_id=' . $languageId;
                $catgeory = $this->db->query($query1);
                $catgeory = $catgeory->getResult();
            }

            if($data){
                return view('category/categoryEdit', ['category'=> $catgeory,'data'=>$data, 'languages' => $languageData]);
            }
        }
    }

    public function search(){
        $searchData = $this->request->getPost('search');


        $result = $this->model->search($searchData);
        // echo '<pre>';
        // print_r($result);
        // die();
        
        return view('category/categoryView', ['results' => $result]);
    }

    public function delete($id){
        $res = $this->model->delete($id);
        if($res){
            $msg = 'Catgeory deleted';
            session()->setFlashdata('delete', $msg);
            return redirect()->to('//category/create');
        }
    }

}