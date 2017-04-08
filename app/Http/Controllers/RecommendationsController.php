<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Subbe\Semantics3\Semantics3;

class RecommendationsController extends Controller
{
    /**
     * Display a listing of the recommendations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $recommendations = Recommendation::with('user')->paginate(25);//::paginate(25);//::with('User')->get();
        //dd($recommendations);
        return view('recommendations.index', compact('recommendations'));
    }

    /**
     * Display a listing of the user's recommendations.
     * Auth::id()
     * @return Illuminate\View\View
     */
    public function mine()
    {
        $recommendations = Recommendation::where('user_id', Auth::id())->paginate(25);//::paginate(25);//::with('User')->get();
        //dd($recommendations);
        return view('recommendations.mine', compact('recommendations'));
    }


    /**
     * Show the form for creating a new recommendation.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id');
        return view('recommendations.create', compact('departments'));
    }

    /**
     * Store a new recommendation in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->affirm($request);
        $data = $request->all();
        $data['user_id'] = (!Auth::guest()) ? Auth::id() : null ;
        //dd($data);
        $data['excerpt'] = Recommendation::truncate($data['body']);

        $this->uploadFile('image', $data);
        Recommendation::create($data);

        Session::flash('success_message', 'Recommendation was added!');
        return redirect()->route('recommendations.recommendation.mine');
    }

    /**
     * Display the specified recommendation.
     *
     * @param  int $id
     *
     * @return Illuminate\View\View
     */
    public function show($slug)
    {
        $recommendation = Recommendation::where('slug', '=', $slug)->first();
        return view('recommendations.show', compact('recommendation'));
    }

    public static function productLookup($code)
    {
        $sem = new Semantics3();
        //$search = $sem->search('iphone');
        $upc = $sem->upc('0885909950942');
        //return response()->json($upc);
        echo '<pre>';
        echo htmlspecialchars(Recommendation::json_format($upc));
        //dd($upc);
        //$site = $sem->site_query('iphone', 'amazon.com');
        //$site = $sem->categories('hard drives');
    }


    /**
     * Show the form for editing the specified recommendation.
     *
     * @param  int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $departments = Department::pluck('name', 'id');
        return view('recommendations.edit', compact('recommendation', 'departments'));
    }

    /**
     * Update the specified recommendation in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->affirm($request);
        $recommendation = Recommendation::findOrFail($id);
        $data = $request->all();
        $this->uploadFile('image', $data);
        $recommendation->update($data);
        Session::flash('success_message', 'Recommendation was updated!');
        return redirect()->route('recommendations.recommendation.index');
    }

    /**
     * Remove the specified recommendation from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Recommendation::destroy($id);
        Session::flash('success_message', 'Recommendation was deleted!');
        return redirect()->route('recommendations.recommendation.index');
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
            'department_id' => 'min:0',
            'title' => 'max:255',
            'seo_title' => 'max:255',
            'excerpt' => 'max:200',
            'body' => 'max:65535',
            'image' => 'max:1000|mimes:jpg,png,gif',
            'slug' => 'max:255',
            'meta_description' => 'max:65535',
            'meta_keywords' => 'max:65535',
            'status' => 'max:9',
            'upc' => 'max:125',
            'amazon_link' => 'max:125',
            'intent' => 'max:4',
        ]);
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
