<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function video(){
        return view('admin.videos.index');
    }

    public function selectVideo(){
        $videos = Video::orderBy('id','desc')->paginate(10);
        $video_count = $videos->count();
        $dataoutput ='<form action="">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên video</th>
                    <th scope="col">Link video</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Demo</th>
                    <th scope="col">Thao tác</th>
                </tr>
                </thead>
                <tbody>';

                if($video_count>0){
                                $i=0;
                                foreach($videos as $key=>$video){
                                $i++;
                    $dataoutput .=' <tr>
                    <th contenteditable  scope="col">'.$video->id.'</th>
                    <th contenteditable  class="video_name_'.$video->id.' editVideo"  data-video_id="'.$video->id.'" data-video_type="video_name" id="video_name_'.$video->id.'" scope="row">'.$video->video_name.'</th>
                    <th contenteditable   class="video_link_'.$video->id.' editVideo" data-video_id="'.$video->id.'" data-video_type="video_link" id="video_link_'.$video->id.'" scope="row">'.$video->video_link.'</th>
                    <th contenteditable  class="video_title_'.$video->id.' editVideo" data-video_id="'.$video->id.'" data-video_type="video_title" id="video_title_'.$video->id.'" scope="row">'.$video->video_title.'</th>
                    <th contenteditable  class="video_description_'.$video->id.' editVideo" data-video_id="'.$video->id.'" data-video_type="video_description" id="video_description_'.$video->id.'" scope="row">'.$video->video_description.'</th>
                    <th>
                      <iframe width="200" height="200" src="https://www.youtube.com/embed/'.$video->video_link.'"
                         title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                          encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </th>
                    <td>
                    <button type="button" data-video_id="'.$video->id.'" class="btn btn-danger btn-sm delete-video">Xóa</button>
                    <button type="button"
                     data-toggle="modal" data-target="#modal_edit_video" data-video_id="'.$video->id.'" class="btn btn-success btn-sm btn-edit-video">Sửa</button>
                    </tr>';}}

                    $dataoutput .='</tbody>
                                    </table>
                                    </form>
                                    ';
        echo $dataoutput;
    }


    public function addVideo(Request $request){
        $data=[
            'video_name'=>$request->video_name,
            'video_link'=>substr($request->video_link,17),
            'video_title'=>$request->video_title,
            'video_description'=>$request->video_description,
            ];
        Video::create($data);
    }
//SỬA VIDEO ĐỂ SAU
    public function editVideo(Request $request){
        $id = $request->video_id;
    }
    public  function updateVideo(Request $request){
        $video_edit = $request->video_edit;
        $video_type = $request->video_type;
        $id=$request->video_id;
        $video = Video::find($id);
        if($video_type == 'video_name'){
            $video->video_name = $video_edit;
        }
        if($video_type == 'video_link'){
            $video->video_link = substr($video_edit,17);
        }
        if($video_type == 'video_title'){
            $video->video_title = $video_edit;
        }
        if($video_type == 'video_description'){
            $video->video_description = $video_edit;
        }
        $video->save();
    }



    public function showVideo(Request $request){
        $id = $request->video_id;
        $video = Video::find($id);
        return response()->json($video);
    }

    public function deleteVideo(Request $request){
        $id=$request->video_id;
       Video::find($id)->delete();
    }
}
