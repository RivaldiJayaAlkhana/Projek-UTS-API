<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index () {
        // mendapatkan semua data students
        $employees = Employees::all();

       // jika data kosong maka kirim status code 204 dan tampilkan pesan eror
        if ($employees->isEmpty()) {
            $data = [
                "message" => "Resource is empty"
            ];
        
            return response()->json($data, 204);
        }

        // jika data berhasil ditemukan akan memumculkan pesan
        $data = [
            "message" => "Get all resource",
            "data" => $employees
        ];

        

        // jika data ada maka kirim status code 200
        return response()->json($data, 200);
    }

    public function store (Request $request) {
        // membuat validasi 
        $request->validate([
             'name' => "required",
             'gender' => "required",
             'phone' => "required",
             'address' => "required",
             'email' => "required|email",
             'status' => "required",
             'hired_on' => "required"
        ]);
        // membuat inputan untuk menambah data employees
         $input = [
             'name' => $request->name,
             'gender' => $request->gender,
             'phone' => $request->phone,
             'address' => $request->address,
             'email' => $request->email,
             'status' => $request->status,
             'hired_on' => $request->hired_on
         ];
         
         // menambahkan data employees
         $employees = Employees::create($input);
         
         // jika data berhasil di tambahkan akan memumculkan pesan sukses
         $data = [
             'message' => 'Employees is created succesfully',
             'data' => $employees,
         ];

         // kirim data(json) dan response code 200 jika berhasil
         return response()->json($data, 201);
     }
 
    
    public function show($id) {
        // mendapatkan data employees berdasarkan id
        $employees = Employees::find($id);
        
        // jika data kosong maka kirim status code 404 dan tampilkan pesan eror
        if (!$employees) {
            $data = [
                "message" => "Resource not found"
            ];
        
            return response()->json($data, 404);
        }
        // jika data ada maka akan memunculkan pesan
            $data = [
            "message" => "Show detail resoucre",
            "data" => $employees
        ];

        // mengembalikan data dan status code 200
        return response()->json($data, 200);
        }

        public function update($id, Request $request) {
            // mendapatkan data employees berdasarkan id
            $employees = Employees::find($id);
        
            // jika data kosong maka kirim status code 404 dan tampilkan pesan eror
        if (!$employees) {
            $data = [
                "message" => "Resource not found"
            ];
        
            return response()->json($data, 404);
        }
            // memasukan inputan sesuai data yang ingin di edit
            $input = [
                'name' => $request->name ?? $employees-> name,
                'gender' => $request->nim ?? $employees-> gender,
                'phone' => $request->phone ?? $employees-> phone,
                'address' => $request->address ?? $employees-> address,
                'email' => $request->email ?? $employees-> email,
                'status' => $request->status ?? $employees-> status,
                'hired_on' => $request->hired_on ?? $employees-> hired_on
            ];

            // mengupdate data yang telah di input 
            $employees->update($input);
        
            // jika data berhasil di update akan memumculkan pesan sukses
         $data = [
            'message' => 'Employees is update succesfully',
            'data' => $employees,
        ];
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);    
        }

        public function destroy($id) {
            // mendapatkan data employees berdasarkan id
            $employees = Employees::find($id);
        
           // jika data kosong maka kirim status code 404 dan tampilkan pesan eror
        if (!$employees) {
            $data = [
                "message" => "Resource not found"
            ];
        
            return response()->json($data, 404);
        }
            // mendelete data yang telah di input 
            $employees->delete();
        
            // jika data berhasil di delete akan memumculkan pesan sukses
         $data = [
            'message' => 'Employees is delete succesfully',
            'data' => $employees,
        ];
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);
        } 

        public function search($name) {
            // mencari data employees berdasarkan nama
            $employees = Employees::where('name',$name)->get();
        
            // jika data kosong maka kirim status code 404 dan tampilkan pesan eror
            if (!$employees) {
                $data = [
                    "message" => "Resource not found",
                ];
        
                return response()->json($data, 404);
            }
            
            // jika data berhasil ditemukan akan memumculkan pesan
            $data = [
                "message" => "Get searched resource",
                "data" => $employees
            ];
        
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);
        }

        public function active() {
            // mencari data employees dengan status active
            $activeEmployees = Employees::where('status', 'active')->get();
        
            // mendapatkan jumlah total active employees
            $totalActiveEmployees = $activeEmployees->count();
            
            // jika data berhasil ditemukan akan memumculkan pesan
            $data = [
                "message" => "Get active resource",
                "total" => $totalActiveEmployees,
                "data" => $activeEmployees
            ];
        
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);
        }

        public function inactive() {
            // mencari data employees dengan status active
            $inactiveEmployees = Employees::where('status', 'inactive')->get();
        
            // mendapatkan jumlah total inactive employees
            $totalInactiveEmployees = $inactiveEmployees->count();
            
             // jika data berhasil ditemukan akan memumculkan pesan
            $data = [
                "message" => "Get inactive resource",
                "total" => $totalInactiveEmployees,
                "data" => $inactiveEmployees
            ];
        
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);
        }

        public function terminated() {
            // mencari data employees dengan status terminated
            $terminatedEmployees = Employees::where('status', 'terminated')->get();
        
            // mendapatkan jumlah total terminated employees
            $totalTerminatedEmployees = $terminatedEmployees->count();
            
            // jika data berhasil ditemukan akan memumculkan pesan
            $data = [
                "message" => "Get terminated resource",
                "total" => $totalTerminatedEmployees,
                "data" => $terminatedEmployees
            ];
        
            // kirim data(json) dan response code 200 jika berhasil
            return response()->json($data, 200);
        }

        
    }
