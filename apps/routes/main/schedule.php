<?php

return [

  /**
   * @OA\Get(
   *     path="/v1/allDoctorSchedules",
   *     summary="Get list of all  the doctors schedules",
   *     tags={"DoctorSchedule"},
   *     @OA\Response(
   *         response=200,
   *         description="successful",
   *         @OA\Schema(
   *            type="array",
   *            @OA\Items(ref="#/components/schemas/Doctorschedule")
   *         )
   *     ),
   *     @OA\Response(
   *        response=401,
   *        description="Unauthorized",
   *        @OA\Schema(ref="#/schemas/Unauthorized")
   *     )
   * )
   */
  'GET allDoctorSchedules' => 'schedule/index',

     /**
     * @OA\Get(
     *     path="/v1/doctorSchedule/{Id}",
     *     summary="Get a doctor schedule by Id",
     *     tags={"DoctorSchedule"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Doctor schedule id to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/DoctorSchedule")
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
    'GET doctorSchedule/{id}' => 'schedule/view',

     /**
     * @OA\Post(
     *     path="/v1/doctorSchedule",
     *     summary="Create data for scheduling  a doctor",
     *     tags={"DoctorSchedule"},
     *     @OA\RequestBody(
     *     description="Create a Doctor Schedule",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateSchedule"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateSchedule")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateSchedule"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/DoctorSchedule")
     *     ),
     *     
     * )
     */
    'POST doctorSchedule' => 'schedule/create',

          /**
     * @OA\Put(
     *     path="/v1/editSchedule/{Id}",
     *     summary="Update Doctor Schedule data",
     *     tags={"DoctorSchedule"},
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
     *        description="Doctor schedule value to be updated",
     *        @OA\JsonContent(ref="#/components/schemas/UpdateDoctorSchedule")
     *     ),
     *    @OA\Response(
     *         response=202,
     *         description="successful",
     *         @OA\JsonContent(
     *          @OA\Property(property="dataPayload", type="object",
     *             @OA\Property(property="data", type="object",ref="#/components/schemas/UpdateDoctorSchedule"),
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
    'PUT editSchedule/{id}' => 'schedule/update',

    /**
     * @OA\Delete(
     *     path="/v1/schedule/{Id}",
     *     summary="Delete doctor schedule",
     *     tags={"DoctorSchedule"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Doctor Schedule id to delete",
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
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateSchedule")
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
    'DELETE schedule/{id}' => 'schedule/delete',
];