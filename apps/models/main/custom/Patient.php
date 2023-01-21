<?php

namespace userModels;

use Yii;
use DateTime;
use models\User;
use DateInterval;
use components\UserJwt;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Patient".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $date_of_birth
 * @property string $gender
 * @property string $blood_group
 * @property string $county_of_residence
 * @property string $sub_county
 * @property string|null $address
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $isDeleted
 *
 * @property Users $user
 */

/**
 * @OA\Schema(
 *   schema="CreatePatient",
 *   title="Patient",
 *   type="object",
 *   required={"first_name","last_name","date_of_birth","gender","blood_group","county_of_residence","sub_county"},
 *  
 * @OA\Property(
 *    property="first_name",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="middle_name",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="last_name",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="email",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="gender",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="date_of_birth",
 *    type="string",
 *   ), 
 *  @OA\Property(
 *    property="blood_group",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="county_of_residence",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="sub_county",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="address",
 *    type="string",
 *   ), 
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdatePatient",
 *   type="object",
 *   required={"first_name","last_name","date_of_birth","gender","blood_group","county_of_residence","sub_county"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreatePatient"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="Patient",
 *   type="object",
 *   required={"first_name","last_name","date_of_birth","gender","blood_group","county_of_residence","sub_county"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreatePatient"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="Patient",
 *     description="Patient portion that needs to be added to the article",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreatePatient"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreatePatient")
 *     )
 * )
 */
class Patient extends ActiveRecord
{
    use UserJwt;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%patient}}';
    }

    public function fields()
    {
        return [
            'id',
            'User ID' => function () {
                return $this->user->id;
            }, 'First Name' => function () {
                return $this->first_name;
            }, 'Last Name' => function () {
                return $this->last_name;
            }, 'Date of Birth' => function () {
                return $this->date_of_birth;
            }, 'Blood Group' => function () {
                return $this->blood_group;
            }, 'County of Residence' => function () {
                return $this->county_of_residence;
            }, 'Sub County/Constituency' => function () {
                return $this->sub_county;
            }, 'Address' => function () {
                return $this->address;
            }
        ];
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
            [['date_of_birth', 'sub_county', 'first_name'], 'required'],
            [['gender', 'last_name', 'blood_group', 'county_of_residence'], 'required'],
            ['email', 'email'],
            [['first_name', 'email', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['gender', 'blood_group'], 'string', 'max' => 255],
            [['county_of_residence', 'sub_county', 'address'], 'string', 'max' => 255],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
