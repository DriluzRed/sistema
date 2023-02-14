<?php

namespace backend\models;
use backend\models\Pais;

use Yii;

/**
 * This is the model class for table "alumno".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $ci
 * @property int $country_id
 * @property string $low_line_number
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $age
 * @property int $campus
 * @property int $subsidiary
 * @property string $enrollment_date
 * @property string $contract_number
 * @property string $year
 * @property string $promotion_year
 * @property string $born_at
 * @property string $promotion
 * @property string $document_front_file
 * @property string $document_back_file
 * @property string $status
 * @property string $study_certificate_file
 * @property string $finded_ips
 * @property string $finded_ruc
 * @property int $programa_id
 * @property string $sex
 * @property string $created_at
 * @property string $updated_at
 */
class Alumno extends \yii\db\ActiveRecord
{
    public $enrrolment_date;
    // public $country_id;
    // public $programa_id;
    public $programas = [];
    public $cohorte;
    public $estado_programa_id;
    public $estado_titulo_id;
    public $resolution;
    public $resolution_date;
    public $promotion_year;
    public $seller;
    public $charge;

    // public $programas = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'ci', 'low_line_number', 'phone', 'email', 'address', 'age', 'enrollment_date', 'contract_number', 'year', 'promotion_year', 'born_at', 'promotion', 'document_front_file', 'document_back_file', 'status', 'study_certificate_file', 'finded_ips', 'finded_ruc', 'sex'], 'string'],
            [['country_id', 'campus', 'subsidiary', 'programa_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'ci' => 'Ci',
            'country_id' => 'Pais',
            'low_line_number' => 'Linea Baja',
            'phone' => 'Telefono',
            'email' => 'Email',
            'address' => 'Address',
            'age' => 'Edad',
            'campus' => 'Sede',
            'subsidiary' => 'Filial',
            'enrollment_date' => 'Enrollment Date',
            'contract_number' => 'Contract Number',
            'year' => 'Año',
            'promotion_year' => 'Año de promocion',
            'born_at' => 'Born At',
            'promotion' => 'Promotion',
            'document_front_file' => 'Document Front File',
            'document_back_file' => 'Document Back File',
            'status' => 'Status',
            'study_certificate_file' => 'Study Certificate File',
            'finded_ips' => 'Finded Ips',
            'finded_ruc' => 'Finded Ruc',
            'programa_id' => 'Programa ID',
            'sex' => 'Sex',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPais(){
        return $this->hasOne(Pais::className(), ['id' => 'country_id']);
    }
    public function getAlumnoProgramas()
    {
        return $this->hasMany(AlumnoPrograma::class, ['alumno_id' => 'id']);
    }
    
    public function getProgramas()
    {
        return $this->hasMany(Programa::class, ['id' => 'programa_id'])
            ->via('alumnoProgramas');
    }
}
