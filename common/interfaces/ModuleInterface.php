<?php

namespace common\interfaces;

interface ModuleInterface
{
    /**
     * Retorna los ítems de menú del módulo.
     * @return mixed
     */
    public static function getMenuItems();
}
