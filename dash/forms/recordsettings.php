<?php
/**
 * Zira project.
 * recordsettings.php
 * (c)2016 http://dro1d.ru
 */

namespace Dash\Forms;

use Zira;
use Zira\Form;
use Zira\Locale;

class Recordsettings extends Form
{
    protected $_id = 'dash-recordsettings-form';

    protected $_label_class = 'col-sm-5 control-label';
    protected $_input_wrap_class = 'col-sm-7';
    protected $_input_offset_wrap_class = 'col-sm-offset-5 col-sm-7';

    protected $_checkbox_inline_label = false;

    public function __construct()
    {
        parent::__construct($this->_id);
    }

    protected function _init()
    {
        $this->setRenderPanel(false);
        $this->setFormClass('form-horizontal dash-window-form');
    }

    protected function _render()
    {
        $html = $this->open();
        $html .= $this->input(Locale::t('Thumbs width'), 'thumbs_width', array('placeholder'=>'50 - 500'));
        $html .= $this->input(Locale::t('Thumbs height'), 'thumbs_height', array('placeholder'=>'50 - 500'));
        $html .= $this->checkbox(Locale::t('Show slider'), 'slider_enabled', null, false);
        $html .= $this->checkbox(Locale::t('Show gallery'), 'gallery_enabled', null, false);
        $html .= $this->checkbox(Locale::t('Enable comments'), 'comments_enabled', null, false);
        $html .= $this->checkbox(Locale::t('Enable rating'), 'rating_enabled', null, false);
        $html .= $this->checkbox(Locale::t('Display author'), 'display_author', null, false);
        $html .= $this->checkbox(Locale::t('Display date'), 'display_date', null, false);
        $html .= $this->close();
        return $html;
    }

    protected function _validate() {
        $validator = $this->getValidator();

        $validator->registerNumber('thumbs_width',50,500,true,Locale::t('Invalid value "%s"',Locale::t('Thumbs width')));
        $validator->registerNumber('thumbs_height',50,500,true,Locale::t('Invalid value "%s"',Locale::t('Thumbs height')));
    }
}