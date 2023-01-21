<?php

namespace adminModels;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "doctorschedule".
 *
 * @property int $id
 * @property int|null $doctor_id
 * @property string|null $schedule_day
 * @property string|null $schedule_date
 * @property string|null $schedule_start
 * @property string|null $schedule_end
 * @property string|null $average_consulting_time
 * @property int|null $status
 *
 * @property Appointment[] $appointments
 * @property Doctor $doctor
 */


/**
 * @OA\Schema(
 *   schema="CreateDoctorSchedule",
 *   title="DoctorSchedule",
 *   type="object",
 *   required={"schedule_day","schedule_date","schedule_start","schedule_end","average_consulting_time"},
 * 
 * @OA\Property(
 *    property="schedule_day",
 *    type="string",
 *   ),
 * @OA\Property(
 *    property="schedule_date",
 *    type="string",
 *   ),
 * 
 * @OA\Property(
 *    property="schedule_start",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="schedule_end",
 *    type="string",
 *   ),
 *  @OA\Property(
 *    property="average_consulting_time",
 *    type="string",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateDoctorSchedule",
 *   type="object",
 *   required={"schedule_day","schedule_date","schedule_start","schedule_end","average_consulting_time"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateDoctorSchedule"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="DoctorSchedule",
 *   type="object",
 *   required={"schedule_day","schedule_date","schedule_start","schedule_end","average_consulting_time"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateDoctorSchedule"),
 *       @OA\Schema(
 *           required={"Id"},
 *           @OA\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */

/**
 * @OA\RequestBody(
 *     request="DoctorSchedule",
 *     description="Doctor Schedule information .",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/CreateDoctorSchedule"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateDoctorSchedule")
 *     )
 * )
 */
class Doctorschedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctorschedule';
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
            [['schedule_day','schedule_date','schedule_start','schedule_end','average_consulting_time'], 'required'],
            [['schedule_start', 'schedule_end', 'average_consulting_time'], 'string', 'max' => 255],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::class, 'targetAttribute' => ['doctor_id' => 'id']],
        ];
    }

 

    /**
     * Gets query for [[Appointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointments()
    {
        return $this->hasMany(Appointment::class, ['doctor_schedule_id' => 'id']);
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
}
