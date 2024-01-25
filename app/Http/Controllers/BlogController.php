<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\BlogCreateRequest;
use App\Http\Requests\Blogs\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Traits\UploadImage;
use Exception;

class BlogController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['blogs'] = Blog::paginate(10);
            if (request()->has('show')) {
                $data['blogs'] = Blog::paginate(request()->show);
                $data['show'] = request()->show;
            } elseif (request()->has('query')) {
                $query = preg_replace('/[0-9\@\.\;\" "]+/', '', request()->get('query'));
                $data['blogs'] = Blog::where('name', 'LIKE', "%{$query}%")
                    ->Orwhere('status', 'LIKE', "%{$query}%")
                    ->paginate(10);
            } else {
                $data['blogs'] = Blog::paginate(10);
            }
            return view('admin.cms.blogs.index', $data);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.cms.blogs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCreateRequest $request)
    {
        try {
            $data = $request->validated();

            $tags  = $_POST['tags'];
            $tags  = json_encode($tags);
            $tags  = htmlspecialchars_decode($tags); // save this to database
            $tags = explode(',', $request->tags);
            $tag_id = null;
            foreach ($tags as $tag) {
                $tag = Tag::firstOrCreate([
                    'name' => $tag,
                    'slug' => Str::slug($tag, '-')
                ]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'], 'blogs');
                $data['image'] = $image['path'];
            }

            $blog = Blog::create($data);
            $blog->tags()->sync($tagIds);

            return redirect()->back()->with('success', 'Blog has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data['blog'] = Blog::find($id);
            if(!$data['blog']) {
                throw new Exception('Blog could not be found on server');
            }
            if(!$data['blog']) {
                throw new Exception('Blog could not be found on server');
            }
            $data['categories'] = Category::all();
            return view('admin.cms.blogs.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {
        try {
            $blog = Blog::find($id);
            if(!$blog) {
                throw new Exception('Blog could not be found on server');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'], 'blogs');
                $data['image'] = $image['path'];

                if ($blog->image) {
                    unlink(public_path($blog->image));
                }
            }
            $blog->update($data);

            // Update Blogs Tag
            $tagsName = explode(',', $data['tags']);
            $tagIds = [];
            foreach ($tagsName as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate([
                        'name' => $tagName,
                        'slug' => Str::slug($tagName)
                    ]);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                }
            }
            $blog->tags()->sync($tagIds);

            return redirect()->back()->with('success', 'Blog has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::find($id);
            if(!$blog) {
                throw new Exception('Blog could not be found on server');
            }
            if ($blog->image) {
                unlink(public_path($blog->image));
            }
            $blog->delete();
            return redirect()->back()->with('success', 'Blog has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
