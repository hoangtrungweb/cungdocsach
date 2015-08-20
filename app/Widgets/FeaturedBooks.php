<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Book;
use DB;

class FeaturedBooks extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 4
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $listItem = Book::where('featured','=','1')->orderBy(DB::raw('RAND()'))->take($this->config['count'])->get();
     
        // return view("widgets.featured_books", [
        //     'config' => $this->config,
        //     'featuredItem' => $featuredItem
        // ]);
        return view("widgets.featured_books",compact('listItem'));
    }
}