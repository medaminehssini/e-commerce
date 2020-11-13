<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{

    public function index ()  {

        return view('admin.slider.list');
    }


    public function SliderData()
    {
        return DataTables::of(Slider::get())
        ->addColumn('action', function ($slider) {
            return '<span class="action-edit" onclick=\'openUpdate('.$slider.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/slider/').'/'.$slider->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($slider) {
                $u = url('').'/';
            return '<img src="'. $u .  $slider->image .'" alt="'.$slider->title.'">';
        })
        ->addColumn('accepter', function ($slider) {
            if($slider->status == 0) {
                return '<a href="'.aurl('accepter/slider').'/'.$slider->id.'"><span class="action-delete" ><i class="feather icon-x"></i>Publier</span></a>';
            }else {
                return '<a href="'.aurl('accepter/slider').'/'.$slider->id.'"><span class="action-delete" style="color: red"><i class="feather icon-check"></i>Masquer</span></a>';
            }
        })
        ->rawColumns(['photo' , 'action' , 'accepter' ])

        ->make(true);
    }

    public function addSlider (Request $request) {
        $messages = [
            'title.required' => 'Vous devez ajouter une title',
            'description.required' => 'Champs description obligatoire',
            'url.required' => 'Champs url obligatoire',
            'buttom_name.required' => 'Champs buttom name obligatoire',
            'image.required' => 'Champs image obligatoire',
        ];

        $this->validate($request, [

            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'buttom_name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);
        $nameImage=null;
        if($request->hasfile('image'))
        {
            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/slider', $name);
            $nameImage = '/uploads/img/slider/'.$name;
        }
        $slider = new Slider();
        $slider->title =  $request->title;
        $slider->description =  $request->description;
        $slider->url =  $request->url;
        $slider->buttom_name =  $request->buttom_name;
        $slider->image =  $nameImage;
        $slider->save();
        alert()->success('Slider bien ajoutée', '')->toToast();
        return back();
    }


    public function editSlider (Request $request , $id) {
        $messages = [
            'title.required' => 'Vous devez ajouter une title',
            'description.required' => 'Champs description obligatoire',
            'url.required' => 'Champs url obligatoire',
            'buttom_name.required' => 'Champs buttom name obligatoire',
        ];

        $this->validate($request, [

            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'buttom_name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);
        $nameImage=null;

        if($request->hasfile('image'))
        {
            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/slider', $name);
            $nameImage = '/uploads/img/slider/'.$name;
        }
        $slider =  Slider::find($id);
        if($slider ) {
            $slider->title =  $request->title;
            $slider->description =  $request->description;
            $slider->url =  $request->url;
            $slider->buttom_name =  $request->buttom_name;
            if ($nameImage) $slider->image =  $nameImage;
            $slider->save();
            alert()->success('Slider bien Modifié', '')->toToast();

        }else
            abort(404);

        return back();
    }


    public function AccepterRefuser ($id) {
        $slider = Slider::find($id) ;

        if ($slider) {
            $message = '';
            if($slider->status == 0) {
                $slider->status = 1;

                $message = 'Slide a été publié';
            }else
            {
                $slider->status =  0;
                $message = 'Slide a été masqué';
            }

            $slider->save();
            alert()->success($message)->toToast();
        }else
            abort(404);


        return back();

    }
    public function suppimer ($id) {
        $slider = Slider::find($id) ;

        if ($slider) {
            $slider->delete();
            alert()->success('Slide a été supprimer')->toToast();
        }else
            abort(404);
        return back();
    }
}
