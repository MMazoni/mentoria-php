<?php

namespace App\Domain;

class ContactNumber
{
    public function __construct(
        private string $ddd,
        private string $number
    )
    {
        $this->defineDdd($ddd);
        $this->defineNumber($this->number);
    }

    private function defineDdd(string $ddd): void
    {
        if (preg_match('/\d{2}/', $ddd) !== 1) {
            throw new \InvalidArgumentException('Invalid DDD');
        }

        $this->ddd = $ddd;
    }

    private function defineNumber(string $number): void
    {
        if (preg_match('/\d{8,9}/', $number) !== 1) {
            throw new \InvalidArgumentException('Invalid phone number');
        }

        $this->number = $number;
    }

    public function __toString(): string
    {
        return "($this->ddd) $this->number";
    }
}