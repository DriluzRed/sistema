<?php

namespace backend\helpers;

use yii\helpers\Html;

/**
 * Class HtmlHelpers
 */
class HtmlHelpers extends Html
{
    /**
     * Return a raw `HTML` without multiplles spaces or tabs and enters.
     * It could be used by an JQuery to bulk-render `HTML` elements.
     *
     * @param string|null $html The `HTML` code.
     * @return string The trimmed `HTML` code or an zero-length string if `$html` parameter is null
     */
    public static function trimmedHtml($html = null)
    {
        if (!isset($html)) return "";

        $output = str_replace(array("\r\n", "\r"), "\n", $html);
        $lines = explode("\n", $output);
        $substrings = array();

        foreach ($lines as $i => $line) {
            if (!empty($line))
                $substrings[] = trim($line);
        }
        $html_without_enter_and_spaces = implode($substrings);

        return $html_without_enter_and_spaces;
    }

    /**
     * Return a Boostrap Alert Panel.
     * @param string $caption The first caption word for the panel.
     * @param string $content The content of the panel.
     * @param string $type Whether the panel is for `info`, `success`, `danger`, `warning`.
     * @param bool $dismissible Whether the panel is closable or not.
     * @return string The Boostrap Alert Panel.
     */
    public static function BootstrapAlert($caption = 'Default caption!', $content = 'Default content...', $type = 'info', $dismissible = true)
    {
        $alertDismissible = $dismissible ? 'alert-dismissible' : null;
        $dismissButton = $dismissible ? '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' : null;

        $html = <<<HTML
<div class="alert alert-{$type} {$alertDismissible}">
    {$dismissButton}
    <strong>{$caption}</strong> {$content}
</div>
HTML;
        return self::trimmedHtml($html);
    }

    public static function BootstrapInfoAlert($caption = 'Default Caption!', $content = 'Default content...', $dismissible = true)
    {
        return self::BootstrapAlert($caption, $content, 'info', $dismissible);
    }

    public static function BootstrapSuccessAlert($caption = 'Default Caption!', $content = 'Default content...', $dismissible = true)
    {
        return self::BootstrapAlert($caption, $content, 'success', $dismissible);
    }

    public static function BootstrapDangerAlert($caption = 'Default Caption!', $content = 'Default content...', $dismissible = true)
    {
        return self::BootstrapAlert($caption, $content, 'danger', $dismissible);
    }

    public static function BootstrapWarningAlert($caption = 'Default Caption!', $content = 'Default content...', $dismissible = true)
    {
        return self::BootstrapAlert($caption, $content, 'warning', $dismissible);
    }

    public static function InfoHelpIcon($class = null)
    {
        $html = <<<HTML
<span class="popuptrigger {$class} text-info glyphicon glyphicon-info-sign" style="padding: 0 4px;"></span>
HTML;
        return self::trimmedHtml($html);
    }

    public static function WarningHelpIcon($class = null)
    {
        $html = <<<HTML
<span class="popuptrigger {$class} text-warning glyphicon glyphicon-info-sign" style="padding: 0 4px;"></span>
HTML;
        return self::trimmedHtml($html);
    }

    public static function DangerHelpIcon($class = null)
    {
        $html = <<<HTML
<span class="popuptrigger {$class} text-danger glyphicon glyphicon-info-sign" style="padding: 0 4px;"></span>
HTML;
        return self::trimmedHtml($html);
    }

    public static function SuccessHelpIcon($class = null)
    {
        $html = <<<HTML
<span class="popuptrigger {$class} text-success glyphicon glyphicon-info-sign" style="padding: 0 4px;"></span>
HTML;
        return self::trimmedHtml($html);
    }

    public static function PrimaryHelpIcon($class = null)
    {
        $html = <<<HTML
<span class="popuptrigger {$class} text-primary glyphicon glyphicon-info-sign" style="padding: 0 4px;"></span>
HTML;
        return self::trimmedHtml($html);
    }

    /**
     * Return a Bootstrap Panel.
     *
     * @param string $type Whether the style is `info`, `danger`, `success` or `warning`.
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
 * @return string
     */
    public static function BootstrapPanel($type = 'success', $header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        $html = null;
        if ($footer != "" && !$closeable)
            $html = <<<HTML
<div class="panel panel-{$type}">
    <div class="panel-heading"><strong>{$header}</strong></div>
    <div class="panel-body">{$body}</div>
</div>
HTML;
        elseif ($footer != '' && $closeable)
            $html = <<<HTML
<div class="panel panel-{$type}">
    <div class="panel-heading"><strong><div class='btn-toolbar'>{$header}<span title='Cerrar panel' class='badge badge-primary pull-right cerrar-panel' style="cursor: pointer" onclick="cerrarPanel(this)">X</span></div></strong></div>
    <div class="panel-body">{$body}</div>
    <div class="panel-footer">{$footer}</div>
</div>
HTML;

        elseif ($footer == "" && !$closeable)
            $html = <<<HTML
<div class="panel panel-{$type}">
    <div class="panel-heading"><strong>{$header}</strong></div>
    <div class="panel-body">{$body}</div>
</div>
HTML;
        elseif ($footer == "" && $closeable)
            $html = <<<HTML
<div class="panel panel-{$type}">
    <div class="panel-heading"><strong><div class='btn-toolbar'>{$header}<span title='Cerrar panel' class='badge badge-primary pull-right cerrar-panel' style="cursor: pointer" onclick="cerrarPanel(this)">X</span></div></strong></div>
    <div class="panel-body">{$body}</div>
</div>
HTML;
        if (!$animate)
            $html .= <<<HTML
<script>
function cerrarPanel(element) {
    $(element).parent().parent().parent().parent()[0].style.display = 'none';
}
</script>
HTML;
        else
            $html .= <<<HTML
<script>
function cerrarPanel(element) {
    $(element).parent().parent().parent().parent().fadeOut();
}
</script>
HTML;

        return self::trimmedHtml($html);
    }

