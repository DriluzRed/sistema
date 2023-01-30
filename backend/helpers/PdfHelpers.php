<?php

namespace backend\helpers;

use Yii;

class PdfHelpers
{
    public static function generateFooter()
    {
        $mesInText = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];
        $fecha = strftime('%d-%m-%Y a las %H:%M:%S', time());
        $mes = explode('-', $fecha)[0] . ' de ' . $mesInText[explode('-', $fecha)[1]] . ' del ' . explode('-', $fecha)[2];
        $responsable = Yii::$app->user->identity->username;

        $html = <<<HTML
<div class="footer" style="width: 100%;">
    <table width="100%">
        <tr>
            <td width="33%" style="font-style: italic; font-size: 11px">
                <strong>Fecha:</strong>&nbsp;$mes
            </td>
            <td width="33%" style="font-style: italic; text-align: center; font-size: 11px">
                <strong>Responsable:</strong>&nbsp;$responsable
            </td>
            <td width="33%" style="text-align: right; font-style: italic; font-size: 11px; font-style: ">
                <strong>Página</strong> {PAGENO}/{nbpg}
            </td>
        </tr>
    </table>
</div>
HTML;

        return HtmlHelpers::trimmedHtml($html);
    }
}