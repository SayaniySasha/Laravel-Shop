<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class SearchController extends Controller
{
  /**
   * Поиск по таблице posts.
   *
   * @param  Request $request
   * @return mixed
   */
  public function search(Request $request)
  {
      // Определим сообщение, которое будет отображаться, если ничего не найдено
      // или поисковая строка пуста
      $error = ['error' => 'No results found, please try with different keywords.'];

      // Удостоверимся, что поисковая строка есть
      if($request->has('q')) {

          // Используем синтаксис Laravel Scout для поиска по таблице posts.
          $posts = Post::search($request->get('q'))->get();

          // Если есть результат есть, вернем его, если нет  - вернем сообщение об ошибке.
          return $posts->count() ? $posts : $error;

      }

      // Вернем сообщение об ошибке, если нет поискового запроса
      return $error;
  }
}
