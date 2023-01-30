<?php

namespace backend\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;

class ExcelHelpers extends Helpers
{
    /**
     * @param Spreadsheet $objPHPExcel
     * @param string $fileName
     * @throws \Exception
     */
    public static function exportToBrowser($objPHPExcel, $fileName)
    {
        $currentDate = strftime('%d-%m-%Y a las %H:%M:%S', time());
        //Versión excel
        $carpeta = Yii::$app->basePath . '/web/uploads/';
        if (!is_dir($carpeta)) {
            if (!@mkdir($carpeta, 0777, true)) {
                throw new \Exception('No se puede crear carpeta.');
            }
        }
        Yii::$app->session->set('carpeta', $carpeta);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xlsx');
        $objWriter->save($carpeta . "temporal_user_id" . Yii::$app->getUser()->identity->getId() . ".xlsx");

        // Exportar en navegador
        $fi = pathinfo($carpeta . "temporal_user_id" . Yii::$app->getUser()->identity->getId() . ".xlsx");
        $OS = strtolower(empty($_SERVER['HTTP_USER_AGENT']) ? '' : $_SERVER['HTTP_USER_AGENT']);
        if (!$OS)
            $OS_IS_MAC = true;
        else
            $OS_IS_MAC = (strpos($OS, 'mac') !== false)
                || (strpos($OS, 'macintosh') !== false)
                || (strpos($OS, 'iphone') !== false)
                || (strpos($OS, 'ipad') !== false);

        if ($OS_IS_MAC) {
//            if(!file_exists($target_relative)){
//                copy($filename,$target_relative);
//                sleep(1);
//            }
//            header('Location: ' . $target);
        } else {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $fileName . $currentDate . '.' . $fi['extension']);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($carpeta . "temporal_user_id" . Yii::$app->getUser()->identity->getId() . ".xlsx"));
            ob_clean();
            flush();
            readfile($carpeta . "temporal_user_id" . Yii::$app->getUser()->identity->getId() . ".xlsx");
        }
        //borramos el fichero temporal
        unlink($carpeta . "temporal_user_id" . Yii::$app->getUser()->identity->getId() . ".xlsx");
    }

    public static function generatePHPExcelObject($customPath = '', $fileName = 'Default_Name.txt')
    {
        // Crear objetoExcel.
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        date_default_timezone_set('America/Asuncion');

        /** Create a new Spreadsheet Object **/
//        $carpeta = Yii::$app->basePath . '/modules/contabilidad/views/reporte/balance/suma-y-saldo/';
        $carpeta = Yii::$app->basePath . $customPath;
        $objPHPExcel = IOFactory::load($carpeta . $fileName);

        return $objPHPExcel;
    }
}