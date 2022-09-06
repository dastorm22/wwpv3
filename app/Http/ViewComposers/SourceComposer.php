<?php

namespace App\Http\ViewComposers;

use App\Source;
use Illuminate\View\View;

class SourceComposer
{
    protected $states;

    protected $columns = [
        null => 'NONE',
        0 => 'A',
        1 => 'B',
        2 => 'C',
        3 => 'D',
        4 => 'E',
        5 => 'F',
        6 => 'G',
        7 => 'H',
        8 => 'I',
        9 => 'J',
        10 => 'K',
        11 => 'L',
        12 => 'M',
        13 => 'N',
        14 => 'O',
        15 => 'P',
        16 => 'Q',
        17 => 'R',
        18 => 'S',
        19 => 'T',
        20 => 'U',
        21 => 'V',
        22 => 'W',
        23 => 'X',
        24 => 'Y',
        25 => 'Z',
    ];

    /**
     * Create a new address composer.
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->types = Source::TYPES;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('types', $this->types)->with('columns', $this->columns);
    }
}
