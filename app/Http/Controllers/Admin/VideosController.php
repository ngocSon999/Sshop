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
                    <th scope="col">'.$i.'</th>
                    <th scope="row">'.$video->video_name.'</th>
                    <th scope="row">'.$video->video_link.'</th>
                    <th scope="row">'.$video->video_title.'</th>
                    <th scope="row">'.$video->video_description.'</th>
                    <th><iframe width="200" height="200" src="'.$video->video_link.'"
                     title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                      encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></th>
                    <td>
                    <button type="button" data-video_id="'.$video->id.'" class="btn btn-danger btn-sm delete-video">Xóa</button>
                    </tr>';}}

                    $dataoutput .='</tbody>
                                    </table>
                                    </form>
                                    ';
        echo $dataoutput;
    }



    public function deleteVideo(Request $request){
        $id=$request->video_id;
       Video::find($id)->delete();
    }
}
