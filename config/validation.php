<?php

return [
    //user
    'name' => 'required|string|max:50',
    'email' => 'required|string|email|max:100',
    'password' => 'required|min:6|max:100',

    //ulti
    'title' => 'required|string|max:255',
    'boolean' => 'required|boolean',
    'numeric' => 'required|numeric'
];
