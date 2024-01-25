<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified','auth'],'prefix' => 'admin'], function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'isAdmin'], function(){
         # Notice Routes
        Route::group(['prefix' => 'notices'], function(){
            Route::get('/',[NoticeController::class,'index'])->name('notices');
            Route::get('/create',[NoticeController::class,'create'])->name('notices.create');
            Route::post('/store',[NoticeController::class,'store'])->name('notices.store');
            Route::get('/edit/{id}',[NoticeController::class,'edit'])->name('notices.edit');
            Route::put('/update/{id}',[NoticeController::class,'update'])->name('notices.update');
            Route::delete('/delete/{id}',[NoticeController::class,'destroy'])->name('notices.destroy');
        });

        #Team Type Routes
        Route::group(['prefix' => 'team-types'], function(){
            Route::get('/',[TeamTypeController::class,'index'])->name('team-types');
            Route::get('/create',[TeamTypeController::class,'create'])->name('team-types.create');
            Route::post('/store',[TeamTypeController::class,'store'])->name('team-types.store');
            Route::get('/edit/{id}',[TeamTypeController::class,'edit'])->name('team-types.edit');
            Route::put('/update/{id}',[TeamTypeController::class,'update'])->name('team-types.update');
            Route::delete('/delete/{id}',[TeamTypeController::class,'destroy'])->name('team-types.destroy');
        });

        # Team Routes
        Route::group(['prefix' => 'teams'], function(){
            Route::get('/',[TeamController::class,'index'])->name('teams');
            Route::get('/create',[TeamController::class,'create'])->name('teams.create');
            Route::post('/store',[TeamController::class,'store'])->name('teams.store');
            Route::get('/edit/{id}',[TeamController::class,'edit'])->name('teams.edit');
            Route::put('/update/{id}',[TeamController::class,'update'])->name('teams.update');
            Route::delete('/delete/{id}',[TeamController::class,'destroy'])->name('teams.destroy');
        });

        # Settings Routes
        Route::group(['prefix' => 'settings'], function(){
            Route::get('/',[SettingController::class,'index'])->name('settings');
            Route::put('/update/{id}',[SettingController::class,'update'])->name('settings.update');
        });

        # User Routes
        Route::group(['prefix' => 'users'], function(){
            Route::get('/',[UserController::class,'index'])->name('users');
            Route::get('/create',[UserController::class,'create'])->name('users.create');
            Route::post('/store',[UserController::class,'store'])->name('users.store');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
            Route::put('/update/{id}',[UserController::class,'update'])->name('users.update');
            Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('users.destroy');
        });

        # Gallery Routes
        Route::group(['prefix' => 'themes'], function(){
            Route::get('/',[ThemeController::class,'index'])->name('themes');
            Route::put('/update/{id}',[ThemeController::class,'update'])->name('themes.update');
            Route::get('/remove-image/{id}',[ThemeController::class,'removeImage'])->name('themes.remove.image');
        });

        # AboutUs Routes
        Route::group(['prefix' => 'aboutus'], function(){
            Route::get('/',[AboutUsController::class,'index'])->name('aboutus');
            Route::put('/update/{id}',[AboutUsController::class,'update'])->name('aboutus.update');
        });
        # Terms Conditions Routes
        Route::group(['prefix' => 'terms-conditions'], function(){
            Route::get('/',[TermConditionController::class,'index'])->name('terms-conditions');
            Route::put('/update/{id}',[TermConditionController::class,'update'])->name('terms-conditions.update');
        });

        # Privacy Policy Routes
        Route::group(['prefix' => 'privacy-policies'], function(){
            Route::get('/',[PrivacyPolicyController::class,'index'])->name('privacy-policies');
            Route::put('/update/{id}',[PrivacyPolicyController::class,'update'])->name('privacy-policies.update');
        });

        # Level Routes
        Route::group(['prefix' => 'levels'], function(){
            Route::get('/',[LevelController::class,'index'])->name('levels');
            Route::get('/create',[LevelController::class,'create'])->name('levels.create');
            Route::post('/store',[LevelController::class,'store'])->name('levels.store');
            Route::get('/edit/{id}',[LevelController::class,'edit'])->name('levels.edit');
            Route::put('/update/{id}',[LevelController::class,'update'])->name('levels.update');
            Route::delete('/delete/{id}',[LevelController::class,'destroy'])->name('levels.destroy');
        });

        # Program Routes
        Route::group(['prefix' => 'programs'], function(){
            Route::get('/',[ProgramController::class,'index'])->name('programs');
            Route::get('/create',[ProgramController::class,'create'])->name('programs.create');
            Route::post('/store',[ProgramController::class,'store'])->name('programs.store');
            Route::get('/edit/{id}',[ProgramController::class,'edit'])->name('programs.edit');
            Route::put('/update/{id}',[ProgramController::class,'update'])->name('programs.update');
            Route::delete('/delete/{id}',[ProgramController::class,'destroy'])->name('programs.destroy');
        });

        # Notice Categories Routes
        Route::group(['prefix' => 'notice-categories'], function(){
            Route::get('/',[NoticeCategoryController::class,'index'])->name('notice-categories');
            Route::get('/create',[NoticeCategoryController::class,'create'])->name('notice-categories.create');
            Route::post('/store',[NoticeCategoryController::class,'store'])->name('notice-categories.store');
            Route::get('/edit/{id}',[NoticeCategoryController::class,'edit'])->name('notice-categories.edit');
            Route::put('/update/{id}',[NoticeCategoryController::class,'update'])->name('notice-categories.update');
            Route::delete('/delete/{id}',[NoticeCategoryController::class,'destroy'])->name('notice-categories.destroy');
        });

        # Research Routes
        Route::group(['prefix' => 'research'], function(){
            Route::get('/',[ResearchController::class,'index'])->name('research');
            Route::get('/create',[ResearchController::class,'create'])->name('research.create');
            Route::post('/store',[ResearchController::class,'store'])->name('research.store');
            Route::get('/edit/{id}',[ResearchController::class,'edit'])->name('research.edit');
            Route::put('/update/{id}',[ResearchController::class,'update'])->name('research.update');
            Route::delete('/delete/{id}',[ResearchController::class,'destroy'])->name('research.destroy');
        });
    });


    # Tag Routes
    Route::group(['prefix' => 'tags'], function(){
        Route::get('/',[TagController::class,'index'])->name('tags');
        Route::get('/create',[TagController::class,'create'])->name('tags.create');
        Route::post('/store',[TagController::class,'store'])->name('tags.store');
        Route::get('/edit/{id}',[TagController::class,'edit'])->name('tags.edit');
        Route::put('/update/{id}',[TagController::class,'update'])->name('tags.update');
        Route::delete('/delete/{id}',[TagController::class,'destroy'])->name('tags.destroy');
    });

    # Category Routes
    Route::group(['prefix' => 'categories'], function(){
        Route::get('/',[CategoryController::class,'index'])->name('categories');
        Route::get('/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/store',[CategoryController::class,'store'])->name('categories.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
        Route::put('/update/{id}',[CategoryController::class,'update'])->name('categories.update');
        Route::delete('/delete/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');
    });

     # Blog Routes
     Route::group(['prefix' => 'blogs'], function(){
        Route::get('/',[BlogController::class,'index'])->name('blogs');
        Route::get('/create',[BlogController::class,'create'])->name('blogs.create');
        Route::post('/store',[BlogController::class,'store'])->name('blogs.store');
        Route::get('/edit/{id}',[BlogController::class,'edit'])->name('blogs.edit');
        Route::put('/update/{id}',[BlogController::class,'update'])->name('blogs.update');
        Route::delete('/delete/{id}',[BlogController::class,'destroy'])->name('blogs.destroy');
    });

    # Slider Routes
    Route::group(['prefix' => 'sliders'], function(){
        Route::get('/',[SliderController::class,'index'])->name('sliders');
        Route::get('/create',[SliderController::class,'create'])->name('sliders.create');
        Route::post('/store',[SliderController::class,'store'])->name('sliders.store');
        Route::get('/edit/{id}',[SliderController::class,'edit'])->name('sliders.edit');
        Route::put('/update/{id}',[SliderController::class,'update'])->name('sliders.update');
        Route::delete('/delete/{id}',[SliderController::class,'destroy'])->name('sliders.destroy');
    });

    # Event Routes
    Route::group(['prefix' => 'events'], function(){
        Route::get('/',[EventController::class,'index'])->name('events');
        Route::get('/create',[EventController::class,'create'])->name('events.create');
        Route::post('/store',[EventController::class,'store'])->name('events.store');
        Route::get('/edit/{id}',[EventController::class,'edit'])->name('events.edit');
        Route::put('/update/{id}',[EventController::class,'update'])->name('events.update');
        Route::delete('/delete/{id}',[EventController::class,'destroy'])->name('events.destroy');
    });

    # Research Routes
     Route::group(['prefix' => 'research-categories'], function(){
        Route::get('/',[ResearchCategoryController::class,'index'])->name('research-categories');
        Route::get('/create',[ResearchCategoryController::class,'create'])->name('research-categories.create');
        Route::post('/store',[ResearchCategoryController::class,'store'])->name('research-categories.store');
        Route::get('/edit/{id}',[ResearchCategoryController::class,'edit'])->name('research-categories.edit');
        Route::put('/update/{id}',[ResearchCategoryController::class,'update'])->name('research-categories.update');
        Route::delete('/delete/{id}',[ResearchCategoryController::class,'destroy'])->name('research-categories.destroy');
    });

     # Publication Category Routes
     Route::group(['prefix' => 'publication-categories'], function(){
        Route::get('/',[PublicationCategoryController::class,'index'])->name('publication-categories');
        Route::get('/create',[PublicationCategoryController::class,'create'])->name('publication-categories.create');
        Route::post('/store',[PublicationCategoryController::class,'store'])->name('publication-categories.store');
        Route::get('/edit/{id}',[PublicationCategoryController::class,'edit'])->name('publication-categories.edit');
        Route::put('/update/{id}',[PublicationCategoryController::class,'update'])->name('publication-categories.update');
        Route::delete('/delete/{id}',[PublicationCategoryController::class,'destroy'])->name('publication-categories.destroy');
    });

    # Report Category Routes
    Route::group(['prefix' => 'report-categories'], function(){
        Route::get('/',[ReportCategoryController::class,'index'])->name('report-categories');
        Route::get('/create',[ReportCategoryController::class,'create'])->name('report-categories.create');
        Route::post('/store',[ReportCategoryController::class,'store'])->name('report-categories.store');
        Route::get('/edit/{id}',[ReportCategoryController::class,'edit'])->name('report-categories.edit');
        Route::put('/update/{id}',[ReportCategoryController::class,'update'])->name('report-categories.update');
        Route::delete('/delete/{id}',[ReportCategoryController::class,'destroy'])->name('report-categories.destroy');
    });

    # Report Routes
    Route::group(['prefix' => 'reports'], function(){
        Route::get('/',[ReportController::class,'index'])->name('reports');
        Route::get('/create',[ReportController::class,'create'])->name('reports.create');
        Route::post('/store',[ReportController::class,'store'])->name('reports.store');
        Route::get('/edit/{id}',[ReportController::class,'edit'])->name('reports.edit');
        Route::put('/update/{id}',[ReportController::class,'update'])->name('reports.update');
        Route::delete('/delete/{id}',[ReportController::class,'destroy'])->name('reports.destroy');
    });

    # Publication Routes
    Route::group(['prefix' => 'publications'], function(){
        Route::get('/',[PublicationController::class,'index'])->name('publications');
        Route::get('/create',[PublicationController::class,'create'])->name('publications.create');
        Route::post('/store',[PublicationController::class,'store'])->name('publications.store');
        Route::get('/edit/{id}',[PublicationController::class,'edit'])->name('publications.edit');
        Route::put('/update/{id}',[PublicationController::class,'update'])->name('publications.update');
        Route::delete('/delete/{id}',[PublicationController::class,'destroy'])->name('publications.destroy');
    });

    # Resources Categories Routes
    Route::group(['prefix' => 'resources-categories'], function(){
        Route::get('/',[ResourcesCategoryController::class,'index'])->name('resources-categories');
        Route::get('/create',[ResourcesCategoryController::class,'create'])->name('resources-categories.create');
        Route::post('/store',[ResourcesCategoryController::class,'store'])->name('resources-categories.store');
        Route::get('/edit/{id}',[ResourcesCategoryController::class,'edit'])->name('resources-categories.edit');
        Route::put('/update/{id}',[ResourcesCategoryController::class,'update'])->name('resources-categories.update');
        Route::delete('/delete/{id}',[ResourcesCategoryController::class,'destroy'])->name('resources-categories.destroy');
    });

    # Gallery Categories Routes
    Route::group(['prefix' => 'gallery-categories'], function(){
        Route::get('/',[GalleryCategoryController::class,'index'])->name('gallery-categories');
        Route::get('/create',[GalleryCategoryController::class,'create'])->name('gallery-categories.create');
        Route::post('/store',[GalleryCategoryController::class,'store'])->name('gallery-categories.store');
        Route::get('/edit/{id}',[GalleryCategoryController::class,'edit'])->name('gallery-categories.edit');
        Route::put('/update/{id}',[GalleryCategoryController::class,'update'])->name('gallery-categories.update');
        Route::delete('/delete/{id}',[GalleryCategoryController::class,'destroy'])->name('gallery-categories.destroy');
    });

    # Gallery Routes
    Route::group(['prefix' => 'gallery'], function(){
        Route::get('/',[GalleryController::class,'index'])->name('gallery');
        Route::get('/create',[GalleryController::class,'create'])->name('gallery.create');
        Route::post('/store',[GalleryController::class,'store'])->name('gallery.store');
        Route::get('/edit/{id}',[GalleryController::class,'edit'])->name('gallery.edit');
        Route::put('/update/{id}',[GalleryController::class,'update'])->name('gallery.update');
        Route::delete('/delete/{id}',[GalleryController::class,'destroy'])->name('gallery.destroy');
        Route::get('/images/{id}',[GalleryController::class,'images'])->name('gallery.images');
        Route::post('/storeimages/{id}',[GalleryController::class,'storeimages'])->name('gallery.storeimages');
        Route::get('/viewimages/{id}',[GalleryController::class,'viewimages'])->name('gallery.viewimages');
        Route::get('/getimages/{id}',[GalleryController::class,'getimages'])->name('gallery.getimages');
        Route::post('/postimages',[GalleryController::class,'postimages'])->name('gallery.postimages');
        Route::put('/updateimages/{id}',[GalleryController::class,'updateimages'])->name('gallery.updateimages');
        Route::get('/editimages/{id}',[GalleryController::class,'editimages'])->name('gallery.editimages');
        Route::get('/getallImages',[GalleryController::class,'getallImages']);
    });

    # Gallery Routes
    Route::group(['prefix' => 'downloads'], function(){
        Route::get('/',[DownloadController::class,'index'])->name('downloads');
        Route::get('/create',[DownloadController::class,'create'])->name('downloads.create');
        Route::post('/store',[DownloadController::class,'store'])->name('downloads.store');
        Route::get('/edit/{id}',[DownloadController::class,'edit'])->name('downloads.edit');
        Route::put('/update/{id}',[DownloadController::class,'update'])->name('downloads.update');
        Route::delete('/delete/{id}',[DownloadController::class,'destroy'])->name('downloads.destroy');
    });

});
