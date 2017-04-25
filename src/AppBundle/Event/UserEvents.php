<?php

namespace AppBundle\Event;

class UserEvents
{
    const RESETTING_REQUEST_SUCCESS = 'user.resetting.request.success';
    const RESETTING_RESET_INITIALIZE = 'user.resetting.reset.initialize';
    const RESETTING_RESET_SUCCESS = 'user.resetting.reset.success';

    const CREATE_SUCCESS = 'user.create.success';
}