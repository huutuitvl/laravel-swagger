<?php
public function rules() {
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ];
}
