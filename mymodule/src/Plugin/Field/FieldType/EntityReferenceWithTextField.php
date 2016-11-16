<?php

namespace Drupal\mymodule\Plugin\Field\FieldType;

use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Validation\Plugin\Validation\Constraint\AllowedValuesConstraint;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;
use Drupal\Component\Utility\Random;

/**
 * Defines the 'entity_reference_with_text_field' entity field type.
 *
 * Supported settings (below the definition's 'settings' key) are:
 * - target_type: The entity type to reference. Required.
 *
 * @FieldType(
 *   id = "entity_reference_with_textfield",
 *   label = @Translation("Entity reference with additional text field"),
 *   description = @Translation("An entity field containing an entity reference and a text field."),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_with_textfield_widget",
 *   default_formatter = "entity_reference_with_textfield_formatter",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList",
 * )
 */
class EntityReferenceWithTextField extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return array(
      'text' => '',
    ) + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['text'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Text Field'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $schema = parent::schema($field_definition);

    $schema['columns'] = array(
      'text' => array(
        'type' => 'varchar',
        'length' => 255,
      ),
      'target_id' => $schema['columns']['target_id'],
    );

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $values = parent::generateSampleValue($field_definition);
    $values['text'] = $random->sentences(2);
    return $values;
  }

}
