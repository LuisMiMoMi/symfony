<?php
namespace App\Service;
class BDProvaLlibres
{
    private $llibres = array(
        array("isbn"  =>  "A111B3",  "titol"  =>  "El   joc   d'Ender",  "autor"=>"Orson Scott Card", "pagines" => 350),
        array("isbn"  =>  "A222B3",  "titol"  =>  "Shrek",  "autor"=>"No ho se", "pagines" => 1000),
        array("isbn"  =>  "A333B3",  "titol"  =>  "Harry Potter",  "autor"=>"Patatuela", "pagines" => 23345632)
    );

    public function get()
    {
        return $this->llibres;
    }
}