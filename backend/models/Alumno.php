<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumno".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $ci
 * @property string|null $country_id
 * @property string|null $low_line_number
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $age
 * @property int|null $programa_id
 * @property int|null $campus
 * @property int|null $subsidiary
 * @property string|null $enrrolment_date
 * @property string|null $contract_number
 * @property string|null $year
 * @property string|null $promotion_year
 * @property string|null $born_at
 * @property string|null $promotion
 * @property string|null $document_front_file
 * @property string|null $document_back_file
 * @property string|null $status
 * @property string|null $study_certificate_file
 * @property string|null $finded_ips
 * @property string|null $finded_ruc
 
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
            [['ci','first_name', 'last_name'], 'required'],
            [['id', 'campus', 'subsidiary'], 'integer'],
            [['first_name', 'last_name', 'ci','enrrolment_date', 'low_line_number', 'phone', 'email', 'address', 'age', 'contract_number', 'year', 'promotion_year', 'born_at', 'promotion', 'document_front_file', 'document_back_file', 'status', 'study_certificate_file', 'finded_ips', 'finded_ruc'], 'string'],
            [['first_name', 'last_name', 'ci','enrrolment_date', 'low_line_number', 'phone', 'email', 'address', 'age', 'contract_number', 'year', 'promotion_year', 'born_at', 'promotion', 'document_front_file', 'document_back_file', 'status', 'study_certificate_file', 'finded_ips', 'finded_ruc', 'programas', 'country_id', 'cohorte'], 'safe'],
            [['estado_programa_id', 'estado_titulo_id', 'resolution', 'resolution_date', 'promotion_year', 'seller', 'charge'], 'safe'],
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
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'ci' => 'Ci',
            'country_id' => 'Pais',
            'low_line_number' => 'Linea Baja',
            'phone' => 'Telefono',
            'email' => 'Email',
            'address' => 'Direccion',
            'age' => 'Edad',
            'programas' => 'Programa',
            'campus' => 'Sede',
            'subsidiary' => 'Filial',
            'enrrolment_date' => 'Fecha Inscripcion',
            'contract_number' => 'Contract Number',
            'year' => 'Year',
            'promotion_year' => 'Promotion Year',
            'born_at' => 'Born At',
            'promotion' => 'Promotion',
            'document_front_file' => 'Document Front File',
            'document_back_file' => 'Document Back File',
            'status' => 'Status',
            'study_certificate_file' => 'Study Certificate File',
            'finded_ips' => 'Finded Ips',
            'finded_ruc' => 'Finded Ruc',
        ];
    }
    public function getPais(){
        return $this->hasOne(Pais::className(), ['id' => 'country_id']);
    }
    public function getProgramas()
    {
        return $this->hasMany(AlumnoPrograma::className(), ['alumno_id' => 'id']);
    }
    public function getAlumnoprograma()
{
    return $this->hasMany(Programa::className(), ['id' => 'programa_id']);
}
    
}
