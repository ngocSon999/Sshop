<?php
namespace App\Http\Service\admins;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Support\Str;

class MenuService {

    private $menuRecusive;
    public function __construct(MenuRecusive $menuRecusive)
    {
        $this->menuRecusive=$menuRecusive;
    }

    public  function getListMenus()
    {
        return Menu::paginate(10);
    }

    public  function createMenus()
    {
        return  $this->menuRecusive->menuRecusiveAdd();
    }
    public function storeMenu($request)
    {
        $data = [
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ];
        Menu::create($data);
    }

    public function getEditMenu($id)
    {
        $menuEdit = Menu::find($id);
        $parentIdEdit=$menuEdit->parent_id;
        $htmlOption = $this->menuRecusive->menuRecusiveEdit($parentIdEdit);

        return [$menuEdit,$htmlOption];
    }

    public function updateMenu($request,$id)
    {
        $data = [
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ];
        Menu::find($id)->update($data);
    }

    public function deleteMenu($id)
    {
        Menu::find($id)->delete();
    }
}
