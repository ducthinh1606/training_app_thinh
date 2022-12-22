<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
use App\Enums\SuccessType;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStatus\TaskStatusRequest;
use App\Services\TaskStatusService;

class TaskStatusController extends BaseController
{
    protected $taskStatusService;

    public function __construct(TaskStatusService $taskStatusService)
    {
        $this->taskStatusService = $taskStatusService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->taskStatusService->getList();

        return $this->sendSuccess($data, trans('response.success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskStatusRequest $request)
    {
        $data = [
            'status_name' => $request->status_name
        ];
        $create = $this->taskStatusService->store($data);

        if (!$create) {
            return $this->sendError(ErrorType::CODE_5003, ErrorType::STATUS_5003, trans('errors.MSG_5003'));
        }

        return $this->sendSuccessNoData(SuccessType::CODE_201, trans('response.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskStatusRequest $request, $id)
    {
        $data = [
            'status_name' => $request->status_name
        ];
        $update = $this->taskStatusService->update($id, $data);

        if (!$update) {
            return $this->sendError(ErrorType::CODE_5004, ErrorType::STATUS_5004, trans('errors.MSG_5004'));
        }

        return $this->sendSuccessNoData(SuccessType::CODE_200, trans('response.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = $this->taskStatusService->delete($id);

        if (!$delete) {
            return $this->sendError(ErrorType::CODE_5005, ErrorType::STATUS_5005, trans('errors.MSG_5005'));
        }

        return $this->sendSuccessNoData(SuccessType::CODE_200, trans('response.success'));
    }
}
