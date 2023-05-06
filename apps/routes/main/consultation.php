<?php

return [

    /**
     * @OA\Post(
     *     path="/v1/consultation",
     *     summary="Create consultation information",
     *     tags={"Consultation"},
     *     @OA\RequestBody(
     *     description="consultation information",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateConsultation"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateConsultation")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateConsultation"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/Consultation")
     *     ),
     *     
     * )
     */
    'POST consultation' => 'consultation/create',

    /**
   * @OA\Get(
   *     path="/v1/allConsultations",
   *     summary="Get list of all  the consulation information",
   *     tags={"Consultation"},
   *     @OA\Response(
   *         response=200,
   *         description="successful",
   *         @OA\Schema(
   *            type="array",
   *            @OA\Items(ref="#/components/schemas/Consultation")
   *         )
   *     ),
   *     @OA\Response(
   *        response=401,
   *        description="Unauthorized",
   *        @OA\Schema(ref="#/schemas/Unauthorized")
   *     )
   * )
   */
  'GET allConsultations' => 'consultation/index',

      /**
     * @OA\Get(
     *     path="/v1/consultation/{Id}",
     *     summary="Get a Consultation by Id",
     *     tags={"Consultation"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Consultation data id to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/Consultation")
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
    'GET consultation/{id}' => 'consultation/view',

      /**
     * @OA\Put(
     *     path="/v1/consultation/{Id}",
     *     summary="Update consultation data",
     *     tags={"Consultation"},
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
     *        @OA\JsonContent(ref="#/components/schemas/UpdateConsultation")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdateConsultation"),
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
    'PUT consultation/{id}' => 'consultation/update',

    /**
     * @OA\Delete(
     *     path="/v1/consultation/{Id}",
     *     summary="Delete data of a certain consultation data",
     *     tags={"Consultation"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Consultation data id to delete",
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
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateConsultation")
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
    'DELETE consultation/{id}' => 'consultation/delete',
];