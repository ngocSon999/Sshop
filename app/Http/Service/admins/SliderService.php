<?php

namespace App\Http\Service\admins;

use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\storageTrait;
use Symfony\Component\HttpFoundation\Request;

class SliderService
{
    use storageTrait;
    use DeleteModelTrait;
    public function getList()
    {
        return Slider
            ::orderBy('id','DESC')
            ->paginate(3);
    }

    public function storeData(Request $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $silderImgTrait = $this->storageTraitUpload($request, 'image_path', 'slider');
        if (!empty($silderImgTrait)) {
            $dataInsert['image_name'] = $silderImgTrait['file_name'];
            $dataInsert['image_path'] = $silderImgTrait['file_path'];

        }
        Slider::create($dataInsert);
    }

    public function getSlider($id)
    {
        return Slider::find($id);
    }

    public function updateSlider($request,$id)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $silderImgTrait = $this->storageTraitUpload($request, 'image_path', 'slider');
        if (!empty($silderImgTrait)) {
            $dataInsert['image_name'] = $silderImgTrait['file_name'];
            $dataInsert['image_path'] = $silderImgTrait['file_path'];

        }
        Slider::where('id', $id)->update($dataInsert);
    }


    public function deleteSlider($id)
    {
        return $this->deleteModelTrait($id, Slider::class);
    }

}
