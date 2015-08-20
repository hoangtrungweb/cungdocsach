<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Book;
use DB;

class SamecategoryBooks extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 4,
        'id' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $listItem = Book::where('cate_id','=',$this->config['id'])->orderBy(DB::raw('RAND()'))->take($this->config['count'])->get();
     
        // return view("widgets.featured_books", [
        //     'config' => $this->config,
        //     'featuredItem' => $featuredItem
        // ]);
        return view("widgets.samecategory_books",compact('listItem'));
    }
}