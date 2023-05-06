<?php

return [

     /**
     * @OA\Post(
     *     path="/v1/doctorLogin",
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
    'POST doctorLogin' => 'doctor/login',

        /**
     * @OA\Post(
     *     path="/v1/doctorChangePassword",
     *     summary="Change Password",
     *     tags={"Doctor"},
     *     description="Kindly provide your new password.",
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                @OA\Property(
     *                    property = "current_password",
     *                    type="string"
     *                     ),
     *                 @OA\Property(
     *                    property = "new_password",
     *                    type="string"
     *                     ),
     *                 @OA\Property(
     *                    property = "confirm_password",
     *                    type="string"
     *                     ),
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
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST doctorChangePassword' => 'doctor/changepassword',

    /**
     * @OA\Post(
     *     path="/v1/doctorRequestPasswordReset",
     *     summary=" Request Password Reset",
     *     tags={"Doctor"},
     *     description="Kindly provide your mobile number below.",
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property = "mobile",
     *                    type="string"
     *                     ),
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Doctor"))
     *     )
     *     ),      
     *       @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST doctorRequestPasswordReset' => 'doctor/doctorrequestpasswordreset',

        /**
     * @OA\Post(
     *     path="/v1/doctorVerifyNumber",
     *     summary="Verify your number",
     *     tags={"Doctor"},
     *     description="Kindly provide your mobile number below.",
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                    property = "user_id",
     *                    type="integer"
     *                     ),
     *                  @OA\Property(
     *                    property = "OTP",
     *                    type="string"
     *                     ),
     *              
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/DoctorVerifyNumber"))
     *     )
     *     ),      
     *       @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST doctorVerifyNumber' => 'doctor/doctorverifynumber',

      /**
     * @OA\Post(
     *     path="/v1/doctorResetPassword",
     *     summary="Reset Password",
     *     tags={"Doctor"},
     *     description="Kindly provide your new password.",
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property = "user_id",
     *                    type="integer"
     *                     ),
     *                 @OA\Property(
     *                    property = "password",
     *                    type="string"
     *                     ),
     *                 @OA\Property(
     *                    property = "confirm_password",
     *                    type="string"
     *                     ),
     *              
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Doctor"))
     *     )
     *     ),      
     *       @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST doctorResetPassword' => 'doctor/doctorresetpassword',

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

    /**
     * @OA\Post(
     *     path="/v1/createDoctor",
     *     summary="Create data for the doctor",
     *     tags={"Doctor"},
     *     @OA\RequestBody(
     *     description="Create a Doctor",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateDoctor"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateDoctor")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateDoctor"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/DoctorDetails")
     *     ),
     *     
     * )
     */
    'POST createDoctor' => 'admin/createdoctor',


  /**
   * @OA\Get(
   *     path="/v1/allDoctors",
   *     summary="Get list of all  the doctors",
   *     tags={"Doctor"},
   *     @OA\Response(
   *         response=200,
   *         description="successful",
   *         @OA\Schema(
   *            type="array",
   *            @OA\Items(ref="#/components/schemas/DoctorDetails")
   *         )
   *     ),
   *     @OA\Response(
   *        response=401,
   *        description="Unauthorized",
   *        @OA\Schema(ref="#/schemas/Unauthorized")
   *     )
   * )
   */
  'GET allDoctors' => 'admin/doctorindex',

      /**
     * @OA\Get(
     *     path="/v1/doctor/{Id}",
     *     summary="Get a doctor by Id",
     *     tags={"Doctor"},
     *      @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Doctor id to be returned",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *        @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object", ref="#/components/schemas/DoctorDetails")
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
    'GET doctor/{id}' => 'admin/viewdoctor',

    /**
     * @OA\Delete(
     *     path="/v1/doctor/{Id}",
     *     summary="Delete data of a certain doctor",
     *     tags={"Doctor"},
     *       @OA\Parameter(
     *         name="Id",
     *         in="path",
     *         description="Doctor id to delete",
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
     *              @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/CreateDoctor")
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
    'DELETE doctor/{id}' => 'admin/deletedoctor',
];