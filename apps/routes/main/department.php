<?php
return[

        /**
     * @OA\Get(
     *     path="/v1/speciality",
     *     summary="Get list all available specialities",
     *     tags={"Speciality"},
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\Schema(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/Department")
     *         )
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @OA\Schema(ref="#/schemas/Unauthorized")
     *     )
     * )
     */
    'GET speciality' => 'department/index',

        /**
     * @OA\Post(
     *     path="/v1/speciality",
     *     summary="Create a certain speciality",
     *     tags={"Speciality"},
     *     @OA\RequestBody(
     *     description="Create a Speciality",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateDepartment"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateDepartment")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateDepartment"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/Department")
     *     ),
     *     
     * )
     */
    'POST speciality' => 'department/create',

    /**
     * @OA\Put(
     *     path="/v1/speciality/{Id}",
     *     summary="Update a speciality ",
     *     tags={"Speciality"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *   
     *     @OA\RequestBody(
     *        required=true,
     *        description="Speciality value to be updated",
     *        @OA\JsonContent(ref="#/components/schemas/UpdateDepartment")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdateDepartment"),
     *             @OA\Property(property="toastMessage", type="string", example="Department updated succefully"),
     *             @OA\Property(property="toastTheme", type="string",example="success"),
     *          )
     *       )
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *           @OA\Property(property="errorPayload", type="object")
     *         )
     *     )
     * )
     */
    'PUT speciality/{id}' => 'department/update',
    
    /**
     * @OA\Get(
     *     path="/v1/speciality/{Id}",
     *     summary="Get a speciality by Id",
     *     tags={"Speciality"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Speciality ID to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/Department")
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object")
     *          )
     *     )
     * )
     */
    'GET speciality/{id}' => 'department/view',

    /**
     * @OA\Delete(
     *     path="/v1/speciality/{Id}",
     *     summary="Delete a Speciality",
     *     tags={"Speciality"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Speciality id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             
     *         ),
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Status Delete",
     *         @OA\JsonContent(
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateDepartment")
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *           @OA\Property(property="errorPayload", type="object")
     *         )
     *     ),
     *  
     * )
     */
    'DELETE speciality/{id}' => 'department/delete',
];
