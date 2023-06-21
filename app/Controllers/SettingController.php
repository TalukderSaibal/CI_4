<?php

namespace App\Controllers;

use App\Models\LanguageModel;

class SettingController extends BaseController
{
    protected $model,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->model = new LanguageModel();
    }


    public function index()
    {

        // $languages = $languageModel->findAll();

        $data = [
            'languages' => $this->model->paginate(6),
            'pager'     => $this->model->pager
        ];

        return view('setting/language', $data);
    }

    // Language Added Method
    public function create(){

        $validation = \Config\Services::validation();

        if(!$this->request->is('post')){
            $query = $this->db->query('SELECT * FROM language_code');

            $result = $query->getResult();
            
            return view('setting/createLanguage', ['res' => $result]);
        }

        $languageModel = new LanguageModel();

        $rules = [
            'flag' => 'uploaded[flag]|mime_in[flag,image/png,image/jpg,image/jpeg]|max_size[flag,2048]',
            'name' => 'required',
            'languageCheck' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('setting/createLanguage');
        }

        $flagFile      = $this->request->getFile('flag');
        $flagName      = $flagFile->getRandomName();
        $name          = $this->request->getPost('name');
        $code          = $this->request->getPost('code');
        $direction     = $this->request->getPost('direction');
        $languageCheck = $this->request->getPost('languageCheck') ? 1:0;


        $data = [
            'language_image'  => $flagName,
            'language_name'   => $name,
            'code'            => $code,
            'direction'       => $direction,
            'language_status' => $languageCheck
        ];

        $languageModel->insert($data);

        $flagFile->move(ROOTPATH . 'public/uploads');

        //Retrieve all data
        $languages = $languageModel->findAll();

        // Set flash data for success message
        $successMessage = 'Language added successfully.';
        session()->setFlashdata('success', $successMessage);

        return view('setting/language', ['languages' => $languages, 'successMessage' => $successMessage]);        
    }

    //Language Search Method
    public function languageSearch(){
        $searchData = $this->request->getPost('search');
        $result = $this->model->search($searchData);
        return view('setting/languageView', ['results' => $result]);
    }

    //Auto Populate language
    public function fetchData(){
       

        // $data = [
        //     ['value' => 'aa', 'label'=> $value->country_name],
        //     ['value' => 'avs', 'label'=> 'Avestan(avs)'],
        //     ['value' => 'ak', 'label'=> 'Akan(ak)'],
        // ];

        // return $this->response->setJSON($data);
    }
}