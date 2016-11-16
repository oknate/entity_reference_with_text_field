<?php

namespace Drupal\mymodule\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;

/**
 * Plugin implementation of the 'entity_reference_with_textfield_autocomplete' widget.
 *
 * @FieldWidget(
 *   id = "entity_reference_with_textfield_widget",
 *   label = @Translation("Text field, Autocomplete"),
 *   description = @Translation("Text field and An autocomplete text field."),
 *   field_types = {
 *     "entity_reference_with_textfield"
 *   }
 * )
 */
class EntityReferenceWithTextFieldWidget extends EntityReferenceAutocompleteWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $title_element = array(
      '#title' => $element['#title'],
      '#type' => 'textfield',
      '#default_value' => $items[$delta]->get('text')->getValue(),
      '#size' => 60,
      '#placeholder' => '',
      '#maxlength' => 255,
    );

    $elements = parent::formElement($items, $delta, $element, $form, $form_state);

    $elements['target_id']['#title'] = t('Reference');
    $elements['target_id']['#title_display'] = 'before';

   // nprint($elements);

    return array(
      'text' => $title_element,
      'target_id' => $elements['target_id'],
    );
  }

}
