<?php


namespace App\Services;


class InputService
{
    /**
     * @param string $label|label
     * @param string $name|name
     * @param string $value
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function string($label, $name, $value = '')
    {
        return view('facades.input.string', compact('label', 'name', 'value'));
    }

    public function text($label, $name, $value = '')
    {
        return view('facades.input.text', compact('label', 'name', 'value'));
    }

    public function image($label, $initialPreview = null, $initialPreviewConfig = null)
    {
        $conf = $this->getConf($initialPreview, $initialPreviewConfig);

        return view('facades.input.image', ['label' => $label, 'conf' => $conf]);
    }

    public function ckeditor($label, $name, $value = '')
    {
        return view('facades.input.ckeditor', compact('label', 'name', 'value'));
    }

    public function switch($label, $name, $value = '')
    {
        return view('facades.input.switch', compact('label', 'name', 'value'));
    }

    public function images($label, $initialPreview = null, $initialPreviewConfig = null)
    {
        $conf = $this->getConf($initialPreview, $initialPreviewConfig);

        return view('facades.input.images', ['label' => $label, 'conf' => $conf]);
    }

    protected function getConf($initialPreview, $initialPreviewConfig)
    {
        if(isset($initialPreview) && isset($initialPreviewConfig)){
            $conf = "{
            theme: 'fas',
            language: 'ru',
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            overwriteInitial: false,
            initialPreviewAsData: true,
            uploadAsync: true,
            deleteExtraData: function() {
                        return {
                            _token: $(\"input[name='_token']\").val()
                        };
                    },
            initialPreview: " . $initialPreview->content() . ",
            initialPreviewConfig: " .  $initialPreviewConfig->content() . "}";
        } else {
            $conf = "{
            theme: 'fas',
            language: 'ru',
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg']}";
        }

        return $conf;
    }
}