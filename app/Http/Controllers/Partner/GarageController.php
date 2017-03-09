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
        $garages = Garage::where('user_id', Auth::user()->id)->where('status', '=', '1')->paginate(10);
        return view('partners.index', ['garages' => $garages]);
    }

    /**
     * This function return list garages of user(partner) has't actived
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNonAct(Request $request)
    {
        $garages = Garage::where('user_id', Auth::user()->id)->where('status', '=', '0')->paginate(10);
        return view('partners.indexNonAct', ['garages' => $garages]);
    }

    /**
     * This function return view create, it allows user(partner) to enter params.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $place = [AdministrationUnit::where('parent_id','=',0)->pluck('name', 'id'),
            AdministrationUnit::where('parent_id','=',1)->pluck('name', 'id'),
            AdministrationUnit::where('parent_id','=',2)->pluck('name', 'id')];
        
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
            'working_time' => $request->get('fromHour') . ':'
                            . $request->get('fromMin') . ' - '
                            . $request->toHour . ':'
                            . $request->toMin,
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
        if(Auth::user()->can('view', $garage)) {
            $place = [ AdministrationUnit::where('parent_id', '=', 0)->pluck('name', 'id'),
                AdministrationUnit::where('parent_id', '=', $garage->province_id)->pluck('name', 'id'),
                AdministrationUnit::where('parent_id', '=', $garage->district_id)->pluck('name', 'id')];

            $curentplace=[AdministrationUnit::where('id', '=', $garage->province_id)->pluck('name', 'id'),
                AdministrationUnit::where('id', '=', $garage->district_id)->pluck('name', 'id'),
                AdministrationUnit::where('id', '=', $garage->ward_id)->pluck('name', 'id')];

            $timeworking = [substr($garage->working_time,0,2),
                substr($garage->working_time,3,2),
                substr($garage->working_time,8,2),
                substr($garage->working_time,11,2),
            ];

            return view('partners.edit',compact('garage','place','curentplace','timeworking'));
        } else {
            abort(503);
        }
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

        if(Auth::user()->can('update', $garage))
        {
            $garage->update([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'province_id' => $request->province,
                'district_id' => $request->district,
                'ward_id' => $request->ward,
                'working_time' => $request->fromHour . ':'
                                . $request->fromMin . ' - '
                                . $request->toHour . ':'
                                . $request->toMin,
            ]);
            return redirect('partner/garages');
        }
        else {
            abort(503);
        }
    }

    /**
     * Function allow user(partner) can be delete a garage by id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
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
