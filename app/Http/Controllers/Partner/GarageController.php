<?php

namespace App\Http\Controllers\Partner;

use App\Helpers\MyHelper;
use App\Http\Requests\AddingGarages;
use App\Models\Garage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AdministrationUnit;
use Illuminate\Support\Facades\Redirect;

class GarageController extends Controller
{
    /**
     * This function return list garages of user(partner) has actived.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $paginateNumber = config('common.garage.paginate');

        if ($request->has('number') && $request->input('number') > 0) {
            $paginateNumber = $request->input('number');
        }

        $garages = Garage::where('user_id', Auth::user()->id)->where('status', '1')->paginate($paginateNumber);

        return view('partners.index',compact('request','garages'));
    }

    /**
     * This function return list garages of user(partner) has't actived
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexInactive(Request $request)
    {
        $garages = Garage::where('user_id', Auth::user()->id)->where('status', '0')->paginate(10);

        return view('partners.indexInactive', ['garages' => $garages]);
    }

    /**
     * This function return view create, it allows user(partner) to enter params.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $place = [
            AdministrationUnit::where('parent_id', 0)->pluck('name', 'id'),
            AdministrationUnit::where('parent_id', 1)->pluck('name', 'id'),
            AdministrationUnit::where('parent_id', 2)->pluck('name', 'id')
            
        ];
        
        return view('partners.create', compact('place'));
    }

    /**
     * Function allow user(partner) can storage new garage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AddingGarages $request)
    {
        Garage::create([
            'name' => $request->name,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'website' => $request->website,
            'working_time' => $request->working_time,
            'province_id' => $request->province,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return Redirect::to('partner/garages/create')->with('success', trans('layout.adding_garage_success'));
    }

    /**
     * Function allow user(partner) can be edit a garage by id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $garage = Garage::find($id);
        if (Auth::user()->cannot('view', $garage)) {
            abort(503);
        }
        $place = MyHelper::getPlace($id);
        $curentplace = MyHelper::getCurrentPlace($id);

        return view('partners.edit', compact('garage', 'place', 'curentplace'));
    }

    /**
     * Function allow user(partner) can be update a gagrage by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $garage = Garage::find($id);

        if (Auth::user()->cannot('update', $garage)) {
            abort(503);
        }
        $garage->update([
            'name' => $request->name,
            'phone_number' => $request->phone,
            'province_id' => $request->province,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'working_time' => $request->working_time
        ]);

        return redirect('partner/garages');
    }

    /**
     * Function allow user(partner) can be delete a garage by id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $garage = Garage::find($id);
        if (Auth::user()->cannot('destroy', $garage)){
            abort(503);
        }

        return \Response::json(Garage::find($id)->delete());
    }

    /**
     * Function show list children units when user chosen parent unit
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chosenPlace(Request $request)
    {
        return MyHelper::chosePlace($request->id);
    }
}
