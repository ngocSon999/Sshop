<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ratting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function addComment(Request $request)
    {
        $id = $request->idComment;
        $statusComment = $request->status_comment;
        $comment = Comment::find($id);
        $comment->comment_status = $statusComment;
        $comment->save();

        $comment = Comment::find($id);
        $statusComment = $comment->comment_status;
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'status' => $statusComment,
        ], 200);
    }

    public function saveComment(Request $request)
    {
        Comment::create([
            'user_id' => \Auth::id(),
            'product_id' => $request->product_id,
            'name' => \Auth::user()->name,
            'email' => \Auth::user()->email,
            'description' => $request->description,
            'content' => $request->contents,
            'comment_status' => 1,
        ]);
        return back()->with('tb', 'Thêm bình luận thành công');
    }



    public function replyComment(Request $request)
    {
        $commentId = $request->comment_id;
        $dataComment = $request->comments;
        $productId = $request->product_id;
        Comment::create([
            'user_id' => \Auth::id(),
            'product_id' =>$productId,
            'name' => \Auth::user()->name,
            'email' => \Auth::user()->email,
            'content' =>$dataComment,
            'comment_status' => 0,
            'parent_comment_id'=>$commentId,
        ]);
            return \response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
    }
    public function editComment($id)
    {
        $comment = Comment::find($id);
        return \response()->json(['data'=>$comment]);
    }

    public function updateComment(Request $request){
        $id = $request->comment_id;
        $data = [
          'description'=>$request->descriptionComment,
          'content'=>$request->contentComment,
        ];
        Comment::where('id',$id)->update($data);
        return response()->json(['code'=>200],200);
    }

    public function deleteComment($id){
        Comment::where('id',$id)->delete();
        return back();
    }
}
