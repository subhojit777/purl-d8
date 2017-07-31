<?php

namespace Drupal\purl\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Scheduled message item annotation object.
 *
 * @see plugin_api
 *
 * @Annotation
 */
class PurlProvider extends Plugin
{
  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

    public function __construct($values)
    {
        parent::__construct($values);

        if (!isset($this->definition['label'])) {
            $id = preg_replace('/([^a-zA-Z0-9])+/', ' ', $this->definition['id']);
            $this->definition['label'] = ucwords($id);
        }
    }
}
