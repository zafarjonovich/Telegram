<?php


namespace zafarjonovich\Telegram\helpers;


use zafarjonovich\Telegram\Keyboard;

class Paginatator
{
    private $keyboard;

    private $pageIndexMask = false;

    private $prevButtonText = 'Prev page';

    private $nextButtonText = 'Next page';

    private $callbackDataCreater;

    private $minIndex;

    private $currentIndex;

    private $maxIndex;

    public function __construct(Keyboard $keyboard,\Closure $callbackDataCreater,int $minIndex,int $currentIndex,int $maxIndex)
    {
        $this->keyboard = $keyboard;

        $this->minIndex = $minIndex;

        $this->currentIndex = $currentIndex;

        $this->maxIndex = $maxIndex;

        $this->callbackDataCreater = $callbackDataCreater;
    }

    /**
     * @param $mask
     * @return $this
     */
    public function showPageIndex($mask)
    {
        $this->pageIndexMask = $mask;
        return $this;
    }

    public function setNavigationButtonTexts($prevButtonText,$nextButtonText)
    {
        if(!is_string($prevButtonText) or !is_string($nextButtonText))
            throw new \Exception('Texts must be string format');

        if(empty($prevButtonText) or empty($nextButtonText))
            throw new \Exception('Texts must not be empty');

        $this->prevButtonText = $prevButtonText;
        $this->nextButtonText = $nextButtonText;
    }

    public function create()
    {
        $keyboard = $this->keyboard;

        $callbackDataCreater = $this->callbackDataCreater;

        $prevIndex = $this->currentIndex == $this->minIndex ? $this->maxIndex : $this->currentIndex - 1;

        $nextIndex = $this->currentIndex == $this->maxIndex ? $this->minIndex : $this->currentIndex + 1;

        $keyboard->addCallbackDataButton(
            $this->prevButtonText,
            $callbackDataCreater($prevIndex)
        );

        if($this->pageIndexMask instanceof \Closure){

            $buttonMaskGenerator = $this->pageIndexMask;

            $keyboard->addCallbackDataButton(
                $buttonMaskGenerator([
                    'nextIndex' => $nextIndex ,
                    'prevIndex' => $prevIndex ,
                    'currentIndex' => $this->currentIndex ,
                    'minIndex' => $this->minIndex ,
                    'maxIndex' => $this->maxIndex ,
                ]),
                '-'
            );
        }

        $keyboard->addCallbackDataButton(
            $this->nextButtonText,
            $callbackDataCreater($nextIndex)
        );

        return $keyboard;
    }
}