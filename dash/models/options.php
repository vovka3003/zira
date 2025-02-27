<?php
/**
 * Zira project.
 * options.php
 * (c)2016 https://github.com/ziracms/zira
 */

namespace Dash\Models;

use Zira;
use Zira\Permission;

class Options extends Model {
    public function save($data) {
        if (!Permission::check(Permission::TO_CHANGE_OPTIONS)) {
            return array('error' => Zira\Locale::t('Permission denied'));
        }

        $form = new \Dash\Forms\Options();
        if ($form->isValid()) {
            $options = array(
                'timezone'=>'string',
                'watermark'=>'string',
                'watermark_enabled'=>'int',
                'date_format'=>'string',
                'datepicker_date_format'=>'string',
                'caching'=>'int',
                'cache_lifetime'=>'int',
                'clean_url'=>'int',
                'gzip'=>'int',
                'hide_file_path'=>'int',
                'db_translates'=>'int',
                'dash_panel_frontend' => 'int',
                'db_widgets_enabled' => 'int',
                'dashwindow_mode' => 'int',
                'dashwindow_maximized' => 'int',
                'watermark_margin' => 'int',
                'site_offline' => 'int',
                'captcha_type' => 'string',
                'recaptcha_site_key' => 'string',
                'recaptcha_secret_key' => 'string',
                'recaptcha3_site_key' => 'string',
                'recaptcha3_secret_key' => 'string',
                'recaptcha3_score' => 'float'
            );

            if (count(Zira\Config::get('languages'))>1) {
                $options['detect_language'] = 'int';
            }

            $config_ids = array();
            $user_configs = Zira\Models\Option::getCollection()->get();
            foreach($user_configs as $user_config) {
                $config_ids[$user_config->name] = $user_config->id;
            }

            foreach($options as $option=>$type) {
                if (!array_key_exists($option, $config_ids)) {
                    $optionObj = new Zira\Models\Option();
                } else {
                    $optionObj = new Zira\Models\Option($config_ids[$option]);
                }
                $optionObj->name = $option;
                $value = $form->getValue($option);

                if ($type=='int') $value=intval($value);
                else if ($type=='float') $value=floatval($value);

                $optionObj->value = $value;
                $optionObj->module = 'zira';
                $optionObj->save();

                if ($option=='caching') Zira\Config::set($option, $value);
            }

            Zira\Models\Option::raiseVersion();

            return array('message'=>Zira\Locale::t('Successfully saved'));
        } else {
            return array('error'=>$form->getError());
        }
    }
}