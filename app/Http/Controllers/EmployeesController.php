<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Employees as Model;
use App\Resources\EmployeeResource;
use App\Resources\PaginatedCollection;
use App\Http\Requests\EmployeeCreateRequest;


class EmployeesController extends Controller
{

     /**
     * VehiclesCompanyRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Employees();
    }

    public function getQuery(Request $request)
    {
        return $this->model->latest();
    }

    public function updateRecord(Model $object, Request $request)
    {
        return $object->saveOrUpdate($object, $request);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = Employees::paginate(10);
        return $employee;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        public function create(EmployeeCreateRequest $request)
        {
            $data = $this->updateRecord(new Model(), $request);
    
            return new EmployeeResource($data);
        }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employees::find($id);
        return response()->json(
            [
                'data' => $employee
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->model->find($id);
        $data = $this->updateRecord($data, $request);
        return $data;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = $this->model->find($id);
        if (!empty($object)) {
            $object->delete();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'deleted',
                    'status' => 'true'
                ],
                200
            );
        }
        return response()->json(
            [
                'code' => 404,
                'message' => 'not found',
                'status' => 'false'
            ],
            200
        );
    }
}
