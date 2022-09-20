<?php

namespace models;

use Yii;
use models\User;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property string|null $username
 * @property int|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $date_of_birth
 * @property string|null $email
 * @property string|null $gender
 * @property string|null $blood_group
 * @property string|null $phone
 * @property string|null $residence
 * @property int|null $user_id
 *
 * @property Users $user
 */

 /**
 * @OA\Schema(
 *   schema="CreateProfile",
 *   title="Profile",
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
 *   schema="UpdateProfile",
 *   type="object",
 *   required={"first_name","last_name","date_of_birth","gender","blood_group","county_of_residence","sub_county"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateProfile"),
 *   }
 * )
 */

 /**
 * @OA\Schema(
 *   schema="Profile",
 *   type="object",
 *   required={"first_name","last_name","date_of_birth","gender","blood_group","county_of_residence","sub_county"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateProfile"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="Profile",
 *     description="Profile portion that needs to be added to the article",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateProfile"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateProfile")
 *     )
 * )
 */
class Profile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
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
            [['date_of_birth','sub_county','first_name', 'gender','last_name','blood_group','county_of_residence'],'required'],
            [['date_of_birth'],'date','format'=>'Y-m-d'],
            ['email','email'],
            [['sub_county','first_name','email','last_name','middle_name'], 'string'],
            [['gender', 'blood_group'], 'string','max' => 255],
            [['blood_group', 'county_of_residence', 'address'], 'string', 'max' => 255],
            
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    
    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $profile = new Profile();
        $profile->user_id = 1;
        $profile->first_name = $this->first_name;
        $profile->middle_name = $this->middle_name;
        $profile->last_name = $this->last_name;
        $profile->date_of_birth = $this->date_of_birth;
        $profile->email = $this->email;
        $profile->gender = $this->gender;
        $profile->county_of_residence = $this->county_of_residence;
        $profile->sub_county = $this->sub_county;
        $profile->address = $this->address;

        return $profile->save();
 
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
