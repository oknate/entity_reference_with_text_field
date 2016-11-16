<?php

namespace Drupal\mymodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceEntityFormatter;

/**
 * Plugin implementation of the 'entity reference rendered entity' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_with_textfield_formatter",
 *   label = @Translation("Rendered entity with additional Textfield"),
 *   description = @Translation("Display the text field then the referenced entities rendered by entity_view()."),
 *   field_types = {
 *     "entity_reference_with_textfield"
 *   }
 * )
 */
class EntityReferenceWithTextField extends EntityReferenceEntityFormatter {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $settings = parent::defaultSettings();
    $settings['text'] = '';
    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);

    foreach ($elements as $delta => $element) {
      $additional_field = $items[$delta]->get('text')->getValue();
      $items = [];
      $items[] = array(
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $additional_field,
      );
      $items[] = $elements[$delta];
      $elements[$delta] = $items;
    }

    return $elements;
  }

}
