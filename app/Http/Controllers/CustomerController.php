<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        $customer = Customer::all();
        // return response()->json([
        //     'message' => "List all customers",
        //     'data' => $customer,
        // ]);

        return CustomerResource::collection($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = $request->user()->customers()->create($request->validated());

        // return response()->json([
        //     'message' => "customer was added successfully",
        //     'data' => $customer,
        // ], 201);

        return (new CustomerResource($customer))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('viewAny', $customer);

        // return response()->json([
        //     'message' => "Show customer",
        //     'data' => $customer,
        // ]);

        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer->update($request->validated());

        // return response()->json([
        //     'message' => "customer was updated successfully",
        //     'data' => $customer,
        // ], 200);

        return (new CustomerResource($customer))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return response()->json([
            'message' => "customer was deleted successfully",
        ], 200);
    }
}
