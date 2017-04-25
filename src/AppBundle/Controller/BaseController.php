<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected function getAppAttibute(Request $request, $attribute, $default = null)
    {
        $attributes = $request->attributes->get('_app_options');

        return isset($attributes[$attribute]) ? $attributes[$attribute] : $default;
    }
}