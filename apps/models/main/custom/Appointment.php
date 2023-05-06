<?php

namespace userModels;

use doctorModels\DoctorDetails;
use doctorModels\Doctorschedule;
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
 *   required={"reason_for_appointment","appointment_time"},
 * 
 * @OA\Property(
 *    property="patient_id",
 *    type="string",
 *   ),
 *  * @OA\Property(
 *    property="reason_for_appointment",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="appointment_time",
 *    type="string",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateAppointment",
 *   type="object",
 *   required={"patient_id","reason_for_appointment","appointment_time"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateAppointment"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="Appointment",
 *   type="object",
 *   required={"patient_id","reason_for_appointment","appointment_time"},
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
 *     description="Appointment information.",
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
            TimestampBehavior::class
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appointment_time','reason_for_appointment','patient_id'],  'required'],
            ['appointment_time', 'string', 'max' => 100 ],
            [['reason_for_appointment'], 'string', 'max' => 255],

            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoctorDetails::class, 'targetAttribute' => ['doctor_id' => 'staff_number']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::class, 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    public function code()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    

    public function appointment(){
        
        $schedule   =   new Doctorschedule();
        // $doctor
        $appointment   =   new  Appointment();
        $appointment->patient_id  = $this->patient_id;
        $appointment->appointment_time = $schedule->schedule();
        $appointment->save();
        
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
