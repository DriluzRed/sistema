<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumno_programa".
 *
 * @property int $id
 * @property int $alumno_id
 * @property int $programa_id
 * @property int $cohort
 * @property int $estado_programa_id
 * @property int $estado_titulo_id
 * @property string $resolution
 * @property string $resolution_date
 * @property string $promotion_year
 * @property string $seller
 * @property string $charge
 * @property Alumno $alumno
 * @property Programa $programa
 */
class AlumnoPrograma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno_programa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumno_id', 'programa_id', 'cohort', 'estado_programa_id', 'estado_titulo_id', 'resolution', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'required'],
            [['alumno_id', 'programa_id', 'cohort', 'estado_titulo_id'], 'integer'],
            [['resolution', 'estado_programa_id', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'string'],
            [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['alumno_id' => 'id']],
            [['programa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programa::className(), 'targetAttribute' => ['programa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumno_id' => 'Alumno ID',
            'programa_id' => 'Programa ID',
            'cohort' => 'Cohort',
            'estado_programa_id' => 'Estado Programa ID',
            'estado_titulo_id' => 'Estado Titulo ID',
            'resolution' => 'Resolution',
            'resolution_date' => 'Resolution Date',
            'promotion_year' => 'Promotion Year',
            'seller' => 'Seller',
            'charge' => 'Charge',
        ];
    }
    
    public function getAlumno()
    {
        return $this->hasOne(Alumno::className(), ['id' => 'alumno_id']);
    }

    
    public function getPrograma()
    {
        return $this->hasMany(Programa::class, ['id' => 'programa_id']);
    }
}