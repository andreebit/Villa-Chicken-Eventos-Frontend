<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveQuotationRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\EventTypeRepository;
use App\Repositories\LoungeRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\QuotationRepository;
use Illuminate\Http\Request;

class QuotationsController extends Controller
{
    
    const BASE_LOCAL_ID = 1;
    
    public function index(QuotationRepository $quotationRepository)
    {
        $data = $quotationRepository->getAll();
        return view('quotations.index', ['items' => $data->data]);
    }


    public function create(EventTypeRepository $eventTypeRepository, LoungeRepository $loungeRepository)
    {
        return view('quotations.form', [
            'quotation' => null,
            'eventTypes' => $eventTypeRepository->getPairIdName(),
            'lounges' => $loungeRepository->getPairIdNameByLocal(self::BASE_LOCAL_ID)
        ]);
    }


    public function edit(QuotationRepository $quotationRepository, EventTypeRepository $eventTypeRepository, LoungeRepository $loungeRepository, $id)
    {
        $data = $quotationRepository->get($id);
        return view('quotations.form', [
            'quotation' => $data->data,
            'eventTypes' => $eventTypeRepository->getPairIdName(),
            'lounges' => $loungeRepository->getPairIdNameByLocal(self::BASE_LOCAL_ID)
        ]);
    }


    public function postForm(SaveQuotationRequest $request, QuotationRepository $quotationRepository)
    {
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

        if (isset($id) && !empty($id)) {
            $response = $quotationRepository->update($id, $data);
            $this->setSuccessMessage(trans('messages.success_update'));
        } else {
            $response = $quotationRepository->create($data);
            $this->setSuccessMessage(trans('messages.success_create'));
        }

        return redirect(route('quotations.edit', ['id' => $response->data->id]));
    }

    public function delete(QuotationRepository $quotationRepository, $id)
    {
        $quotationRepository->delete($id);
        $this->setSuccessMessage(trans('messages.success_delete'));
        return redirect(route('quotations.index'));
    }

    public function preview(QuotationRepository $quotationRepository, EventTypeRepository $eventTypeRepository, Request $request)
    {

        $eventTypeId = $request->get('event_type_id', null);

        $quotations = [];
        if (!is_null($eventTypeId)) {
            $quotations = $quotationRepository->getByEventType($eventTypeId);
            $quotations = $quotations->data;
        }

        return view('quotations.preview', [
            'eventTypes' => $eventTypeRepository->getPairIdName(),
            'quotations' => $quotations
        ]);
    }


    public function postSearchCustomer(Request $request, CustomerRepository $customerRepository) {
        $documentType = $request->get('document_type', null);
        $documentNumber = $request->get('document_number', null);

        $data = $customerRepository->getByDocument($documentType, $documentNumber);
        return response()->json(['status' => 'success', 'data' => $data]);
    }


    public function postMaterialsByEventType(Request $request, MaterialRepository $materialRepository) {
        $eventTypeId = $request->get('event_type_id', null);

        $data = $materialRepository->getAllByEventType($eventTypeId);
        return response()->json(['status' => 'success', 'data' => $data]);
    }

}
