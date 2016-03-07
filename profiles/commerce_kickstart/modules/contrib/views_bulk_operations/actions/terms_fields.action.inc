<?php

/**
 * @file
 * Implements node taxonomy terms modifications, based on taxonomy terms reference fields of selected nodes.
 * Values are distinct for each field (same for all node types/bundle).
 */

define('TAXOFIELDS_ACTION_REPLACE', 1);
define('TAXOFIELDS_ACTION_DELETE', 2);
define('TAXOFIELDS_ACTION_NO_CHANGE', 4);


function views_bulk_operations_terms_fields_action_info() {
  if (!(module_exists('taxonomy') && module_exists('entity'))) {
    return array();
  }
  return array(
    'views_bulk_operations_terms_fields_action' => array(
      'type' => 'entity',
      'label' => t('Modificar los términos de taxonomía del nodo.'),
      'behavior' => array('changes_taxonomy_terms'),
      'configurable' => FALSE,
      'vbo_configurable' => TRUE,
        'triggers' => array('any'),
    )
  );
}

function views_bulk_operations_terms_fields_action($entity, $params) {

  //dsm($entity);

  foreach($params['fields_actions'] as $field_name => $field_infos) {

    if (isset($entity->field_porcentaje_de_descuento)) {

      $field = $entity->field_porcentaje_de_descuento;

      $new_terms = array();
      foreach ($field_infos['terms'] as $term) {
        $new_terms[] = array('tid' => $term);
      }

      switch ($field_infos['do']) {

        case TAXOFIELDS_ACTION_REPLACE:
          $new_field = array();
          $new_field[LANGUAGE_NONE] = $new_terms;
          
          $entity->field_porcentaje_de_descuento = $new_field; 
          entity_save('commerce_product', $entity);
          break;

        case TAXOFIELDS_ACTION_DELETE:
          $entity->field_porcentaje_de_descuento = NULL;
          entity_save('commerce_product', $entity);
          break;
       
        default:
          break;
      }
    }
  }
  return TRUE;
}

function views_bulk_operations_terms_fields_action_form($context, &$form_state) { 

  //dsm($form_state);

  $fields = field_info_fields();
  $taxo_fields = array();
  
  foreach($fields as $field) {
    if ($field['type'] == 'taxonomy_term_reference' && $field['field_name'] == 'field_porcentaje_de_descuento') {
      foreach($field['bundles']['commerce_product'] as $bundle) {
        $taxo_fields[$field['field_name']] = $field;
      }
    }
  }
  
  $fields_list = array();
  
  $form = array();

  if (count($taxo_fields) > 0) {

    foreach ($taxo_fields as $taxo_field) {
    
      $vocabulary = $taxo_field['settings']['allowed_values'][0]['vocabulary'];
      $fields_list[] = $taxo_field['field_name'];
      
      $element = array(
	    '#type' => 'fieldset',
	    '#title' => t('Acciones disponibles', array('@field' => $taxo_field['field_name'])),
	    '#collapsible' => TRUE,
	    '#tree' => TRUE,
	    '#parents' => array(),
	  );  

      // We get the vocabulary ID of the current field
      $options = taxonomy_allowed_values($taxo_field);
      $field_form = array();
      $field_form['terms+'.$taxo_field['field_name']] = array(
        '#title' => t('Seleccione el descuento que desea aplicar',array('@vocabulary' => $vocabulary)),
        '#type' => 'select',
        '#options' => $options,
        '#multiple' => TRUE,
        '#size' => 8
      );
      $field_form['do+'.$taxo_field['field_name']] = array(
        '#type' => 'select',
        '#title' => t('Acción a llevar a cabo'),
        '#default_value' => isset($context['do']) ? $context['do'] : TAXOFIELDS_ACTION_NO_CHANGE,
        '#options' => array(
          TAXOFIELDS_ACTION_REPLACE => t('Reemplazar el descuento actual con el descuento seleccionado'), 
          TAXOFIELDS_ACTION_DELETE => t('Borrar los descuentos para los productos seleccionados'),
          TAXOFIELDS_ACTION_NO_CHANGE => t('No realizar ningún cambio')
        ),
        '#required' => TRUE,
        '#weight' => -2,
      );

      $element[] = $field_form;
      $form[] = $element;
    }
    $form['items_list'] = array(
      '#type' => 'hidden',
      '#value' => serialize($fields_list)
    );
    return $form;
  }
  return array();
}

function views_bulk_operations_terms_fields_action_submit($form, $form_state) {
  $result = array();
  foreach($form_state['values'][0] as $form_field_name => $value) {
    $field_infos = explode('+',$form_field_name);
    
    if (count($field_infos) == 2) {
      switch ($field_infos[0]) {
        case 'terms':
          $result[$field_infos[1]]['terms'] = $value;
          break;
        case 'do':
          $result[$field_infos[1]]['do'] = $value;
          break;
      }
    }
  }
  return array('fields_actions' => $result);
}

function views_bulk_operations_terms_fields__action_validate($form, $form_state) {
  // Let's suppose everything's fine for now
}
