<?php

namespace forms;

use Yii;
use models\User;
use yii\base\Model;

/**
 * @OA\Schema(
 *   schema="NewUser",
 *   title="NewUser",
 *   type="object",
 *   required={ "username", "email", "password"},
 *
 *  @OA\Property(
 *     property="username",
 *     type="string",
 * ),
 * @OA\Property(
 *     property="email",
 *     type="string",
 * ),
 * 
 * @OA\Property(
 *     property="password",
 *     type="string",
 * ),
 *)
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Register user.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() && $this->sendEmail($user);

        // return $user->save() ? $user : null;
    }

       /**
     * Sends registration success email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
     protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ''])
            ->setTo($this->email)
            ->setSubject(' ' . Yii::$app->name)
            ->send();
    } 
}