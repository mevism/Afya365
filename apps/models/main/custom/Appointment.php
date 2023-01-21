<?php

namespace userModels;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "appointment".
 *
 * @property int $id
 * @property int|null $doctor_id
 * @property int|null $patient_id
 * @property int|null $doctor_schedule_id
 * @property int|null $appointment_number
 * @property string|null $reason_for_appointment
 * @property string $appointment_time
 * @property string|null $doctor_comments
 * @property int|null $status
 * @property string|null $patient_come_into_hospital
 *
 * @property Doctor $doctor
 * @property Doctorschedule $doctorSchedule
 * @property Patient $patient
 */

 /**
 * @OA\Schema(
 *   schema="CreateAppointment",
 *   title="Appointment",
 *   type="object",
 *   required={"appointment_number","reason_for_appointment","appointment_time","doctor_comments ","patient_come_into_hospital"},
 * 
 * @OA\Property(
 *    property="appointment_number",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="reason_for_appointment",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="appointment_time",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="doctor_comments ",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="patient_come_into_hospital",
 *    type="string",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateAppointment",
 *   type="object",
 *   required={"appointment_number","reason_for_appointment","appointment_time","doctor_comments ","patient_come_into_hospital"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateAppointment"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="Appointment",
 *   type="object",
 *   required={"appointment_number","reason_for_appointment","appointment_time","doctor_comments ","patient_come_into_hospital"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateAppointment"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="Appointment",
 *     description="Appointment information .",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateAppointment"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateAppointment")
 *     )
 * )
 */
class Appointment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointment';
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
        // Yii::$app->formatter->asDate($dateStr,"php:H:i:s"); // Example $dateStr -> "09:15:00" 
        return [
            [[ 'appointment_number','appointment_time','reason_for_appointment'],  'required'],
            [['appointment_time'], 'safe'],
            [['patient_come_into_hospital'], 'string'],
            [['reason_for_appointment', 'doctor_comments'], 'string', 'max' => 255],

            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::class, 'targetAttribute' => ['doctor_id' => 'id']],
            [['doctor_schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctorschedule::class, 'targetAttribute' => ['doctor_schedule_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::class, 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::class, ['id' => 'doctor_id']);
    }

    /**
     * Gets query for [[DoctorSchedule]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorSchedule()
    {
        return $this->hasOne(Doctorschedule::class, ['id' => 'doctor_schedule_id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }
}
