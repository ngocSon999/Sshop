<?php
namespace App\Components;
use App\Models\Menu;

class MenuRecusive {
    private $html;
    public function __construct(){

        $this->html='';
    }
    public function menuRecusiveAdd($parentId=0,$subMark = ''){
        $data = Menu::where('parent_id',$parentId)->get();
        foreach ($data as $value){
            $this->html .= "<option value='".$value->id."'>".$subMark.$value->name."</option>";
            $this->menuRecusiveAdd($value->id,$subMark.'--');
        }
        return $this->html;
    }

    public function menuRecusiveEdit($parentIdEdit,$parentId=0,$subMark = ''){
        $data = Menu::where('parent_id',$parentId)->get();
        foreach ($data as $item){
            if($parentIdEdit == $item->id){
                $this->html .= "<option selected value='".$item->id."'>".$subMark.$item->name."</option>";
            }else{
                $this->html .= "<option  value='".$item->id."'>".$subMark.$item->name."</option>";
            }
            $this->menuRecusiveEdit($parentIdEdit,$item->id,$subMark.'--');
        }
        return $this->html;
    }

}
