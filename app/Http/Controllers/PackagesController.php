<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePackageRequest;
use App\Repositories\EventTypeRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(PackageRepository $packageRepository)
    {
        $data = $packageRepository->getAll();
        return view('packages.index', ['items' => $data->data]);
    }


    public function create(EventTypeRepository $eventTypeRepository, ServiceCategoryRepository $serviceCategoryRepository)
    {
        return view('packages.form', [
            'package' => null,
            'eventTypes' => $eventTypeRepository->getPairIdName(),
            'serviceCategories' => $serviceCategoryRepository->getPairIdName()
        ]);
    }


    public function edit(PackageRepository $packageRepository, EventTypeRepository $eventTypeRepository, ServiceCategoryRepository $serviceCategoryRepository, $id)
    {
        $data = $packageRepository->get($id);
        return view('packages.form', [
            'package' => $data->data,
            'eventTypes' => $eventTypeRepository->getPairIdName(),
            'serviceCategories' => $serviceCategoryRepository->getPairIdName()
        ]);
    }


    public function postForm(SavePackageRequest $request, PackageRepository $packageRepository) {
        $id = $request->get('id', null);
        $data = $request->only(['event_type_id', 'name', 'minimum_pax', 'price']);
        $descriptions = $request->get('description');
        $serviceCategories = $request->get('service_category_id');
        $items = [];

        foreach ($descriptions as $index => $value) {
            $items[] = [
                'description' => $value,
                'service_category_id' => $serviceCategories[$index]
            ];
        }

        $data['items'] = $items;

        if(isset($id) && !empty($id)) {
            $response = $packageRepository->update($id, $data);
            $this->setSuccessMessage(trans('messages.success_update'));
        } else {
            $response = $packageRepository->create($data);
            $this->setSuccessMessage(trans('messages.success_create'));
        }

        return redirect(route('packages.edit', ['id' => $response->data->id]));
    }

    public function delete(PackageRepository $packageRepository, $id)
    {
        $packageRepository->delete($id);
        $this->setSuccessMessage(trans('messages.success_delete'));
        return redirect(route('packages.index'));
    }


}
