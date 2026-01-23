<?php

use App\CsrfTokenManager;

function csrf_token()
{
   return CsrfTokenManager::generateToken();
}