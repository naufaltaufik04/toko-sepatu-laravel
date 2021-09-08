<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            "message" => "Get data duccessed",
            "response_code" => Response::HTTP_OK,
            "data" => Shoe::all()
        ];
        return response($response, Response::HTTP_OK);
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
    public function store(Request $request)
    {
        $validate = $request->validate([
            'type' => 'required|string',
            'excerpt' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        try {
            Shoe::create($request->all());

            return response([
                'message' => 'Store data successed',
                'response_code' => Response::HTTP_CREATED,
                'data' => [
                    'type' => $request->get('type'),
                    'excerpt' => $request->get('excerpt'),
                    'description' => $request->get('description')
                ]
            ]);
        } catch (QueryException $e) {
            return response([
                'message' => 'Store data is failed. ' . $e->getMessage(),
                'response_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        try {
            $response = Shoe::Where('type', $type)->firstOrFail();
            return response([
                'message' => 'Data found',
                'response_code' => Response::HTTP_OK,
                'data' => [
                    'type' => $response->type,
                    'excerpt' => $response->excerpt,
                    'description' => $response->description
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => 'Data not found. ' . $e->getMessage(),
                'response_code' => Response::HTTP_NOT_FOUND,
            ]);
        }
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
    public function update(Request $request, $type)
    {
        $validate = $request->validate([
            'type' => 'string',
            'excerpt' => 'string|max:255',
            'description' => 'string'
        ]);

        Shoe::where('type', $type)->update($request->all());
        return response([
            'message' => 'Data has been updated',
            'response_code' => Response::HTTP_OK,
            'data' => [
                'type' => $request->get('type'),
                'excerpt' => $request->get('excerpt'),
                'description' => $request->get('description')
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type)
    {
        Shoe::where('type', $type)->delete();
        return response([
            'message' => 'Data has been deleted',
            'response_code' => Response::HTTP_OK
        ]);
    }
}
