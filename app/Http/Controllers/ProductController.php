<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index ()  {
        $cat = Categorie::all();
        return view('admin.product.list')->with('categories' , $cat  );
    }


    public function productData()
    {
        return Datatables::of(Product::with('categorie')->get())
        ->addColumn('action', function ($product) {
            return '<span class="action-edit" onclick=\'openUpdate('.$product.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/product/').'/'.$product->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($product) {
                $u = url('');
            return '<img src="'. $u . explode(',',$product->images)[0] .'" alt="Img placeholder">';
        })
        ->addColumn('statusDetails', function ($product) {

            $message = '';
            switch ($product->status) {
                case 0:
                    $message = '            <div class="chip chip-primary">
                    <div class="chip-body">
                        <div class="chip-text">pending</div>
                    </div>
                </div>';
                    break;
                case 1:
                    $message = '<div class="chip chip-success">
                        <div class="chip-body">
                            <div class="chip-text">delivered</div>
                        </div>
                    </div>';
                    break;
                case 2:
                    $message = '<div class="chip chip-warning">
                    <div class="chip-body">
                        <div class="chip-text">on hold</div>
                    </div>
                </div>';
                    break;
                case 3:
                    $message = '            <div class="chip chip-danger">
                    <div class="chip-body">
                        <div class="chip-text">canceled</div>
                    </div>
                </div>';
                    break;
            }
            return $message ;
        })
        ->rawColumns(['photo' , 'action' , 'statusDetails'])

        ->make(true);
    }


    public function addProduct (Request $request) {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,gif'
        ]);

        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {

                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/img/products', $name);
                $images[$i] = '/uploads/img/products/'.$name;
                $i++;
            }
        }

        $product = new  Product() ;


        $product->images      = implode(",", $images);
        $product->categorie   = $request->categorie;
        $product->title       = $request->title;
        $product->price       = $request->price;
        $product->description = $request->description;
        $product->status       = $request->status;


        $product->save();

        return back();
    }

    public function editProduct ( Request $request , $id ) {




        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            $this->validate($request, [

                'images.*' => 'mimes:jpg,jpeg,png,gif'
            ]);
            foreach($request->file('images') as $file)
            {

                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/img/products', $name);
                $images[$i] = '/uploads/img/products/'.$name;
                $i++;
            }
        }

        $product =   Product::find($id ) ;

        if($product)
        {
            if (count($images)>0) $product->images      = implode(",", $images);
            $product->categorie   = $request->categorie;
            $product->title       = $request->title;
            $product->price       = $request->price;
            $product->description = $request->description;
            $product->status       = $request->status;
            $product->save();
        }




        return back();
    }


    public function remove ($id) {


        $product = Product::find($id ) ;

        if($product)
        {
            $product->delete();

        }

        return back();
    }


}
