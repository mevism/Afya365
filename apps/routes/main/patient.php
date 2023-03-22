<?php
return [


  /**
   * @OA\Get(
   *     path="/v1/viewpatient",
   *     summary="Get list of all  the doctors",
   *     tags={"Patient"},
   *     @OA\Response(
   *         response=200,
   *         description="successful",
   *         @OA\Schema(
   *            type="array",
   *            @OA\Items(ref="#/components/schemas/Patient")
   *         )
   *     ),
   *     @OA\Response(
   *        response=401,
   *        description="Unauthorized",
   *        @OA\Schema(ref="#/schemas/Unauthorized")
   *     )
   * )
   */
  'GET viewpatient' => 'patient/index',
    /**
     * @OA\Put(
     *     path="/v1/patient/{Id}",
     *     summary="Update patient data",
     *     tags={"Patient"},
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
     *        description="Patient value to be updated",
     *        @OA\JsonContent(ref="#/components/schemas/UpdatePatient")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdatePatient"),
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
    'PUT patient/{id}' => 'patient/update',
    
    /**
     * @OA\Get(
     *     path="/v1/patient/{Id}",
     *     summary="Get patient by Id",
     *     tags={"Patient"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Patient ID to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/Patient")
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
    'GET patient/{id}' => 'patient/view',

    /**
     * @OA\Post(
     *     path="/v1/appointment",
     *     summary="Create data for patient appointment",
     *     tags={"Patient"},
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
    'POST appointment' => 'patient/appointment',
];