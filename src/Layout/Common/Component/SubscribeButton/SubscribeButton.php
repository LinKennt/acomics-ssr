<?php
namespace Acomics\Ssr\Layout\Common\Component\SubscribeButton;

use Acomics\Ssr\Layout\AbstractComponent;

class SubscribeButton extends AbstractComponent
{
    public const TYPE_READER = 'reader';
    public const TYPE_CATALOG = 'catalog';
    
	private int $serialId;
	private bool $isSubscribed;
    private string $type;

	public function __construct(int $serialId, bool $isSubscribed, string $type = self::TYPE_READER)
	{
		$this->serialId = $serialId;
		$this->isSubscribed = $isSubscribed;
		$this->type = $type;
	}

	public function render(): void
	{
        $title = $this->isSubscribed ? 'Отписаться' : 'Подписаться';

		echo '<button class="subscribe-button ' . $this->type . '" data-is-subscribed="' . ($this->isSubscribed ? 1 : 0) . '" data-serial-id="' . $this->serialId . '" title="' . $title . '">';
		echo '<span class="caption caption-subscribe">Подписаться</span>';
		echo '<span class="caption caption-subscribed">В подписке</span>';
		echo '<span class="caption caption-unsubscribe">Отписаться</span>';
		echo '</button>'; // subscribe-button
	}
}
