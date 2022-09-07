<?php


return [

    /**
     * @OA\Get(
     *     path="/v1/profile",
     *     summary="Get list profile",
     *     tags={"Profile"},
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\Schema(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/Profile")
     *         )
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @OA\Schema(ref="#/schemas/Unauthorized")
     *     )
     * )
     */
    'GET profile' => 'profile/index',

    /**
     * @OA\Post(
     *     path="/v1/profile",
     *     summary="Create data profile",
     *     tags={"Profile"},
     *     @OA\RequestBody(
     *     description="Create a Profile",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateProfile"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateProfile")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateProfile"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/Profile")
     *     ),
     *     
     * )
     */
    'POST profile' => 'profile/create',

    /**
     * @OA\Put(
     *     path="/v1/profile/{Id}",
     *     summary="Update profile data",
     *     tags={"Profile"},
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
     *        description="Profile value to be updated",
     *        @OA\JsonContent(ref="#/components/schemas/UpdateProfile")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdateProfile"),
     *             @OA\Property(property="toastMessage", type="string", example="Profile updated succefully"),
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
    'PUT profile/{id}' => 'profile/update',
    
    /**
     * @OA\Get(
     *     path="/v1/profile/{Id}",
     *     summary="Get profile by Id",
     *     tags={"Profile"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Profile ID to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/Profile")
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
    'GET profile/{id}' => 'profile/view',

    /**
     * @OA\Delete(
     *     path="/v1/profile/{Id}",
     *     summary="Delete data profile",
     *     tags={"Profile"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Profile id to delete",
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
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateProfile")
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
    'DELETE profile/{id}' => 'profile/delete',
];