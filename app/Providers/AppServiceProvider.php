<?php

namespace App\Providers;

use App\Mixin\ResponseMixin;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use App\Models\Board;
use App\Models\ExamList;
use App\Models\UniversityList;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::mixin(new ResponseMixin());
        \Artisan::call('schedule:run');


        $divisions = Division::all();
        view()->share('divisions',$divisions);
        $districts = District::all();
        view()->share('districts',$districts);
        $upazilas = Upazila::all();
        view()->share('upazilas',$upazilas);

        $exams = ExamList::all();
        view()->share('exams',$exams);
        $university_list = UniversityList::all();
        view()->share('university_list',$university_list);
        $boards = Board::all();
        view()->share('boards',$boards);
    }
}
