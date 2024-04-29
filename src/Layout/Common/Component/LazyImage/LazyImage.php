<?php

namespace Acomics\Ssr\Layout\Common\Component\LazyImage;

use Acomics\Ssr\Layout\AbstractComponent;

class LazyImage extends AbstractComponent
{
	private string $src;
	private string $stubSrc;
	private int $width;
	private int $height;
	private string $alt;
	private ?string $class;
	private ?array $otherAttributes;

	public function __construct(
		string $src,
		string $stubSrc,
		int $width,
		int $height,
		string $alt,
		?string $class = null,
		?array $otherAttributes = null,
	)
	{
		$this->src = $src;
		$this->stubSrc = $stubSrc;
		$this->width = $width;
		$this->height = $height;
		$this->alt = $alt;
		$this->class = $class;
		$this->otherAttributes = $otherAttributes;
	}

	public function render(): void
	{
		if ($this->src === $this->stubSrc)
		{
			$this->renderNormal();
		}
		else
		{
			$this->renderLazy();
		}
	}

	private function renderNormal()
	{
		echo '<img ' .
			'src="' . $this->src . '" ' .
			'width="' . $this->width . '" ' .
			'height="' . $this->height . '" ' .
			'alt="' . $this->alt . '" ' .
			'style="' . $this->style() . '" ' .
			($this->class !== null ? 'class="' . $this->class . '" ' : '') .
			$this->otherAttributesString() .
			'>';
	}

	private function renderLazy()
	{
		echo '<img ' .
			'src="' . $this->stubSrc . '" ' .
			'data-real-src="' . $this->src . '"' .
			'width="' . $this->width . '" ' .
			'height="' . $this->height . '" ' .
			'alt="' . $this->alt . '" ' .
			'style="' . $this->style() . '" ' .
			'class="' . ($this->class ? $this->class . ' ' : '') . 'lazy-image"' .
			$this->otherAttributesString() .
			'>';
	}

    private function style(): string
    {
        return 'aspect-ratio: calc(' . $this->width .' / ' . $this->height .'); max-width: ' . $this->width . 'px';
    }

	private function otherAttributesString(): string
	{
		if ($this->otherAttributes === null) {
			return '';
		}

		$result = '';
		foreach ($this->otherAttributes as $name => $value)
		{
			if ($value !== null)
			{
				$result .= $name . '="' . $value . '" ';
			}
		}
		return $result;
	}
}
