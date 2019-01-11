<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user_backend".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class UserBackendModel extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_backend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    /**
     * 根据user_backend表的主键(id)获取用户
     * @param  [type] $id [主键]
     * @return [type]     [用户数据]
     */
    public static function findIdentity( $id )
    {
        return static::findOne( ['id'=>$id] );
    }

    /**
     * 根据access_token获取用户,我们暂时先不实现，在文章 http://www.manks.top/yii2-restful-api.html 有过实现，如果你感兴趣的话可以先看看
     * @param  [type] $token [description]
     * @param  [type] $type  [description]
     * @return [type]        [description]
     */
    public static function findIdentityByAccessToken( $token, $type = null )
    {
         throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * 用以标识 Yii::$app->user->id 的返回值
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 获取auth_key
     * @return [type] [description]
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * 验证auth_key
     * @param  [type] $authKey [description]
     * @return [type]          [description]
     */
    public function validateAuthKey( $authKey )
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 
     * @param [type] $password [description]
     */
    public function setPassword( $password ) 
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash( $password );
    }

    /**
     * 生成"remember me" 认证 key
     * @return [type] [description]
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 根据user_backend表的username获取用户
     * @param  [type] $username [description]
     * @return [type]           [description]
     */
    public static function findByUsername( $username )
    {
        return static::findOne( ['username' => $username] );
    }

    public function validatePassword( $password )
    {
        return Yii::$app->security->validatePassword( $password, $this->password_hash );
    }
}
