<?php

namespace App\Services;

class CodeGeneratorService
{
    public function generate(string $model, string $prefix, int $digit = 3): string
    {
        $lastCode = $model::withTrashed()->latest()->first();

        $nextNumber = 1;

        if ($lastCode) {
            $number = substr($lastCode->code, strlen($prefix));
            $nextNumber = (int) $number + 1;
        }

        return $prefix . str_pad($nextNumber, $digit, '0', STR_PAD_LEFT);
    }
}
