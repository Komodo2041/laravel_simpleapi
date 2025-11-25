<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Workers;

class WorkerController extends Controller
{
    public function add(Request $request)
    { 
        $allData = $request->all();
        $errors = $this->validateWorker($allData);
        if ($errors) {
            return response()->json(['message' => 'No Worker added', 'errors' => $errors], 404);
        }
        $data = [
           'name' => $allData['name'],
           'surname' => $allData['surname'],
           'company_id' => $allData['company_id'],
           'email' => $allData['email']     
        ];
        if (isset($allData['phone'])) {
            $data['phone'] = $allData['phone'];
        }
        $worker = Workers::create($data);
        return response()->json(['message' => 'Worker added', 'id' => $worker->id], 200);
       
    }

    private function validateWorker($params, $fields = ['name', 'surname', 'email',  'company_id']) {
        $errors = [];
        foreach ($fields AS $key) {
           if (!isset($params[$key])) {
               $errors[] = "no field ".$key;
           } elseif ($key != "company_id" && strlen($params[$key]) < 3) {
               $errors[] = $key." is too short";
           }
        } 
     
        if (isset($params['company_id'])) {
            $company = Company::find($params['company_id']);  
            if (!$company) {
                $errors[] = "Company Not Found";
            }            
        }
        if (isset($params['email'])) {
            if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "incorrect email address provided";
            }
        }
        return $errors;
    }

    public function destroy(string $id)
    {
        $company = Workers::find($id);
        if ($company) {
            $company->delete();
            return response()->json(['message' => 'Worker deleted'], 200);
        }
        return response()->json(['message' => 'Worker not found'], 404);
    }

    public function update(Request $request, string $id)
    {
        $worker = Workers::find($id);   
        if ($worker) {
            $fields = ['name', 'surname', 'email', 'phone', 'company_id'];
            $allData = $request->all();
            $toUpdate = [];
            foreach ($fields AS $key) {
                if (isset($allData[$key])) {
                    $toUpdate[] = $key;
                }
            }
            if (!$toUpdate) {
                return response()->json(['message' => 'no fields for improvement'], 404);   
            }
            $errors = $this->validateWorker($allData, $toUpdate);
            if ($errors) {
                return response()->json(['message' => 'no worker update', 'errors' => $errors], 404);
            }
            foreach ($toUpdate as $key) {
                $worker->$key = $allData[$key];
            }
            $worker->save();
            return response()->json(['message' => 'worker updated', 'id' => $worker->id], 200);
        }
        return response()->json(['message' => 'Worker not found'], 404);     
    }


}
