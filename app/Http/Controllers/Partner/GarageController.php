<?php

namespace App\Http\Controllers\Partner;

use App\Helpers\MyHelper;
use App\Http\Requests\AddingGarages;
use App\Models\Garage;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AdministrationUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Response;

class GarageController extends Controller
{
     /**
     * This function return list garages of user(partner) has actived.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $garages = Garage::where('user_id', Auth::user()->id)
                ->where('status', $status)
                ->paginate(config('common.paginate'));

        return view('partners.garages.index',compact('garages', 'status'));
    }

    /**
     * This function return list garages of user(partner) has't actived
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexInactive(Request $request)
    {
        $garages = Garage::where('user_id', Auth::user()->id)->
        where('status', config('common.garage.status.unactivated'))->paginate(config('common.paginate'));

        return view('partners.indexInactive', compact('garages'));
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
            AdministrationUnit::where('parent_id', 2)->pluck('name', 'id'),
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Garage::create($data);

        return Redirect::to('partner/garages/create')->with('success', trans('layout.adding_garage_success'));
    }

//    /**
//     * Function allow user(partner) can be edit a garage by id
//     * @param $id
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function edit($id)
//    {
//        $garage = Garage::find($id);
//
//        if (Auth::user()->cannot('view', $garage)) {
//            abort(503);
//        }
//
//        $place = MyHelper::getPlace($id);
//        $curentplace = MyHelper::getCurrentPlace($id);
//
//        return view('partners.garages.showGarage', compact('garage', 'place', 'curentplace'));
//    }


    public function show($id)
    {
        $garage = Garage::find($id);

        if (Auth::user()->cannot('view', $garage)) {
            abort(503);
        }

        $place = MyHelper::getPlace($id);
        $curentplace = MyHelper::getCurrentPlace($id);

        return view('partners.garages.edit', compact('garage', 'place', 'curentplace'));
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

        $garage->update($request->all());

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
        $data = [];

        if (Auth::user()->cannot('destroy', $garage)){
            abort(503);
        }

        DB::beginTransaction();
        try {
            foreach ($garage->services as $service) {
                $service->delete();
            }
            $garage->delete();

            DB::commit();
            $data['status'] = 1;
            $data['message'] = config('common.message.delete_success');
        } catch (Exception $e){
            DB::rollbackTransaction();
            $data['status'] = -1;
            $data['message'] = config('common.message.delete_error');
        }

        return \Response::json($data);
    }

    /**
     * Function show list children units when user chosen parent unit
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chosenPlace(Request $request)
    {
        $type = $request->input('type');
        $places = MyHelper::chosePlace($request->id);
        $stdPlaces = [];
        foreach ($places as $place) {
            $stdPlaces[$place->id] = $place->name;
        }

        return view('partners.components.administrationUnit', ['type' => $type, 'places' => $stdPlaces]);
    }
}
