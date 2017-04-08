<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Catalog;

class CatalogsController extends Controller
{

    /**
     * Display a listing of the catalogs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $catalogs = Catalog::paginate(25);

        return view('catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new catalog.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('catalogs.create');
    }

    /**
     * Store a new catalog in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->affirm($request);
        $data = $request->all();
        $this->uploadFile('image', $data);
        Catalog::create($data);

        Session::flash('success_message', 'Catalog was added!');

        return redirect()->route('catalogs.catalog.index');
    }

    /**
     * Display the specified catalog.
     *
     * @param  int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        //$catalog = Catalog::findOrFail($id);
        $catalog = Catalog::where('slug', '=', $slug)->first();
        return view('catalogs.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified catalog.
     *
     * @param  int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);

        return view('catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified catalog in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->affirm($request);
        $catalog = Catalog::findOrFail($id);
        $data = $request->all();
        $this->uploadFile('image', $data);
        $catalog->update($data);

        Session::flash('success_message', 'Catalog was updated!');

        return redirect()->route('catalogs.catalog.index');
    }

    /**
     * Remove the specified catalog from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Catalog::destroy($id);

        Session::flash('success_message', 'Catalog was deleted!');

        return redirect()->route('catalogs.catalog.index');
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        return $this->validate($request, [
            'title' => 'max:255',
            'description' => 'max:65535',
            'image' => 'max:1000|mimes:jpg,png,gif',
            'slug' => 'max:255',
            'meta_keywords' => 'max:65535',
            'status' => 'max:9',
            'recurring' => 'max:13',
            'longitude' => 'max:25',
            'latitude' => 'max:25',
            'address1' => 'max:125',
            'address2' => 'max:125',
            'city' => 'max:125',
            'state' => 'max:125',
            'country' => 'max:225',
            'zipcode' => 'max:25',
            'catalog_type' => 'max:9',

        ]);

    }


    public function mine()
    {
        $catalogs = Catalog::where('user_id', Auth::id())->paginate(25);//::paginate(25);//::with('User')->get();
        //dd($recommendations);
        return view('catalogs.mine', compact('catalogs'));
    }

    /**
     * Uploads a givin file to the server.
     *
     * @param string $fieldName
     * @param array $data
     *
     * @return $this
     */
    protected function uploadFile($fieldName, array & $data)
    {
        $file = Input::file($fieldName);

        if( $file && $file->isValid() )
        {
            $destination = config('codegenerator.files_upload_path');
            $newName = sprintf('%s.%s', str_random(30), $file->getClientOriginalExtension());
            $file->move($destination, $newName);
            $data[$fieldName] = $file->getRealPath() . '/' . $newName;
        }

        return $this;
    }
}
