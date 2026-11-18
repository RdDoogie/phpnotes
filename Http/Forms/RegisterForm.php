<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (! Validator::string($attributes['name'], 5, 20)) {
            $this->errors['name'] = 'Please provide a valid Username.';
        }
        if (! Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (! Validator::string($attributes['password'], 7, 255)) {
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

    public static function validate(array $attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed(): bool
    {
        return count($this->errors) > 0;
    }

    public function throw(): never
    {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function error(string $field, string $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}