<?php

namespace doctorModels;


use Yii;
use DateTime;
use models\User;
use DateInterval;
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
 *   required={"id_number","first_name","last_name","phone_number","date_of_birth","gender","email","speciality","address","average_consulting_time"},
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
 *  @OA\Property(
 *    property="average_consulting_time",
 *    type="integer",
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
 *   required={"id_number","first_name","last_name","phone_number","date_of_birth","gender","email","speciality","address","average_consulting_time"},
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
    // use DoctorJwt;

    public $token;
    // public $phone_number;
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
            [['id_number', 'first_name', 'middle_name', 'last_name', 'phone_number', 'date_of_birth', 'gender', 'email', 'speciality', 'address','average_consulting_time'], 'required'],

            [['image'], 'required', 'on' => 'update'],
            ['average_consulting_time', 'integer'],
            ['email','trim'],
            ['email', 'email'],
            [['email'],'required'],

            ['date_of_birth','validateDoc'],
            // [['date_of_birth'], 'safe'],

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
        'average consulting time'=>function(){ 
            return $this->average_consulting_time; },
        ];
    }

    public function ValidateDoc($attribute, $params){
        $date = new DateTime();

        $range = $date->sub(new DateInterval('P27Y'));
        $min = $range->format('Y-m-d');

        $old = $date->sub(new DateInterval('P145Y'));
        $max = $old->format('Y-m-d');
       
            if(($min > $this->date_of_birth) || ($this->date_of_birth < $max)){
                $this->addError($attribute,  'A doctor cannot be younger than 27 years or older than 100 years.');            
            }
        return false;             
    }

    public function checkDoctor(){
        
        if (!$this->validate()) {
            return false;
        }           
    
        $doctor   =   new DoctorDetails();
        $doctor->staff_number   =   'DR' .rand(9999, 4);
        $doctor->id_number      =   $this->id_number;
        $doctor->first_name     =   $this->first_name;
        $doctor->middle_name    =   $this->middle_name;
        $doctor->last_name      =   $this->last_name;
        $doctor->phone_number   =   '+254' . substr($this->phone_number, -9);
        $doctor->date_of_birth  =   $this->date_of_birth;
        $doctor->gender         =   $this->gender;
        $doctor->email          =   $this->email;
        $doctor->speciality     =   $this->speciality;
        $doctor->address        =   $this->address;
        $doctor->average_consulting_time        =   $this->average_consulting_time;
        if($doctor->save(false)){
                $user = new User;
                $user->username = $doctor->staff_number;
                $user->mobile = $doctor->phone_number;
                $user->mobile_verify = "Doctor Verified";
                $user->is_patient_profile_updated = "Doctor Updated"; 
                $user->setPassword($this->id_number);
                $user->generateAuthKey();
                $user->status  =  10;
                $user->save();
                return $user->save() ? "saved successfuly" : false;

        }

        return false;

    }


   
}
