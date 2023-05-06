<?php
return [

    /**
     * @OA\Post(
     *     path="/v1/appointment",
     *     summary="Create data for patient appointment",
     *     tags={"Appointment"},
     *     @OA\RequestBody(
     *     description="Create an appointment",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateAppointment"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateAppointment")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateAppointment"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     
     * )
     */
    'POST appointment' => 'appointment/create',

    /**
   * @OA\Get(
   *     path="/v1/allAppointments",
   *     summary="Get list of all  the consulation information",
   *     tags={"Appointment"},
   *     @OA\Response(
   *         response=200,
   *         description="successful",
   *         @OA\Schema(
   *            type="array",
   *            @OA\Items(ref="#/components/schemas/Appointment")
   *         )
   *     ),
   *     @OA\Response(
   *        response=401,
   *        description="Unauthorized",
   *        @OA\Schema(ref="#/schemas/Unauthorized")
   *     )
   * )
   */
  'GET allAppointments' => 'appointment/index',

  /**
 * @OA\Get(
 *     path="/v1/appointment/{Id}",
 *     summary="Get an appointment by Id",
 *     tags={"Appointment"},
 *      @OA\Parameter(
 *         name="Id",
 *         in="path",
 *         description="Appointment data id to be returned",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful",
 *        @OA\JsonContent(
 *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/Appointment")
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
'GET appointment/{id}' => 'appointment/view',



     /**
     * @OA\Delete(
     *     path="/v1/withdraw/{Id}",
     *     summary="Delete Appointment Data",
     *     tags={"Appointment"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Appointment Data id to delete",
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
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateAppointment")
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
    'DELETE withdraw/{id}' => 'appointment/withdraw'
];