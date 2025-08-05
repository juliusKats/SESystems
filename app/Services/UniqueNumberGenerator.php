<?php

namespace App\Services;

use App\Models\UserFiles;
use Illuminate\Support\Str;

class UniqueNumberGenerator
{
    /**
     * Create a new class instance.
     */
    private function generateUnique13DigitNumber(string $fieldName){
        do{
            //generate a 13-digi Random number
            $randomNumber=mt_random(1000000000000,9999999999999);
            $randomNumber=(string)$randomNumber; // Ensuring it is Sting;
            //check if number is in Database
            $exists=UserFiles::where($fieldName,$randomNumber)->exists();

        }
        while($exists);

        return $randomNumber;
    }
    public function getNewUniqueId(){
        return $this->generateUnique13DigitNumber('ticket');//Replace with fielname
    }
}
