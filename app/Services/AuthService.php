<?php

namespace App\Services;

use App\Exceptions\loginException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $phoneNumber;
    protected int $addressId;

    public static function make()
    {
        return new static();
    }
    public function register()
    {
        return User::query()
            ->create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone_number' => $this->phoneNumber,
                'address_id' => $this->addressId
            ]);
    }

    public function login()
    {
        $user = User::where('email', $this->getEmail())->first();

        if (!$user || !Hash::check($this->getEmail(), $user->password)) {
            throw new loginException('The provided credentials are incorrect.',403);
        }
        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }
    public function setName(string $name) :AuthService
    {
        $this->name = $name;
        return $this;
    }

    public function getName() :string
    {
        return $this->name;
    }
    public function setEmail(string $email) :AuthService
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail() :string
    {
        return $this->email;
    }
    public function setPassword(string $password) :AuthService
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword() :string
    {
        return $this->password;
    }
    public function setPhoneNumber(string $phoneNumber) :AuthService
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getPhoneNumber() :string
    {
        return $this->phoneNumber;
    }
    public function setAddressId(int $addressId) :AuthService
    {
        $this->addressId = $addressId;
        return $this;
    }

    public function getAddressId() :int
    {
        return $this->addressId;
    }
}