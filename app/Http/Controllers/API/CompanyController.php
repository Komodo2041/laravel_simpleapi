<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
 
    public function company(Request $request) 
    {
        $company = Company::all();
        return response()->json(['company' => $company], 200);
    }


    public function add(Request $request)
    {
        $allData = $request->all();
        $errors = $this->validateCompany($allData);
        if ($errors) {
            return response()->json(['message' => 'no company added', 'errors' => $errors], 404);
        }
 
        $company = Company::create([
           'name' => $allData['name'],
           'city' => $allData['city'],
           'adress' => $allData['adress'],
           'postcode' => $allData['postcode'],
           'nip' => $allData['nip'],
        ]);
        return response()->json(['message' => ' company added', 'id' => $company->id], 200);
    }
 
    private function validateCompany($params, $fields = ['name', 'nip', 'adress', 'city', 'postcode']) {
        $errors = [];
        foreach ($fields AS $key) {
           if (!isset($params[$key])) {
               $errors[] = "no field ".$key;
           } elseif (strlen($params[$key]) < 3) {
               $errors[] = $key." is too short";
           }
        } 
     
        if (isset($params['nip'])) {
            if (!$this->checkNIP($params['nip'])) {
                $errors[] = "incorrect tax identification number was provided";
            }
            $checkCompany = Company::where("nip", $params['nip'])->count();
       
            if ($checkCompany) {
                $errors[] = "the given tax identification number is already in use";
            }            
        }
        return $errors;
    }

     /* Pobrane z netu */
    private function checkNIP($nip) {
        $nip = preg_replace("/[^0-9]/", "", $nip);

        if (strlen($nip) != 10) {
            return false;
        }
        $wagi = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
        $suma = 0;
        for ($i = 0; $i < 9; $i++) {
            $suma += $nip[$i] * $wagi[$i];
        }
        if (($suma % 11) % 10 == $nip[9]) {
            return true;
        } else {
            return false;
        }
    }
 
    public function update(Request $request, string $id)
    {
        $company = Company::find($id);   
        if ($company) {
            $fields = ['name', 'nip', 'adress', 'city', 'postcode'];
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
            $errors = $this->validateCompany($allData, $toUpdate);
            if ($errors) {
                return response()->json(['message' => 'no company update', 'errors' => $errors], 404);
            }
            foreach ($toUpdate as $key) {
                $company->$key = $allData[$key];
            }
            $company->save();
            return response()->json(['message' => ' company updated', 'id' => $company->id], 200);
        }
        return response()->json(['message' => 'Company not found'], 404);     
    }
 
    public function destroy(string $id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            return response()->json(['message' => 'Company deleted'], 200);
        }
        return response()->json(['message' => 'Company not found'], 404);
    }
}
