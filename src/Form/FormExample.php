<?php

/**
* @file
 * Contains \Drupal\formexample\Form\FormExample.
 */

namespace Drupal\formexample\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FormExample extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'formexample_drupal8';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
    );
    $form['surname'] = array(
      '#type' => 'textfield',
      '#title' => t('Surname:'),
      '#required' => TRUE,
    );
    $form['age'] = array (
      '#type' => 'number',
      '#title' => t('Age:'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if ($form_state->getValue('age') < 18) {
        $form_state->setErrorByName('age', $this->t('Your age is under 18.'));
      }
    }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
   
        $values = array(
		'name' => $form_state->getValue('name'),
		'surname' => $form_state->getValue('surname'),
		'age' => $form_state->getValue('age'),		
	);

	$insert = db_insert('formexample')
		-> fields(array(
			'name' => $values['name'],
			'surname' => $values['surname'],
			'age' => $values['age'],
		))
		->execute();
	
	drupal_set_message(t('Ok, the fields have been saved'));

   // foreach ($form_state->getValues() as $key => $value) {
   //   drupal_set_message($key . ': ' . $value);
    }

}
