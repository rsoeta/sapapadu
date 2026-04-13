<?php
function app_config($key)
{
    $model = new \App\Models\AppConfigModel();
    return $model->getValue($key);
}
