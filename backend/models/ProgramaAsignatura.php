<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "programa_asignatura".
 *
 * @property int $id
 * @property int|null $asignatura_id
 * @property int|null $programa_id
 *
 * @property Asignatura $asignatura
 * @property Programa $programa
 */
class ProgramaAsignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programa_asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'asignatura_id', 'programa_id'], 'integer'],
            [['id'], 'unique'],
            [['asignatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::class, 'targetAttribute' => ['asignatura_id' => 'id']],
            [['programa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programa::class, 'targetAttribute' => ['programa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asignatura_id' => 'Asignatura ID',
            'programa_id' => 'Programa ID',
        ];
    }

    /**
     * Gets query for [[Asignatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignatura()
    {
        return $this->hasOne(Asignatura::class, ['id' => 'asignatura_id']);
    }

    /**
     * Gets query for [[Programa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrograma()
    {
        return $this->hasOne(Programa::class, ['id' => 'programa_id']);
    }
}

