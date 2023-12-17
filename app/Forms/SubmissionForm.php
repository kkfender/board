<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SubmissionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => '題名',
                'rules' => 'required' 
            ])
            ->add('name', 'text', [
                'label' => '名前',
                'rules' => 'required'
            ])
            ->add('email', 'email', [
                'label' => 'メールアドレス',
                'rules' => 'required|email'
            ])
            ->add('location', 'text', [
                'label' => '場所`',
                'rules' => 'required',
            ])
            ->add('body', 'textarea', [
                'label' => '本文',
                'rules' => 'required',
            ])
            ->add('operation_key', 'text', [
                'label' => '編集削除キー',
                'rules' => 'required',
            ])
            ->add('submit', 'submit', ['label' => '保存']);
    }
}