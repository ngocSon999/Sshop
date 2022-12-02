<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckMenu;
use App\Http\Service\admins\MenuService;

//file đệ quy

//Xóa mềm


class MenusController extends Controller
{
    private $menuSevrvice;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->getListMenus();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $htmlOption = $this->menuService->createMenus();
        return view('admin.menus.create', compact('htmlOption'));
    }


    public function store(CheckMenu $request)
    {
        $this->menuService->storeMenu($request);
        return redirect()->route('admin.menu.index')->with('tb', 'Thêm menu thành công');
    }

    public function edit($id)
    {
        $data = $this->menuService->getEditMenu($id);
        list($menuEdit, $htmlOption) = $data;

        return view('admin.menus.edit', compact('menuEdit', 'htmlOption'));
    }


    public function update(CheckMenu $request, $id)
    {
        $this->menuService->updateMenu($request, $id);

        return redirect()->route('admin.menu.index')->with('tb', 'Update menu thành công');
    }

    public function delete($id)
    {
        $this->menuService->deleteMenu($id);

        return back()->with('tb', 'Xóa menu thành công');
    }
}
