<?php
return [
     /**
     * @OA\Post(
     *     path="/v1/adminLogin",
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
    'POST adminLogin' => 'admin/login',

    /**
     * @OA\Post(
     *     path="/v1/adminChangePassword",
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
    'POST adminChangePassword' => 'admin/adminchangepassword',
    /**
     * @OA\Post(
     *     path="/v1/changeMobileNumber",
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
    'POST changeMobileNumber' => 'admin/changemobilenumber',

    /**
     * @OA\Post(
     *     path="/v1/adminRequestPasswordReset",
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
    'POST adminRequestPasswordReset' => 'admin/adminrequestpasswordreset',

        /**
     * @OA\Post(
     *     path="/v1/adminVerifyNumber",
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
    'POST adminVerifyNumber' => 'admin/adminverifynumber',

      /**
     * @OA\Post(
     *     path="/v1/adminResetPassword",
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
    'POST adminResetPassword' => 'admin/adminresetpassword'
];