<?php

namespace App\Exceptions;

use Exception;

class NotFound extends Exception
{
    public function report(){

    }

    public function render(){//here we put code that are want to active when error has found to avtive the exception
        return '404 page not found';
    }
}
