<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $content 内容
 * @property int $is_delete 是否删除 1未删除 2已删除
 */
class BlogModel extends \yii\db\ActiveRecord
{
    public $category;

    public function init()
    {
        parent::init();
        $this->on( self::EVENT_BEFORE_INSERT, [$this, 'onBeforeInsert'] );
        $this->on( self::EVENT_AFTER_INSERT, [$this, 'onAfterInsert'] );
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'content', 'category'], 'required'],
            [['id', 'is_delete'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'is_delete' => 'Is Delete',
        ];
    }

    public static function dropDownList( $name ) 
    {   
        if( $name == 'is_delete' ){
            $array = [ 1=>'未删除', 2=> '删除' ];
        }
        return $array;
    }

    public function onBeforeInsert( $event )
    {
        yii::info( 'This is beforeInsert event' );
    }

    public function onAfterInsert( $event )
    {
        yii::info( 'This is afterInsert event' );   
    }

}
