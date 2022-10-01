<?php

return[

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
     *     path="/v1/otp",
     *     summary="Verify your Phone Number",
     *     tags={"Authentication"},
     *     description="Provide the code sent to your mobile number",
     *      security={{}},
     *      @OA\RequestBody(
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                    property = "token",
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

     ];