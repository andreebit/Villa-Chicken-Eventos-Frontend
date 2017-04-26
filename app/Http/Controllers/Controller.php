<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $message
     */
    protected function setSuccessMessage($message = null)
    {
        $message = (is_null($message)) ? trans('messages.success') : $message;
        request()->session()->flash('success_message', $message);
    }
}
