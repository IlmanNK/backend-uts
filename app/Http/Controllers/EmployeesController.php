<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;


class EmployeesController extends Controller
{
    // Menampikan data Employees
    public function index()
    {

        $employees = Employees::all();
        if ($employees->isEmpty()) {
            $data = [
                'message' => "Data is Empty"
            ];

            return response()->json($data, 200);
        }

        $data = [
            "message" => "Get All Resource",
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        // melakukan validatasi penambahan data
        $validateData = $request->validate([
            "Name" => "required|string",
            "Gender" => "required|in:L,P", // Sesuai gender karyawan atau Laki-laki dan Perempuan
            "Phone" => "required|numeric",
            "Email" => "required|email",
            "Address" => "required|string",
            "Status" => "required|string",
            "Hired_on" => "required|date",
            // "timestamp" => "required|date_format:Y-m-d",
        ]);

        $employees = Employees::create($validateData);

        $data = [
            "message" => "Resource is added successfully",
            "data" => $employees,
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $employees = Employees::find($id);
        if (!$employees) {
            $data = [
                "message" => "Resource not Found"
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                "message" => "Get Detail Resource"
            ];
            return response()->json($data, 200);
        }
    }

    public function update(Request $request, $id){

        $employees = Employees::find($id);

        if(!$employees) {
            return response()->json([
                'message' => 'Resource not found',
            ], 404);
        }

        $employees->update([
            "Name" => $request->Name ?? $employees->Name,
            "Gender" => $request->Gender ?? $employees->Gender,
            "Phone" => $request->Phone ?? $employees->Phone,
            "Email" => $request->Email ?? $employees->Email,
            "Address" => $request->Address ?? $employees->Address,
            "Status" => $request->Status ?? $employees->Status,
            "Hired_on" => $request->Hired_on ?? $employees->Hired_on,
        ]);

        
        $data = [
            'message' =>'Resource is updated successfully',
            'data' => $employees];
        return response()->json($data, 200);
        
    }

    public function destroy($id) {

        // mencari data siswa berdasarkan id
        $employees = Employees::find($id);

        // mengecek apakah data tersebut ada atau tidak
        if (!$employees) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        $employees->delete();
        return response()->json([
            'message' => 'Resource is delete succesfully',
            'data' => $employees   
        ], 200);
    }

    public function search(Request $request, $name){
        $name = $request->input('name');

        if (!$name) {
            return response()->json(['message' => 'Name parameter is required'], 400);
        }

        $searchEmployees = Employees::where('Name', 'like', "%$name%")->get();

        if ($searchEmployees->isEmpty()){
            return response()->json(['message'=>'Resource not Found'], 404);
        }

        return response()->json([
            'message' => 'Get searchd resource',
            'data' => $searchEmployees], 200);
        
    }

    public function getActiveResources(Request $request) {
        $activeResources = Employees::active()->get();
        $totalActiveResources = $activeResources->count();

        return response()->json([
            'message' => 'Get active resource',
            'total' => $totalActiveResources,
            'data' => $activeResources
        ], 200);
    
}
}