    /**
     * Return a Bootstrap Primary Panel.
     *
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
     *
     * @return string
     */
    public static function BootstrapPrimaryPanel($header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        return self::BootstrapPanel('primary', $header, $body, $footer, $closeable, $animate);
    }

    /**
     * Return a Bootstrap Success Panel.
     *
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
     *
     * @return string
     */
    public static function BootstrapSuccessPanel($header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        return self::BootstrapPanel('success', $header, $body, $footer, $closeable, $animate);
    }

    /**
     * Return a Bootstrap Info Panel.
     *
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
     *
     * @return string
     */
    public static function BootstrapInfoPanel($header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        return self::BootstrapPanel('info', $header, $body, $footer, $closeable, $animate);
    }

    /**
     * Return a Bootstrap Warning Panel.
     *
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
     *
     * @return string
     */
    public static function BootstrapWarningPanel($header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        return self::BootstrapPanel('warning', $header, $body, $footer, $closeable, $animate);
    }

    /**
     * Return a Bootstrap Danger Panel.
     *
     * @param string $header The header content.
     * @param string $body The body content.
     * @param string $footer The footer content.
     * @param bool $closeable Whether the header will show a span for close the panel or not, pulled to right side.
     * @param bool $animate Whether the panel will fade out smoothly in place of disappear suddenly.
     *
     * @return string
     */
    public static function BootstrapDangerPanel($header = 'Default Header', $body = 'Default Body......', $footer = "", $closeable = true, $animate = false)
    {
        return self::BootstrapPanel('danger', $header, $body, $footer, $closeable, $animate);
    }

    public static function LinkToFilesOfInterest($title = 'Default Title', $link = "", $linkText = '', $type = 'text')
    {
        if ($link == "") return false;

        $html = "";
        $slices = explode('/', $link);
        $fileName = str_replace('_', ' ', $slices[sizeof($slices) - 1]);
        $linkText = ($linkText != "" && isset($linkText)) ? $linkText : $fileName;

        if ($type == 'text' || $type == "") {
            $html = <<<HTML
<legend><small>{$title}</small></legend>
<ul><li><h5><a href="{$link}" class="text-primary">{$linkText}</a></h5></li></ul>
HTML;
        }

        if ($type == 'span') {
            $html = <<<HTML
<legend><small>{$title}</small></legend>
<ul><li><a href="{$link}" class="badge badge-primary">{$linkText}</a></li></ul>
HTML;
        }

        return self::trimmedHtml($html);
    }

    public static function MultiLinksToFiles($title = 'Default Title', $links = [], $type = 'text')
    {
        if (empty($links)) return false;

        $html = "<legend><small>{$title}</small></legend><ul>";
        foreach ($links as $link) {
            $slices = explode('/', $link);
            $fileName = str_replace('_', ' ', $slices[sizeof($slices) - 1]);
            $linkText = $fileName;

            if ($type == 'text' || $type == "") {
                $html .= "<li><h5><a href=\"{$link}\">{$linkText}</a></h5></li>";
            }

            if ($type == 'span') {
                $html .= "<li><a href=\"{$link}\" class=\"badge badge-primary\">{$linkText}</a></li>";
            }
        }
        $html .= "</ul>";

        return self::trimmedHtml($html);
    }

    public static function SuccessColorHex($lighting = false)
    {
        return $lighting ? "00C851" : "007E33";
    }

    public static function InfoColorHex($lighting = false)
    {
        return $lighting ? "33b5e5" : "0099CC";
    }

    public static function WarningColorHex($lighting = false)
    {
        return $lighting ? "ffbb33" : "33b5e5";
    }

    public static function DangerColorHex($lighting = false)
    {
        return $lighting ? "ff4444" : "CC0000";
    }

    public static function PrimaryColorHex($lighting = false)
    {
        return $lighting ? "4285F4" : "0d47a1";
    }

    /**
     * Returns the div with submit button autogenerated by GII by default.
     *
     * @param string $saveText
     * @param string $colorType
     * @param string $extraClass
     * @param array $data
     * @return string
     */
    public static function SubmitButton($saveText = "", $colorType = 'success', $extraClass = '', $data = [])
    {
        $action = \Yii::$app->controller->action;
        $saveText = ($saveText == "" || !isset($saveText)) ? ($action == 'create' ? "Crear" : "Guardar") : $saveText;
        $submitButton = Html::submitButton($saveText, ['class' => "btn btn-$colorType $extraClass", 'data' => $data]);
        $submitButtonField = <<<HTML
    <div class="form-group">
        {$submitButton}
    </div>
HTML;

        return self::trimmedHtml($submitButtonField);
    }
}
