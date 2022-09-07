<?php

namespace models;

use Yii;
use models\User;
/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property string|null $username
 * @property int|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $dob
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
 *   required={"username","first_name","middle_name", "last_name","dob","email","gender","blood_group","phone","residence"},
 *  
 * @OA\Property(
 *    property="username",
 *    type="string",
 *   ), 
 * @OA\Property(
 *    property="first_name",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="last_name",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="gender",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="blood_group",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="phone",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="nationality",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="occupation",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="residence",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="user_id",
 *    type="integer",
 *   ),
 * )
 */

 /**
 * @OA\Schema(
 *   schema="UpdateProfile",
 *   type="object",
 *   required={"username","first_name","middle_name", "last_name","dob","email","gender","blood_group","phone","residence"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateProfile"),
 *   }
 * )
 */

 /**
 * @OA\Schema(
 *   schema="Profile",
 *   type="object",
 *   required={"username","first_name","middle_name", "last_name","dob","email","gender","blood_group","phone","residence"},
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
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','dob','username','first_name','middle_name','last_name','phone','blood_group','residence'],'required'],
            [['dob','required'],'date'],
            ['email','required'],
            ['email','email'],
            [['username','first_name','email','last_name','middle_name'], 'string'],
            [['gender', 'blood_group'], 'string','max' => 255],
            [[ 'blood_group', 'phone','residence'], 'string', 'max' => 255],
           [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'username',
            'first_name' => 'first_name',
            'middle_name' => 'middle_name',
            'last_name' => 'last_name',
            'dob' => 'dob',
            'email' => 'email',
            'gender' => 'Gender',
            'blood_group' => 'blood_group',
            'phone' => 'Phone',
            'residence' => 'Residence',
           
        ];
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
