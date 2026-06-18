<?php

namespace App\RealWorld\Transformers;

class UserTransformer extends Transformer
{
    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'email'     => $data['email'],
            'token'     => '',
            'username'  => $data['username'],
            'bio'       => $data['bio'],
            'image'     => $data['image'],
        ];
    }
}