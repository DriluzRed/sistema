<?php

namespace backend\models\autonumber;

use backend\models\BaseModel;

/**
 * This is the model class for table "auto_number".
 *
 * @property string $group
 * @property string $template
 * @property integer $number
 * @property integer $optimistic_lock
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AutoNumber extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auto_number}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['optimistic_lock', 'number'], 'default', 'value' => 1],
            [['group'], 'required'],
            [['number', 'optimistic_lock'], 'integer'],
            [['group'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'template' => 'Template Num',
            'number' => 'Number',
        ];
    }
}
