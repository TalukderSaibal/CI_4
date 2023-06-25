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

    public function languageCreate(){
        $languageModel = new LanguageModel();
            $rules = [
                'flag' => 'uploaded[flag]|mime_in[flag,image/png,image/jpg,image/jpeg]|max_size[flag,2048]',
                'name' => 'required',
                // 'languageCheck' => 'required'
            ];

            if (!$this->validate($rules)) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Please enter a name'
                ];

                return json_encode($response);
            }

            $flagFile      = $this->request->getFile('flag')->getName();
            $name          = $this->request->getPost('name');
            $code          = $this->request->getPost('code');
            $direction     = $this->request->getPost('direction');
            $languageCheck = $this->request->getPost('languageCheck') ? 1:0;

            // if($code == 0){
            //     $msg = "Please choose a language";
            //     return view('setting/createLanguage', ['res' => $result, 'msg' => $msg]);
            // }

            $data = [
                'language_image'  => $flagFile,
                'language_name'   => $name,
                'code'            => $code,
                'direction'       => $direction,
                'language_status' => $languageCheck
            ];

            $languageModel->insert($data);

            $flagFile = $this->request->getFile('flag');
            $flagFile->move(ROOTPATH . 'public/uploads');
    }

    // Language Added Method
    public function create(){

        $msg = "";
        $validation = \Config\Services::validation();
        $query = $this->db->query('SELECT * FROM language_code');

        $result = $query->getResult();

        if(!$this->request->is('POST')){
            return view('setting/createLanguage', ['res' => $result, 'msg' => $msg]);
        }else{
            $languageModel = new LanguageModel();
            $rules = [
                'flag' => 'uploaded[flag]|mime_in[flag,image/png,image/jpg,image/jpeg]|max_size[flag,2048]',
                'name' => 'required',
                // 'languageCheck' => 'required'
            ];

            if (!$this->validate($rules)) {
                $response = [
                    'success' => 'language check',
                ];

                return json_encode($response);
            }

            $flagFile      = $this->request->getFile('flag')->getName();
            $name          = $this->request->getPost('name');
            $code          = $this->request->getPost('code');
            $direction     = $this->request->getPost('direction');
            $languageCheck = $this->request->getPost('languageCheck') ? 1:0;

            if($code == 0){
                $msg = "Please choose a language";
                return view('setting/createLanguage', ['res' => $result, 'msg' => $msg]);
            }

            $data = [
                'language_image'  => $flagFile,
                'language_name'   => $name,
                'code'            => $code,
                'direction'       => $direction,
                'language_status' => $languageCheck
            ];

            $languageModel->insert($data);

            $flagFile = $this->request->getFile('flag');
            $flagFile->move(ROOTPATH . 'public/uploads');

            //Retrieve all data
            $languages = $languageModel->findAll();

            // Set flash data for success message
            $successMessage = 'Language added successfully.';
            session()->setFlashdata('success', $successMessage);

            return view('setting/createLanguage', ['languages' => $languages, 'successMessage' => $successMessage, 'res' => $result, 'msg' => $msg]); 
        }
    }

    //Edit form for language
    public function edit($id){
        if($id != null){
            $result = $this->model->find($id);

            $id              = $result['id'];
            $image           = $result['language_image'];
            $name            = $result['language_name'];
            $code            = $result['code'];
            $direction       = $result['direction'];
            $language_status = $result['language_status'];

            // $query = $this->db->query('SELECT * FROM language_code');
            // $languageResult = $query->getResult();
            // 'languageRes'=>$languageResult,
            

            if(!empty($result)){
                return view('setting/editLanguage', ['id'=>$id,'image'=> $image,'name' => $name, 'code'=> $code, 'direction'=> $direction, 'language_status'=> $language_status]);
            }
        }
    }

    public function update(){

        $validationRules = [
            'name' => 'required',
            'direction' => 'required',
            'flag' => 'uploaded[flag]|max_size[flag,1024]|ext_in[flag,png,jpg,jpeg]'
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $id            = $this->request->getPost('lang_id');
        $flagFile      = $this->request->getFile('flag')->getName();
        $name          = $this->request->getPost('name');
        $direction     = $this->request->getPost('direction');
        $languageCheck = $this->request->getPost('languageCheck') ? 1:0;

        $data = [
            'language_image'  => $flagFile,
            'language_name'   => $name,
            'direction'       => $direction,
            'language_status' => $languageCheck
        ];

        $flagFile = $this->request->getFile('flag');
        $flagFile->move(ROOTPATH . 'public/uploads');

        $success = $this->model->update($id, $data);
        if($success){
            return redirect()->to('language/setting');
        } 
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

    public function delete($id){
        if($id != null){
            $this->model->delete($id);
            session()->setFlashdata('delete_success', 'Language deleted successfully.');
            return redirect()->to('/language/setting');
        }
    }
}