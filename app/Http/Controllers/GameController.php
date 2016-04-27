<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use DB;

class GameController extends Controller
{
    public function index(){
        return view('index');
    }

    public function show(Question $question, Category $category){
        $categories = Category::all()->take(6);
        $questions = Question::all()->where('category_id', $category->id);
        return view('game', compact('categories', 'questions', 'question'));
    }

    public function showQuestion(Category $category){
        return view('question', compact('question', 'category'));
    }
}
