<?php

namespace App\Controllers;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }


    public function index(){
        // Retrieve Data from database

        $data = [
            'categories' => $this->model->paginate(6),
            'pager'      => $this->model->pager
        ];

        return view('category/category', $data);
    }

    public function create(){
        if(!$this->request->is('post')){
            return view('category/createcategory');
        }else{
            $validation = \Config\Services::validation();

                $rules = [
                    'language' => 'required',
                    'name' => 'required',
                    'slug' => 'required',
                ];

                if (!$this->validate($rules)) {
                    return view('category/createcategory');
                }
                
                $data = [
                    'language_name' => $this->request->getPost('language'),
                    'category_name' => $this->request->getPost('name'),
                    'category_slug' => $this->request->getPost('slug'),
                ];

                $res = $this->model->insert($data);

                $successMessage = 'Catgeory added successfully.';
                session()->setFlashdata('success', $successMessage);

                //retrive All Data from database
                $categories = $this->model->findAll();

                if($res){
                    return view('category/category', ['categories' => $categories,'successMsg' => $successMessage]);
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

}