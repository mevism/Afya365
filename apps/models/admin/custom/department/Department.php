<?php

namespace department;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @OA\Schema(
 *   schema="CreateDepartment",
 *   title="Department",
 *   type="object",
 *   required={"name"},
 *   
 * @OA\Property(
 *    property="name",
 *    type="string",
 *   ),
 * )
 */

 /**
 * @OA\Schema(
 *   schema="UpdateDepartment",
 *   type="object",
 *   required={"name"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateDepartment"),
 *   }
 * )
 */

 /**
 * @OA\Schema(
 *   schema="Department",
 *   type="object",
 *   required={"name"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateDepartment"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="Department",
 *     description="Department portion that needs to be added to the article",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateDepartment"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateDepartment")
 *     )
 * )
 */
/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string|null $name
 */
class Department extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
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
            [['name'], 'string', 'max' => 255],
        ];
    }

}
