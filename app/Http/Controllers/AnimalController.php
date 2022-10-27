<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    #property animals
    public $animals = [
        [
            "name" => "Anjing"
        ],
        [
            "name" => "Monyet"
        ],
        [
            "name" => "Babi"
        ]
    ];

    #method index (menampilkan data)
    public function index()
    {
        echo "Daftar nama hewan <br>";
       foreach($this->animals as $animal)
       {
            echo "-" .  $animal["name"] . "<br>"; 
       }
    }

    #method store (menambahkan data)
    public function store(Request $request)
    {
      echo "Menambahkan hewan: $request->name <br>";
      array_push($this->animals, $request);
      $this->index();
    }

    #method update (mengupdate data)
    public function update(Request $request, $id)
    {
        echo "Mengubah nama hewan: " . $this->animals[$id]["name"] . " dengan nama $request->name <br>";
        $this->animals[$id] = $request;
        $this->index();
    }

    #method destroy (menghapus data)
    public function destroy($id)
    {
        echo "Menghapus data hewan ". $this->animals[$id]["name"] . "<br>";
        unset($this->animals[$id]);
        $this->index();
    }

    /*
    Nama    : Muhammad Ammar Ayyasy
    Nim     : 0110221082
    Rombel  : TI03
    */
}
