<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class GeneralController extends BaseController
{
    protected $model,$db;

    function __construct(){
        $this->db = \Config\Database::connect();
        $this->model = new GeneralModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        
        // if(count($data) > 0){
           
        // } else {
        //     return view('general/general', ['data' => null, 'color'=>null]);
        // }

        foreach($data as $row){
            $jsonDecodeGeneral = json_decode($row['general']);
            $jsonDecodeColor = json_decode($row['colors']);
            return view('general/general', ['data'=>$jsonDecodeGeneral, 'color' => $jsonDecodeColor]);
        }
    }

    public function create(){
        $siteName  = $this->request->getPost("general")['site']['name'];
        $siteUrl   = $this->request->getPost("general")['site']['url'];
        $siteEmail = $this->request->getPost("general")['site']['email'];
        $siteTerms = $this->request->getPost("general")['site']['terms'];
        $siteDate  = $this->request->getPost("general")['site']['date'];
        $siteTime  = $this->request->getPost("general")['site']['time'];

        $primaryColor = $this->request->getPost('color')['site']['primary'];
        $secondaryColor = $this->request->getPost('color')['site']['secondary'];
        $thirdColor = $this->request->getPost('color')['site']['third'];
        $backgroundColor = $this->request->getPost('color')['site']['background'];

        // var_dump($this->request->getRawInput());


        $fullSite = [
            'name'  => $siteName,
            'url'   => $siteUrl,
            'email' => $siteEmail,
            'terms' => $siteTerms,
            'date'  => $siteDate,
            'time'  => $siteTime
        ];

        $fullColor = [
            'primary'    => $primaryColor,
            'secondary'  => $secondaryColor,
            'third'      => $thirdColor,
            'background' => $backgroundColor
        ];

        if (!empty($fullSite)) {
            $jsonEncodeData = json_encode($fullSite);
            $fullColor = json_encode($fullColor);
            $data = $this->model->insert([
                'general' => $jsonEncodeData,
                'colors' => $fullColor
            ]);
            
            if($data){
                return redirect()->to('/general/create')->with('success', 'Your site has been created');
            }
        } else {
            return "Something went wrong";
        }

        
    }
}