<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "clndr_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property string $salt
 * @property string $access_token
 * @property string $create_date
 *
 * @property ClndrAccess[] $clndrAccesses
 * @property ClndrAccess[] $clndrAccesses0
 * @property ClndrCalendar[] $clndrCalendars
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clndr_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'surname', 'password', 'salt'], 'required'],
            [['create_date'], 'safe'],
            [['username'], 'string', 'max' => 128],
            [['name', 'surname'], 'string', 'max' => 45],
            [['password', 'salt', 'access_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['access_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'password' => Yii::t('app', 'Password'),
            'salt' => Yii::t('app', 'Salt'),
            'access_token' => Yii::t('app', 'Access Token'),
            'create_date' => Yii::t('app', 'Create Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClndrAccesses()
    {
        return $this->hasMany(ClndrAccess::className(), ['user_owner' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClndrAccesses0()
    {
        return $this->hasMany(ClndrAccess::className(), ['user_guest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClndrCalendars()
    {
        return $this->hasMany(ClndrCalendar::className(), ['creator' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
