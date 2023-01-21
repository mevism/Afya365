<?php

return [

    /**
     * @OA\Get(
     *   path="/v1/about",
     *   summary="About app",
     *   tags={"About"},
     *   @OA\Response(
     *     response=200,
     *     description="Detail Information App",
     *   @OA\JsonContent(
     *      @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/About")
     *     )
     *     
     *   )
     * )
     */
    'GET about' => 'guest/index',

    /**
     * @OA\Post(
     *     path="/v1/login",
     *     summary="Login to the application",
     *     tags={"Authorization"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Login"))
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
    'POST login' => 'guest/login',


    /**
     * @OA\Post(
     *     path="/v1/resend",
     *     summary="Resend One Time Password",
     *     tags={"Authentication"},
     *     description="Provide the code sent to your mobile number",
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
     *  
     *             )
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Resend"))
     *     )
     *     ),      
     *   )
     * )
     */
    'POST resend' => 'guest/resend',

    /**
     * @OA\Post(
     *     path="/v1/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     description="Register a new user",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\Schema(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/NewUser")
     *         )
     *     ),
     *       @OA\RequestBody(
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/NewUser"),
     *         @OA\XmlContent(ref="#/components/schemas/NewUser")
     *     ),
     *   
     * )
     */
    'POST register' => 'guest/register',

    /**
     * @OA\Post(
     *     path="/v1/refresh",
     *     summary="Refresh Token",
     *     tags={"Authorization"},
     *     description="Refresh token of the currently logged in user.",
     *      @OA\RequestBody(
     *         description="token refreshed successfully",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property = "user_id",
     *                    type="integer"
     *                     ),
     *             )
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/User"))
     *     ),
     *   )
     *     ),      
     *   )
     * )
     */
    'POST refresh' => 'guest/refresh',

    /**
     * @OA\Post(
     *     path="/v1/verify",
     *     summary="Verify your Phone Number",
     *     tags={"Authentication"},
     *     description="Provide the code sent to your mobile number",
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
     *                  @OA\Property(
     *                    property = "OTP",
     *                    type="string"
     *                     ),
     *             )
     *         ),
     *         
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *          @OA\JsonContent(
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/Otp"))
     *     )
     *     ),      
     *   )
     * )
     */
    'POST verify' => 'guest/verify',

    /**
     * @OA\Post(
     *     path="/v1/requestpasswordreset",
     *     summary="Request Password Reset",
     *     tags={"Passwords"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/User"))
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
    'POST requestpasswordreset' => 'guest/requestpasswordreset',
    
    /**
     * @OA\Post(
     *     path="/v1/verifynumber",
     *     summary="Verify your number",
     *     tags={"Passwords"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/VerifyNumber"))
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
    'POST verifynumber' => 'guest/verifynumber',

     /**
     * @OA\Post(
     *     path="/v1/resetpassword",
     *     summary="Reset Password",
     *     tags={"Passwords"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/User"))
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
    'POST resetpassword' => 'guest/resetpassword',

     /**
     * @OA\Post(
     *     path="/v1/changepassword",
     *     summary="Change Password",
     *     tags={"Passwords"},
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
     *           @OA\Property(property="dataPayload", type="object",ref="#/components/schemas/User"))
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
    'POST changepassword' => 'guest/changepassword',
    

];
