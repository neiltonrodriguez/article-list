<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function create(Request $r)
    {
            $u = auth()->user();

            try {
                $article = new Article();
                $article->title = $r->title;
                $article->description = $r->description;
                $article->text = $r->text;
                $article->author = $u->email;

                $image = "";
                if($r->hasFile('image')){
                    $reqImage = $r->file('image');
                    $extension = $reqImage->extension();
                    $imageName = md5($reqImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $reqImage->move(public_path('img/categorias'), $imageName);
                    $image = $imageName;
                }

                $article->image = $image;
                $article->created_at = now();
                $article->updated_at = now();

                if ($article->save()) {
                    return response()->json(['status' => 'success', 'data' => $article]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }

        return response()->json(['error' => true, 'message' => 'voce nao tem permissao para executar essa acao'], 500);
    }

    public function getAll(){
        $query = Article::query()->select('id', 'title', 'description', 'image', 'created_at');
        $articles = $query->paginate(2);
        return response()->json($articles);
    }

    public function getById($id)
    {
        $article = Article::where('id', '=', $id)->first();
        return response()->json(['status' => 'success', 'data' => $article]);
    }
}
