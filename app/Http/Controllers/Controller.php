<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    // Agora seu controller terá todos os métodos base do Laravel
    // incluindo o método middleware()
}