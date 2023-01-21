<?php

return [

     /**
     * @OA\Post(
     *     path="/v1/doctorlogin",
     *     summary="Login to the application",
     *     tags={"Doctor"},
     *     description="Login to get access token",
     *      security={{}},
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property = "username",
     *                    type="string"
     *                     ),
     *                  @OA\Property(
     *                    property = "password",
     *                    type="string"
     *                     )
     *             )
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/DoctorDetails"))
     *     )
     *     ),      
     *       @OA\Response(
     *         response=423,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST doctorlogin' => 'doctor/login',

      /**
     * @OA\Put(
     *     path="/v1/doctor/{Id}",
     *     summary="Update Doctor data",
     *     tags={"Doctor"},
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
     *        description="Doctor value to be updated",
     *        @OA\JsonContent(ref="#/components/schemas/UpdateDoctor")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdateDoctor"),
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
    'PUT doctor/{id}' => 'doctor/update',
];