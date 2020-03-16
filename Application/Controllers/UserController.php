<?php
namespace Application\Controllers;

use Application\Views\UserView;
use JAWA\JAWAController;

class UserController extends JAWAController
{
    public function __construct()
    {
        $this->view = new UserView();
        $this->userRoutes = self::resourcefulRoutes();
        $this->guestRoutes = [];
    }
}