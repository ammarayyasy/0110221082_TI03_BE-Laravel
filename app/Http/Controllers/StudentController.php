<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    #method index - get all resources
    public function index()
    {
        #menggunakan model Student untuk select data
        $student = Student::all();

        if($student){
            $data = [
                'message' => 'Get all students',
                'data' => $student
            ];

            #menggunakan respons json laravel
            #otomatis set header content type json
            #otomatis mengubah data array ke json
            #mengatur status code
            return response()->json($data, 200);
        } else{
            $data = [
                'message' => 'Data student not found'
            ];

            #mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    #method store - menambahkan resource
    public function store(Request $request)
    {
        #menangkap request
        /*
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];
        */

        # membuat validasi
        $validateData = $request->validate([
            # kolom => rules/rules 
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);

        # menggunakan variable student untuk insert data
        $student = Student::create($validateData);

        $data = [
            'message' => 'student is created succesfully',
            'data' => $student
        ];

        # mengembalikan data (json) dan status code 201
        return responce()->json($data, 201);
    }

    # method update - mengupdate resource
    public function update(Request $request, $id){
        # cari id student yang ingin dicari
        $student = Student::find($id);
        
        if($student){
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];

            #melakukan update data
            $student->update($input);

            $data = [
                'message' => 'Student id '. $id . ' is updated',
                'data' => $student
            ];

            #mengembalikan data (json) status code 200
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Data student id ' . $id . ' not found'
            ];

            #mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }

    }

    # method destroy - menghapus resource (id)
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        $data = [
            'message' => 'Student with id '. $id . ' is removed'
        ];

        #mengembalikan data (json) status code 200
        return response()->json($data, 200);
    }

    # method show - mendapatakan detail student
    public function show($id){
        # cari id student yang ingin dicari
        $student = Student::find($id);

        if($student){
            $data = [
                'message' => 'Get detail student id ' . $id,
                'data' => $student
            ];

            #mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else{
            $data = [
                'message' => 'Data student id ' . $id . ' not found'
            ];

            #mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

}

/*
nama    = Muhammad Ammar Ayyasy
nim     = 0110221082
rombel  = TI03
*/
