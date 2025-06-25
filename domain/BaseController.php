<?php

namespace Domain;

use App\Http\Controllers\Controller;
use Domain\Traits\ResponseTrait;

class BaseController extends Controller
{
    use ResponseTrait;
}
