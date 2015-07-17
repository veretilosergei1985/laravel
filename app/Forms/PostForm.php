<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('publish', 'checkbox')
            ->add('save', 'submit', ['label' => 'Create']);
    }
}