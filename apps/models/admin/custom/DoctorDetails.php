<?php

namespace adminModels;


use Yii;
use components\DoctorJwt;
use department\Department;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "doctor_details".
 *
 * @property int $id
 * @property string $staff_number
 * @property string $id_number
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $date_of_birth
 * @property string $gender
 * @property string $email
 * @property string $speciality
 * @property string $image
 * @property string $address
 */

/**
 *  @OA\Schema(
 *   schema="CreateDoctor",
 *   title="DoctorDetails",
 *   type="object",
 *   required={"id_number","first_name","last_name","phone_number","date_of_birth","gender","email","speciality","address"},
 * 
 *  @OA\Property(
 *    property="id_number",
 *    type="string",
 *   ), 
 * @OA\Property(
 *    property="first_name",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="middle_name",
 *    type="string",
 *   ),
 * 
 *  @OA\Property(
 *    property="last_name",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="phone_number",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="date_of_birth",
 *    type="string",
 *   ), 
 *  @OA\Property(
 *    property="gender",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="email",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="speciality",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="address",
 *    type="string",
 *   ), 
 * )
 */


/**
 *  @OA\Schema(
 *   schema="Update",
 *   title="update",
 *   type="object",
 *   required={"image"},
 * 
 *   @OA\Property(
 *    property="image",
 *    type="string",
 *   ), 
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateDoctor",
 *   type="object",
 *   required={"image"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/Update"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="DoctorDetails",
 *   type="object",
 *   required={"id_number","first_name","last_name","phone_number","date_of_birth","gender","email","speciality","address"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateDoctor"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="DoctorDetails",
 *     description="Doctor information to be added to his/her data.",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateDoctor"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateDoctor")
 *     )
 * )
 */
class DoctorDetails extends \yii\db\ActiveRecord
{
    use DoctorJwt;

    public $token;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctor_details';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,

        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_number', 'first_name', 'middle_name', 'last_name', 'phone_number', 'date_of_birth', 'gender', 'email', 'speciality', 'address'], 'required'],

            [['image'], 'required', 'on' => 'update'],

            ['email','trim'],
            ['email', 'email'],
            [['email'],'required'],

            [['date_of_birth'], 'safe'],

            [['phone_number'], 'string', 'max' => 13, 'min' => 10, 'notEqual' => 'Mobile Number can only be 10 or 13 digits.'],
            [['phone_number'], 'unique', 'targetClass' => DoctorDetails::class, 'targetAttribute' => 'phone_number', 'message' => 'An account with similar mobile number already exists.'],

            ['id_number', 'unique','targetClass' => DoctorDetails::class,'targetAttribute' => 'id_number', 'message' => 'This ID number is already taken.'],

            [['id_number', 'first_name', 'middle_name', 'last_name', 'phone_number', 'gender', 'email', 'speciality', 'image', 'address'], 'string', 'max' => 255],

            ['speciality', 'exist', 'targetClass' => Department::class, 'targetAttribute' => 'name', 'message' => 'There is no speciality with simillar name.'],

        ];
    }
    public function fields()
    {
        return [
        'id',
        'staff number'=>function(){ 
           return $this->staff_number; },
        'id number'=>function(){ 
            return $this->id_number; },
        'first name'=>function(){ 
            return $this->first_name; },
        'last name'=>function(){ 
            return $this->last_name; },
        'phone number'=>function(){ 
            return $this->phone_number; },
        'speciality'=>function(){ 
            return $this->speciality; },
        'token'
        ];
    }
   
}
