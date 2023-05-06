<?php

namespace doctorModels;

use userModels\Appointment;
use userModels\Patient;
use Yii;

/**
 * This is the model class for table "consultation".
 *
 * @property int $id
 * @property int|null $doctor_id
 * @property string|null $doctor_comments
 * @property string|null $prescription
 * @property int|null $status
 *
 * @property DoctorDetails $doctor
 */

 /**
 * @OA\Schema(
 *   schema="CreateConsultation",
 *   title="Consultation",
 *   type="object",
 *   required={"doctor_id","patient_id","doctor_comments","prescription"},
 * 
 * @OA\Property(
 *    property="doctor_id",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="patient_id",
 *    type="string",
 *   ),
 *  * @OA\Property(
 *    property="doctor_comments",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="prescription",
 *    type="string",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateConsultation",
 *   type="object",
 *   required={"doctor_id","patient_id","doctor_comments","prescription"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateConsultation"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="Consultation",
 *   type="object",
 *   required={"doctor_id","patient_id","doctor_comments","prescription"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateConsultation"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="Consultation",
 *     description="Consultation information.",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateConsultation"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateConsultation")
 *     )
 * )
 */


class Consultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%consultation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'doctor_comments', 'prescription','patient_id'], 'required'],
            [['doctor_comments', 'prescription'], 'string'],

            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::class, 'targetAttribute' => ['patient_id' => 'id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoctorDetails::class, 'targetAttribute' => ['doctor_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(DoctorDetails::class, ['id' => 'doctor_id']);
    }
}
