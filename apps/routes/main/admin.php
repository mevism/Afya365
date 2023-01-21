<?php
return [
     /**
     * @OA\Post(
     *     path="/v1/adminlogin",
     *     summary="Login to the application",
     *     tags={"Admin"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Admin"))
     *     )
     *     ),      
     *       @OA\Response(
     *         response=421,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(
     *          @OA\Property(property="errorPayload", type="object",ref="#/components/schemas/ErrorValidate"))
     *      )
     *     )
     *   )
     * )
     */
    'POST adminlogin' => 'admin/login',

    /**
     * @OA\Post(
     *     path="/v1/adminchangepassword",
     *     summary="Admin Change Password",
     *     tags={"Admin"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Admin"))
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
    'POST adminchangepassword' => 'admin/adminchangepassword',
    /**
     * @OA\Post(
     *     path="/v1/changemobilenumber",
     *     summary="Admin Change Phone number",
     *     tags={"Admin"},
     *     description="Kindly provide your new phone number.",
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                @OA\Property(
     *                    property = "current_mobile",
     *                    type="string"
     *                     ),
     *                 @OA\Property(
     *                    property = "new_mobile",
     *                    type="string"
     *                     ),
     *                 @OA\Property(
     *                    property = "confirm_mobile",
     *                    type="string"
     *                     ),
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Admin"))
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
    'POST changemobilenumber' => 'admin/changemobilenumber',

      /**
     * @OA\Post(
     *     path="/v1/adminrequestpasswordreset",
     *     summary="Admin Request Password Reset",
     *     tags={"Admin"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Admin"))
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
    'POST adminrequestpasswordreset' => 'admin/adminrequestpasswordreset',

        /**
     * @OA\Post(
     *     path="/v1/adminverifynumber",
     *     summary="Verify your number",
     *     tags={"Admin"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/AdminVerifyNumber"))
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
    'POST adminverifynumber' => 'admin/adminverifynumber',

      /**
     * @OA\Post(
     *     path="/v1/adminresetpassword",
     *     summary="Reset Password",
     *     tags={"Admin"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Admin"))
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
    'POST adminresetpassword' => 'admin/adminresetpassword',

    /**
     * @OA\Post(
     *     path="/v1/createdoctor",
     *     summary="Create data for the doctor",
     *     tags={"Admin"},
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
    'POST createdoctor' => 'admin/createdoctor',


  /**
   * @OA\Get(
   *     path="/v1/alldoctors",
   *     summary="Get list of all  the doctors",
   *     tags={"Admin"},
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
  'GET alldoctors' => 'admin/doctorindex',

      /**
     * @OA\Get(
     *     path="/v1/doctor/{Id}",
     *     summary="Get a doctor by Id",
     *     tags={"Admin"},
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
     *     tags={"Admin"},
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

     /**
     * @OA\Post(
     *     path="/v1/doctorschedule",
     *     summary="Create data for scheduling  a doctor",
     *     tags={"Admin"},
     *     @OA\RequestBody(
     *     description="Create a Doctor Schedule",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CreateDoctorSchedule"),
     *     @OA\MediaType(
     *         mediaType="application/xml",
     *         @OA\Schema(ref="#/components/schemas/CreateDoctorSchedule")
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(ref="#/components/schemas/CreateDoctorSchedule"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @OA\JsonContent(ref="#/components/schemas/DoctorSchedule")
     *     ),
     *     
     * )
     */
    'POST doctorschedule' => 'admin/schedule',
];