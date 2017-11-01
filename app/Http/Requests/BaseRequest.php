<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Janaagraha\Sanitizer\SanitizesInputTrait;

class BaseRequest extends FormRequest
{
    use SanitizesInputTrait;
}
