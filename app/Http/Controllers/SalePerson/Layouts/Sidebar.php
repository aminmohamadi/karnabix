<?php

namespace App\Http\Controllers\SalePerson\Layouts;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;

use Livewire\Component;

class Sidebar extends Component
{
    public function render
    (
        CommentRepositoryInterface $commentRepository,
        NewCourseRepositoryInterface $newCourseRepository
    )
    {
        $data = [
            'comments' => $commentRepository::getNew(),
            'new_courses' => $newCourseRepository::getNewTeacher(),
        ];
        return view('salePerson.layouts.sidebar',$data);
    }
}
