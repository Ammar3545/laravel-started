<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptionController extends Controller
{
    public function encrypt()
    {
        $encryptString=Crypt::encrypt(205010);//encryptString
        return $encryptString;
    }

    public function decrypt()//decryptString
    {
        $decryptString=Crypt::decrypt('eyJpdiI6IkpyK2ZxcHZwQm1tMUkzZDBrYUVQMEE9PSIsInZhbHVlIjoid1BEK2xlUDdBb3dPMmloYTAreVd0Zz09IiwibWFjIjoiNTU0ZDllMzJkYjQ0NDNiNTkxNDgwOWMyNDUxZTQyOGMwYzU5OGYxYWE3YmIzNTU3YjU0OTk1MzYyY2JmOTI3NSIsInRhZyI6IiJ9');
        return $decryptString;
    }
}
