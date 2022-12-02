<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckSlider;
use App\Http\Service\admins\SliderService;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\storageTrait;


class SliderController extends Controller
{
    use DeleteModelTrait,storageTrait;


    /**
     * @var SliderService
     */
    private $sliderService;
    private $slider;

    public function __construct(Slider $slider, SliderService $sliderService)
    {
        $this->slider = $slider;
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        $slides = $this->sliderService->getList();

        return view('admin.slider.index', compact('slides'));

    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(CheckSlider $request)
    {
        $this->sliderService->storeData($request);

        return redirect()->route('admin.slider.index');
    }

    public function edit($id)
    {
       $slider = $this->sliderService->getSlider($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(CheckSlider $request,$id)
    {
        $this->sliderService->updateSlider($request,$id);

        return redirect()->route('admin.slider.index');
    }


    public function delete($id)
    {
        $this->sliderService->deleteSlider($id);
    }
}
