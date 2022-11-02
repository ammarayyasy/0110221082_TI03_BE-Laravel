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
        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];

        #menggunakan respons json laravel
        #otomatis set header content type json
        #otomatis mengubah data array ke json
        #mengatur status code
        return response()->json($data, 200);
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

        $student = Student::create($request->all());

        $data = [
            'message' => 'Student is created succesfully',
            'data' => $student
        ];

        #mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    # method update - mengupdate resource
    public function update(Request $request, $id){
        $student = Student::find($id);
        $student->update($request->all());

        $data = [
            'message' => 'Student with id '. $id .' is updated',
            'data' => $student
        ];

        #mengembalikan data (json) status code 200
        return response()->json($data, 200);
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
}