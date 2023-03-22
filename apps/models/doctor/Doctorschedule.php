<?php

namespace doctorModels;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "doctorschedule".
 *
 * @property int $id
 * @property string $staff_number
 * @property string $schedule_date
 * @property string $schedule_start
 * @property string $schedule_end
 * @property int|null $status
 *
 * @property Appointment[] $appointments
 */


/**
 * @OA\Schema(
 *   schema="CreateSchedule",
 *   title="DoctorSchedule",
 *   type="object",
 *   required={"staff_number","schedule_date","schedule_start","schedule_end"},
 *  
 *  @OA\Property(
 *    property="staff_number",
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
 * )
 */

/**
 * @OA\Schema(
 *   schema="UpdateDoctorSchedule",
 *   type="object",
 *   required={"staff_number","schedule_date","schedule_start","schedule_end"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateSchedule"),
 *   }
 * )
 */

/**
 * @OA\Schema(
 *   schema="DoctorSchedule",
 *   type="object",
 *   required={"staff_number","schedule_date","schedule_start","schedule_end"},
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/CreateSchedule"),
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
 *     @OA\JsonContent(ref="#/components/schemas/CreateSchedule"),
 *     @OA\MediaType(
 *         mediaType="application/xml",
 *         @OA\Schema(ref="#/components/schemas/CreateSchedule")
 *     )
 * )
 */
class Doctorschedule extends \yii\db\ActiveRecord
{
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

    public function fields()
    {
        return ['staff_number', 'schedule_date', 'schedule_start', 'schedule_end'];
    }

    public function rules()
    {
        return [
            ['staff_number', 'required'],
            [['schedule_date', 'schedule_start', 'schedule_end'], 'required'],
            ['schedule_date', 'datetime', 'format' => 'php:Y-m-d'],
            [['schedule_start', 'schedule_end'], 'datetime', 'format' => 'php:H:i:s'],
            ['schedule_start', 'dateValidation'],
            [['staff_number'], 'string', 'max' => 255],
            ['staff_number', 'exist',  'targetClass' => DoctorDetails::class, 'targetAttribute' =>  'staff_number', 'message' => 'Staff number not found.'],
        ];
    }

    public function dateValidation($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->schedule_end < $this->schedule_start) {
                $this->addError($attribute, 'schedule end time cannot be less than the schedule start time');
            }
            return false;
        }
    }

    public function schedule($slots = [])
    {
        $user = DoctorDetails::findOne(['staff_number' => $this->staff_number]);
        $time = $user->average_consulting_time;

        $start = strtotime($this->schedule_start);
        $end = strtotime($this->schedule_end);
        $interval = $time * 60; // $time minutes in seconds

        for ($i = $start; $i <= $end; $i += $interval) {
            $_end = $i + $interval;
            $_start = date("Hi", $i);
            $slots[] = [
                'app_id' => $time . substr(date('Y'), 0, 2) . date('dmy') . $_start,
                'dr_id' => $this->staff_number,
                'start_time' => $_start,
                'end_time' => date("Hi", $_end),
                'status' => $this->status($_start),
            ];
        }
        return $slots;
    }

    protected function status($start_time)
    {
        if (date('Hi') > $start_time) {
            return 'Clossed';
        }
        return 'Active';
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

}
