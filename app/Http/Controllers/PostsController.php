<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function show(Post $post){
        
        $recent_posts = Post::latest()->take(5)->get();
        //Bộ sưu tập kết quả sẽ chứa 5 bài đăng gần đây nhất, sẽ được sử dụng để hiển thị nội dung gần đây trên trang bài đăng.
        $categories  = Category::where('name','!=','Chưa phân loại')->withCount('posts')->orderBy('created_at','DESC')->take(10)->get();
        //Dòng này truy xuất tối đa 10 danh mục từ cơ sở dữ liệu, ngoại trừ danh mục có tên "Chưa phân loại" (Chưa phân loại).
//where('name','!=','Chưa phân loại')lọc ra danh mục "Chưa phân loại".



        $tags = Tag::latest()->take(50)->get();

        /*----- Lấy ra 4 bài viết mới nhất theo các danh mục khác nhau -----*/
        $category_unclassified = Category::where('name','Chưa phân loại')->first();
//Dòng này truy xuất danh mục có tên "Chưa phân loại" (Chưa được phân loại) từ cơ sở dữ liệu bằng cách sử dụng mô Categoryhình.

//Bộ mã tiếp theo sử dụng một vòng lặp để truy xuất 4 bài đăng được phê duyệt mới nhất từ ​​​​các danh mục khác nhau (không bao gồm danh mục "Chưa phân loại") 
//và lưu trữ chúng trong mảng $posts_new.
        $posts_new[0]= Post::latest()->approved()
                    ->where('category_id','!=', $category_unclassified->id )
                    ->take(1)->get();
        $posts_new[1] = Post::latest()->approved()
                    ->where('category_id','!=', $category_unclassified->id )
                    ->where('category_id','!=', $posts_new[0][0]->category->id )
                    ->take(1)->get();
        $posts_new[2] = Post::latest()->approved()
                    ->where('category_id','!=', $category_unclassified->id )
                    ->where('category_id','!=', $posts_new[0][0]->category->id )
                    ->where('category_id','!=', $posts_new[1][0]->category->id )
                    ->take(1)->get();
        $posts_new[3] = Post::latest()->approved()
                    ->where('category_id','!=', $category_unclassified->id )
                    ->where('category_id','!=', $posts_new[0][0]->category->id )
                    ->where('category_id','!=', $posts_new[1][0]->category->id)
                    ->where('category_id','!=', $posts_new[2][0]->category->id )
                    ->take(1)->get(); 

        
        // Bài viết tương tự 
        $postTheSame = Post::latest()->approved()->where('category_id', $post->category->id)->where('id', '!=' , $post->id)->take(5)->get(); ;
        

        // Bài viết nổi bật
        $outstanding_posts = Post::approved()->where('category_id', '!=',  $category_unclassified->id )->take(5)->get();
        
        // Tăng lượt xem khi xem bài viết
        $post->views =  ($post->views) + 1;
        $post->save();

        return view('post', [ 
            'post' => $post,  //Đây có thể là một biến chứa thông tin về bài viết hiện tại được hiển thị, có thể là một đối tượng hoặc một mảng dữ liệu.
            'recent_posts' => $recent_posts,   //Mảng chứa thông tin về những bài viết gần đây.
            'categories' => $categories,    //Mảng chứa thông tin về các danh mục (categories) mà bài viết hiện tại thuộc về.
            'tags' => $tags,   //Mảng chứa thông tin về các thẻ (tags) liên quan đến bài viết hiện tại.
            'posts_new' => $posts_new, //Mảng chứa thông tin về những bài viết mới nhất.
            'postTheSame' =>  $postTheSame, // Bài viết tương tự
            'outstanding_posts' => $outstanding_posts, // bài viết xu hướng
        ]);
    }

    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:5|max:300']);//Dòng này lấy các dữ liệu được gửi từ form (request) và sử dụng hàm "validate" để kiểm tra tính hợp lệ của chúng

        $attributes['user_id'] = auth()->id();

        $comment = $post->comments()->create($attributes);   //Dòng này tạo một bình luận mới trong cơ sở dữ liệu

        return redirect('/posts/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Bạn vừa bình luận thành công.');


    }

    public function addCommentUser(){
        $data = array();
        $data['success'] = 0;
        $data['errors'] = [];

        $rules = [
            'the_comment' => 'required|min:5|max:300',
            'post_title' => 'required',
        ];

        $validated = Validator::make( request()->all(), $rules);
//Đây là cấu trúc điều kiện để kiểm tra xem dữ liệu có vượt qua xác thực hay không.
        if($validated->fails()){
            $data['errors'] = $validated->errors()->first('the_comment');
      // Nếu xác thực không thành công, dòng này sẽ thiết lập thông báo lỗi chung cho người dùng.
            $data['message'] = "Khổng thể bình luận";

        }else{
            $attributes = $validated->validated();
            $post = Post::where('title', $attributes['post_title'])->first();

            $comment['the_comment'] = $attributes['the_comment']; // Dòng này tạo một mảng $comment để chứa thông tin bình luận mới. 
            //Sau đó, nó gán các giá trị bình luận, ID bài viết và ID người dùng vào mảng $comment.
            $comment['post_id'] = $post->id ; 
            $comment['user_id'] = auth()->id();

            $post->comments()->create($comment);
//Dòng này đặt thông báo thành công để trả về cho người dùng.
            $data['success'] = 1;
            $data['message'] = "Bạn đã bình luận thành công !";
            $data['result'] = $comment;
        }
  
        return response()->json($data);//Dòng này trả về kết quả dưới dạng JSON chứa thông báo thành công, 
        //thông báo lỗi (nếu có) và thông tin bình luận nếu bình luận thành công.
    }

    

   
}
