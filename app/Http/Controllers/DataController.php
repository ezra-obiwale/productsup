<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Entities\Data;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group Data
 *
 * Endpoints to interact with the `data` resource
 */
class DataController extends Controller
{

    /**
     * Fetch a paginated list of data.
     * 
     * Support filtering with on all fields. For exampole, `/api/data?q[description]=sodium
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $paginationData = QueryBuilder::for(Data)::allowedFilters(
            'title', 'description', 'short_description', 
            'category', 'price', 'image_link', 'deeplink'
            )
            ->simplePaginate(10)
            ->toArray();
        $data = $paginationData['items'];
        unset($paginationData['items']);
        return $this->success($data, 200, ['meta' => $paginationData]);
    }

    /**
     * Create a new data resource
     * 
     * @bodyParam title string required The title of the data
     * @bodyParam description string required The description of the data
     * @bodyParam short_description string required The short descripotion of the data
     * @bodyParam category string required The category of the data
     * @bodyParam price numeric required The price of the data
     * @bodyParam image file The image file. Required if the image link is not provided.
     * @bodyParam image_link string The link to the image. Required if image file is not provided.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $requestData = $request->all();

        $validation = Data::validate($requestData);
        if ($validation->fails()) {
            return $this->error('Validation Error', 400, $validation->errors());
        }

        if ($request->hasFile('image')) {
            $requestData['image_link'] = $this->uploadImage();
        }

        $data = Data::create($requestData);

        return $this->success($data);
    }

    /**
     * Fetch the detail of a data resource
     * 
     * @urlParam id string required The id of the data resource
     * 
     * @param string id The id of the data resource
     * @return JsonResponse
     */
    public function show(string $id) : JsonResponse
    {
        $data = Data::find($id);
        if (!$data) {
            return $this->error('Resource not found', 404);
        }
        return $this->success($data);
    }

    /**
     * Update an existing data resource
     * 
     * @urlParam id string required The id of the data resource
     * 
     * @bodyParam title string required The title of the data
     * @bodyParam description string required The description of the data
     * @bodyParam short_description string required The short descripotion of the data
     * @bodyParam category string required The category of the data
     * @bodyParam price numeric required The price of the data
     * @bodyParam image file The image file. Required if the image link is not provided.
     * @bodyParam image_link string The link to the image. Required if image file is not provided.
     * 
     * @param Request $request
     * @param string id The id of the data resource
     */
    public function update(Request $request, string $id) : JsonResponse
    {
        $requestData = $request->all();

        $validation = Data::validate($requestData);
        if ($validation->fails()) {
            return $this->error('Validation Error', 400, $validation->errors());
        }

        $data = Data::find($id);
        if (!$data) {
            return $this->error('Resource not found', 404);
        }

        if (!$update = $data->update($data)) {
            return $this->error('Something went wrong', 500);
        }

        return $this->success($update, 201);
    }

    /**
     * Deletes a data resource
     * 
     * @urlParam id string required The id of the data resource
     * 
     * @param string id The id of the data resource
     * @return JsonResponse
     */
    public function destroy(string $id) : JsonResponse
    {
        $data = Data::find($id);
        if (!$data) {
            return $this->error('Resource not found', 404);
        }
        if (!$data->delete()) {
            return $this->error('Something went wrong', 500);
        }

        return $this->success($data);
    }

    /**
     * Upload the image in the request
     * 
     * @param Request $request
     * @return string The full url to image
     */
    protected function uploadImage(Request $request) : string
    {
        $path = $request->file('image')->store('public');
        return assets('storage/' . $path);
    }

    /**
     * Create a success json response
     * 
     * @param mixed $data The success data
     * @param int $code The status code
     * @param array $meta The meta to return with the success data, if any.
     * 
     * @return JsonResponse
     */
    protected function success($data, int $code = 200, array $meta = null) : JsonResponse
    {
        $json = [
            'status' => 'success',
            'data' => $data
        ];
        if ($meta) {
            $json['meta'] = $meta;
        }
        return response()->json($json, $code);
    }

    /**
     * Create an error json response
     * 
     * @param string $message The error message
     * @param int $code The status code
     * @param array $errors The array of errors that occured
     * 
     * @return JsonResponse
     */
    protected function error(string $message, int $code = 400, array $errors = []) : JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
