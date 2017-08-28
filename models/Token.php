<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $user_id
 * @property string $code
 * @property integer $created_at
 * @property bool $isExpired
 *
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
    private $expirationTime = 86400;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['code', 'created_at'], 'required'],
            [['code'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'code' => 'Code',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /** @inheritdoc */
    public static function primaryKey()
    {
        return ['user_id', 'code'];
    }

    /**
     * @return bool Whether token has expired.
     */
    public function getIsExpired()
    {
        return ($this->created_at + $this->expirationTime) < time();
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            static::deleteAll(['user_id' => $this->user_id]);
            $this->setAttribute('created_at', time());
            $this->setAttribute('code', Yii::$app->security->generateRandomString());
        }

        return parent::beforeSave($insert);
    }
}
