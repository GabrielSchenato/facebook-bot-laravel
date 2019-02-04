<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Menu;
use CodeBot\Build\Solid;

class MenusController extends Controller
{

    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['menu_buttons'];

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
    
    public function setMenu(int $menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        
        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));
        
        $result = $bot->addMenu($menu->locale, $menu->composer_input_disabled, $menu->menu_buttons->toArray());
        
        $menu->facebook_diff = false;
        $menu->save();
        
        return $result;
    }
    
    public function removeMenu()
    {
        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));
        
        return $bot->removeMenu();
    }

}
